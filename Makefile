# 開発環境を起動する
start:
	docker-compose up -d

# laravelのコンテナの中に入る
ssh:
	docker exec -it laravel-study bash

# 開発環境を停止する
stop:
	docker-compose down

# 開発環境をリビルドする
build:
	docker-compose build --no-cache

# Dockerコンテナの起動状況を一覧する
ps:
	docker ps
