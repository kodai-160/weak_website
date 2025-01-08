from flask import Flask, request, redirect, render_template, abort, url_for

app = Flask(__name__)

@app.route('/login', methods=['GET', 'POST'])
def login():
    error = None
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        if username == "admin" and password == "pass":
            return "Login succuessful!"
        else:
            error = "Invalid credentials. please try again"
    return render_template('login.html', error=error)

@app.route('/admin')
def admin():
    abort(403)
    
@app.route('/admin/flag')
def flag():
    return render_template('flag.html')

@app.route('/robots.txt')
def robot():
    return """
        User-agent: *
        Disallow: /admin/
    """, 200, {'Content-type': 'text/plain'}
    
@app.route('/')
def index():
    return redirect(url_for('login'))

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)