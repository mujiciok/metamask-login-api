## About 

"Metamask login API" is an example of integration of metamask login in a Laravel project. It serves as an API for the "Metamask login VUE" project.

###Features to be implemented:

- [x] Authentication with Metamask 
- [x] NFT store (file upload + DB insert)
- [ ] NFT collection implementation (ERC-1155)
- [ ] File storage in IPFS 
- [x] Metadata store per NFT
- [x] Metadata json file generation
- [ ] Metadata json file generation based on provider structure (e.g. Opensea)
- [ ] Solidity contract generation
- [ ] Solidity contract deployment

## Init

Clone project
```
git@github.com:mujiciok/metamask-login-api.git
```
Navigate to project folder
```
cd metamask-login-api
```
Init docker
```
git submodule init
git submodule update
```
Navigate to docker folder
```
cd ./laradock
```
Generate docker `.env` file
```
cp .env.example .env
```
Update .env (change constants below)
```
COMPOSE_PROJECT_NAME=crypto-api
...
PHP_VERSION=8.0
...
MYSQL_DATABASE=crypto
MYSQL_USER=root
MYSQL_PASSWORD=root
```
Build docker containers (nginx, php-fpm, mysql, phpmyadmin, workspace)
```
docker-compose up -d nginx php-fpm mysql phpmyadmin workspace
```
Enter workspace
```
docker-compose exec workspace bash
```
Generate project `.env` file
```
cp .env.example .env
```
Install dependencies
```
composer install --ignore-platform-reqs
```
Set permissions
```
chmod -Rf 755 bootstrap/cache
chmod -Rf 755 storage
```
Generate app key
```
art key:generate
```
Generate storage link
```
art storage:link
```
