# Organize | A to-do list application

This application is based on the MVC Framework and the backend is on PHP.
The application uses [ToroPHP](https://github.com/anandkunal/ToroPHP) for routing and [Twig](https://github.com/twigphp/Twig) for templates.

### Set Up : 
- Clone the repository.
- Import the schema from '/schema/organize.sql'.
- Run `composer install` to install all the dependencies.
- Modify '/config/config.example.php' and rename it as 'config.php'.
- Ensure that a SMTP server is set up for sending mails from the application.
- Link the '/public' folder to the apache server root and name the link as 'organize'.