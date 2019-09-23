# simpleTestSymfony
Projeto Baseado em Symfony 4.3 Criado com o objetivo de um pequeno teste das funcionalidades.
https://symfony.com/doc/current/deployment.html

Utilizado css Botstrap, fontawesome, Jquery ui.


1 - Ajustar o arquivo .env com as informações de banco de dados linha 27
        DATABASE_URL=mysql://user:password@host:port
2 - Installar o projeto com suas dependencias
     composer install --no-dev --optimize-autoloader

3 - Executar os comando para instalar o banco e suas tabelas
     php bin/console make:migration
     php bin/console doctrine:migrations:migrate

4 - Limpar os caches
     APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear

