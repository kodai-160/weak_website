from flask import Flask, request, render_template

app = Flask(__name__)

FLAG = "FLAG{XSS_success}"

@app.route('/', methods=['GET', 'POST'])
def index():
    result = None
    if request.method == 'POST':
        user_input = request.form.get('input')
        result = f"<p>Your input: {user_input}</p>"

        if "<script>" in user_input:
            result += f"<p>Congratulations! Here is your flag: {FLAG}</p>"

    return render_template('index.html', result=result)

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
