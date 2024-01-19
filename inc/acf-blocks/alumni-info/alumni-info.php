<div class="alumni-info">
	<div class="alumni-staying">
		<div class="alumni-domain">
			<?php
			echo '<span class="alumni-line">' . esc_html__( 'Disciplines : ', 'imera' ) . '</span>';
			if ( 'residents' === get_post_type() ) {
				$disciplins = wp_get_post_terms( get_the_ID(), 'resident_type', array( 'fields' => 'names' ) );
			}
			if ( 'alumnis' === get_post_type() ) {
				$disciplins = wp_get_post_terms( get_the_ID(), 'alumni_type', array( 'fields' => 'names' ) );
			}
			if ( ! empty( $disciplins ) ) {
				foreach ( $disciplins as $disciplin ) {
					echo '<span>' . esc_html( $disciplin ) . '</span>';
				}
			}
			?>
		</div>
		<?php
		$range_year = get_field( 'periode_residence_alumni', get_the_ID() );
		$post_institution = get_field( 'post_and_institution' );
		$residence_type = get_field( 'residence_type' );
		$residence_period = get_field( 'residence_period' );
		if ( ! empty( $range_year ) ) :
			?>
		<div class="alumni-year">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Année académique : ', 'imera' ) . '</span>';
				echo esc_html( $range_year );
			?>
		</div>
			<?php
			endif;
		if ( ! empty( $post_institution ) ) :
			?>
		<div class="alumni-post">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Poste et institution de provenance : ', 'imera' ) . '</span>';
				echo esc_html( $post_institution );
			?>
		</div>
			<?php
		endif;
		if ( ! empty( $residence_type ) ) :
			?>
		<div class="alumni-residence">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Type de résidence : ', 'imera' ) . '</span>';
				echo esc_html( $residence_type );
			?>
		</div>
			<?php
		endif;
		if ( get_the_terms( get_the_ID(), 'alumni_chaire' ) ) :
			?>
		<div class="alumni-residence">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Chaire : ', 'imera' ) . '</span>';
				echo esc_html( join( ', ', wp_list_pluck( get_the_terms( get_the_ID(), 'alumni_chaire' ), 'name' ) ) );
			?>
		</div>
			<?php
		endif;
		if ( get_the_terms( get_the_ID(), 'alumni_programme' ) ) :
			?>
		<div class="alumni-residence">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Programme de recherche : ', 'imera' ) . '</span>';
				echo esc_html( join( ', ', wp_list_pluck( get_the_terms( get_the_ID(), 'alumni_programme' ), 'name' ) ) );
			?>
		</div>
			<?php
		endif;
		if ( ! empty( $residence_period ) ) :
			?>
		<div class="alumni-period">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Période de résidence : ', 'imera' ) . '</span>';
				echo esc_html( $residence_period );
			?>
		</div>
			<?php
		endif;
		?>
	</div>
	<div class="alumni-links">
		<?php
		$email = get_field( 'alumni_email' );
		$website = get_field( 'alumni_website' );
		$wiki = get_field( 'alumni_wikipedia' );
		$custom_links = get_field( 'custom_links' );
		if ( ! empty( $email ) ) :
			?>
		<div class="alumni-email">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'E-mail : ', 'imera' ) . '</span>';
				echo '<a href="mailto:' . esc_html( $email ) . '">' . esc_html( $email ) . '</a>';
			?>
		</div>
			<?php
			endif;
		if ( ! empty( $website ) ) :
			?>
		<div class="alumni-website">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Site web : ', 'imera' ) . '</span>';
				echo '<a href="' . esc_html( $website ) . '">' . esc_html( $website ) . '</a>';
			?>
		</div>
			<?php
			endif;
		if ( ! empty( $wiki ) ) :
			?>
		<div class="alumni-wikipedia">
			<?php
				echo '<span class="alumni-line">' . esc_html__( 'Wikipedia : ', 'imera' ) . '</span>';
				echo '<a href="' . esc_html( $wiki ) . '">' . esc_html( $wiki ) . '</a>';
			?>
		</div>
			<?php
				endif;
		if ( ! empty( $custom_links ) ) {
			foreach ( $custom_links as $custom_link ) :
				?>
				
			<div class="alumni-social">
				<span class="alumni-line"><?php echo esc_html( $custom_link['link_name'] ); ?> : </span>
				<a href="<?php echo esc_html( $custom_link['custom_link'] ); ?>"><?php echo esc_html( $custom_link['custom_link'] ); ?></a>
			</div>

				<?php
				endforeach;
		}
		?>
	</div>
</div>
