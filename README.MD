##Докер
###тесты

переходим в директорию ```docker```  
запускаем ```docker-compose up --build```  

"заходим" в контейнер ```docker exec -it tr-php-fpm fish```   
устанавливаем зависимости ```composer install```  
запускаем тесты ```bin/phpunit```
