jQuery( function( $ ) {

    // https://rudrastyh.com/wordpress/load-more-posts-ajax.html

	$( '.imera-loadmore-button' ).click(function(){
		var button = $(this),
		data = {
			'action':    'loadmore',
			'query':     imera_loadmore_params.query_args, // that's how we get params from wp_localize_script() function
			'page':      imera_loadmore_params.current_page + 1, // Default paged is at 0, we increment it here
			'simple':    imera_loadmore_params.simple,     // Specifify that this query is a simple have_posts loop
		};
		var content_button = $(this).html();
		$.ajax({ // you can also use $.post here
			url : imera_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text( '...' ); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					button.html( content_button ); // insert new posts
                    $( '.card-container' ).append(data)
					imera_loadmore_params.current_page++;

					if ( imera_loadmore_params.current_page == imera_loadmore_params.max_page ) 
					$( '.imera-loadmore' ).remove(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					$( '.imera-loadmore' ).remove(); // if no data, remove the button as well
				}
			}
		});
	});
});