from flask import Flask, request, render_template
import sqlite3

app = Flask(__name__)

# SQLiteデータベースの初期化
def init_db():
    conn = sqlite3.connect('database.db')
    c = conn.cursor()
    c.execute('''
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            password TEXT NOT NULL
        )
    ''')
    c.execute("INSERT INTO users (username, password) VALUES ('admin', 'FLAG{sql_injection_success}')")
    c.execute("INSERT INTO users (username, password) VALUES ('user', 'user_password')")
    conn.commit()
    conn.close()

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/search', methods=['POST'])
def search():
    username = request.form['username']
    conn = sqlite3.connect('database.db')
    c = conn.cursor()
    
    # SQL Injection 脆弱性のあるコード
    query = f"SELECT password FROM users WHERE username = '{username}'"
    c.execute(query)
    result = c.fetchone()
    conn.close()
    
    if result:
        return f"Password: {result[0]}"
    else:
        return "User not found"

if __name__ == '__main__':
    init_db()
    app.run(host='0.0.0.0', port=5000)
