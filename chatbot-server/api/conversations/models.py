from pydantic import BaseModel
from ..config.pyobject import PyObjectId
from typing import Optional
from datetime import datetime
from pydantic import BaseModel, Field

# Delete Conversation Model
class DeleteConversations(BaseModel):
     user_id: str
     ids: list[str]

# Add Conversations Model
class AddConversations(BaseModel):
     user_id: str
     name: str
     desc: str

# Users Model
class Conversations(BaseModel):
     id: Optional[PyObjectId] = Field(alias="_id", default=None)
     user_id: Optional[PyObjectId] = Field()
     name: str = Field()
     soft_delete: bool = Field(default=False)
     desc: str = Field(default=None)
     message: Optional[PyObjectId] = Field()
     last_message: Optional[PyObjectId] = Field(default=None)
     created_at: datetime = Field(default=datetime.now())
     updated_at: datetime = Field(default=datetime.now())
