<?php
$swiper_id = randomUniqueID();
$home_banner = get_field('home_banner', 'option');
$show_navigation = $home_banner['show_navigation'];
$show_pagination = $home_banner['show_pagination'];
$sliders = $home_banner['sliders'];
?>
<div class="hero-banner-slider mb-4">
    <div class="swiper menu-swiper hero-swiper-<?= $swiper_id;?>" data-swiper-id="<?= $swiper_id;?>" id="hero-swiper-<?= $swiper_id;?>">
        <div class="swiper-wrapper">
        <?php foreach( $sliders as $slide ) { 
            $banner_image = $slide['banner_image'];
            $banner_link = $slide['banner_link'];
        ?>
            <div class="swiper-slide" data-img-src="<?= $banner_image['url'];?>" data-link="<?= json_encode($banner_link);?>">
            <?php
            if( !empty($banner_image['url']) ) {
                echo '<img src="'.$banner_image['url'].'" class="img-fluid w-100 h-auto" alt="'.$banner_image['alt'].'"/>';
            }
            ?>
            </div>
        <?php } ?>
        </div>
        <?php
        if( $show_pagination ) { ?>
            <div class="herobanner-pagination position-absolute d-flex justify-content-center align-items-center gap-2 w-100 z-1"></div>
        <?php }
        ?>
    </div>
</div>