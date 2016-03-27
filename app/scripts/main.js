'use strict';
jQuery(document).ready(function($) {
  // Inside of this function, $() will work as an alias for jQuery()
  // and other libraries also using $ will not be accessible under this shortcut
  var fixedNavBar = $('.sticky-row');

  if (fixedNavBar.length) {
    fixedNavBar.affix({
      offset: {
        top: $('.sticky-row').offset().top - $('.sticky-row').height(),
        bottom: $('footer').outerHeight(true),
      },
    });

    fixedNavBar.on('affix.bs.affix', function(e) {
      var currentOffset = parseInt($('.has-navbar-top').css('padding-top'), 10);
      // console.log('affix.bs.affix : ');
      // console.debug(e);
      // console.log('old : ' + currentOffset );
      // console.log('delta : ' + $(e.target).outerHeight(false) );
      // console.log('new : ' + currentOffset + $(e.target).outerHeight(false) );
      $('.has-navbar-top').css('padding-top', (currentOffset + $(e.target).outerHeight(false)) + 'px' );
    });

    fixedNavBar.on('affix-top.bs.affix', function(e) {
      var currentOffset = parseInt($('.has-navbar-top').css('padding-top'), 10);
      // console.log('affix-top.bs.affix : ');
      // console.debug(e);
      // console.log('old : ' + currentOffset );
      // console.log('delta : ' + $(e.target).outerHeight(false) );
      // console.log('new : ' + currentOffset - $(e.target).outerHeight(false) );
      $('.has-navbar-top').css('padding-top', ( currentOffset - $(e.target).outerHeight(false) ) + 'px' );
    });
  }

  var sidebar = $('<div></div>');
  sidebar.addClass('navmenu navmenu-inverse navmenu-fixed-right offcanvas');
  sidebar.addClass('navbar-inverse');
  sidebar.addClass('canvas-slid');
  sidebar.addClass('offcanvas-sidebar');
  $('#header-menu').children().each(function(key,item){
    var menu = $(item).clone();
    sidebar.append(menu);
  });
  console.log(sidebar);
  $('#page').before(sidebar);
  sidebar.offcanvas({
    canvas: 'body',
    placement: 'right',
    toggle: false
  });

  $('#masthead .navbar-toggle').click(function(e) {
    e.preventDefault();
    $('.offcanvas-sidebar').offcanvas('show');
  });

  $('.btn-back-offcanvas').click(function(e) {
    e.preventDefault();
    $('.offcanvas-sidebar').offcanvas('hide');
  });

  $('#header-menu .search-form .input-group-addon').click(function(e) {
    $(this).toggleClass('active');
    $(this).next('input[type="text"]').toggleClass('show').focus();
  });


});
