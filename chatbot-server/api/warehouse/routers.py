from fastapi import APIRouter, status
from ..config.database import db
from ..core.response import HTTPResponse
from .schemas import list_warehouse_individual_serial
from .services import warehouse_services
from .models import AddWarehouse

# Collection
collection = db.get_collection("warehouse")

# Router
router = APIRouter(
    prefix="/warehouse",
    tags=["warehouse"],
)

# [POST] /create
@router.post("/create", status_code=status.HTTP_201_CREATED)
async def get(body: AddWarehouse):
    # Parse
    dump = body.model_dump()

    # Created
    created = warehouse_services.create(dump["intent"], dump["question"], dump["answer"])
    
    # Return
    return HTTPResponse(data=created)

# [GET] /page
@router.get("/page", status_code=status.HTTP_200_OK)
async def page(page: int = 0):
     # Get Page
    page = list_warehouse_individual_serial(warehouse_services.page(page))
    
    # Return    
    return HTTPResponse(data=page)