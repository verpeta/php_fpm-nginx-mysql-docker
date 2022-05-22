### How to install
1. Run `docker-compose up -d`
2. Go to http://demo-proxy.localhost/ to see traefik dashboard
4. Go to http://demo.localhost/ to test nginx & php works as expected
3. Go into php container `docker exec -it demo-app sh`
   1. Run `composer install`
   2. Run `php ./src/redis/test.php` to test redis.
   3. Run `php ./src/mysql/test.php` to test mysql.
   4. To test rabbit we need run 2 commands:
      1. Push message to queue - `php ./src/rabbit/publish.php`
      2. Read message from queue - `php ./src/rabbit/consume.php`
4. It's all!) Now you can modify any code for your needs.
