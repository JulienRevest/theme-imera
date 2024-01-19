<div class="post-info">
	<?php
	if ( get_field( 'show_post_author' ) ) :
		?>
	<div class="post-author">
		<?php
		echo esc_html_e( 'Écrit par ', 'imera' );
		$author = get_field( 'published_by' );
		echo esc_html( empty( $author ) ? get_the_author() : $author );
		?>
	</div>
	·
	<?php endif ?>
	<div class="post-date">
		<?php
		if ( 'agenda' != get_post_type() ) {
			echo esc_html_e( 'Publié le ', 'imera' );
		}

		$event_date = get_field( 'event_date' );
		if ( get_field( 'event_date_end' ) ) {
			$event_date = $event_date . ' / ' . get_field( 'event_date_end' );
		}
		echo esc_html( empty( $event_date ) ? get_post_datetime()->format( 'd M Y' ) : $event_date );
		?> <?php echo get_field( 'event_info' );?>
	</div>
</div>