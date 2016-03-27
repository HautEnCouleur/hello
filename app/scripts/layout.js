'use strict';
jQuery(document).ready(function($) {

  $('#btn-full-height-page').click(function(e) {
    $('#page').toggleClass('page-full-height');
  });

  $('#btn-full-height-content').click(function(e) {
    $('#page .content').toggleClass('content-stretch');
  });

  var addSpacer = function(e){
    var template = $('.theme-spacer.template').clone();
    template.removeClass('template');
    template.find('.add-spacer').click(addSpacer);
    template.find('.remove-spacer').click(function(e){
      $(this).closest('.theme-spacer').remove();
    });
    $('.theme-spacer.template').before(template);
  };


  $('#btn-add-spacer').click(addSpacer);

  $('#masthead').headroom();

});
