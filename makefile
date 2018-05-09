docker_name = janado-php-fpm
docker_webserver = janado-webserver
docker_mysql = janado-mysql
docker_image = restapiskeletonlaravel55_php-fpm

help: #prints list of commands
	@cat ./makefile | grep : | grep -v "grep"

show_containers: #start docker container #
	@sudo sudo docker ps

start: #start docker container #
	@sudo docker-compose up -d

stop: #stop docker container
	@sudo docker-compose down

remove: #remove docker image
	@sudo docker-compose down; sudo docker rmi -f $(docker_image)

composer_update: #update vendors
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar update && chmod -R 777 . && php composer.phar dump-autoload'

composer_dump: #update vendors
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload'

set_env: #set default environments
	@cp ./.env.example ./.env

create_controller: #create controller name=[controllerName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:controller $(name) && chmod -R 777 .'

create_resource: #create controller name=[controllerName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:controller $(name) --resource && chmod -R 777 .'

create_model: #create model name=[modelName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:model "Models\$(name)" -m && chmod -R 777 .'

create_seeder: #create seeder name=[seederName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:seeder $(name) && chmod -R 777 .'

create_test: #create test name=[testName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:test $(name)Test && chmod -R 777 .'

create_email: #create email name=[emailName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:mail $(name) && chmod -R 777 .'

create_middleware: #create middleware name=[emailName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:middleware $(name) && chmod -R 777 .'

create_command: #create console command name=[emailName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:command $(name) && chmod -R 777 .'

create_queue_job: #create queue job name=[emailName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:job $(name) && chmod -R 777 .'

migration: #run migration
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan migrate'

rollback: #run migration
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan migrate:rollback'

status: #run migration
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan migrate:status'

seed: #run migration
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan db:seed'

refresh: #Refresh the database and run all database seeds
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan migrate:refresh --seed'

chmod: #allow RW to all
	@sudo docker exec -it $(docker_name) bash -c 'chmod -R 777 .'

route: #show all routes
	@sudo docker exec -it $(docker_name) bash -c 'php artisan route:list'

conf: #refresh config cache
	@sudo docker exec -it $(docker_name) bash -c 'php artisan config:cache'

test: #run test cases
	@sudo docker exec -it $(docker_name) bash -c 'php artisan config:clear && vendor/bin/phpunit'

test_class: #test specific class name="$(name)"
	@sudo docker exec -it $(docker_name) bash -c 'vendor/bin/phpunit --filter $(name)'

bash: #bash
	@sudo docker exec -it $(docker_name) bash

clear_cache: #clear laravel cache php artisan optimize --force php artisan config:cache php artisan route:cache
	@sudo docker exec -it $(docker_name) bash -c 'php artisan cache:clear && php artisan view:clear && php artisan route:clear && php artisan config:clear'

socket: #start socket message service
	@sudo docker exec -it $(docker_name) bash -c 'php artisan socket_messages_server:serve'

remove_tmp_files: #remove files from tmp folder
	@sudo docker exec -it $(docker_name) bash -c 'php artisan tmp_files:remove'

connect: #connect to container bash
	@sudo docker exec -it $(docker_name) bash

connect_beanstalkd: #connect to container bash
	@sudo docker exec -it beanstalkd bash

connect_mysql: #connect to container bash
	@sudo docker exec -it $(docker_mysql) bash

version: #laravel version
	@sudo docker exec -it $(docker_name) bash -c 'php artisan --version'

volumes: #docker volumes list
	@sudo docker volume ls

rm_volume: #remove docker volume name=[volumeName]
	@sudo docker-compose down && sudo docker volume rm $(name)

cache_route: #cache route
	@sudo docker exec -it $(docker_name) bash -c 'php artisan route:cache'

start_queue: #start queue worker
	@sudo docker exec -it $(docker_name) bash -c 'php artisan queue:work'

prod: #optimizations for production server
	@sudo docker exec -it $(docker_name) bash -c 'php artisan route:clear && php artisan route:cache && php artisan optimize'

swagger_publish: #publish swagger conf
	@sudo docker exec -it $(docker_name) bash -c 'php artisan l5-swagger:publish'

swagger: #generate dock
	@sudo docker exec -it $(docker_name) bash -c 'php artisan l5-swagger:generate && chmod -R 777 .'

populate_vendors: #generate dock
	@sudo docker exec -it $(docker_name) bash -c 'cp -R ./vendor ./ven && chmod -R 777 .' && sudo sh -c 'rm -R ./vendor; mv ./ven ./vendor'
