from pydantic import BaseModel, field_validator
from ..users.models import Users
from ..common.enum.gender import GenderEnum
from fastapi import HTTPException, status
from ..core.jwt import Token
import re


# Auth Request Model
class AuthRequest(BaseModel):
    email: str
    password: str

    @field_validator("email")
    def validate_email(cls, email):
        if not (email and re.match(r"^[\w\.-]+@[\w\.-]+\.\w+$", email)):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Định dạng Email không đúng",
            )
        # Return
        return email

    @field_validator("password")
    def validate_password(cls, v):
        if not (v and re.match(r"^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{6,}$", v)):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Mật khẩu phải ít nhất 6 ký tự, bao gồm chữ số, số, chữ hoa, chữ thường, kí tự đặc biệt",
            )
        # Return
        return v


# Auth Response Model
class AuthResponse(BaseModel):
    token: Token
    user: Users


# Resgister Request Model
class RegisterRequest(BaseModel):
    email: str
    password: str
    confirm: str
    firstname: str
    lastname: str
    avatar: str
    gender: str

    @field_validator("email")
    def validate_email(cls, email):
        if not (email and re.match(r"^[\w\.-]+@[\w\.-]+\.\w+$", email)):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Định dạng Email không đúng",
            )
        # Return
        return email

    @field_validator("password")
    def validate_password(cls, v):
        if not (v and re.match(r"^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{6,}$", v)):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Mật khẩu phải ít nhất 6 ký tự, bao gồm chữ số, số, chữ hoa, chữ thường, kí tự đặc biệt",
            )
        # Return
        return v

    @field_validator("confirm")
    def validate_confirm(cls, confirm, values):
        # Request password
        res_password = values.data.get("password")

        # Check confirm
        if not (res_password and confirm == res_password):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Mật khẩu nhập lại không trừng khớp",
            )
        # Return
        return confirm

    @field_validator("firstname")
    def validate_firstname(cls, firstname, values):
        # Check firstname
        if not (firstname and len(firstname) > 0):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Họ đệm không được trống",
            )
        # Return
        return firstname

    @field_validator("lastname")
    def validate_lastname(cls, lastname, values):
        # Check lastname
        if not (lastname and len(lastname) > 0):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Tên không được trống",
            )
        # Return
        return lastname

    @field_validator("gender")
    def validate_gender(cls, gender, values):
        # Check gender
        if not gender:
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Giới tính không được trống",
            )
        elif gender not in list(GenderEnum):
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_409_CONFLICT,
                detail="Giới tính không hợp lệ",
            )
        # Return
        return gender
