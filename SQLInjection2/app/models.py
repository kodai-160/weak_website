import sqlite3

# データベース初期化
def init_db():
    conn = sqlite3.connect("database/users.db")
    cur = conn.cursor()

    cur.execute('''
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            password TEXT NOT NULL
        )
    ''')

    cur.execute('INSERT INTO users (username, password) VALUES (?, ?)', ("admin", "admin123"))
    cur.execute('INSERT INTO users (username, password) VALUES (?, ?)', ("user1", "pass1"))
    cur.execute('INSERT INTO users (username, password) VALUES (?, ?)', ("user2", "pass2"))

    conn.commit()
    conn.close()

def validate_user(username, password):
    conn = sqlite3.connect("database/users.db")
    cur = conn.cursor()
    cur.execute('SELECT * FROM users WHERE username = ? AND password = ?', (username, password))
    user = cur.fetchone()
    conn.close()
    return user
