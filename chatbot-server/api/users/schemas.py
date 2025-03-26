# User Individual Serial
def users_individual_serial(data) -> dict:
     # Return
     return {
          "_id": str(data["_id"]),
          "email": data["email"],
          "firstname": data["firstname"],
          "lastname": data["lastname"],
          "avatar": data["avatar"],
          "gender": data["gender"],
          "created_at": data["created_at"],
          "updated_at": data["updated_at"],
     }
