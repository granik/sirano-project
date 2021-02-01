#!/bin/bash

source .env-dev

# Starting the project.
docker-compose stop && docker-compose up -d --build || exit 1;

sleep 5

# Import DB dump.
docker-compose exec -iT mysql mysql -uroot -p"$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE" < "./docker/mysql/$MYSQL_DATABASE.sql" \
&& echo "========= DB Import DONE ==========" || exit 1;

# Composer Install.
docker-compose exec php composer install \
&& echo "========= Composer Install DONE ============="
