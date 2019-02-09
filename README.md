<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Laravel Boilerplate

Laravel boilerplate is a basic boilerplate for laravel applications, specially targeted for medium to large level applications. It is configured with some of the must have packages and organized folder structure to manage different classes and files. 

### Packages included

- [doctrine/dbal](https://github.com/doctrine/dbal): Doctrine Database Abstraction Layer for extended database operation (specially in migrations)
- [laracasts/flash](https://github.com/laracasts/flash): Easy flash notifications
- [laravelcollective/html](https://github.com/laravelcollective/html): HTML and Form Builders.
- [prettus/l5-repository](https://github.com/andersao/l5-repository):  Repositories to abstract the database layer.
- [league/fractal](https://fractal.thephpleague.com/): A presentation and transformation layer for complex data output, specially used for RESTful APIs
- [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog): To log activities in models.
- [spatie/laravel-cors](https://github.com/spatie/laravel-cors): To send CORS headers.
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission): For ACL by associating users with roles and permissions.

#### Packages as 'dev dependencies'

- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar): Laravel Debugbar.
- [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper): Laravel IDE Helper.

## Installation

- Create project with composer's `create-project` command in your terminal.
```
composer create-project puncoz/laravel-boilerplate blog
```

## Inbuilt Features

- Supported for different services like: **front-office**, **back-office**, **authentication** and **API**s services.
- Webpack configured for basic **js** and **sass** along with **vuejs**
- **Login**: Customized laravel's default login scaffold with both username or email supported.
- **Password reset**: Customized to give success message even if email provided is not registered. (For security reason)
- Customized routes, notification emails (email verification and password reset)
- Email not verified warning alert in dashboard, authenticated pages.
- and many more...

## Directory Structure

```
-- app
   |-- Constants
   
   |-- Core
       |-- BaseClasses
           |-- Controllers
               |-- Controller.php
               |-- BackOfficeController.php
               |-- FrontOfficeController.php
           |-- Repositories
               |-- Repository.php
               |-- RepositoryInterface.php
       |-- Broadcasting
       |-- Contracts
       |-- Events
       |-- Exceptions
           |-- Handler.php
       |-- Helpers
           |-- ViewHelpers
               |-- homepage.php
               |-- dashboard.php
           |-- auth.php
           |-- common.php
       |-- Jobs
       |-- Listeners
       |-- Mails
       |-- Notifications
           |-- Auth
               |-- ResetPasswordNotification.php
               |-- VerifyEmail.php
       |-- Rules
       
   |-- Data
       |-- Entities
           |-- Accessors
               |-- User
                   |-- UserAccessors.php
           |-- Models
               |-- Log
                   |-- ActivityLog.php
               |-- User
                   |-- Permission.php
                   |-- Role.php
                   |-- User.php
           |-- Scopes
           |-- Traits
               |-- UserInfoTrait.php
               |-- UuidTrait.php
       |-- Repositories
           |-- User
               |-- Permission
                   |-- PermissionEloquentRepository.php
                   |-- PermissionRepository.php
               |-- Role
                   |-- RoleEloquentRepository.php
                   |-- RoleRepository.php
               |-- UserEloquentRepository.php
               |-- UserRepository.php
           |-- RepositoryBindings.php
       
   |-- Domain
       |-- Api
           |-- Controllers
               |-- Users
                   |-- UsersController.php
           |-- Policies
           |-- Presenters
               |-- Users
                   |-- UserPresenter.php
           |-- Requests
               |-- Users
                   |-- UserRequest.php
           |-- Services
               |-- Users
                   |-- UserService.php
          |-- Transformers
              |-- Users
                  |-- UserTransformer.php
       |-- BackOffice
           |-- Controllers
               |-- Dashboard
                   |-- DashboardController.php
           |-- Policies
           |-- Requests
               |-- Dashboard
                   |-- DashboardRequest.php
           |-- Services
               |-- Dashboard
                   |-- DashboardService.php
       |-- Console
       |-- Frontend
           |-- Controllers
               |-- Home
                   |-- HomeController.php
           |-- Policies
           |-- Requests
               |-- Home
                   |-- HomeRequest.php
           |-- Services
               |-- Home
                   |-- HomeService.php
                   
   |-- Libraries
   
   |-- StartUp
       |-- Kernels
           |-- ConsoleKernel.php
           |-- HttpKernel.php
       |-- Middleware
           |-- Authenticate.php
           |-- CheckForMaintenanceMode.php
           |-- EmailVerificationWarning.php
           |-- EncryptCookies.php
           |-- RedirectIfAuthenticated.php
           |-- TrimStrings.php
           |-- TrustProxies.php
           |-- VerifyCsrfToken.php
       |-- Providers
           |-- AppServiceProvider.php
           |-- AuthServiceProvider.php
           |-- BroadcastServiceProvider.php
           |-- EventServiceProvider.php
           |-- RepositoryServiceProvider.php
           |-- RouteServiceProvider.php
   
-- bootstrap
-- config
-- database
-- public
-- resources
-- routes
-- storage
-- tests
```

## Contribution

Anybody can contribute this scaffolding as per their requirement. To contribute, send pull request with detailed description of changes. If you are updating this scaffolding to fit with different packages and stacks, you need to create branch with appropriate name.

eg: If you want ReactJs instead of VueJs, create branch with name `boilerplate-reactjs`. i.e. branch name with '*boilerplate-*' as prefix.

## Security Vulnerabilities

If you discover a security vulnerability and other issues, please create an issues. All security vulnerabilities and issues will be promptly addressed.

## License

This laravel-scaffolding is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT) and totally inherits all the rights from [Laravel Framework](http://laravel.com).
