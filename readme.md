# Github Auth Login

### Description

Gihub authentication using Laravel 5.4. In addition, a call a github api to display the logged in users repo's and last 3 commmits.

Framework used, Laravel (v5.4)

##

## Setup a local virtual dev environment

### Install Oracle Virtual Box (v5.1)
Download and install the DEB or DMG file: (https://www.virtualbox.org/wiki/Linux_Downloads).

### Install Vagrant (v1.9.1)
Download and install the DEB or DMG file: (https://www.vagrantup.com/downloads.html)

##

### Download the repo
Create a "Code" directory in your home directory.

Clone the git repo into your "Code" directory.

Linux/Mac
```
$ git clone https://github.com/nadeemorrie/GithubAuth.git
```
##

### Install dependencies

Open the githubauth folder
```
$ cd githubauth/
```
Laravel utilizes Composer to manage its dependencies. So, before using Laravel, make sure you have Composer installed on your machine.

Run composer update
```
$ composer update
```
The repo/project ships with a Vagrantfile allowing you to run vagrant per project instead of globally.

##

### Install homestead

Install vagrant virtual machine Homestead.
```
$ cd githubauth/
$ php vendor/bin/homestead make
```
##

### Edit hosts file

The default virtual server runs on 192.168.10.10. see Homestead.yaml. you can change this ip to anything you like.

Add the ip in your hosts file. use any editor of your choice.
```
$ vi /etc/hosts
```
** Set it to something like this: 192.168.10.10 dev.manager

Finally, run vagrant from terminal
```
$ cd githubauth/
$ vagrant up
```
##

### Github OAuth Developer settings
My  github OAuth is setup with the following homepage URL
```
http://dev.manager
```

My OAuth registered settings are as follows. You can find the settings in .env.
```
GIT_HUB_CLIENT_ID=00eaf872412f7eca1b05
GIT_HUB_CLIENT_SECRET=1ac042b60da70d010fa655f9b1f94a1a14ed8a5d
GIT_HUB_CALLBACK_URL=http://dev.manager/auth/github/callback
```

[![NOTE]]: If you want to use my OAuth settings then please set your homepage dev url to http://dev.manager.
Alternatively register your own application settings for OAuth on https://github.com/settings/applications/new
and update the .env file.

Example of your developer settings in github for 
```
Homepage URL = http://YOUR_SERVER_NAME
Authorization callback URL = http://YOUR_SERVER_NAME/auth/github/callback
```

## Finally test the link

Test the link: (http://dev.manager)

## Setup using your own custom server.

You will need to make sure your server meets the following requirements:

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

You need composer for dependencies.

Read more: (https://laravel.com/docs/5.4/installation)
