( function( $ ) {
	'use strict';
	var lastScrollTop = 0;
	$( document ).ready( function() {
        /* Menu sticky */
		stickyMenu();
		lastScrollTop = $( window ).scrollTop();
		$( window ).scroll( function () {
			stickyMenu();
		} );

		/* Dropdown sub-menu */
		$( '.menu-item a' ).click( function() {
			// console.log( $( this ).parent().closest('.menu-item') );
			$( this ).parent().toggleClass('touched');
		})
    } );

	/* Header sticky */
	function stickyMenu() {
		/*if( window.innerWidth >= 1024 ) {
			if( $( window ).scrollTop() > 1 ) {
				$( "header" ).addClass( "sticky" );
			} else {
				$( "header" ).removeClass( "sticky" );
			}
		} else {*/
			var currentScroll = $( window ).scrollTop();
			var submenu = $( '.sub-menu' ).css('opacity');
			// console.log(currentScroll);
			if( currentScroll > 1 ) {
				$( "header" ).addClass( "sticky" )
			} else {
				$( "header" ).removeClass( "sticky" );
			}

			if( currentScroll > 1 && currentScroll < lastScrollTop ) {
				$( "header" ).addClass( "shown" );
			} else if ( submenu <= 0 ){
				$( "header" ).removeClass( "shown" );
			}
			lastScrollTop = currentScroll;
		// }
	}

} ) ( jQuery );