from flask import Flask, render_template, request, jsonify

app = Flask(__name__)

FLAG = "FLAG{you_reached_1000_clicks}"

@app.route('/')
def index():
    return render_template('click.html')

@app.route('/check_flag')
def check_flag():
    count = request.args.get('count', type=int, default=0)
    if count >= 1000:
        return jsonify({"success": True, "flag": FLAG})
    return jsonify({"success": False})

if __name__ == '__main__':
    app.run(debug=True)