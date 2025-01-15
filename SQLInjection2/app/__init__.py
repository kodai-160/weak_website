from flask import Flask
from .routes import app as routes_blueprint  # Blueprint をインポート

def create_app():
    app = Flask(__name__)
    app.secret_key = 'hello'  # セッション用の秘密鍵
    app.register_blueprint(routes_blueprint)  # Blueprint を登録
    return app
