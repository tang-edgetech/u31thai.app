<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.'.time() );
define( 'ASSETS_URL', get_stylesheet_directory_uri() . '/images' );
define( 'BUTTON_SOLID_BLINKING', '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="shineLike-aDiamond"><path fill="#fff" fill-opacity="0.8" d="m4 8 3.66-.34L8 4l.34 3.66L12 8l-3.66.34L8 12l-.34-3.66z"></path></svg>' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'swiper-css', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'media-query', get_stylesheet_directory_uri() . '/css/media.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	if( !is_admin() ) {
        wp_deregister_script('jquery');
        wp_dequeue_script('jquery');
		wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery-3.7.1.min.js', array(), '3.7.1', true );
	}
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );
	wp_enqueue_script( 'swiper-js', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );
	wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function randomUniqueID($length = 8) {
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, $length);
}

function allow_custom_mime_types( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['json'] = 'application/json';
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_custom_mime_types' );

add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {

    $filetype = wp_check_filetype( $filename, $mimes );

    if ( in_array( $filetype['ext'], [ 'svg', 'json', 'webp' ], true ) ) {
        $data['ext']  = $filetype['ext'];
        $data['type'] = $filetype['type'];
    }

    return $data;
}, 10, 4 );

add_action('wp', function() {
	global $elementor_mode;
	$elementor = \Elementor\Plugin::$instance;

	if ( $elementor->editor->is_edit_mode() || $elementor->preview->is_preview_mode() ) {
		$elementor_mode = 'editor-preview';
	}
	else {
		$elementor_mode = 'front-end';
	}
});

class Icon_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $icon = get_field('menu_icon', $item->ID);
		$icon_html = '';

        if (!empty($icon)) {
			if ( 'dashicons' === $icon['type'] ) {
				$icon_html = '<div class="dashicons icon '. esc_attr( $icon['value'] ) .'>';
			}

			if ( 'media_library' === $icon['type'] ) {
				$attachment_url = $icon['value']['url'];
				$icon_html = '<img class="menu-icon icon" src="'.$attachment_url.'"/>';
			}

			if ( 'url' === $icon['type'] ) {
				$url = $icon['value'];
				$icon_html = '<img class="menu-icon icon" src="'.esc_url( $url ).'">';
			}
        }
        $output .= '<li class="menu-item nav-item menu-item-'.$item->ID.'">';

        $output .= '<a class="nav-link" href="' . esc_url($item->url) . '">';
        $output .= $icon_html;
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
}

add_action( 'after_setup_theme', function() {
    remove_theme_support( 'title-tag' );
}, 20 );

add_filter( 'astra_meta_generator', '__return_false' );
add_filter( 'astra_schema_enabled', '__return_false' );

add_action( 'wp_head', function() {
    remove_action( 'wp_head', '_wp_render_title_tag', 1 );
}, 0 );

add_action( 'init', function() {
	// Custom remove meta tags
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
	
	// Define Language Label
    if ( function_exists( 'pll_register_string' ) ) {
        pll_register_string('header_login_label', 'Login', 'Theme Labels', true);
        pll_register_string('header_register_label', 'Register', 'Theme Labels', true);
    }
});

function shortcode_custom_header_navigation() {
	ob_start();
	$home_url		= home_url();
	$site_title     = get_bloginfo( 'name' );
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo_url       = wp_get_attachment_image_url( $custom_logo_id, 'full' );
	$logo_alt       = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
	?>
	<nav class="navbar">
		<div class="navbar-row d-flex flex-row flex-wrap justify-content-center align-items-center w-100">
			<div class="col-6">
				<a href="<?= $home_url;?>" class="navbar-brand p-0">
				<?= ( !empty($logo_url) ) ? '<img src="'.$logo_url.'" class="img-fluid w-100 h-100"/>' : '<p class="mb-0">'.$site_title.'</p>'; ?>
				</a>
			</div>
			<div class="col-6">
				<div class="col-inner d-flex flex-row justify-content-end align-items-center gap-2">
				<?php
				$header_cta = get_field('header_cta', 'option');
				$login_link = (!empty($header_cta['login_link'])) ? $header_cta['login_link']['url'] : '#';
				$register_link = (!empty($header_cta['register_link'])) ? $header_cta['register_link']['url'] : '#';
				?>
					<a href="<?= $login_link;?>" class="btn btn-outline"><span><?= pll__( 'Login' );?></span></a>
					<a href="<?= $register_link;?>" class="btn btn-solid"><span><?= pll__( 'Register' );?></span></a>
					<?= BUTTON_SOLID_BLINKING;?>
				</div>
			</div>
		</div>
	</nav>
	<?php
	return ob_get_clean();
}
add_shortcode('shortcode_custom_header_navigation', 'shortcode_custom_header_navigation');

function shortcode_custom_footer_base() {
	ob_start();
	$current_page_id = get_the_ID();
	$locations = get_nav_menu_locations();
	$foot_menu_rand_id = randomUniqueID();
	?>
	<nav class="navbar footer-navbar">
		<ul class="navbar-nav nav d-flex flex-row justify-content-between align-items-center w-100 p-0">
		<?php
		if ( isset( $locations['footer_menu'] ) ) {
			$footer_menu_id = $locations['footer_menu'];
			$footer_menu_items = wp_get_nav_menu_items( $footer_menu_id );
			foreach( $footer_menu_items as $item ) {
                $icon = get_field('menu_icon', $item->ID);
			?>
			<li class="nav-item nav-item-<?= $item->ID;?> iconbox col-2<?= (intval($current_page_id)===intval($item->object_id)) ? ' active' : '';?>">
				<a href="<?= esc_url($item->url);?>" class="nav-link iconbox-inner text-center p-0" data-current="<?= $current_page_id;?>" data-object="<?= $item->object_id;?>">
					<div class="iconbox-icon icon-type-<?= $icon['type'];?>">
					<?php
					if (!empty($icon)) {
						if ( 'dashicons' === $icon['type'] ) {
							echo '<div class="dashicons icon '. esc_attr( $icon['value'] ) .'"></div>';
						}

						if ( 'media_library' === $icon['type'] ) {
							$attachment_url = $icon['value']['url'];
							echo '<img class="menu-icon icon" src="'.$attachment_url.'"/>';
						}

						if ( 'url' === $icon['type'] ) {
							$url = $icon['value'];
							echo '<img class="menu-icon icon" src="'.esc_url( $url ).'">';
						}
					}
					?>
					</div>
					<span><?= esc_html( $item->title ); ?></span>
				</a>
			</li>
			<?php
			}
		}
		?>
		</ul>
	</nav>
	<?php
	return ob_get_clean();
}
add_shortcode('shortcode_custom_footer_base', 'shortcode_custom_footer_base');

add_action('after_setup_theme', function () {
    register_nav_menus([
        'footer_disclaimer' => 'Disclaimer Menu',
    ]);
});

function section_footer_disclaimer() {

	ob_start();
	$copyright = get_field('copyright', 'option');
	$menu_items = $copyright['pages'];
	echo '<div class="footer-disclaimer">';
		echo '<div class="disclaimer-menu">';
			echo '<div class="menu-item menu-type-label menu-item-label"><span>Copyright '.date('Y').' &copy;</span></div>';
			foreach( $menu_items as $item ) {
				$link = $item['link'];
				$link_target = (!empty($link['target'])) ? ' target="'.$link['target'].'"' : '';
				echo '<div class="menu-item menu-type- menu-item-"><a href="'.$link['url'].'"'.$link_target.'>'.$link['title'].'</a></div>';
			}
		echo '</div>';
	echo '</div>';
	echo ob_get_clean();
}