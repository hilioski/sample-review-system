#!/usr/bin/env sh

script_path="$0"
env_dir="$(dirname $script_path)"
cd "$env_dir"
cd ../../

docker run --name="nginx-proxy" --restart=always --userns="host" -d -p 80:80 -v /var/run/docker.sock:/tmp/docker.sock:ro jwilder/nginx-proxy || true
docker network create simple-review-system || true
docker network connect simple-review-system nginx-proxy || true

cp environments/development/docker-compose.development.yml ./docker-compose.yml
cp environments/development/.env.development .env

docker-compose build
docker-compose run --rm phpfpm composer install
docker-compose run --rm phpfpm php artisan key:generate
docker-compose run --rm phpfpm php artisan jwt:secret
docker-compose run --rm phpfpm php artisan migrate
docker-compose run --rm phpfpm php artisan db:seed

docker-compose up -d
