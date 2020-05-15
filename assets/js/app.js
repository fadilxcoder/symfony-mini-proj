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
    //console.log('init!');
}

/* Function to be called once all DOM elements of the page are ready to be used */
$(function () {
    scriptVar.loggedData();
});
