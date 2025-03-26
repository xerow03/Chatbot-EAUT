from fastapi import APIRouter, status
from ..config.database import db
from .models import Users

# Collection
collection = db.get_collection("users")

# Router
router = APIRouter(
    prefix="/users",
    tags=["users"],
)

# [POST] /get
@router.get("/get", response_model=Users, status_code=status.HTTP_200_OK)
async def get():
     # Date
     user : dict = collection.find_one({"email": "vietbao2k2@gmail.com"})
     
     # Return
     return user
