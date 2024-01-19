( function( $ ) {
	'use strict';	
	
	$( document ).ready( function() {
		
		/* direct menu */
		$( '.direct-menu a' ).focus( function() {
			$( '.direct-menu' ).addClass( 'focus' );
		} );
		$( '.direct-menu a' ).blur( function() {
			$( '.direct-menu' ).removeClass( 'focus' );
		} );
		
		/* menu */
		$( '.menu-mobile' ).click( function() {
			$( '#header' ).toggleClass( 'mobile' );
			$( 'body' ).toggleClass( 'mobile-overflow' );
		} );
		
		/* back top */
		$( '.back-top' ).click( function() {
			$( 'html, body' ).animate( { scrollTop: 0 } );
			return false;
		} );
		
		/* accessible menu/submenu */
		if ( document.getElementById( 'menu-header-main' ) ) {
			var menubar = new Menubar( document.getElementById( 'menu-header-main' ) );
			menubar.init();
		}
		
		/* search form */
		$( '.open-search' ).click( function() {
			$( '.header-search' ).addClass( 'open' );
			$( '.overlay' ).addClass( 'visible' );
			$( '.header-search .search-field' ).focus();
		} );
		$( '.close-search' ).click( function() {
			$( '.header-search' ).removeClass( 'open' );
			$( '.overlay' ).removeClass( 'visible' );
		} );
	} );

	/* sharing buttons */
	if ( $('.imera-sharing').length > 0 ) {
		init_sharring();
	}

} ) ( jQuery );

function init_sharring() {
	const ffbBtn = document.querySelector(".facebook-btn");
	const ftwBtn = document.querySelector(".twitter-btn");
	const fliBtn = document.querySelector(".linkedin-btn");
	let postUrl = encodeURI(document.location.href);
	let postTitle = encodeURI("Hi everyone, please check this out: ");
	let via = encodeURI("itsmepronay");

    ffbBtn.setAttribute(
        "href",
        `https://www.facebook.com/sharer.php?u=${postUrl}`
    );

    ftwBtn.setAttribute(
        "href",
        `https://twitter.com/share?url=${postUrl}&text=${postTitle}&via=${via}`
    );

    fliBtn.setAttribute(
        "href",
        `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`
    );
}
