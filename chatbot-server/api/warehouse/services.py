from fastapi import HTTPException, status
from ..config.database import db
from datetime import datetime
from .models import Warehouse
from .models import WarehouseIntent


class WarehouseServices:
    def __init__(self) -> None:
        # Collection
        self.collection = db.get_collection("warehouse")

    # Get cvs
    def get(self, id: str) -> Warehouse:
        # Get User
        whd: Warehouse = self.collection.find_one({"_id": id})

        # Check warehose data is valid
        if not whd:
            # Raise Error
            raise HTTPException(
                status_code=status.HTTP_404_NOT_FOUND,
                detail="Không tìm thấy dữ liệu câu hỏi.",
                headers={"WWW-Authenticate": "Bearer"},
            )

        # Return
        return whd

    # Create
    def create(self, intent: WarehouseIntent, question: str, answer: str) -> Warehouse:
        # Exception
        try:
            # Template
            template = {
                "answer": answer,
                "intent": intent,
                "question": question,
                "created_at": datetime.now(),
                "updated_at": datetime.now(),
            }

            # Insert User
            inserted = self.collection.insert_one(template)

            # Check
            if not inserted:
                # Raise error
                raise HTTPException(
                    status_code=status.HTTP_400_BAD_REQUEST,
                    detail="Xảy ra lỗi khi thêm câu hỏi vào kho dữ li.",
                    headers={"WWW-Authenticate": "Bearer"},
                )

            # Convert to string
            template["_id"] = str(inserted.inserted_id)

            # Return
            return template

        except Exception as e:
            raise e

    # Page
    def page(self, page: int) -> list[Warehouse]:
        # Finded with page
        finded = self.collection.find().skip(page * 10).limit(10)
        
        print(finded)

        # Get Page
        return list(finded)


# Warehouse Services Export
warehouse_services = WarehouseServices()
