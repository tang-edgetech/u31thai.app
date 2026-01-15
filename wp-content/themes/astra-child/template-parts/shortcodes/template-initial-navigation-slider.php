<?php
$locations = get_nav_menu_locations();
$menu_rand_id = randomUniqueID();

if ( isset( $locations['primary'] ) ) :
    $menu_id = $locations['primary'];
    $menu_items = wp_get_nav_menu_items( $menu_id );
    ?>
    <div class="main-menu-slider mb-2">
        <div class="swiper menu-swiper menu-swiper-<?= $menu_rand_id;?>" data-menu-id="<?= $menu_rand_id;?>" id="menu-swiper-<?= $menu_rand_id;?>">
            <div class="swiper-wrapper">
            <?php foreach ( $menu_items as $item ) { 
                $icon = get_field('menu_icon', $item->ID);
            ?>
                <div class="swiper-slide swiper-menu-<?= $item->ID;?>">
                    <div class="iconbox">
                        <a href="<?= esc_url( $item->url ); ?>" class="iconbox-inner">
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
                            <div class="iconbox-content"><div class="iconbox-title"><?= esc_html( $item->title ); ?></div></div>
                        </a>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
<?php endif; ?>