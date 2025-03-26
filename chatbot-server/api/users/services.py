from fastapi import HTTPException, status
from ..config.database import db
from ..users.models import Users
from datetime import datetime
import bcrypt

# Auth Services
class UsersServies:
    def __init__(self) -> None:
        # Collection
        self.collection = db.get_collection("users")

    # Create User
    def create(self, user: Users) -> bool:
        # Exception
        try:
            # Find user
            finded = self.collection.find_one({"email": user["email"]})

            # User is valid
            if finded:
                # Raise error
                raise HTTPException(
                    status_code=status.HTTP_400_BAD_REQUEST,
                    detail="Địa chỉ email này đã được đăng ký.",
                    headers={"WWW-Authenticate": "Bearer"},
                )
            
            # Hashed
            hashed = bcrypt.hashpw(user["password"].encode('utf-8'), bcrypt.gensalt())
            
            # Hash password
            user["password"] = hashed.decode('utf-8')
            
            # Created
            user["created_at"] = datetime.now()
            
            # Updated
            user["updated_at"] = datetime.now()
            
            # Insert User
            self.collection.insert_one(user)
            
            # Return
            return True
        except Exception as e: raise e

    # Get user
    def get(self, email: str) -> Users:
        # Get User
        user: Users = self.collection.find_one({"email": email})

        # Check user is valid
        if not user:
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_404_NOT_FOUND,
                detail="Không tìm thấy tài khoản trên hệ thống.",
                headers={"WWW-Authenticate": "Bearer"},
            )

        # Return
        return user


# User Services Export
users_services = UsersServies()
