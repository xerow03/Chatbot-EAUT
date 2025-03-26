from .models import Messages
from fastapi import HTTPException, status
from ..config.database import db
from datetime import datetime
from bson import ObjectId

class MessagesServices:
    def __init__(self) -> None:
        # Collection
        self.collection = db.get_collection("messages")
        self.cvs_collection = db.get_collection("conversations")

    # Create
    def create(self, message: str, sender: str, cvs_id: str) -> Messages:
          # Exception
          try:
               # Template
               template = {
                    "conversation": ObjectId(cvs_id),
                    "message": message,
                    "sender": sender,
                    "send_at": datetime.now(),
                    "updated_at": datetime.now(),
               }

               # Insert Message
               inserted = self.collection.insert_one(template)

               # Check
               if not inserted:
                    # Raise error
                    raise HTTPException(
                         status_code=status.HTTP_400_BAD_REQUEST,
                         detail="Xảy ra lỗi khi gửi tin nhắn.",
                         headers={"WWW-Authenticate": "Bearer"},
                    )

               # Convert to string
               template["_id"] = str(inserted.inserted_id)

               # Convert to string
               template["conversation"] = str(template["conversation"])
               
               # Set last message
               self.cvs_collection.find_one_and_update(
                    {"_id": ObjectId(cvs_id)},
                    {"$set": {"last_message": template, "updated_at": datetime.now()}}
               )

               # Return
               return template

          except Exception as e: raise e

    # Page
    def page(self, page: int, cvs_id: str) -> list[Messages]:
          # Limit
          limit = 15
          
          # Finded with page limit 15
          finded = (
               self.collection.find({ "conversation": ObjectId(cvs_id)})
               .sort("send_at", -1)
               .skip(page * limit)
               .limit(limit)
          )
          
          # Get Page
          return list(finded)

# Messages Services Export
messages_services = MessagesServices()
