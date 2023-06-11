import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  static targets = ["theming"];

  connect() {
    this.darkMode = JSON.parse(localStorage.getItem("darkMode")) ?? false;
    this.updateTheme();
  }

  toggleDarkMode(event) {
    //event.preventDefault();
    this.darkMode = !this.darkMode;
    localStorage.setItem("darkMode", this.darkMode);
    this.updateTheme();
  }

  updateTheme() {
    //console.log("coucou");
    this.themingTarget.setAttribute(
      "data-bs-theme",
      this.darkMode ? "dark" : "light"
    );
  }
}
