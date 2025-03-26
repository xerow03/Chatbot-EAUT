from fastapi import APIRouter, status
from .services import messages_services
from ..core.response import HTTPResponse
from .schemas import list_mess_individual_serial
# Router
router = APIRouter(
    prefix="/messages",
    tags=["messages"],
)

# [GET] /page
@router.get("/page", status_code=status.HTTP_200_OK)
async def page(page: int = 0, cvs_id: str = None):
    # Check user id
    if cvs_id is not None:
        # Get Page
        page = list_mess_individual_serial(messages_services.page(page, cvs_id))
        
        # Return    
        return HTTPResponse(data=page)