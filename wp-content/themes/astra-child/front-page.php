<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Plugin;
get_header(); ?>

	<div id="primary" <?php astra_primary_class(); ?>>
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                if (
                    ! Plugin::$instance->editor->is_edit_mode() &&
                    ! Plugin::$instance->preview->is_preview_mode()
                ) {
                    get_template_part('template-parts/shortcodes/template', 'initial-navigation-slider');
                    get_template_part('template-parts/shortcodes/template', 'home-introduction-banner');
                }
                else {
                    echo '<div class="alert-wrapper p-4 my-4"><div class="alert alert-warning mb-0" role="alert">The layout is temporarily disabled within preview mode.</div></div>';
                }
                
                the_content();
            }
        }
        ?>
		<?php section_footer_disclaimer();?>
	</div>
<?php 
get_footer(); 
?>
