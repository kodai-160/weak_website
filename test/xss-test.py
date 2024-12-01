from flask import Flask, request, render_template_string

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def xss_demo():
    user_input = ""
    if request.method == 'POST':
        user_input = request.form.get('user_input', '')

    template = f"""
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>XSS Demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h1 class="text-center">XSS Demonstration</h1>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="user_input" class="form-label">Enter something:</label>
                            <input type="text" name="user_input" id="user_input" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>

            <div class="mt-4 card shadow">
                <div class="card-header bg-secondary text-white">
                    <h2>Output:</h2>
                </div>
                <div class="card-body">
                    <p>{user_input}</p>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    """
    return render_template_string(template)

if __name__ == '__main__':
    app.run(debug=True)
