from pydantic import BaseModel
from ..config.pyobject import PyObjectId
from typing import Optional
from datetime import datetime
from pydantic import BaseModel, Field, EmailStr
from enum import Enum

class GenderEnum(Enum):
     MALE = "MALE"
     FEMALE = "FEMALE"
     OTHER = "OTHER"

# Users Model
class Users(BaseModel):
     id: Optional[PyObjectId] = Field(alias="_id", default=None)
     email: EmailStr = Field()
     firstname: str = Field()
     lastname: str = Field()
     avatar: str = Field()
     password: str = Field()
     gender: GenderEnum
     created_at: datetime = Field(default=datetime.now())
     updated_at: datetime = Field(default=datetime.now())