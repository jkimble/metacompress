# metacompress

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
