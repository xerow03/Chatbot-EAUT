from ..users.services import users_services
from fastapi import HTTPException, status
from ..users.models import Users
import bcrypt

# Auth Services
class AuthServices:
     def __init__(self) -> None:
          # User services
          self.users_servies = users_services
          
     # Verify Password
     def verify_password(self, plain_password, hashed_password) -> bool:
          # Exception
          try:
               # Hashed
               hashed = bcrypt.checkpw(plain_password.encode('utf-8'), hashed_password.encode('utf-8'))
               
               # Return
               return hashed
          except:
            # Raise Error
               raise HTTPException(
                    status_code=status.HTTP_400_BAD_REQUEST,
                    detail="Xảy ra lỗi khi kiểm tra mật khẩu.",
                    headers={"WWW-Authenticate": "Bearer"},
               )
          
          
     # Authenticate
     def authenticate(self, email: str, password: str) -> Users | bool:
          # Finding User
          user: Users = users_services.get(email)
          
          # Check user is valid
          if not user: return False
               
          # Verify password
          if not self.verify_password(password, user["password"]): 
               # Raise Error
               raise HTTPException(
                    status_code=status.HTTP_400_BAD_REQUEST,
                    detail="Mật khẩu không đúng.",
                    headers={"WWW-Authenticate": "Bearer"},
               )
               
          # Delete field password
          del user["password"]
          
          # Return
          return user
# aut Services Export
auth_services = AuthServices()