from pydantic import BaseModel
from ..config.pyobject import PyObjectId
from typing import Optional
from datetime import datetime
from pydantic import BaseModel, Field
from enum import Enum

class WarehouseIntent(Enum):
     TEACHER = "TEACHER"
     INFRASTRUCTURE = 'INFRASTRUCTURE'
     REGULATIONS = 'REGULATIONS'
     STUDY = 'STUDY'
     
# Add Warehouse Model
class AddWarehouse(BaseModel):
     intent: str
     question: str
     answer: str

# Warehouse Model
class Warehouse(BaseModel):
     id: Optional[PyObjectId] = Field(alias="_id", default=None)
     intent: WarehouseIntent
     question: str = Field(default=None)
     answer: str = Field(default=None)
     send_at: datetime = Field(default=datetime.now())
     updated_at: datetime = Field(default=datetime.now())

