import os
import sys
from pydantic import BaseModel
from jose import jwt as jwt_instance
from datetime import datetime, timedelta, timezone


class Token(BaseModel):
    access_token: str
    expiration: str
    
# Token Class
class JWT:
    def __init__(self) -> None:
          # Secret Key
          self.SECRET_KEY = "tshus.access_token_key.dvb28"

          # ALGORITHM
          self.ALGORITHM = "HS256"

          # Expitation time
          self.ACCESS_TOKEN_EXPIRE_MINUTES = 60

    # Create access tokenß
    def create_access_token(self, data: dict):
        # Encode data
        to_encode = data.copy()
        
        # Excpires delta
        expire_delta = timedelta(minutes=self.ACCESS_TOKEN_EXPIRE_MINUTES)
        
        # Create time
        expire = datetime.now(timezone.utc) + expire_delta

        # Push data to token expiration
        to_encode.update({"exp": expire})

        # Encode
        encoded_jwt = jwt_instance.encode(
            to_encode, self.SECRET_KEY, algorithm=self.ALGORITHM
        )

        # Return
        return encoded_jwt
           
jwt = JWT()
