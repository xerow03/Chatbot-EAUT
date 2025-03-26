from fastapi.testclient import TestClient

from api.main import app

client = TestClient(app)


# Test login
def test_login():
    # Response
    response = client.post(
        "/auth/login", json={"email": "vietbao2k2@gmail.com", "password": "123456"}
    )

    # Assert Status
    assert response.status_code == 200, response.text
