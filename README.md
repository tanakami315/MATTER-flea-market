# アプリケーション名
 Flea Market

## 概要
ユーザーが会員登録することで商品の出品、購入ができるフリマアプリです。

## 環境構築
・Dockerビルド
- git clone git@github.com:tanakami315/MATTER-flea-market.git
- docker-compose up -d --build

・Laravel環境構築
- docker-compose exec php bash
- composer install
- cp .env.example .env,
- .env ファイルの環境変数を変更
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan storage:link

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/index.php

## 実行環境
- PHP 8.5.3
- Laravel Framework 8.83.8
- MariaDB 11.8.6
- nginx 1.21.1

## 使用技術
- Laravel Fortify
- Livewire
- Tailwind CSS
- Blade
- CSS

## ER図
![ER図](ER.png)