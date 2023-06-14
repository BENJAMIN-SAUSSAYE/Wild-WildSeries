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

document.getElementById("watchlist").addEventListener("click", addToWatchlist);

function addToWatchlist(event) {
  event.preventDefault();
  const watchlistLink = event.currentTarget;
  const link = watchlistLink.href;
  // Send an HTTP request with fetch to the URI defined in the href
  try {
    fetch(link)
      // Extract the JSON from the response
      .then((response) => response.json())
      // Then update the icon
      .then((data) => {
        const watchlistIcon = watchlistLink.firstElementChild;

        if (data.isInWatchlist) {
          watchlistIcon.classList.remove("bi-heart", "text-light"); // Remove the .bi-heart (empty heart) from classes in <i> element
          watchlistIcon.classList.add("bi-heart-fill", "text-danger"); // Add the .bi-heart-fill (full heart) from classes in <i> element
        } else {
          watchlistIcon.classList.remove("bi-heart-fill", "text-danger"); // Remove the .bi-heart-fill (full heart) from classes in <i> element
          watchlistIcon.classList.add("bi-heart", "text-light"); // Add the .bi-heart (empty heart) from classes in <i> element
        }
      });
  } catch (err) {
    console.error(err);
  }
}
