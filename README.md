# metacompress

[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2Fb26539a6-4555-4de7-b742-e7d5a3dc1aba%3Fdate%3D1&style=flat-square)](https://forge.laravel.com/servers/884649/sites/2612538)

A hobby image compression and conversion web app using [Intervention Image](https://intervention.io/).

## Usage

Laravel, composer, tailwind and yarn (or npm) are all required.

#### Install composer packages:

```
composer install
```

#### Install yarn packages and build styles:

```
yarn; yarn build
```

## Storage

Images are temporarily saved within local storage and deleted immediately after an event most of the time.
Local storage can be deleted with:

```
php artisan cleanup:storage
```
