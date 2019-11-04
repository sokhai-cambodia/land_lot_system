# Laravel Dashboard

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software + extensions and how to install them


1. [Visual Studio Code](https://code.visualstudio.com)
    - Better Comments
    - Laravel Blade Snippets
    - Laravel goto view
    - laravel-blade
    - laravel-goto-controller
    - Markdown All in One
    - PHP Debug
    - PHP Extension Pack
    - PHP Intelephense
    - PHP IntelliSense
2. [WAMP](http://www.wampserver.com/en/) or [XAMP](https://www.apachefriends.org/index.html) for Window & [XAMPP](https://www.apachefriends.org/index.html) or [MAMP](https://www.mamp.info/en/) for Mac user
3. Requirement PHP 7.1 +
4. [Composer](https://getcomposer.org/)
5. For more info you can take a look at Laravel Docs [Laravel](https://laravel.com/docs/6.x)
### Installing

A step by step series of examples that tell you how to get a development env running

1 step you need to run below command to download dependency.

```
run command: composer update
```

2 step copy env.example and rename it to env

```
Config you env file
```
3 step is generate APP_KEY

```
run command: php artisan key:generate
```

4 step is migrations

```
run command: php artisan migrate
```

5 step is seed default user Username: admin & Password: admin@123

```
run command: php artisan db:seed
```

Now you can start this project. to start this project you need to run below command. if you don't want to use command to start project you can use Valet. See [Valet](https://laravel.com/docs/6.x/valet) docs for more info and install

```
run command: php artisan serve
```

## Understand Project Structure

> **Q: How project structure folder?**
>
> **A:** Treeview below will explain the way I structure project.

    .
    app
    ├── ...
    ├── Helpers                 # My Custom Helper Class
    │...
    public
    ├── cms                     # Cms plugin script (css, js)
    resources
    ├── view
    │   ├── cms                 # Folder that contain cms view
    ├── layouts
    │   ├── cms                 # Folder that contain cms layout
    │   ├── message             # Folder that contain cms message
    routes
    ├── cms                     # My seperate folder for cms route
    └── ...

## Deployment

Add additional notes about how to deploy this on a live system

## Authors

* **Sok Hai** - *Initial and Config Laravel Dashboard* - [Sok Hai](https://www.facebook.com/sokhaicambodia.1996)

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
