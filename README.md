Freestylepoker
==========

Part 1: Install
-----

- Install yii2 [http://yiiframework.com](http://yiiframework.com)  

- Copy **old forum** in `/forum`

- Create and migration Databases

Part 2: Update forum to phpbb 3.1.2
---------------------------------

- Download **phpbb 3.1.2 rus** [http://www.phpbbguru.net/files/base/phpbb31-ru/](http://www.phpbbguru.net/files/base/phpbb31-ru/)
    
- Delete _all_ files except config.php, `/styles`, `/store`, `/images`

- Unpack **phpbb 3.1.2 rus** to forum folder

- Go in browser on URL: `http://domain.loc/forum/install/database_update.php`

- Update database

- Add `.htaccess` **before*** _Frontend redirect_
```
# Forum redirect
    RewriteCond %{REQUEST_URI} ^/forum
    RewriteRule ^forum/(.*)$ forum/$1 [L]
```

- Add alias `\common\config\aliases.php`:

```
Yii::setAlias('phpbb', dirname(dirname(__DIR__)) . '/forum/phpbb');
```

 > **All change:** In the folder `docs`, you can find all the detailed information about the settings and changes

-
#### Docs list
- [Users module](https://github.com/8sun/freestylepoker/blob/master/docs/users.md)
- [Integration](https://github.com/8sun/freestylepoker/blob/master/docs/integration.md)
