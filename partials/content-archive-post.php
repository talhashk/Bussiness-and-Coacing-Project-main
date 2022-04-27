<?php
/**
 * Template part for displaying posts in an archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */



?>

<article  class="post-box" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-image-archive">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-featured-thumb">
					<?php the_post_thumbnail(
						'thumb_600',
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
	<div class="post-content-archive">
		<h4 id="post-<?php the_ID(); ?>" class="post-title-archive">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h4>
		<?php get_template_part( 'partials/post-meta-archive' ); ?>
		<p><?php echo glide_excerpt_nomore( 130 ); ?></p>
	</div><!-- .post-content -->
</article><!-- #post-<?php the_ID(); ?> -->
