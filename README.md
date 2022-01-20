# Serenity Lotus Framework

### Action Domain Responder package for SerenityPHP.

This is the base framework that provides ADR and Inertia support for Serenity.

You can learn more about ADR and why we think it's far superior to MVC at the [ADR repository.](https://github.com/pmjones/adr)

Learn more about **Serenity** at: [SerenityPHP.com](https://serenityphp.com/docs)

Here are the package contents.

```
src
 ├─> Lotus
 │   ├─> Concerns
 │   │   ├── ImmutableActionMethods.php
 │   │   └── SelfResolves.php
 │   ├─> Contracts
 │   │   ├── ActionInterface.php
 │   │   ├── CriteriaInterface.php
 │   │   ├── CriterionInterface.php
 │   │   ├── FilterInterface.php
 │   │   ├── PayloadInterface.php
 │   │   ├── RepositoryInterface.php
 │   │   ├── ResponderInterface.php
 │   │   ├── ResponseFactoryInterface.php
 │   │   └── ServiceInterface.php
 │   ├─> Core
 │   │   ├── Action.php
 │   │   ├── BladeResponder.php
 │   │   ├── Breadcrumbs.php
 │   │   ├── Entity.php
 │   │   ├── Filter.php
 │   │   ├── Options.php
 │   │   ├── Payload.php
 │   │   ├── Repository.php
 │   │   ├── Responder.php
 │   │   ├── Service.php
 │   │   └── User.php
 │   ├─> Exceptions
 │   │   ├── EntityNotFound.php
 │   │   ├── NoEntityDefined.php
 │   │   └── NoResponderDefined.php
 │   ├── Lotus.php
 │   ├─> Middleware
 │   │   ├── AccountVerified.php
 │   │   ├── CheckSystemPassword.php
 │   │   ├── InertiaMiddleware.php
 │   │   └── MuteActions.php
 │   ├─> Payloads
 │   │   └── InertiaPayload.php
 │   ├─> Providers
 │   │   └── LotusServiceProvider.php
 │   ├─> Responders
 │   │   └── Vue.php
 │   └── helpers.php
 └─> config
     └── lotus.php
```
