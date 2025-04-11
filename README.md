# Chatbot EAUT

## Yêu cầu môi trường
- Python 3.10
- Hai môi trường ảo riêng biệt:
    - Một cho thư mục `chatbot-server/api`
    - Một cho thư mục `chatbot-server/rasa`

## 1. Hướng dẫn cài đặt

### 1.1. Cài đặt môi trường cho API
1. Di chuyển vào thư mục `chatbot-server/api`:
     ```sh
     cd chatbot-server/api
     ```
2. Tạo và kích hoạt môi trường ảo:
     ```sh
     python -m venv venv
     source venv/bin/activate  # Trên Linux/MacOS
     venv\Scripts\activate     # Trên Windows
     ```
3. Cài đặt các thư viện cần thiết:
     ```sh
     pip install -r requirements.txt
     ```

### 1.2. Cài đặt môi trường cho Rasa
1. Di chuyển vào thư mục `chatbot-server/rasa`:
     ```sh
     cd chatbot-server/rasa
     ```
2. Tạo và kích hoạt môi trường ảo:
     ```sh
     python -m venv venv
     source venv/bin/activate  # Trên Linux/MacOS
     venv\Scripts\activate     # Trên Windows
     ```
3. Cài đặt các thư viện cần thiết:
     ```sh
     pip install -r requirements.txt
     ```

## 2. Huấn luyện và chạy Chatbot
1. Huấn luyện Chatbot:
     ```sh
     rasa train
     ```
2. Chạy Chatbot:
     ```sh
     rasa shell
     ```