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

## AWS EC2 Instance

# SSH
ssh -i "aws-ec2-key.pem" ec2-user@ec2-13-51-252-248.eu-north-1.compute.amazonaws.com
(-o ServerAliveInterval=120) or .ssh/config

## Deploy Using Drone

# Caddy - Reverse Proxy
Caddyfile:

http://13.51.252.248.nip.io:8080 {
	reverse_proxy localhost:8081
}
13.51.252.248.nip.io:8443 {
	reverse_proxy localhost:8444
}
13.51.252.248.nip.io:7000 {
	reverse_proxy localhost:7001
}

Run: sudo caddy start > caddy_server.log 2>&1 &

# Drone:
docker run  \
  --volume=/var/lib/drone:/data  \
  --env=DRONE_GITHUB_CLIENT_ID=SECRET_ID \
  --env=DRONE_GITHUB_CLIENT_SECRET=SUÅPER_SECRET \
  --env=DRONE_RPC_SECRET=VERY_SECRET \
  --env=DRONE_SERVER_HOST=13.51.252.248.nip.io\
  --env=DRONE_SERVER_PROTO=http \
  --env=DRONE_USER_CREATE=username:fjdrodrigues,admin:true \
  --publish=8081:80 \
  --publish=8444:443 \
  --restart=always \
  --detach=true \
  --name=drone-github \
  drone/drone
  
# Drone Linux Runner:
docker run --detach \
  --volume=/var/run/docker.sock:/var/run/docker.sock \
  --env=DRONE_RPC_PROTO=http \
  --env=DRONE_RPC_HOST=13.51.252.248.nip.io:8080 \
  --env=DRONE_RPC_SECRET=VERY_SECRET  \
  --env=DRONE_RUNNER_CAPACITY=2 \
  --env=DRONE_RUNNER_NAME=github-runner \
  --publish=3000:3000 \
  --restart=always \
  --name=github-runner \
  drone/drone-runner-docker

# Run once
sudo docker run --detach \
	--publish=7001:80 \
	--name=rauma-social-dancing-web-app \
	fjdrodrigues/rauma-social-dancing-web-app

# Watchtower
docker run -d \
    --name watchtower \
	-v /var/run/docker.sock:/var/run/docker.sock \
    containrrr/watchtower \
	-i=60 \
	rauma-social-dancing-web-app