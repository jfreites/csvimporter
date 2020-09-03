## Hello partner!

### Quick instructions:

- clone the project
- run docker-compose up
- run docker-compose exec app composer install
- run docker-compose exec node npm run dev
- setup the variables in src/.env for Laravel app
- add in your hosts file: 127.0.0.1   http://csvimporter.local
- in your browser go to http://csvimporter.local
- dont forget run this command inside your app container: php artisan storage:link
- have some fun!

### TODO

- Test suite
- File validation
- Check for duplicates