$(function() {

  $("#contactForm input,#contactForm textarea").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      $button = $("#contactForm button[type='submit']");
      $button.prop("disabled", true); // Disable submit button until call is complete to prevent duplicate messages
      setTimeout(()=>{$button.prop("disabled", false);}, 5000);
    },
    filter: function() {
      return $(this).is(":visible");
    },
  });

});
