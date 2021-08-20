$ symfony new symfony-rest-api
$ cd symfony-rest-api
$ symfony serve -d --no-tls

$ composer require api
$ composer require migrations
$ composer require symfony/string
$ composer require symfony/maker-bundle --dev

# config/packages/api_platform.yaml
api_platform:
    title: 'Symfony REST API'
    description: 'A Symfony API to manage a simple blog app.'
    version: '1.0.0'
    mapping:
        paths: ['%kernel.project_dir%/src/Entity']
    patch_formats:
        json: ['application/merge-patch+json']
    swagger:
        versions: [3]

$ php bin/console make:entity
$ php bin/console make:user

```php
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 */

/**
 * @Groups("user:write")
 *
 * @SerializedName("password")
 */
```

$ composer require jwt-auth
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

```php
###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=
###< lexik/jwt-authentication-bundle ###
```