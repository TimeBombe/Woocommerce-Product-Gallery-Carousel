<?php
/*
Plugin Name: Product Gallery Carousel
Description: Display WooCommerce product gallery images in a carousel with a lightbox.
Version: 1.0
Author: Danish Iqabl
*/

// Enqueue scripts and styles
function pgc_enqueue_scripts() {
    // Enqueue Owl Carousel CSS
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');

// Enqueue scripts and styles
function pgc_enqueue_scripts() {
    // ... existing code ...

    // Enqueue your custom CSS
    wp_enqueue_style('pgc-custom-style', plugins_url('css/style.css', __FILE__));
    // ... existing code ...
}


    // Enqueue Lightbox CSS
    wp_enqueue_style('lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css');

    // Enqueue jQuery (if not already enqueued)
    wp_enqueue_script('jquery');

    // Enqueue Owl Carousel JS
    wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '', true);

    // Enqueue Lightbox JS
    wp_enqueue_script('lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), '', true);

    // Enqueue your custom script
    wp_enqueue_script('pgc-custom-script', plugins_url('js/custom-script.js', __FILE__), array('jquery', 'owl-carousel', 'lightbox'), '', true);
}

add_action('wp_enqueue_scripts', 'pgc_enqueue_scripts');
// Shortcode to display product gallery carousel
function pgc_product_gallery_carousel_shortcode($atts) {
    global $product;

    // Get product gallery images
    $attachment_ids = $product->get_gallery_image_ids();

    ob_start();

    // Output Owl Carousel container
    echo '<div class="owl-carousel" width: 320px;>';

    // Output each image in the carousel
    foreach ($attachment_ids as $attachment_id) {
        $image_url = wp_get_attachment_url($attachment_id);
        echo '<div class="item"><a href="' . $image_url . '" data-lightbox="product-gallery"><img src="' . $image_url . '" alt="Product Image"></a></div>';
    }

    echo '</div>';

    return ob_get_clean();
}

add_shortcode('pgc_product_gallery_carousel', 'pgc_product_gallery_carousel_shortcode');

