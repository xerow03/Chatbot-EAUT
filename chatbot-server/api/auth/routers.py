from fastapi import APIRouter, status, HTTPException
from .services import auth_services
from ..users.services import users_services
from .models import AuthRequest, RegisterRequest
from api.core.response import HTTPResponse
from ..users.schemas import users_individual_serial
from ..core.jwt import jwt
import requests

# Router
router = APIRouter(
    prefix="/auth",
    tags=["auth"],
)

# [POST] /login
@router.post("/login", status_code=status.HTTP_200_OK)
async def login(body: AuthRequest):
    # Parse
    dump = body.model_dump()
    
    # Authenticate user
    user = auth_services.authenticate(dump["email"], dump["password"])
    
    # Check user is valid
    if not user:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Sai thông tin đăng nhập hoặc mật khẩu.",
            headers={"WWW-Authenticate": "Bearer"},
        )
        
    # Access Token
    token = jwt.create_access_token(data={"sub": user["email"]})
    
    # Parse user data
    parse = users_individual_serial(user)
    
    # Response data
    response: dict = {
        "token": token,
        "user": parse
    }
    
    # Return
    return HTTPResponse(data=response)

# [POST] /register
@router.post("/register", status_code=status.HTTP_201_CREATED)
def register(body: RegisterRequest):
    # Parse
    dump = body.model_dump()
    
    # Check password and confirm match
    if dump["password"] != dump["confirm"]:
        # Raise Error
        raise HTTPException(
            status_code=status.HTTP_400_BAD_REQUEST,
            detail="Mật khẩu nhập lại và mật khẩu khác nhau.",
            headers={"WWW-Authenticate": "Bearer"},
        )
    
    # Delete field confirm
    del dump['confirm']
    
    # Create user
    users_services.create(dump)
    
    # Return
    return HTTPResponse(detail="Đăng ký thành công.")
