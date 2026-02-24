# Image perso de PHP pour convenir spécifiquement a nos besoins
FROM php:8.2-apache
# gestion apache et PHP [obligé pour le front controller]
# active le module de réécriture d'url via un .htacces d'apache
# installe xdebug et active les extensions PHP nécessaires
RUN a2enmod rewrite \
    && a2enmod headers \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
# Ajout du ServerName dans la conf apache [evite le warning lors du up du service apache]
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
# Configuration apache pour pointer sur le /public [la mememanipulation que pour créer un virtual host dans apache avec wamp]
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
&& sed -i '/<Directory \/var\/www\/html>/,/<\/Directory>/ s|\/var\/www\/html|\/var\/www\/html/public|' /etc/apache2/sites-available/000-default.conf \
&& sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
# PHP Dev affiche les erreurs + les couleurs et le rendu en HTML
# modifie les valeurs dans le php.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-dev.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-dev.ini \
    && echo "html_errors = On" >> /usr/local/etc/php/conf.d/docker-php-dev.ini \
    && echo "xdebug.mode=develop,display" >> /usr/local/etc/php/conf.d/docker-php-dev.ini \
    && echo "xdebug.var_display_max_depth=5" >> /usr/local/etc/php/conf.d/docker-php-dev.ini \
    && echo "xdebug.var_display_max_children=256" >> /usr/local/etc/php/conf.d/docker-php-dev.ini \