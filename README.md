sm.journal.local
================

# installing

`git clone https://github.com/METALmasterKS/sf.journal.git`
`cd sf.journal`
`composer install`
`cp app/config/parameters.yml.dist app/config/parameters.yml`

set your database parameters

`nano app/config/parameters.yml`
`php app/console doctrine:database:create`
`php app/console doctrine:schema:create`
`php app/console server:run`

and go to browser http://127.0.0.1:8000

