(function($) {
  // Site title
  wp.customize('blogname', function(value) {
    value.bind(function(to) {
      $('.brand').text(to);
      $( '.site-title a' ).text( to );
    });
  });

  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );
  // Header text color.
  wp.customize( 'header_textcolor', function( value ) {
    value.bind( function( to ) {
      if ( to === 'blank' ) {
        $( '.site-title, .site-description' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute',
        } );
      } else {
        $( '.site-title, .site-description' ).css( {
          'clip': 'auto',
          'color': to,
          'position': 'relative',
        } );
      }
    } );
  } );
  // Footer Text
  wp.customize( 'custom_footer_text', function( value ) {
    value.bind( function( to ) {
      $( '.footer-text' ).html( to );
    } );
  } );


})(jQuery);
