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