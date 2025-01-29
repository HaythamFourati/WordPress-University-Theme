import $ from "jquery";

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    // Place On the Top Important
    this.addSearchHTML();
    // ////////////////////
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.getJSON(
      `/wp-json/university/v1/search?keyword=${this.searchField.val()}`,
      (results) => {
        this.resultsDiv.html(`
    <div class="row">
        <div class="one-third">
        <h2 class="search-overlay__section-title"> Pages <h2>
        <ul class="link-list min-list"> 
      ${
        results.pages.length === 0
          ? "<li>No Results Found</li>"
          : results.pages
              .map((result) => {
                return `<a href="${result.Link}"><li>${result.Name}</li></a>`;
              })
              .join("")
      }
      </ul>
        </div>

        <div class="one-third">
        <h2 class="search-overlay__section-title"> Professors <h2>
         <ul class="professor-cards"> 
           ${
             results.professors.length === 0
               ? "<li>No Results Found</li>"
               : results.professors
                   .map((result) => {
                     return `
                    <li class="professor-card__list-item">
                      <a class="professor-card" href="${result.Link}">
                        <img class="professor-card__image" src="${result.Picture}">
                        <span class="professor-card__name">${result.Name}</span>
                      </a>
                    </li>
                  `;
                   })
                   .join("")
           }
          </ul>

        </div>

        <div class="one-third">
        <h2 class="search-overlay__section-title"> Posts <h2>

        <ul class="link-list min-list"> 
      ${
        results.posts.length === 0
          ? "<li>No Results Found</li>"
          : results.posts
              .map((result) => {
                return `<a href="${result.Link}"><li>${result.Name}</li></a>`;
              })
              .join("")
      }
      </ul>
        </div>

    </div>
        `);
      }
    );

    // this.resultsDiv.html();
    // this.isSpinnerVisible = false;
  }

  keyPressDispatcher(e) {
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      !$("input, textarea").is(":focus")
    ) {
      this.openOverlay();
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    setTimeout(() => this.searchField.focus(), 350);

    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    console.log("our close method just ran!");
    this.isOverlayOpen = false;
    this.searchField.val(null);
  }

  addSearchHTML() {
    $("body").append(`
      <!-- Search Overlay Popup module -->
  <div class="search-overlay">
    <div class="search-overlay__top">
      <div class="container">
        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
        <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
      </div>
    </div>
    <div class="container">
      <div id="search-overlay__results">

      </div>
    </div>
  </div>
      
      `);
  }
}

export default Search;
