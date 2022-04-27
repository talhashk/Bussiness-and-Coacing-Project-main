<?php
/**
 * Template Name: Blog
 * Template Post Type: page
 *
 * This template is for displaying blog page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 *
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;


$basethemevar_pagetitle = (isset($fields['basethemevar_pagetitle']) && $fields['basethemevar_pagetitle']!='' ) ? $fields['basethemevar_pagetitle'] : get_the_title();

?>

<section id="hero-content" class="hero-content">
<!-- Hero Start -->
	<h1><?php echo $basethemevar_pagetitle; ?></h1>
<!-- Hero Start -->
</section>

<section id="page-content" class="page-content">
<?php
	// WP_Query arguments
	$args = array(
		'post_type'              => array( 'post' ),
		'posts_per_page'         => '-1',
	);
	// The Query
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
	} else {

		// If no content, include the "No posts found" template.
		get_template_part( 'partials/content', 'none' );
	}

	if (function_exists("glide_pagination")) {
		glide_pagination($query->max_num_pages);
	}

?>

<?php get_footer();
