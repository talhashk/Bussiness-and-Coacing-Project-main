<?php
/**
 * The template for displaying website footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */
// Global variables
global $option_fields;
global $pID;
global $fields;

$pID = get_the_ID();

if ( is_home() ) {
	$pID = get_option( 'page_for_posts' );
}

if ( is_404() || is_archive() || is_category() || is_search() ) {
	$pID = get_option( 'page_on_front' );
}

if (function_exists('get_fields') && function_exists('get_fields_escaped')) {
	$option_fields = get_fields_escaped( 'option' );
	$fields        = get_fields_escaped( $pID );
}
?>



<?php

// Schema Markup - ACF variables.


$basethemevar_schema_check = $option_fields['basethemevar_schema_check'];
if($basethemevar_schema_check){
	$basethemevar_schema_business_name 			= html_entity_remove($option_fields['basethemevar_schema_business_name']);
	$basethemevar_schema_business_legal_name 	= html_entity_remove($option_fields['basethemevar_schema_business_legal_name']);
	$basethemevar_schema_street_address 		= html_entity_remove($option_fields['basethemevar_schema_street_address']);
	$basethemevar_schema_locality 				= html_entity_remove($option_fields['basethemevar_schema_locality']);
	$basethemevar_schema_region 				= html_entity_remove($option_fields['basethemevar_schema_region']);
	$basethemevar_schema_postal_code 			= html_entity_remove($option_fields['basethemevar_schema_postal_code']);
	$basethemevar_schema_map_short_link 		= html_entity_remove($option_fields['basethemevar_schema_map_short_link']);
	$basethemevar_schema_latitude 				= html_entity_remove($option_fields['basethemevar_schema_latitude']);
	$basethemevar_schema_longitude 				= html_entity_remove($option_fields['basethemevar_schema_longitude']);
	$basethemevar_schema_opening_hours 			= html_entity_remove($option_fields['basethemevar_schema_opening_hours']);
	$basethemevar_schema_telephone 				= html_entity_remove($option_fields['basethemevar_schema_telephone']);
	$basethemevar_schema_business_email 		= html_entity_remove($option_fields['basethemevar_schema_business_email']);
	$basethemevar_schema_business_logo 			= html_entity_remove($option_fields['basethemevar_schema_business_logo']);
	$basethemevar_schema_price_range 			= html_entity_remove($option_fields['basethemevar_schema_price_range']);
	$basethemevar_schema_type 					= html_entity_remove($option_fields['basethemevar_schema_type']);
}
// Default Footer Options
$footer_scripts             = html_entity_decode($option_fields['footer_scripts'],ENT_QUOTES);
?>

</main>
<footer id="site-footer" class="site-footer">
<?php get_template_part( 'partials/cta' ); ?>
<!-- Footer Start -->

<div class="footer-nav">
	<?php
		wp_nav_menu(array(
			'theme_location'   => 'footer-nav',
			'fallback_cb'      => 'nav_fallback',
			'container'        => 'nav',
			'container_class'  => 'footer-nav',
			'container_id'     => 'footer-nav'
		));
	?>
</div>

<div class="legal-nav">
	<?php
		wp_nav_menu(array(
			'theme_location'   => 'legal-nav',
			'fallback_cb'      => 'nav_fallback',
			'container'        => 'nav',
			'container_class'  => 'legal-nav',
			'container_id'     => 'legal-nav'
		));
	?>
</div>

<!-- Footer End -->

	<?php if($basethemevar_schema_check){ ?>
		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "<?php echo $basethemevar_schema_type; ?>",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "<?php echo $basethemevar_schema_locality; ?>",
				"addressRegion": "<?php echo $basethemevar_schema_region; ?>",
				"postalCode": "<?php echo $basethemevar_schema_postal_code; ?>",
				"streetAddress": "<?php echo $basethemevar_schema_street_address; ?>"
			},
			"hasMap": "<?php echo $basethemevar_schema_map_short_link; ?>",
			"geo": {
				"@type": "GeoCoordinates",
				"latitude": "<?php echo $basethemevar_schema_latitude; ?>",
				"longitude": "<?php echo $basethemevar_schema_longitude; ?>"
			},
			"name": "<?php echo $basethemevar_schema_business_name; ?>",
			"openingHours": "<?php echo $basethemevar_schema_opening_hours; ?>",
			"telephone": "<?php echo $basethemevar_schema_telephone; ?>",
			"email": "<?php echo $basethemevar_schema_business_email; ?>",
			"url": "<?php echo esc_url( home_url() ); ?>",
			"image": "<?php echo $basethemevar_schema_business_logo; ?>",
			"legalName": "<?php echo $basethemevar_schema_business_legal_name; ?>",
			"priceRange": "<?php echo $basethemevar_schema_price_range; ?>"
		}
		</script>
	<?php } ?>
</footer>

<?php wp_footer(); ?>
<?php if ( $footer_scripts != '' ) { ?>
	<div style="display: none;">
    	<?php echo $footer_scripts ?>
	</div>
<?php } ?>
</body>

</html>
