up:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down --volume

bash:
	docker exec -it --user www-data praca_php bash
