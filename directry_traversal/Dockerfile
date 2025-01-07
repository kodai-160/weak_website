# ベースイメージとして Python を使用
FROM python:3.9-slim

# 作業ディレクトリを設定
WORKDIR /app

# 必要なファイルをコピー
COPY requirements.txt requirements.txt
COPY . .

# パッケージをインストール
RUN pip install --no-cache-dir -r requirements.txt

# Flaskアプリを起動
CMD ["python", "app.py"]
