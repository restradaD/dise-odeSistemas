# dise-odeSistemas
diseño de sistemas 


# Symfony3 Project by Rene estrada

A Symfony project created on January 22, 2016, 2:00 am.
This will be the base for all Symfony3 applications.

##Required


* PHP needs to be a minimum version of PHP 5.5.9
* JSON needs to be enabled
* ctype needs to be enabled
* Your php.ini needs to have the date.timezone setting

##Optional

* You need to have the PHP-XML module installed
* You need to have at least version 2.6.21 of libxml
* PHP tokenizer needs to be enabled
* mbstring functions need to be enabled
* iconv needs to be enabled
* POSIX needs to be enabled (only on *nix)
* Intl needs to be installed with ICU 4+
* APC 3.0.17+ (or another opcode cache needs to be installed)
* php.ini recommended settings
    * short_open_tag = Off
    * magic_quotes_gpc = Off
    * register_globals = Off
    * session.auto_start = Off

##Assetic
```
# Watch changes on assets
php bin/console assetic:watch

# Dump new assets
php bin/console assets:install --symlink
php bin/console assetic:dump
php bin/console cache:clear --env=prod
```
 
##Generate Model and update DB
```
php bin/console doctrine:generate:entities WbcAdministratorBundle
php bin/console doctrine:schema:update --force
```

##Update translation XML
```
php bin/console translation:update --output-format="xlf" es app --dump-messages --force
```

##Build Bootstrap.cache
```
php vendor/sensio/distribution-bundle/Resources/bin/build_bootstrap.php
```


## Generate Bundle
```
php bin/console generate:doctrine:crud --overwrite --format="yml" --with-write WbcAdministratorBundle:Locale
```

## Import translations to LexikTranslationsBundle
```
php bin/console lexik:translations:import --globals --force
```

## Import Currency with data from ECB (European Central Bank)
```
php bin/console lexik:currency:import yahoo
```

## Git Folder renaming case
```
Renaming the folder to something like setup-temp
git add -A
git commit -m "Whate`ver"
Rename the folder back to what you want
git add -A
git commit -m "Whatever"
```


## Generate Migrations example
```
php app/console doctrine:generate:entities WbcAdministratorBundle
php app/console doctrine:migrations:diff
```

## RUN Migrations
```
php app/console doctrine:migrations:migrate
```
