from ..messages.schemas import mess_individual_serial

# User Individual Serial
def warehouse_individual_serial(data) -> dict:
     # Return
     return {
          "_id": str(data["_id"]),
          "intent": str(data["intent"]),
          "question": data["question"],
          "answer": data["answer"],
          "created_at": data["created_at"],
          "updated_at": data["updated_at"],
     }

# User Individual Serial
def list_warehouse_individual_serial(data) -> list:
     return [warehouse_individual_serial(x) for x in data]
