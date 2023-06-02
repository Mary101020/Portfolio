<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>

<?php do_action('ocean_before_content_wrap'); ?>

<div id="content-wrap" class="container clr">

	<?php do_action('ocean_before_primary'); ?>

	<div id="primary" class="content-area clr">

		<?php do_action('ocean_before_content'); ?>


		<div id="content" class="site-content clr">

			<?php do_action('ocean_before_content_inner'); ?>


			<?php
			// Elementor `single` location.
			if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) {

				// Start loop.
				while (have_posts()):
					the_post();

					get_template_part('partials/page/layout');

				endwhile;

			}
			?>
			<?php
// Query the custom post type "projets"
$args = array(
    'post_type' => 'projets',
    'posts_per_page' => -1, // Retrieve all posts
);

$projets_query = new WP_Query($args);

// Check if there are any posts
if ($projets_query->have_posts()) {
    // Start the loop
    echo '<div class="image-block">'; // Start the image-block container
    while ($projets_query->have_posts()) {
        $projets_query->the_post();

        // Get the ACF image field value
        $image = get_field('capture');

        // Display the image
        if ($image) {
            echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
        }
    }
    echo '</div>'; // End the image-block container

    // Reset post data
    wp_reset_postdata();
} else {
    echo 'No projects found.';
}
?>

			<?php do_action('ocean_after_content_inner'); ?>

		</div><!-- #content -->

		<?php do_action('ocean_after_content'); ?>

	</div><!-- #primary -->




	<?php do_action('ocean_after_primary'); ?>

</div><!-- #content-wrap -->

<?php do_action('ocean_after_content_wrap'); ?>

<?php get_footer(); ?>