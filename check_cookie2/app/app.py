from flask import Flask, request, redirect, make_response, render_template
import base64
import json

app = Flask(__name__)

FLAG = "kitsec{check_cookie2_base64}"

@app.route('/')
def index():    
    return render_template('normal.html')

@app.route('/vip')
def vip():
    cookie = request.cookies.get('session')
    
    if not cookie:
        return render_template('error.html', messeage="Cookieが見つかりません")
    
    try:
        decoded_cookie = base64.b64decode(cookie).decode()
        user_data = json.loads(decoded_cookie)
        
    except Exception as e:
        return render_template('error.html', message="Cookieが無効です")
    
    if user_data.get("role") == "vip":
        return render_template('vip.html', flag=FLAG)
    else:
        return render_template('error.html', message="権限がありません")
    
@app.route('/login', methods=['POST'])
def login():
    username = request.form.get('username', 'guest')
    role = 'normal'
    
    if username == "admin":
        role = "normal"
        
    cookie_data = {
        "username":username,
        "role":role
    }
    encoded_cookie = base64.b64encode(json.dumps(cookie_data).encode()).decode()
    
    response = make_response(redirect('/vip'))
    response.set_cookie('session', encoded_cookie, httponly=True)
    return response

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)