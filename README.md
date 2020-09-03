## Hello partner!

### Quick instructions:

- clone the project
- setup the .env file for Docker (Important for Linux)
- setup the .env dile for the Laravel app
- run docker-compose up
- run docker-compose exec app composer install
- run docker-compose exec node npm run dev
- add in your hosts file: 127.0.0.1   http://csvimporter.local
- in your browser go to http://csvimporter.local
- dont forget run this command inside your app container: php artisan storage:link
- have some fun!

### Problems?

- If you have issues trying to run commands inside your docker containers in the host, try in this way: 

```
docker-compose exec app bash

$ php artisan list
```

### Screenshots

![Home page](screenshots/home.png?raw=true "Home")

![Contact list](screenshots/table.png?raw=true "Contact List")

![Importer page](screenshots/importer.png?raw=true "Contact List")

### TODO

- Test suite
- File validation
- Check for duplicates