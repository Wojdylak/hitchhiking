up:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down --volume

bash:
	docker exec -it praca_php bash
