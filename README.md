Rauma Social Dancing - Web App

# Current Versions - Working
Angular CLI: 12.2.17
Node: 14.17.0
Package Manager: npm 6.14.13

Angular: 12.2.16
... animations, common, compiler, compiler-cli, core, forms
... language-service, localize, platform-browser
... platform-browser-dynamic, router

Package                            Version
------------------------------------------------------------
@angular-devkit/architect          0.1202.17
@angular-devkit/build-angular      12.2.17
@angular-devkit/core               12.2.17
@angular-devkit/schematics         12.2.17
@angular/cdk                       12.2.13
@angular/cli                       12.2.17
@angular/material                  12.2.13
@angular/material-moment-adapter   12.2.13
@schematics/angular                12.2.17
rxjs                               6.6.7
typescript                         4.2.4


# Frontend
# Install Node JS
Download & Install
# Install Angular
 - npm install -g @angular/cli
 - cd ~/rauma-social-dancing-web-app
 - run npm install
# Install Dependencies (inside the project directory)
 - sudo npm install @ngx-translate/http-loader --save
 - sudo npm install @ngx-translate/core --save

# Backend
# Install MySQL 5.7
Download & Install
# Install Apache 2.4
 - Download httpd-2.4.41-win64-VS16.zip from https://www.apachelounge.com/download/
 - Extract Apache24 to C:\
 - Download & Install vc_redist_x64 from https://www.apachelounge.com/download/
 - cd C:\Apache24\bin
 - httpd.exe -k install
 - Edit httpd.conf:
    LoadModule rewrite_module modules/mod_rewrite.so
# Install PHP 7
 - Download ZIP file and extract to C:\php7.1
 - Copy C:\php7.1\php.ini-development to C:\php7.1\php.ini
 - extension_dir = "ext"
 - Remove semicolon in Extensions:
extension=php_curl.dll
extension=php_gd2.dll
extension=php_mbstring.dll
extension=php_mysqli.dll
extension=php_pdo_mysql.dll
extension=php_xmlrpc.dll
 - Add C:\%php% to environment variables
 - Stop Apache2.4
 - Edit httpd.conf in C:\Apache24\conf. Line 285 to DirectoryIndex index.php index.html
 - Add at the end of the file:
    # PHP7 module
    LoadModule php7_module "C:/php7.1/php7apache2_4.dll"
    AddType application/x-httpd-php .php
    PHPIniDir "C:/php7.1"
# .htacess file
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ / [L]

# Rauma Social Dancing

This project was generated with [Angular CLI](https://github.com/angular/angular-cli) version 8.3.4.

## Development server

Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `frontend/` directory. Use the `--configuration=production` flag for a production build. `ng build --configuration=production`

## Running unit tests

Run `ng test` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Running end-to-end tests

Run `ng e2e` to execute the end-to-end tests via [Protractor](http://www.protractortest.org/).

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI README](https://github.com/angular/angular-cli/blob/master/README.md).

Rauma Social Dance logo:
Width: 406.03px
Height: 78.83px
Colour: #f8f1f1


#d79922 - gold
#efe2ba - dutch white
#f13c20 - vermillion
#4056a1 - dark blue
#c5cbe3 - light violet/blue
#31343f - Grey
------------
#f8f1f1 - Dark White
