from flask import Flask, request, abort, render_template, render_template_string
import os

app = Flask(__name__)

DATA_DIR = os.path.join(os.path.dirname(os.path.abspath(__file__)), "data")
FLAG_FILE = os.path.join(os.path.dirname(os.path.abspath(__file__)), "flag.txt")

@app.route('/')
def index():
    return render_template('menu.html')

@app.route('/view/<item_id>')
def view_item(item_id):
    file_path = os.path.join(DATA_DIR, f"{item_id}.txt")
    
    try:
        if not os.path.isfile(file_path):
            abort(404)
        
        with open(file_path, 'r', encoding="utf-8_sig") as f:
            description = f.read()
        
        return render_template_string('item.html', title=item_id.capitalize(), description=description)
    
    except Exception as e:
        return f"Error: {e}"
    
@app.route('/flag')
def flag():
    try:
        with open(FLAG_FILE, 'r') as f:
            return f"FLAG: {f.read()}"
    except:
        abort(404)

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)