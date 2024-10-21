# 🍎🥕 Fruits and Vegetables - Answer - Minh Vu (Kai)

### 🏃‍♂️ Running containers
```bash
docker-compose -f ./docker/docker-compose.yml up -d --build
docker-compose -f ./docker/docker-compose.yml exec php composer install
docker-compose -f ./docker/docker-compose.yml exec php bin/console doctrine:schema:create
docker-compose -f ./docker/docker-compose.yml exec php bin/console doctrine:schema:update --force
# Open http://127.0.0.1:8080 in your browser
# Use postman collection in root folder for manual testing purpose
# Testing screenshots are in screenshots folder
```

### 🏃‍♂️ Running storage service
```bash
docker-compose -f ./docker/docker-compose.yml exec php bin/console app:store-items
```

### 🛂 Running tests
```bash
docker-compose -f ./docker/docker-compose.yml exec php bin/console doctrine:schema:update --force --env=test
docker-compose -f ./docker/docker-compose.yml exec php vendor/bin/phpunit
```
