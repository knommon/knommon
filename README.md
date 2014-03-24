# Knommon

We believe that there is a fundamental gap between the way that information is taught vs. the way that it is learned. This project hopes to bridge that gap by creating a community of self-motivated developers in your area focused around project-based learning. There is no failing, there is no grading -- all you have is what you can do with what you know. What would you do if you knew you couldn't fail? Stay hungry, stay foolish.

## Application Stack

Frontend. HTML, SCSS + Compass with Pure-css / Boostrap? as a base.  
Backend. Laravel PHP Framework, MySQL / PostgreSQL?, Apache.  
Development. Bower, Grunt, Composer, Git.  

## Setup Guide

See [INSTALL.md](https://github.com/knommon/knommon/blob/master/INSTALL.md).

## Coding Conventions

#### Database
All tables are lowercase with underscores. Tables should end in an 's' (i.e. users, projects). Relations should be singular (i.e. membership defines a users-to-projects relation).

#### Whitespace 
PHP files are tab-indented, HTML files are indented with 2 spaces.

## Laravel Documentation

Checkout this [handy Laravel cheatsheet](http://cheats.jesse-obrien.ca/).

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

Caching:  
Redis / Varnish / Memcached?  
https://github.com/TheMonkeys/laravel-blade-cache-filter

Deploying:  
http://code.tutsplus.com/tutorials/deploying-a-laravel-application-using-capistrano--net-35685

http://rocketeer.autopergamene.eu/#toc23

@todo, see different environments:
http://laravel.com/docs/configuration#environment-configuration

http://chrishayes.ca/blog/code/laravel-4-setting-utilizing-environments-environment-configuration
