Installation :
Fixtures : composer req --dev orm-fixtures
Forms : composer require symfony/form

Utilisation:
Création Fixtures : php bin/console make:fixtures
Migration Fixtures vers BDD : php bin/console doctrine:fixtures:load --append


Modifier l'entité MotClés :
php bin/console make:entity MotCles

Mettre a jour la base de données selon les entités :
php bin/console make:migration

Migre les données de mon app vers ma base de données :
php bin/console doctrine:migrations:migrate