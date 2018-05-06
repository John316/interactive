FROM phpdockerio/php71-fpm:latest
WORKDIR "/application"

RUN apt-get update && \
    apt-get install -y unzip && \
	apt-get install -y supervisor && \
	apt-get install -y libzip-dev && \
	apt-get install -y libpng-dev && \
	apt-get install -y wget && \
    apt-get -y install git && \
    apt-get -y install cron && \
    apt-get -y install php7.1-sqlite3 php7.1-pdo  php7.1-mysql && \
    apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY ./ /application

RUN php composer.phar update && chmod -R 777 . && php composer.phar dump-autoload

RUN (crontab -l ; echo "* * * * * /usr/local/bin/php /application/artisan schedule:run >>/dev/null 2>&1") | crontab

EXPOSE 9090

CMD cp ./.env.example ./.env; php artisan l5-swagger:generate; service supervisor start; service cron start; chmod -R 777 .; php-fpm
