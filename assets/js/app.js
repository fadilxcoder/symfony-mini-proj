/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

import $ from 'jquery';
import 'bootstrap';

import 'jquery-migrate';

import '../plugins/gijgo';
import '../plugins/vegas.min';
import '../plugins/owl.carousel.min';
import '../plugins/magnific-popup.min';
import '../plugins/slicknav.min';
import '../js/main';

// Usage of require (node.js)
const scriptVar = require('./Components/Script');

import './Components/Core';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

/********** My own codes below **********/

export function init()
{
    // console.log('init in newsletter.js');
}

function rgpdCookie()
{
    tarteaucitron.init({
        "privacyUrl": "", /* Privacy policy url */
        "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
        "cookieName": "tarteaucitron", /* Cookie name */
        "orientation": "top", /* Banner position (top - bottom - middle - popup) */
        "groupServices": true, /* Group services by category */
        "showAlertSmall": false, /* Show the small banner on bottom right */
        "cookieslist": false, /* Show the cookie list */
        "showIcon": false, /* Show cookie icon to manage cookies */
        // "iconSrc": "", /* Optionnal: URL or base64 encoded image */
        "iconPosition": "BottomRight", /* Position of the icon between BottomRight, BottomLeft, TopRight and TopLeft */
        "adblocker": false, /* Show a Warning if an adblocker is detected */
        "DenyAllCta" : true, /* Show the deny all button */
        "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
        "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */
        "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */
        "removeCredit": true, /* Remove credit link */
        "moreInfoLink": true, /* Show more info link */
        "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
        "cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for subdomain website */
        "readmoreLink": "", /* Change the default readmore link pointing to tarteaucitron.io */
        "mandatory": true /* Show a message about mandatory cookies */
    });
    (tarteaucitron.job = tarteaucitron.job || []).push('facebookcomment');
    (tarteaucitron.job = tarteaucitron.job || []).push('facebook');
    (tarteaucitron.job = tarteaucitron.job || []).push('amazon');
    (tarteaucitron.job = tarteaucitron.job || []).push('xandrconversion');
    (tarteaucitron.job = tarteaucitron.job || []).push('bingads');
    (tarteaucitron.job = tarteaucitron.job || []).push('tawkto');
    (tarteaucitron.job = tarteaucitron.job || []).push('alexa');
}

/* Function to be called once all DOM elements of the page are ready to be used */
$(function () {
    scriptVar.loggedData();
    rgpdCookie();
});
