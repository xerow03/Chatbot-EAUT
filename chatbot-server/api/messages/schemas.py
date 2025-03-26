# User Individual Serial
def mess_individual_serial(data) -> dict:
    return {
        "_id": str(data["_id"]),
        "conversation": str(data["conversation"]),
        "message": data["message"],
        "sender": data["sender"],
        "send_at": str(data["send_at"]),
        "updated_at": str(data["updated_at"]),
    }


# User Individual Serial
def list_mess_individual_serial(data) -> list:
    return [mess_individual_serial(x) for x in data]
