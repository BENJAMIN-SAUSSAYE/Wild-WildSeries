/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

const $ = require("jquery");
const bootstrap = require("bootstrap");

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";

//import bootstrap icon
import "bootstrap-icons/font/bootstrap-icons.css";

// start the Stimulus application
import "./bootstrap";

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

var popoverTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="popover"]')
);

var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl);
});
