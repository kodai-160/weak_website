from flask import Flask, request, abort, render_template, redirect, url_for
import os

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('menu.html')

@app.route('/file')
def file():
    file_name = request.args.get('file_name')
    if not file_name:
        return "<h1>Error: No file specified</h1>", 400
    
    prices = {
        "item1.txt": "600",
        "item2.txt": "400",
        "item3.txt": "400",
        "item4.txt": "450",
        "item5.txt": "650",
        "item6.txt": "600",
        "item7.txt": "1210",
        "item8.txt": "600",
        "item9.txt": "600",
    }
    
    try:
        file_path = f"./src/public/{file_name}"
        print(f"Attempting to open file: {file_path}")
        
        with open(file_path, "r", encoding="utf-8") as f:
            data = f.read()
            
        image_name = file_name.rsplit('.', 1)[0] + ".jpg"
        image_path = url_for('static', filename=f'images/{image_name}')
        price = prices.get(file_name, "未定")    
            
        return render_template('file.html', file_name=file_name, data=data, image_path=image_path, price=price)

    except FileNotFoundError:
        return "<h1>Error: File not found</h1>", 404
    except Exception as e:
        return f"<h1>Error</h1><p>{e}</p>"


if __name__ == '__main__':
    flag_value = os.environ.get('FLAG', 'DEFAULT_FLAG')
    
    os.makedirs('./src/secret', exist_ok=True)
    
    with open('./src/secret/flag', mode='w', encoding='UTF-8') as f:
        f.write(flag_value)
        
    app.run(host='0.0.0.0', port=80)