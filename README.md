# Serenity Lotus ADR with Inertia and Tailwind

### Action Domain Responder package for Laravel 7 and above.

This package turns your new Laravel 7 installation into a full ADR application complete with generators, full Inertia support, Tailwind CSS and authentication scaffolding.

You can learn more about ADR and why we think it's far superior to MVC at the [ADR repository.](https://github.com/pmjones/adr)

You can also use the pre-built version of **Serenity** at: [serenityphp.com](https://serenityphp.com)

**IMPORTANT**

> This package is for new installations of Laravel 7 only, installing this into an existing application will destroy all your previous work.

**YOU'VE BEEN WARNED!**

Lotus will completely remove your existing `app` directory and replace it with a beautifully designed ADR directory structure that makes it drop dead simple to understand and locate your files, all while keeping the principles of ADR intact.

The beginning scaffolding will give you a structure like this:

```
app
├── Actions
│   ├── Account
│   │   ├── SettingEditAction.php
│   │   └── SettingUpdateAction.php
│   ├── Auth
│   │   ├── LoginShowAction.php
│   │   ├── LoginStoreAction.php
│   │   ├── LogoutAction.php
│   │   └── ...
│   ├── Dashboard
│   │   └── IndexAction.php
│   └── PageAction.php
├── Domain
│   ├── Console
│   ├── Contracts
│   ├── Entities
│   ├── Exceptions
│   ├── Middleware
│   ├── Payloads
│   ├── Providers
│   ├── Repositories
│   ├── Requests
│   ├── Services
│   ├── Traits
│   └── Kernel.php
└── Responders
    ├── Account
    ├── Auth
    └── Dashboard
        └── IndexResponder.php
```

We didn't expand all the directories for the sake of brevity, but you can see the idea here. 

All of your business logic now exists ONLY within your Domain directory, which allows for clean Separation of Concerns delegating all HTTP related tasks to your Action, and all HTTP Response tasks to your Responders.

No more muddy controllers doing far more work than they should be.

### Installation

First install a new laravel installation in your Code directory or wherever you keep your dev apps.

```bash
laravel new web
```

Once Laravel is installed we need to generate a key, and we'll link our storage directory since we need that support later.

```bash
cd web
php artisan key:generate
php artisan storage:link
```

Next let's download Serenity Lotus.

```bash
composer require serenity/lotus
```

Make sure that the `seranity/lotus` service provider is discovered in the package auto-discovery message.

Now let's install Lotus.

```bash
php artisan lotus:install
```

You should now see the new directory structure inside of the `app` directory, and all the needed files have had path and namespace changes implemented where needed.

Next let's install our assets and resources.

```bash
npm install
```

This will take a couple minutes to run. Then we can build our css and javascript, move image files etc.

```bash
npm run dev
```

You should now be able to view the default site in homestead or valet, or boot up a local server via `php artisan serve` and view the app at `localhost:8000`

### Useage

Coming soon ...
