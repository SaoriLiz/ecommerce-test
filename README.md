# Eshop

## Installation

### Clone the repository

```bash
git clone https://github.com/webforcehq/ecommerce-test.git
```
### Change to directory project

```bash
cd ecommerce-test
```

### Install dependencies

```bash
composer install
npm install
```

### Copy the .env file and generate the key application

```bash
cp .env.example .env
php artisan key:generate
```

### Create a new mysql database and modify the .env file with the database data

```bash
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=myeshop
DB_USERNAME=root
DB_PASSWORD=
```

### Migrate the database, with the default users

```bash
php artisan migrate --seed
```

### Install passport

```bash
php artisan passport:install
```

### Compile the frontend app files

```bash
npm run dev
```

### Run and test

```bash
php artisan serve
```

#### You can login with this credentials

```bash
user: admin
password:secret

user:user
password:secret
```
