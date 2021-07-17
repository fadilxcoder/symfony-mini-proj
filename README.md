# Procedure & Notes to run application

- Create database : `doctrine:database:create`
- Migrate entities : `doctrine:migrations:migrate` OR `doctrine:schema:update --force`
- Populate contents : `doctrine:fixtures:load`
- (Optional) Fake data with CLI : `app:populate:db` - **Created command**
- `dev-pack` are developped packages that are used in the application

# Deploying on HEROKU

- create file : `Profile`
- change configuration in .env : `APP_ENV=prod`
- change configuration in *config/packages/prod/monolog.yaml* : `nested > path: "php://stderr"`
- **Heroku** -> In CMD : `heroku config:set NPM_CONFIG_PRODUCTION=false YARN_PRODUCTION=false NODE_MODULES_CACHE=false`
- **Heroku** -> In CMD : `heroku buildpacks:add --index 1 heroku/nodejs` tell Heroku that our project is PHP but NodeJS too
- Comment `yarn.lock` i.e : `yarn.lock` to `~yarn.lock` to avoid conflict when installing node packages.
- **Heroku** -> In CMD : `heroku logs --tail` to see logs of heroku process
- **Git** -> In CMD : `git add .`
- **Git** -> In CMD : `git commit -m 'your commit message goes here'`
- **Git** -> In CMD : `git push heroku master`
- **Heroku** -> In CMD : `heroku run bash -a gfx-your-app-name` connection to heroku terminal

# Service Container / Dependency Injection / `services.yaml`

- Service container is like a box that contain classes like twig, mailer, repository, router, session, doctrine, ...
- These classes are injected in 3 ways :
- - `src/config/bundles.php`
- - `src` folder **excluding** some mentionned in services.yaml
- - `services.yaml` - class installed elsewhere but are registered in this file
<br>

- In `services.yaml`
- *autoconfigure: true* : symfony detect the class and make it available for use
- *autowire: true* : make it possible to be injected
<pre>
services:
  your_service_name_alias:
    class: App\Directory\ClassName
    arguments: ["@another_service_name", "plain_text", "%services_yaml_parameter_name", "'%env(ENV_VARIABLE)%"]
    tags: { name: tag_name*} 
</pre>

- - *tag_name** - https://symfony.com/doc/current/reference/dic_tags.html (Built-in Symfony Service Tags)
- - **tags** hook your service into different part of the core system
- - You can remove the **arguments** when using *autowire: true*, symfony will read the type-hints of each constructor argument

# Event Listener / Subscriber / Dispatcher

- List of Kernel Events : https://symfony.com/doc/current/reference/events.html
- Events and Event Listeners : https://symfony.com/doc/current/event_dispatcher.html
- Event subscriber always know which event they are listening to (Knowledge of the event is kept in the class) compared to event listener where we have to register it in `services.yaml` and use *tags* to listen to a particular event

- ### Event Listener

- Listen on `kernel.event_listener` for event `kernel.controller` - see `services.yaml`
- Handling in `src/Listener/OnControllerListener.php`

- ### Event Subscriber

- Listen on `security.interactive_login` in `src/EventSubscriber/LoginListenerSubscriber.php`

- ### Event Dispatcher

- Dispatch events (when something happen, an avent can be triggered), see how it work:
- - `src/Controller/VehicleController.php` - Dispatch it
- - `src/EventSubscriber/Events.php` - Naming of events
- - `src/EventSubscriber/Events/VehicleEvent.php` - The event class
- - `src/EventSubscriber/AppSubscriber.php` - Logic handling
- The EventDispatcher Component : https://symfony.com/doc/current/components/event_dispatcher.html


# Sub Request

- Method `_newsletterForm` in `HomeController`
- In twig, use `{{ render(controller('App\\Controller\\HomeController::_newsletterForm', { yr: "now"|date("Y")  })) }}`

# FOS JS Routing Bundle

- command : `composer require friendsofsymfony/jsrouting-bundle`
- Add below code to base.html.twig
- `<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>`
- `<script src="{{ path('fos_js_routing_js', { callback: 'fos.Router.setData' }) }}"></script>`
- Code in JS file : `Routing.generate('newsletterSubscribe')`
- Controller's method route : `@Route("/newsletter-subscription", name="newsletterSubscribe", options={"expose"=true})`
- Add route in `routes/fos_js_routing.yaml`

# JS Class

- Using JS Class
- Using `module.exports` & `export default`
- Requiring `Script.js`, exporting modules & using constant in `app.js`
- Using a JS variable ob object - `Core.js` & importing it in `app.js`
- Exporting JS function in `app.js` & importing in `Newsletter.js` class
- Added new JS in `webpack.config.js`
- Configuring folder structure of JS ~ **plugins**

# Customized 404 page & IP authorized - Under Maintenance

### 503 - Under Maintenance

- In `config/services.yaml`, add `maintenance` in *parameters*
- In `config/packages/twig.yaml`, add `maintenance` in *globals*
- Create a PHP Class : `src/Listener/OnRequestListener`
- Add `on_request_listener` in `config/services.yaml` 
- Create your twig to display. **Twig should NOT extend base.html.twig**

### 404 - Page not found / 500 - Internal Server Error / 403 - Forbidden Error

- To verify the created page in DEV environment, add `_error/404`, `_error/403` or `_error/404.json`, `_error/403.xml` in URL 
- Create the error page in `templates/bundles/TwigBundle/Exception`.
- Depending on errors, create your page : *error404.html.twig*, *error500.html.twig*, ...
- Need to clear cache : `php bin/console cache:clear`
- All **error page CAN extend base.html.twig**

# Translation (Optional)

- Install `composer require willdurand/js-translation-bundle`
- Include JS / Update HTML in base
- - `<script src="{{ asset('bundles/bazingajstranslation/js/translator.min.js') }}"></script>`
- - `<script src="{{ url('bazinga_jstranslation_js') }}"></script>`
- - Modify in html `<html lang="{{ app.request.locale|split('_')[0] }}">` 
- Create `messages.fr.yaml` & `messages.en.yaml` in translation folder

# Data Fixtures

- Install `composer require --dev orm-fixtures`
- DataFixtures folder will appear
- Create your class `PricingBlockFixtures`
- Use command to RUN `php bin/console doctrine:fixtures:load --group=pricing-block --append`
- If `--append` is omitted, 'It will clear DB'

# Commands

- Create folder `src/Command`
- Create `PopulateDatabaseCommand` class
- See code base for more details

# Migrations

- Edit `config/packages/doctrine_migrations.yaml` to add configuration for migration folder
- Run : `php bin/console make:migration` to create migration file
- Run : `php bin/console doctrine:migrations:migrate` to run migration and create tables

# Using SQL `rand()` in doctrine

- GOTO `src/config/packages/doctrine.yaml`
- Add `dql` under `orm`
- Check `src/Doctrine/DoctrineHelper`
- Custom query in `VehiculesRepository`
- See code base for more details
- `rand()` does not work in SQLite, see changes in `VehiculesRepository.php`

# Commands `php bin console ...`

- `php bin/console doctrine:query:sql 'select * from category'` / `... d:q:s 'select * from category'` : Results array - Write SQL queries
- `php bin/console make:migration` - Create migrations
- `php bin/console doctrine:migrations:migrate` - Execute migrations
- `php bin/console doctrine:database:create` - Create DB
- `php bin/console doctrine:database:drop` - Delete DB
- `php bin/console make:subscriber <NameOfSubscriber>` - Create subscriber
- `php bin/console debug:event-dispatcher <EventName>` - List of all listeners registered
- `php bin/console debug:autowiring <FullClassNanme>` - List of all of the available services that can be used for autowiring
- `php bin/console debug:container` - List of container services

# Entity (Addons)

- `Vehicules.php` : `@ORM\HasLifecycleCallbacks` , `initSlug()`, `@ORM\PrePersist`, `@ORM\PreUpdate`

# Symfony Form Collection & Twig / Macros

- Gist repo : https://gist.github.com/fadilxcoder/ee7e7a9ab128a084285e01e348774ba2

# User Entity / Login / Logout

- Create User entity 
- - `php bin/console make:user` & choose settings (email as unique)
- - `php bin/console make:entity` > `User` , Add new properties if needed 
- - Edit`User.php`, modify `eraseCredentials()`, `getRoles()` if needed
- - Property ending with `At` (createdAt, lastLoginAt, ...) are detected as *datetime*


- Login / Logout functionality
- `php bin/console make:auth` & choose settings (`[1] Login form authenticator, `LoginFormAuthenticator`, `SecurityController`, ...)
- Using `Doctrine\HashPasswordListener` & register the Subscriber as a Service in `services.yaml`
- - Manipulate *password* by using getter/setter *plainPassword* - Set the plain-text password on the User and encode it automatically via a Doctrine listener when it saves
- Update method `onAuthenticationSuccess()` in *LoginFormAuthenticator.php*

# Cache

- See `src/Controller/HomeController.php` - `index()` : using cache to save data for 60 seconds

# Custom packages

- Custom created packages `dev-pack`, check configuration of file structure before installing packages
- Might need to remove `composer.lock` & then `composer install`
- Register class in `services.yaml`
- Use it by depency injection `src/Controller/HomeController.php` - `debugApp`

# Mailer

- `src/Mailer/BaseMailer.php` can be used in services by passing arguments and returning the `$templateEmail`
<pre>
// The templated object
$templateEmail = BaseMailer::getEmailObject(
    $sender,
    $to,
    $subject,
    'emails/your_twig_file.html.twig',
    [
        'message' => $messageString,
        'application_name' => $this->applicationName,
    ]
);

$templateEmail->addReplyTo($sender);

// Send the email
$this->mailer->send($templateEmail);
</pre>

- `src/Mailer/AuthMailer.php` send email to user on each connection (event subscriber) to plateform
- `src/templates/base-email.html.twig` - email base template