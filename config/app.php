<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Data Perusahaan / Instansi
    |--------------------------------------------------------------------------
    |
    |
    */

    'url_google_maps' => 'https://maps.app.goo.gl/PeYkKNb1meHFXygm6',
    'notelepon' => '+03619008200',
    'wa' => '+6282340530800',
    'fb' => '',
    'ig' => 'https://www.instagram.com/rural_bali_adventure/',
    'tiktok' => '',
    'x' => '',
    'youtube' => 'https://www.youtube.com/@RuralBaliAdventure',
    'email' => 'ruralbaliadventure@gmail.com',
    'webname' => 'Posyandu Ramah Ibu dan Anak',
    'tagline' => 'Melayani dengan Hati, Menjaga Generasi Negeri',
    'kodepos' => '80572',
    'title' => 'Rural Bali Adventure',
    'alamat2' => 'Bali, Kab.Gianyar, Kec.Gianyar 80572',
    'alamat' => 'Br.Begawan, Payangan',
    'webcreator' => 'Bali Coding | balicoding.com',
    'webdesc' => 'Posyandu - "Sehat Bersama, Tumbuh Bahagia". Tempat terbaik untuk pemantauan tumbuh kembang anak, imunisasi, dan edukasi kesehatan keluarga. Dikelola oleh kader lokal, Posyandu hadir untuk mendukung generasi sehat dari desa',
    'angkatan' => 2025,
    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    'aliases' => Facade::defaultAliases()->merge([
        'Pagination' => 'App\Lib\Pagination',
        'Option' => 'App\Lib\Option',
        'GetString' => 'App\Lib\GetString',
        'IDateTime' => 'App\Lib\IDateTime',
        'ImageUtils' => 'App\Lib\ImageUtils',
    ])->toArray(),

];
