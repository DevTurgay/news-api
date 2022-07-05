# News API

This is a PHP (Laravel) project developed to simulate a News API.
## Installation


```bash
git clone https://github.com/DevTurgay/news-api.git
```

## Installation (2 Versions)

Update .env file

### 1. Via artisan on local

### Required PHP Extensions:
1. BCMath
2. Ctype
3. JSON
4. Mbstring
5. OpenSSL
6. PDO
7. Tokenizer
8. XML

[Get composer](https://getcomposer.org/download/)


```bash
#composer update
composer update

# install packages
composer install

# Create/Migrate Db
php artisan migrate

# Generate project key
php artisan key:generate

# Start the server
php artisan serve
```
### 2. Via docker

Update docker-compose.yml for db credentials (related to .env)

```bash
# Run docker-compose.yaml
docker-compose up
```

## Usage
Just browse the root directory of server (localhost:8000/)

Please make sure to update tests as appropriate.

### Documentation
API Documentation can be found under:
https://documenter.getpostman.com/view/21783624/UzJHPcLo

### Live mode
You can try the API under:
http://153.92.221.35/

<p align="right">(<a href="#top">back to top</a>)</p>
