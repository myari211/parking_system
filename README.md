
# PARKING SYSTEM BACKEND TEST

Parking system is made for testing for PT Xylo Solusi Indonesia. Using Laravel V7, MySQL




## Installation

Install my-project with composer

###### After u clone the Repo

```bash
composer Install

```

###### Generate Key
```bash
php artisan key:generate

```

###### Migrating Database and seeder
```bash
php artisan migrate:fresh --seed

```

###### Create New Token for Laravel Passport
```bash
php artisan passport:install

```

    


## API Reference

#### Login Petugas


#### PS: Copy paste token after login to your Authorization API Test

```http
  POST /api/login
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `Email` | `string` | **Required**. `petugas@parking.com` |
| `Password`| `string` | **Required**. `petugasParking`|

#### Login Admin

```http
  POST /api/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `Email` | `string` | **Required**. `admin@parking.com` |
| `Password`| `string` | **Required**. `adminParking`|

#### Log Out
```http
  POST /api/logout
```

## Petugas

#### Gate In

```http
  POST /api/petugas/gate/in
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `no_pol` | `string` | **Required** |


#### Gate Out

```http
  POST /api/petugas/gate/out
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `unique_key` | `string` | **Required**|

#### Generate Gate Out

```http
  POST /api/petugas/gate/generate
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `no_pol` | `string` | **Required**.|
| `tap_in`| `datetime` | **Required**. `Ex:22/07/2022 15:00:00`|

## Admin

#### Report

```http
  POST /api/admin/report
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `start_date` | `datetime` | `Ex:22/07/2022` |
| `end_date` | `datetime` | `Ex:22/07/2022` |
## Authors

- [@ari_pratama04](https://www.github.com/myari211)

