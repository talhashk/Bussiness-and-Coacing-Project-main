<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */


$post_data=get_queried_object();
$pID  = get_the_ID();
if (function_exists('get_fields') && function_exists('get_fields_escaped')) {
	$post_fields = get_fields_escaped( $pID );
}

?>

<article class="post-container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="s-section">
		<div class="wrapper">
			<div class="post-content">
				<?php get_template_part( 'partials/content' ); ?>
				<div class="post-tags">
					<?php the_tags( '', ',', '' ); ?>
				</div>
				<div class="post-pagination">
					<?php the_posts_pagination() ?>
				</div>
				<div class="post-comments">
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
	wp_reset_query();
	wp_reset_postdata();

	$basethemevar_rp_selection_criteria = isset($fields['basethemevar_rp_selection_criteria']) ? $fields['basethemevar_rp_selection_criteria'] : null;
	if($basethemevar_rp_selection_criteria == 'random'){

		$args = array(
			'posts_per_page' => 3,
			'post__not_in'   => array( $post->ID ),
			'orderby'        => 'rand',
		);

		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				//Include specific template for the content.
				get_template_part( 'partials/content', 'archive-post' );
			}
		?>

		<div class="clear"></div>
		<?php
		}
	}
	else {
		global $post;
		$basethemevar_selected_posts = array();
		$basethemevar_selected_posts = isset($fields['basthemevar_rp_selected_posts']) ? $fields['basthemevar_rp_selected_posts'] : null;
		if ( $basethemevar_selected_posts ) { ?>
				<div class="related-posts ">
					<h3><?php _e( 'Related Posts', 'basetheme_td' ) ?></h3>
					<?php
						foreach ( $basethemevar_selected_posts as $basethemevar_post ) {
							$post = $basethemevar_post;
							setup_postdata( $post );
							$pID         = $post->ID;
							$post_fields = get_fields( $pID );
							$custom_field  = $post_fields['custom_field'];
							$src         = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'thumb_600', false );
							if ( ! $src ) {
								$src = get_template_directory_uri() . '/assets/img/admin/defaults/default-image.webp';
							} else {
								$src = $src[0];
							}
								get_template_part( 'partials/content', 'archive-post' );
						}
					?>
				</div>

		<?php } wp_reset_query();
		wp_reset_postdata();
		}
		?>

</article>
