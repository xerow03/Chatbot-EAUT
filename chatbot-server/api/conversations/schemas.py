from ..messages.schemas import mess_individual_serial

# User Individual Serial
def cvs_individual_serial(data) -> dict:
     # Last message
     last_message = None
     
     # Check last message
     if data["last_message"] is not None:
          last_message = mess_individual_serial(data["last_message"])
          
     # Return
     return {
          "_id": str(data["_id"]),
          "name": data["name"],
          "desc": data["desc"],
          "user_id": str(data["user_id"]),
          "soft_delete": data["soft_delete"],
          "last_message": last_message,
          "created_at": data["created_at"],
          "updated_at": data["updated_at"],
     }

# User Individual Serial
def list_cvs_individual_serial(data) -> list:
     return [cvs_individual_serial(x) for x in data]
