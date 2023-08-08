![Logo](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/th5xamgrr6se0x5ro4g6.png)

# Perdinku

Sebuah aplikasi yang digunakan untuk melakukan pengelolaan perjalanan dinas (perdin) pegawai dalam sebuah perusahaan. Aplikasi ini ditujukan untuk mencatat perjalanan dinas dan besaran nominal
uang saku yang diberikan kepada pegawai selama tugas untuk dinasnya.

## Clone

```bash
git clone https://github.com/rikhoari01/rikhoari01.git
cd perdin
```


## Installation

Gunakan PHP versi 8.1 ke atas.

```bash
composer install
cp .env.example .env
php artisan key:generate
```

## Database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perdin
DB_USERNAME=root
DB_PASSWORD=
```

``` bash
php artisan migrate --seed
```

## Run Server

``` bash
php artisan serve
```

## Credentials

#### Admin
```
Username : admin001 | Password : 12345678
```

#### Divisi SDM
```
Username : sdm001 | Password : 12345678
```

#### Pegawai
```
Username : pegawai001 | Password : 12345678
```

## License

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)