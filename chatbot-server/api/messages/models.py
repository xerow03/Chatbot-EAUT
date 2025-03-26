from pydantic import BaseModel
from ..config.pyobject import PyObjectId
from typing import Optional
from datetime import datetime
from pydantic import BaseModel, Field
from ..config.database import db
from pymongo import TEXT
from pymongo.collection import Collection
from enum import Enum

class SenderEnum(Enum):
     USER = "USER"
     BOT = "BOT"
     
# Users Model
class Messages(BaseModel):
     id: Optional[PyObjectId] = Field(alias="_id", default=None)
     conversation: Optional[PyObjectId] = Field()
     message: str = Field(default=None)
     sender: SenderEnum
     send_at: datetime = Field(default=datetime.now())
     updated_at: datetime = Field(default=datetime.now())
     
# ALTER
collection: Collection = db['messages']
collection.create_index([("message", TEXT)])
