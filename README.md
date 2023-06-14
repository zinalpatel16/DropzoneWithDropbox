# Dropzone with Dropbox Package

##### Dropzone file upload with dropbox.

Live url : (https://packagist.org/packages/hcipl/dropzone-with-dropbox)

## Usage
1. Install the package: "composer require hcipl/dropzone-with-dropbox".
2. Configure your database ".env" file.
3. The first thing you need to do is get an authorization token at Dropbox. Unlike [other companies](https://google.com) Dropbox has made this very easy. You can just generate a token in the [App Console](https://www.dropbox.com/developers/apps) for any Dropbox API app. You'll find more info at [the Dropbox Developer Blog](https://blogs.dropbox.com/developers/2014/05/generate-an-access-token-for-your-own-account/).
4. Set dropbox configuration on your .env file
5. Configure Dropbox as Driver in AppServiceProvider.php 

```php
    public function boot()
    {
    	
        Storage::extend('dropbox', function (Application $app, array $config) {

            $adapter = new DropboxAdapter(new DropboxClient(
                $config['authorization_token']
            ));
   
            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
```    

6. Add a new driver on the config/filesystems.php inside "disks".

	'dropbox' => [
        'driver' => 'dropbox',
        'key' => env('DROPBOX_APP_KEY'),
        'secret' => env('DROPBOX_APP_SECRET'),
        'authorization_token' => env('DROPBOX_AUTHORIZATION_TOKEN', null),
        'case_sensitive' => true,
    ]

7. Run migration: "php artisan migrate"
8. Run project server "php artisan serve",
9. Test url "http://127.0.0.1:8000/image/index"

## Views Modification
###### In order to modify the dropzone:
1. Select the option which depicts "Provider:Hcipl\dropzoneWithDropbox\DropzoneWithDropboxServiceProvider".
2. Run below command to publish the assests.
php artisan vendor:publish --tag=public --force
