<?php
/**
 * The template for displaying all posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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


 /**
 * Single Post Masthead
 *
 */
?>
<section id="hero-content" class="hero-content">

<!-- Hero Start -->
	<section>
		<h1><?php the_title(); ?></h1>
		<?php get_template_part( 'partials/post-meta' ); ?>
	</section>
<!-- Hero Start -->
</section>
<section id="page-content" class="page-content">

	<section>
		<div class="post-image">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="thumb">
						<?php the_post_thumbnail(
							'thumb_1200',
							array(
								'alt'   => get_the_title(),
								'title' => get_the_title(),
							)
						); ?>
					</div>
				<?php } else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/admin/defaults/default-image.webp"  class="" alt="<?php get_the_title(); ?>" title="<?php get_the_title(); ?>">
				<?php } ?>
			</a>
		</div><!-- .post-image -->
	</section>

<?php
/**
 * Single Post Masthead End
 *
 */
?>
<?php
	while ( have_posts() ) { the_post();

		//Include specific template for the content.
		get_template_part( 'partials/content', get_post_type() );

	} ?>

	<div class="clear"></div>

<?php get_footer();
