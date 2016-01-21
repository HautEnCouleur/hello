# hello

just another wordpress theme

--------

> **early stage - currently bootstraping the repo :grin:**

--------

## history

This [gulp](http://gulpjs.com/) app is based on the [gulp webapp generator](https://github.com/yeoman/generator-gulp-webapp) for [yeoman](http://yeoman.io/).

**Notes :**  

The `test` features included in the generator have been disabled.

The [jade](http://jade-lang.com/) template engine was added for the mockups generation.  
(the following [recipe](https://github.com/yeoman/generator-gulp-webapp/blob/master/docs/recipes/jade.md) was used)

> TODO : add deploy

-------

## requirement

- Nodejs (tested with v0.10.28)
- npm (tested with v1.4.9)


-------

## install

1. pull the repo
2. install gulp globally
```
npm install -g gulp
```
(_might require a `sudo`_)
3. install node modules (building libraries) and bower component (front end libraries) locally
```
> npm run setup # ( npm install && bower install && babel gulpfile.babel.js --out-file gulpfile.js )
```
4. create a file named `.deployrc` at the root of your working directory and fill it using this template
```json
{
    "dev": {
      "host": "ftp.your-awesome-server.com",
      "port": "21",
      "user": "awesome-ftp-user",
      "password": "awesome-ftp-password",
      "path": "/dev/wp-content/themes/hello"
    },
    "prod": {
      "host": "ftp.your-awesome-server.com",
      "port": "21",
      "user": "awesome-ftp-user",
      "password": "awesome-ftp-password",
      "path": "/www/wp-content/themes/hello"
    },
    "local": {
      "path": "/localpath/wp-content/themes/hello"
    }
}
```
**_do not sync this file and leave it in the `.gitignore` config file_**
-------

## build

Since we use [gulp](http://gulpjs.com/) to play in your local environment, the following tasks are available :

### `gulp`
will build & pack the whole app in the `dist` folder

### `gulp serve`
will build the app and serve it on http://localhost:9000/

### `gulp deploy:dev` (beta)
deploy the template code (`dist` folder) to your development ftp server (see `.deployrc`)

### `gulp deploy:watch` (beta)
watch and deploy to your development ftp server :thumbsup:

### `gulp deploy:prod` (beta)
deploy the template code (`dist` folder) to your **production** ftp server (see `.deployrc`)

### `gulp deploy:local` (alpha)
deploy the template code (`dist` folder) to your **local** folder (see `.deployrc`)

-------

## Folder Structure 

> WIP

    .
    ├── .tmp/
    ├── app/                        # 
    │   ├── images/                 # Images 
    │   ├── includes/               # Table of contents
    │   ├── languages/              # I18N
    │   ├── layouts/                # 
    │   ├── libraries/              # 
    │   ├── scripts/                # 
    │   ├── [static/]?              # 
    │   ├── styles/                 # 
    │   ├── index.php.jade          # 
    │   ├── robots.txt              # 
    │   ├── screenshot.png          # 
    │   ├── searchform.php.jade     # 
    │   ├── style.css               # 
    │   ├── woocommerce.php.jade    # 
    │   ├── screenshot.png          # 
    │   └── functions.php           # 
    ├── [bower_components/]         # Bower / front end dependencies
    ├── [dist/]                     # 
    ├── [node_modules/]             # NPM dependencies (Gulp,Babel,Jade...)
    ├── gulpfile.babel.js           # Gulpfile babel source 
    ├── gulpfile.js                 # 
    ├── LICENSE                     # 
    ├── package.json                # 
    └── README.md                   # This file

  