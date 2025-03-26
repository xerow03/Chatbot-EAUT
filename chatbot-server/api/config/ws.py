from fastapi import WebSocket, WebSocketDisconnect
from fastapi.responses import HTMLResponse
from ..messages.schemas import mess_individual_serial
from ..messages.services import messages_services
from ..messages.schemas import mess_individual_serial
from datetime import datetime
import requests

# Fake Data
fake_bot_data = {
    "_id": "toichachatbot",
    "message": "Xin chào bạn tôi là CHATBOT",
    "sender": "BOT",
    "send_at": str(datetime.now()),
    "updated_at": str(datetime.now()),
}

class ConnectionManager:
    def __init__(self):
        self.active_connections: list[WebSocket] = []

    async def connect(self, websocket: WebSocket):
        await websocket.accept()
        print('Connect')
        self.active_connections.append(websocket)

    def disconnect(self, websocket: WebSocket):
        self.active_connections.remove(websocket)

    async def send_personal_message(self, message: dict, websocket: WebSocket):
        await websocket.send_json(message)
# Manager
manager = ConnectionManager()

# Message
async def ws_chats(websocket: WebSocket):
    # Connect
    await manager.connect(websocket)
    
    # Exception
    try:
        while True:
            # Get Message
            message = await websocket.receive_json()
            
            # Insert Message
            user_inserted = mess_individual_serial(messages_services.create(
                message["message"], message["sender"], message["conversation"]
            ))
            
            print(user_inserted)
            
            # Check inserted user
            if user_inserted:
                # Request
                req = requests.post(
                    "http://localhost:5005/webhooks/rest/webhook", 
                    json={
                        "sender": message["sender"],
                        "message": message["message"]
                    }
                )
                
                # Response to json
                res = req.json()
                
                # Convert res to a dictionary if it's not already
                if isinstance(res, list):
                    # Assuming you want the first element of the list
                    res = res[0]
                
                
                # Insert Message
                bot_inserted = mess_individual_serial(messages_services.create(
                    res["text"], "BOT", message["conversation"]
                ))
                
                # Send user chats
                await manager.send_personal_message(bot_inserted, websocket)
            
    except WebSocketDisconnect:
        # Disconnect
        manager.disconnect(websocket)


