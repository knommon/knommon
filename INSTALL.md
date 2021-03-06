# Mac Installation Guide

Linux and Windows users, please contribute a guide. You will need all of the programs listed below, but the exact setup may differ. Feel free to edit this document as needed, including any additional information you found helpful.

Handy [Mac guide](http://www.createdbypete.com/articles/php-54-development-on-os-x-with-mysql-and-laravel-4/).

## Getting Started

If you didn't already, make sure you download [Homebrew](http://brew.sh/).
To check if you have brew, run `$ which brew`. It should return a path like `/usr/local/bin/brew`, if not then you need to install brew. which can be used to check if any of the programs below are installed.

If you get a permission error at any point, try re-running the command with root access. 
`$ sudo !!`

## Lamp Dev Stack Setup

Tap the following PHP repositories, allowing brew to see the packages available by these vendors: 
```$ brew tap josegonzalez/homebrew-php  
$ brew tap homebrew/dupes```

Laravel requires PHP 5.3.7+ with the mcrypt module.  
To install a new version of PHP, run `$ brew install php55 php55-mcrypt`.  
You may also configure php with additional options such as `--with-pgsql` for PostgreSQL support.
For a full list of available extensions, [see this](http://justinhileman.info/article/reinstalling-php-on-mac-os-x/#but-wait-theres-more).

Now, you'll need to add brew's version of php to your path.

In you're ~/.bashrc file, add the following line:  
`export PATH="$(brew --prefix josegonzalez/php/php55)/bin:$PATH"`  
This will use Homebrew's PHP that we just installed instead of the default version of PHP. Make sure the version of PHP corresponds to the one you installed and your .bash_profile is has `source .bashrc`.

Close the current shell window or re-load the bashrc file (`$ . ~/.bashrc`). Now, check if PHP is setup correctly run `$ php -v`. It should be 5.3.7+. Next, run `$ php -m | grep mcrypt`. This should print out a single line with `mcrypt`, otherwise you still don't have mcrypt installed.

Install PostgreSQL. See [this install guide](http://stackoverflow.com/questions/61747/installing-pdo-drivers-for-postgresql-on-mac-using-zend-for-eclipse).  
Make sure you add the extension to your php.ini file.

Next install [composer](https://getcomposer.org/doc/00-intro.md#globally) globally, a PHP dependency manager.  
`$ curl -sS https://getcomposer.org/installer | php`  
`$ mv composer.phar /usr/local/bin/composer`  
Alternatively, you can install it with homebrew:  
`$ brew install josegonzalez/php/composer`

Install sass with [gem](http://rubygems.org/pages/download) (see link for gem install guide). `$ gem install sass`

Next install [compass](http://compass-style.org/install/) version 1.0.0.alpha.19 or higher.   
`$ gem update --system && gem install compass`

Run `gem install compass --pre` to get the newest alpha version.

NPM. You also need to install the Node Package Manager to install a few other utilities.  
`$ brew install node`

Grunt task runner.  
`$ npm install -g grunt-cli`

Bower frontend package manager.
`$ npm install -g bower`

------

## Dev Setup

With the required pacakges installed, `cd` into the project directory.

First, you'll need to download the required PHP packages with composer.  
`$ composer install`  
After that completes, install Node dependencies.  
`$ npm install`  
Finally, some frontend dependencies.  
`$ bower install`

Run `$ sudo make`.

Now you'll need to compile the CSS, Sprite & Javascript.  
`$ grunt make`

**Database setup**. Edit app/config/database.php and modify it to include your database settings. If you don't know your database settings, you should learn them! If you don't know database stuff at all:
`$ mysql -u root`     // run the database program as root so you have necessary permissions
```mysql> create database my_database;  
mysql> grant all on my_database.* to username@localhost identified by 'password';  
mysql> flush privileges;  
mysql> quit;```

Then go to app/config/database.php and edit the connection so that the default database is 'my_database', 'username', 'password'

Do not modify default.database.php. 

Create the migrations table. `php artisan migrate:install`

Next, to create the database tables, run `php artisan migrate`.

If you're unsure, run `php artisan migrate --pretend` to see what the migrate command will do. Read more about migrations [here](http://daylerees.com/codebright/migrations).

For new migrations, the following artisan commands may be helpful:
`php artisan migrate:rollback` rollback the last migration operation  
`php artisan migrate:reset` reset all migrations  
`php artisan migrate:refresh` rollback all migrations and run them again  
See [the Laravel Docs/Migrations](http://laravel.com/docs/migrations#rolling-back-migrations) for more details.

## Dev Workflow

Run the Laravel application (on port 8000 by default, can specify with `--port=8080`).  
`$ php artisan serve`

Typically when developing, it's handy to have grunt running and polling for changes to the websites frontend resources. It will auto-compile any scss files and JavaScript. Simple run `$ grunt` and it will wait for changes to update the frontend files.

Also, for instant browser refreshing, install the Chrome extension [LiveReload](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=en).

## Git Workflow

Do **not** use git pull. Instead use *git up*, which will help to keep the commit history clean. To create this command, run the following: `git config --global alias.up "!git remote update -p; git merge --ff-only @{u}"`

*Never commit directly to master!* Always do work in a seperate dev branch.  
Checkout another branch so that if you mess anything up, you are safe. 

`$ git checkout -b my_branch` or whatever you want to call your branch  

Then you do whatever - create files, edit files, make and destroy folders, mostly in knommon/app. Do your thing.
Once you have a good, logical chunck completed push your code.

To push your code, do the following:

On branch *dev*. 
`git checkout master`  
`git up` fetch the latest changes  
`git checkout dev`  
`git rebase master` apply new changes to our dev branch, then apply our commits to dev   
make sure there are no merge conflicts, fix them and run `git rebase --continue`  
`git checkout master`  
`git merge dev` Merge our newest changes into master  
`git push` push changes to the server  


## All Done

You're all set, happy developing!

