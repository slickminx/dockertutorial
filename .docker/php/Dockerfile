FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo_mysql

#PHP needs the pdo_mysql extension in order to read from a MySQL database. Although it doesn't come with the official image, the Docker Hub description provides some instructions to install PHP extensions easily. At the top of our Dockerfile, we indicate that we start from the official image, and we proceed with installing pdo_mysql with a RUN command. And that's it! Next time we start our containers, Docker Compose will pick up the changes and build a new image based on the recipe we gave it.