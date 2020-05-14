# FOS JS Routing Bundle
- command : `composer require friendsofsymfony/jsrouting-bundle`
- Add below code to base.html.twig
- `<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>`
- `<script src="{{ path('fos_js_routing_js', { callback: 'fos.Router.setData' }) }}"></script>`
- Code in JS file : `Routing.generate('newsletterSubscribe')`
- Controller's method route : `@Route("/newsletter-subscription", name="newsletterSubscribe", options={"expose"=true})`