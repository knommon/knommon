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
`$ brew tap josegonzalez/homebrew-php`
`$ brew tap homebrew/dupes`

Laravel requires PHP 5.3.7+ with the mcrypt module.
To install a new version of PHP, run `$ brew install php55 php55-mcrypt`.

Now, you'll need to add brew's version of php to your path.

In you're ~/.bashrc file, add the following line:
`export PATH="$(brew --prefix josegonzalez/php/php55)/bin:$PATH"`
This will use Homebrew's PHP that we just installed instead of the default version of PHP. Make sure the version of PHP corresponds to the one you installed.

Close the current shell window or re-load the bashrc file (`$ . ~/.bashrc`). Now, check if PHP is setup correctly run `$ php -v`. It should be 5.3.7+. Next, run `$ php -m | grep mcrypt`. This should print out a single line with `mcrypt`, otherwise you still don't have mcrypt installed.

Next install [composer](https://getcomposer.org/doc/00-intro.md#globally) globally, a PHP dependency manager.
`$ curl -sS https://getcomposer.org/installer | php`
`$ mv composer.phar /usr/local/bin/composer`
Alternatively, you can install it with homebrew:
`$ brew install josegonzalez/php/composer`

Install sass with [gem](http://rubygems.org/pages/download) (see link for gem install guide). `$ gem install sass`

Next install [compass](http://compass-style.org/install/).
`$ gem update --system && gem install compass`

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
Finally, some frontend packages. 
`$ bower install`

Run `$ sudo make`.

Now you'll need to compile the CSS, Sprite & Javascript.
`$ grunt make`

## Dev Workflow

Run the Laravel application (on port 8000 by default, can specify with `--port=8080`).
`$ php artisan serve`

Typically when developing, it's handy to have grunt running and polling for changes to the websites frontend resources. It will auto-compile any scss files and JavaScript. Simple run `$ grunt` and it will wait for changes to update the frontend files.

Also, for instant browser refreshing, install the Chrome extension [LiveReload](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=en).

## All Done!

You're all set, happy developing!
