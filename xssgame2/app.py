from flask import Flask, request, render_template

app = Flask(__name__)

FLAG = "kitsec{xss_game2}"

def custom_escape(user_input):
    replacements = {
        "<": "&lt;",
        ">": "&gt;",
        "&": "&amp;",
        '"': "&quot;",
        "'": "&#x27;",
        "/": "&#x2F;"
    }
    
    for key, value in replacements.items():
        user_input = user_input.replace(key, value)
    return user_input

@app.route('/', methods=['GET', 'POST'])
def index():
    result = None
    if request.method == 'POST':
        user_input = request.form.get('input')

        safe_input = custom_escape(user_input)
        
        result = f"<p>Your input: {safe_input}</p>"

        if "<script>" in user_input:
            result += f"<p>You cannot fire XSS</p>"

    return render_template('index.html', result=result)

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
