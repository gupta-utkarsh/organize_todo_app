# Organize | A to-do list application

This application is based on the MVC Framework and the backend is on PHP.
The application uses [ToroPHP](https://github.com/anandkunal/ToroPHP) for routing and [Twig](https://github.com/twigphp/Twig) for templates.

### Set Up : 
- Clone the repository.
- Copy over `config/config.example.php` to `config/config.php` and edit the values.
- Copy over `config/organize.in.conf` to /etc/apache2/sites-available/organize.in.conf`,edit it and enable it(`sudo a2ensite organize.in`), and add entry in hosts file(`/etc/hosts`).
- Enable mod_rewrite(`sudo a2enmod rewrite`) and restart apache(`sudo service apache2 restart`).
- Import schema `/schema/organize.sql`.
- Install composer (`curl -sS https://getcomposer.org/installer | php`) and run `composer install` to install all the dependencies.
- Install and run `grunt`.
- Run `sudo apt-get install ssmtp` and copy over `config/ssmtp.example.conf` to `/etc/ssmtp/ssmtp.conf`.
- Open [organize.in](http://organize.in) in browser.