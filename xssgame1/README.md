実行手順
1. DockerImageをビルドする
`docker build -t xssgame1 .`
2. コンテナを起動する
`docker run -p 5001:5000 xssgame1`
3. 立ち上がったサイトにアクセスする
`http://<IPアドレス>/:5001`
