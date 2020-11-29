# FOS JS Routing Bundle

- command : `composer require friendsofsymfony/jsrouting-bundle`
- Add below code to base.html.twig
- `<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>`
- `<script src="{{ path('fos_js_routing_js', { callback: 'fos.Router.setData' }) }}"></script>`
- Code in JS file : `Routing.generate('newsletterSubscribe')`
- Controller's method route : `@Route("/newsletter-subscription", name="newsletterSubscribe", options={"expose"=true})`

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


