# UrlShortener

The project involved the development of a web-based link shortening tool that allowed users to input long URLs and receive a shortened version in return. This tool was built using the Model-View-Controller (MVC) architectural pattern, which separated the application into distinct components for data modeling, user interface, and control logic.

The website was developed using the PHP 7+ programming language and utilized the Symfony and twig frameworks to provide a robust and efficient foundation for the application. The Nginx web server was used to serve the website to users.

In addition to the basic link shortening functionality, the website tracked and stored each redirect from the shortened URL to the actual URL. This allowed users to see how often their shortened links were being used, and it provided valuable data for analyzing traffic patterns and user behavior.

Overall, the project resulted in a functional and user-friendly website that allowed users to easily create and track shortened links for a variety of purposes.



## Deployment

To run this project use

```bash
  composer install
  composer update
  
  docker-compose up -d
```

For database migration use

```bash
  php bin/console doctrine:migrations:migrate  
```

To shutdown the docker container use
```bash
docker-compose down -v --remove-orphans   
```
## Features

- Shortens the url
- Url click preview



## Tech Stack

**Client:** PHP 7+, Symfony, twig

**Server:** Nginx, MySQL




## Author

- [@saldinbeganovic](https://www.github.com/saldinbeganovic)
