from typing import Optional

def HTTPResponse(data: Optional[dict] = None, detail: Optional[str] = None):
     
     # If  has data and no detail
     if(data is not None and detail): return {"data": data, "detail": detail}
     
     # If no detail
     if(detail is not None and not data): return {"detail": detail}
     
     # If no data
     if(data is not None and not detail): return {"data": data}