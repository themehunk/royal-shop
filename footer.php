<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package  Royal Shop
 * @since 1.0.0
 */ 
?>
    <?php do_action( 'royal_shop_before_footer' ); ?>
    <?php do_action( 'royal_shop_footer' ); ?>
    <?php do_action( 'royal_shop_after_footer' ); ?>
    </div> <!-- end royal-shop-site -->
<?php wp_footer(); ?>
</body>
</html>