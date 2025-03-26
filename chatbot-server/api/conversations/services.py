from .models import Conversations
from fastapi import HTTPException, status
from ..config.database import db
from datetime import datetime
from bson import ObjectId


class ConversationsServies:
    def __init__(self) -> None:
        # Collection
        self.collection = db.get_collection("conversations")
        
        # Message Collection
        self.mess_collection = db.get_collection("messages")

    # Get cvs
    def get(self, id: str) -> Conversations:
        # Get User
        cvs: Conversations = self.collection.find_one({"_id": id})

        # Check user is valid
        if not cvs:
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_404_NOT_FOUND,
                detail="Không tìm thấy cuộc hội thoại.",
                headers={"WWW-Authenticate": "Bearer"},
            )

        # Return
        return cvs

    # Create
    def create(self, name: str, desc: str, user_id: str) -> Conversations:
        # Exception
        try:
            # Template
            template = {
                "name": name,
                "desc": desc,
                "user_id": ObjectId(user_id),
                "soft_delete": False,
                "last_message": None,
                "created_at": datetime.now(),
                "updated_at": datetime.now(),
            }

            # Insert User
            inserted = self.collection.insert_one(template)

            # Check
            if not inserted:
                # Raise error
                raise HTTPException(
                    status_code=status.HTTP_400_BAD_REQUEST,
                    detail="Xảy ra lỗi khi tạo hội thoại.",
                    headers={"WWW-Authenticate": "Bearer"},
                )

            # Convert to string
            template["_id"] = str(inserted.inserted_id)

            # Convert to string
            template["user_id"] = str(template["user_id"])

            # Return
            return template

        except Exception as e:
            raise e

    # Page
    def page(self, page: int, user_id: str) -> list[Conversations]:
        # Finded with page
        finded = (
            self.collection.find({"user_id": ObjectId(user_id), "soft_delete": False})
            .skip(page * 10)
            .limit(10)
        )

        # Get Page
        return list(finded)

    # Soft delete
    def soft_delete(self, ids: list[str], user_id: str) -> int:
        # Excetion
        try:
            # Ids to ObjectId
            obj_ids = [ObjectId(id) for id in ids]

            # Deleted
            deleted = self.collection.delete_many(
                {"_id": {"$in": obj_ids}, "user_id": ObjectId(user_id)}
            )

            # Check deleted
            if deleted.deleted_count == 0:
                # Raise error
                raise HTTPException(
                    status_code=status.HTTP_400_BAD_REQUEST,
                    detail="Xảy ra lỗi khi xoá các cuộc trò chuyện.",
                    headers={"WWW-Authenticate": "Bearer"},
                )

            # Convert to string
            result = deleted

            # Message deleted
            mes_deleted = self.mess_collection.delete_many(
                {"conversation": {"$in": obj_ids}}
            )

            # Return
            return mes_deleted.deleted_count != 0
        except:
            # Raise error
            raise HTTPException(
                status_code=status.HTTP_400_BAD_REQUEST,
                detail="Xảy ra lỗi khi xoá các cuộc trò chuyện.",
                headers={"WWW-Authenticate": "Bearer"},
            )


# Conversation Services Export
cvs_services = ConversationsServies()
