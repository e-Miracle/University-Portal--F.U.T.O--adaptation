(function($) {
  "use strict";

  /*========================
  1.Parallax banner id div
  =========================*/
  $('#lp-pom-block-10').parallax("50%", 0.3);

  // Scroll to DIV
  $("#arrow").on("click", function() {
    $('html, body').animate({
      scrollTop: $("#about-container").offset().top
    }, 2000);
  });

  /*===================
  2.Scroll To Top
    ===================*/

  // hide #back-top first
  $("#back-top").hide();

  // fade in #back-top
    $(window).on("scroll", function() {
      if ($(this).scrollTop() > 100) {
        $('#back-top').fadeIn();
      } else {
        $('#back-top').fadeOut();
      }
    });

    // scroll body to 0px on click
    $('#back-top a').on("click", function() {
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });

})(jQuery);