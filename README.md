# Translation

- Install `composer require willdurand/js-translation-bundle`
- Include JS / Update HTML in base
- - `<script src="{{ asset('bundles/bazingajstranslation/js/translator.min.js') }}"></script>`
- - `<script src="{{ url('bazinga_jstranslation_js') }}"></script>`
- - Modify in html `<html lang="{{ app.request.locale|split('_')[0] }}">` 
- Create `messages.fr.yaml` & `messages.en.yaml` in translation folder


