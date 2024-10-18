# ベースとなるイメージを指定
FROM python:3.9-slim

# 作業ディレクトリを設定
WORKDIR /app

# アプリケーションのファイルをコンテナにコピー
COPY . /app

# 依存パッケージをインストール
RUN pip install -r requirements.txt

# コンテナが起動する際に実行するコマンド
CMD ["python", "app.py"]