from fastapi import FastAPI, status
from .auth import routers as auth_router
from .users import routers as user_router
from .conversations import routers as cvs_router
from .messages import routers as messages_router
from .warehouse import routers as warehouse_router
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import JSONResponse
from .config.ws import ws_chats

# App
app = FastAPI()

# CORS Middleware
app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "http://localhost:3005",
    ],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


# Auth Middlware
# @app.middleware("http")
# Auth Middleware
async def auth_middleware(request, call_next):
    # Path
    path = request.url.path

    # Response next
    response = await call_next(request)

    return response

    # Check path
    if path.startswith("/auth") or path.startswith("/sockets"):
        # Next
        response = await call_next(request)
    else:
        if "Authorization" not in request.headers:
            # Raise Error
            return JSONResponse(
                status_code=status.HTTP_401_UNAUTHORIZED,
                content={"detail": "Không có quyền truy cập tài nguyên này"},
            )

        # Response next
        response = await call_next(request)
    return response


# Includes websocket
app.websocket("/ws/{client_id}")(ws_chats)

# Includes routes
for route in [auth_router, user_router, cvs_router, messages_router, warehouse_router]:
    app.include_router(route.router)
