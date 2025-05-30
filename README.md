# Tech Stack

## External API
This app makes use of Laravel and PHP's built-in web server, with a SQLite database for data persistence, to make up the backend.
The external API being consumed by the server returns a list of information about every country in the world - this app truncates it to 100 results and serves the information as a table via the blade templating engine when the user first visits the site.

## Back end
This backend stack was chosen for its ease of use. The Laravel CLI has a robust project generator which takes care of configuring the database connection,
creating web sessions and example migrations for common tables, common base classes like `Model` and `Controller` to extend custom logic from, as well as the Eloquent ORM for quick entity <-> model mapping.
Laravel also bootstraps routing and middleware for web requests and comes with the PHPUnit unit testing packages for easy to configure unit tests.

## Front end
The front end is a Vue 3 project, chosen because I had some familiarity with Vue 2 and the Options API. Why this was not the most efficient choice for me will be discussed further in the Time Limitations section.
Vite is used to bundle and run the development server for hot-swapping UI components. Cypress is my software of choice for front-end tests, as it's fairly lightweight for how closely you can recreate real user interactions.
Cypress requires extra plugins to play nice with Laravel, and its ESM/Vite ecosystem is much less mature than the CommonJS/Webpack era. Component testing is the latest Cypress offering, a form of integrations test that, in theory,
allows front end components to be tested in relative isolation while still fully interacting with the Laravel server if desired.

# Build and Run the App
Running a Laravel app is pretty painless. A more complicated app would make use of environments like Herd, Homestead, or Valet for convenient access to common PHP binaries and the ability to serve requests over HTTPS with self-signed certificates. I considered implementing one of these in this app, but didn't feel that would be the best of use time, and it would require you to finagle the browser's root trusted certificate store.

These steps do assume you have Node and PHP installed.
## Build Steps
```shell
cp .env.example .env

composer install

php artisan key:generate

npm i

npm run build

# For ease of testing, I have included the .sqlite file. Normally I would never do this. Laravel even ignores it by default when bootstrapping the app
php artisan migrate:fresh --seed

php artisan serve
```

# Testing

## Running PHP Unit Tests
Eloquent's built-in methods reduce the need for defining, therefore testing, many of our own database and model methods. With Cypress for the front end, I focused back end tests on repositories and business logic.

The PHPUnit tests primarily covered the `CountryListRepository.php` class, as well as ensuring that the controller serves the home page as expected.

An IDE like PHPStorm handles running the tests. Otherwise navigate to the project root and run the following in the command line:

`./vendor/phpunit/phpunit/phpunit`

## Running Cypress
While serving the Laravel server, run the following:

`npx cypress open`

and select Component Testing.

Vite's development server interferes with the base URL for network requests made from Cypress.



Initially, I wanted end-to-end tests with Cypress. Unfortunately, the switch to Vite caused some major headaches. Cypress still defaults to webpack, offering some TypeScript documentation for Vite development but is ultimately still pretty weak in that regard. Configuring Cypress support for ESM and Vite has to be possible, but not in this time frame.

For common SPA frameworks, Cypress pushes Component testing. This is also less mature than their end to end testing and requires specific component configuration to take full advantage of what they do offer. If I had time to refactor, I would <i> heavily </i> prioritize slots in my Vue components as that is what Cypress is more tailored to.

As it stands, the front end tests cover component rendering, in spite of incompatibilities with Vite (failing to fully bundle JS and CSS files), and some basic functionality for client-side operations. 

# Time Limitations

## Many to Many Relationships
I realized too late in the project that I should not have architected the `Country` to `CountryList` relationship as One-to-Many.
This meant that deleting a list of favorite countries would force every country associated with that list to be deleted for data integrity purposes.

The "workaround" was creating a row in the country table for every country added to a favorites list, which would cause many, many duplicates if this were a real app. Refactoring this to make use of a pivot table would be one of the highest priority refactoring tasks if I had more time available.

## Vite
I have only worked with webpack and did not foresee how much a headache choosing the latest versions of everything would be. If this app were a proof of concept for a larger project, I would caution against using Vite for this specific tech stack until the ecosystem matures more.

Vue 3 recommends using Vite but still offers webpack support. Especially with Cypress, this is what I would choose to use in retrospect.

## Styling
I could spend the few hours allotted for this project centering a div and purposefully chose to limit how much time I spent tweaking the front end.
I think this is apparent as you read down the checklist. As my available time dwindled, I focused on proving the functionality exists rather than making it look aesthetic.
Unfortunately, this is why we see the raw text appear on screen when viewing favorite lists. 

## User Features
Nice-to-have's like pruning and naming lists were not reached. Instead, I've used placeholders such as generating a unique name for lists when saving them. 
In lieu of feature complete, I have added placeholders where I can to show where in the UI these features would go. Modals and nested dropdowns would be next.
