<?php
/**
 * Plugin Name: Blog Banner Shortcode
 * Description: Insert a customizable HTML banner inside blog content using a shortcode.
 * Version: 1.0.0
 * Author: VISER X
 * Author URI: https://viserx.com
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Blog_Banner_Shortcode {
    public function __construct() {
        add_shortcode( 'blog_banner', [ $this, 'render_banner' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function enqueue_assets() {
        // Enqueue CSS
        wp_register_style( 'blog-banner-style', plugin_dir_url( __FILE__ ) . 'style.css' );
        wp_enqueue_style( 'blog-banner-style' );
    }

    public function render_banner( $atts, $content = null ) {
        $atts = shortcode_atts( [
            'image' => 'https://via.placeholder.com/300x200',
            'heading' => 'Default Heading',
            'description' => 'This is a sample description text for the banner.',
            'button_text' => 'Click Here',
            'button_url' => '#',
        ], $atts, 'blog_banner' );

        ob_start();
        ?>
        <div class="blog-banner-wrapper">
            <div class="blog-banner-inner">
                <div class="banner-left">
                    <img src="<?php echo esc_url( $atts['image'] ); ?>" 
     alt="<?php echo esc_attr( $atts['heading'] ); ?>" 
     decoding="async" 
     loading="eager" 
     data-no-lazy="1" 
     class="blog-banner-img">

                </div>
                <div class="banner-right">
                    <h2><?php echo esc_html( $atts['heading'] ); ?></h2>
                    <p><?php echo esc_html( $atts['description'] ); ?></p>
                    <a href="<?php echo esc_url( $atts['button_url'] ); ?>" class="banner-btn">
                        <?php echo esc_html( $atts['button_text'] ); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

new Blog_Banner_Shortcode();
