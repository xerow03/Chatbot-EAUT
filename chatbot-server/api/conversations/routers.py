from fastapi import APIRouter, status
from .services import cvs_services
from .models import AddConversations, DeleteConversations
from ..core.response import HTTPResponse
from .schemas import list_cvs_individual_serial

# Router
router = APIRouter(
    prefix="/conversations",
    tags=["conversations"],
)


# [POST] /create
@router.post("/create", status_code=status.HTTP_201_CREATED)
async def get(body: AddConversations):
    # Parse
    dump = body.model_dump()

    # Created
    created = cvs_services.create(dump["name"], dump["desc"], dump["user_id"])
    
    # Return
    return HTTPResponse(data=created)

# [GET] /page
@router.get("/page", status_code=status.HTTP_200_OK)
async def page(page: int = 0, user_id: str = None):
    # Check user id
    if user_id is not None:
        # Get Page
        page = list_cvs_individual_serial(cvs_services.page(page, user_id))
        
        # Return    
        return HTTPResponse(data=page)


# [PUT] /soft_delete
@router.put("/soft_delete", status_code=status.HTTP_200_OK)
async def soft_delete(body: DeleteConversations):
    # Dump
    dump = body.model_dump()
    
    # Check user id
    if dump["user_id"]:
        # Soft delete
        soft_delete = cvs_services.soft_delete(dump["ids"], dump["user_id"])
        
        # Return    
        return HTTPResponse(data=soft_delete)