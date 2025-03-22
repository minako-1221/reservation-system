# Rese（リーズ）

グループ会社の飲食店予約サービス

![Home Screen](./images/home_screen.png)


## 概要説明

外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい


## 環境構築

**Docker ビルド**

1. リポジトリをクローンする

```bash
`git clone git@github.com:minako-1221/reservation-system.git`
```

2. DockerDesktop アプリを立ち上げる
3. Docker コンテナをビルド

```bash
`docker-compose up -d --build`
```

**Laravel 環境構築**

1. PHP コンテナに入る

```bash
docker-compose exec php bash
```

2. Composer で必要なパッケージをインストール

```bash
composer install
```

3. `.env`ファイルを作成

```bash
cp .env.example .env
```

4. `.env`ファイルに以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```


## 使用技術（実行環境）

- PHP:8.3.13
- Laravel:8.83.27
- Composer:2.8.0
- MySQL:8.0.26
- Nginx:1.21.1


## ER 図

![ER Diagram](./images/Rese.drawio.png)


## URL

- 開発環境：http://localhost/
- phpMyAdmin:http://localhost:8080/


## 使用方法

### 会員登録

1. 会員登録画面にアクセスする

```bash
http://localhost/register
```

2. 必要な情報（名前、メールアドレス、パスワード）を入力する
3. 会員登録ボタンを押す
4. 登録が完了するとサンクスページが表示される

```bash
http://localhost/thanks
```

5. サンクスページのログインするボタンを押すとログイン画面に遷移する


### ログイン

1. ログイン画面にアクセスする

```bash
http://localhost/login
```

2. 登録したメールアドレスとパスワードを入力する
3. ログインボタンを押す
4. ログインに成功するとホーム画面にリダイレクトされる


### ホーム画面

**店舗一覧表示**

1. カード形式で店舗一覧が表示される

**検索機能**

1. エリア、ジャンルは選択式で検索可能
2. 店舗名は部分一致、完全一致で検索可能

**お気に入り機能**

1. カード右下にグレーのハートボタンを配置
2. ハートボタンをクリックすると色がピンクに替わり、お気に入り追加
3. 再度クリックするとグレーに戻り、お気に入り削除


### 店舗詳細ページ

**店舗詳細表示**

1. 画面左側に表示（店舗名、画像、エリア、ジャンル、店舗説明）

**予約機能**

1. 画面右側に表示
2. 日付、時間、人数を選択して予約するボタンを押す
3. 予約が完了すると予約完了ページが表示される

```bash
http://localhost/done
```

4. 戻るボタンを押すと店舗詳細ページに遷移され、予約リストが追加される


### マイページ

**予約リスト**

1. 左側にログインユーザーと紐づく有効な予約リストを表示
2. リスト右上の×印クリックで予約の削除

**お気に入りリスト**

1. 右側にログインユーザーと紐づくお気に入り店舗リストを表示
2. ハートボタンをクリックするとお気に入り登録解除


### ログアウト

1. ナビゲーションメニューの「logout」をクリックする
2. ログアウト後はログイン画面にリダイレクトされる


### 注意事項

**ログインしていない時**

- ホーム画面のカード右下のハートボタンは非表示
- 店舗詳細ページ右側の予約機能の予約するボタンは無効
