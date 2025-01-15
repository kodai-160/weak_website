from flask import Blueprint, request, render_template, redirect, url_for, session
import sqlite3

# Blueprint を定義
app = Blueprint('app', __name__)

# データベース接続関数
def get_db():
    conn = sqlite3.connect("database/users.db")
    conn.row_factory = sqlite3.Row
    return conn

# フィルタルールの定義
FILTER_RULES = {
    "level1": [],
    "level2": ["or"],
    "level3": ["or", "and", "=", "like", "--"],
    "level4": ["or", "and", "=", "like", "--", "union", "admin"],
    "level5": ["or", "and", "=", "like", "--", "union", "admin", "SELECT", "INSERT"]
}

@app.route('/')
def index():
    return render_template('home.html')

# フィルタルールを表示するエンドポイント
@app.route('/filter', methods=['GET'])
def filter_rules():
    level = request.args.get('level')  # レベルをクエリパラメータから取得
    if level:
        filters = FILTER_RULES.get(f"level{level}")
        if filters is None:
            return f"No filters found for level {level}.", 404
        # 特定レベルのフィルタを表示
        return render_template('filter.html', level=level, filters=filters)
    else:
        # 全フィルタを表示
        return render_template('filter.html', filters=FILTER_RULES)

# 各レベルの問題を解くためのエンドポイント
@app.route('/level<int:level>', methods=['GET', 'POST'])
def level(level):
    if level not in range(1, 6):  # 無効なレベルの場合
        return "Invalid level.", 404

    # セッションからクリア済みレベルを取得
    cleared_levels = session.get('cleared_levels', [])
    if level > 1 and (level - 1) not in cleared_levels:
        # 前のレベルをクリアしていない場合はリダイレクト
        return redirect(url_for('app.level', level=level - 1))

    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        filters = FILTER_RULES[f"level{level}"]

        # フィルタルールのチェック
        for rule in filters:
            if rule.lower() in username.lower() or rule.lower() in password.lower():
                return f"Input contains forbidden keyword: {rule}", 400

        # SQLクエリを実行
        query = f"SELECT * FROM users WHERE username = '{username}' AND password = '{password}';"
        conn = get_db()
        cur = conn.cursor()
        try:
            cur.execute(query)
            user = cur.fetchone()
            if user:
                # レベルクリアをセッションに記録
                if level not in cleared_levels:
                    cleared_levels.append(level)
                    session['cleared_levels'] = cleared_levels

                # 次のレベルへリダイレクト
                if level < 5:
                    return redirect(url_for('app.level', level=level + 1))
                else:
                    return "Congratulations! You have completed all levels!"
            else:
                return "Invalid credentials."
        except sqlite3.Error as e:
            return f"SQL Error: {e}"

    # レベルのログインページを表示
    return render_template('login.html', level=level)

# セッションをリセットするエンドポイント
@app.route('/reset')
def reset_progress():
    session.pop('cleared_levels', None)  # クリア済み情報をリセット
    return redirect(url_for('app.level', level=1))
