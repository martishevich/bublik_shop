install:
    sudo apt-get install docker docker-compose docker.io

start:
    sudo docker-compose up -d
    docker exec -it bublik-php /bin/bash
    php composer.phar update

test:
    
