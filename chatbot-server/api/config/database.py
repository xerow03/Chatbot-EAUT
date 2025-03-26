from pymongo import MongoClient
from pymongo import TEXT

# URL
URI = "mongodb://localhost:27017/"

# Create new client and connect to server
client = MongoClient(URI)

# DB
db = client.get_database("chatbots")

# Loop
for collection in ["messages", "conversations", "users", "warehouse"]:
     # Check and create collection
     if collection not in db.list_collection_names():
          # Create Collection
          db.create_collection(collection)

# Conversation Index
db["conversations"].create_index([("name", TEXT)])

# Message Index
db["messages"].create_index([("message", TEXT)])

# Send a ping to confirm a successfully connection
try:
     # Ping server
     client.admin.command("ping")
     
     # Print
     print("Kết nối thành công!")
except Exception as e:
     # Print error
     print(e)