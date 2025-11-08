<?php 
/**
 *Blog Function
 * @package     Royal Shop
 * @author      ThemeHunk
 * @copyright   Copyright (c) 2021, ThemeHunk
 * @since       Royal Shop 1.0.0
 */

        /**
		 * Excerpt count.
		 *
		 * @param int $length default count of words.
		 * @return int count of words
		 */
		function royal_shop_excerpt_length( $length ) {
			if(is_admin()){
             	return $length;
             }
			 $excerpt_length = (string) get_theme_mod( 'royal_shop_blog_expt_length' );

			if ( '' != $excerpt_length ) {
			   $length = $excerpt_length;
			}
			return $length;
		}
		add_filter( 'excerpt_length','royal_shop_excerpt_length', 999 );
/**
 * Display Blog Post Excerpt
 */
if ( ! function_exists( 'royal_shop_the_excerpt' ) ){
	/**
	 * Display Blog Post Excerpt
	 *
	 * @since 1.0.0
	 */
	function royal_shop_the_excerpt(){?>
		<div class="entry-content">
		<?php  $excerpt_type = get_theme_mod( 'royal_shop_blog_post_content','excerpt');
		if ( 'full' == $excerpt_type ){
			the_content();
		} elseif('excerpt' == $excerpt_type ){
			the_excerpt();
		} else {
          return false;
		}?>
		</div>	
	<?php }
}

/**
		 * Read more text.
		 *
		 * @param string $text default read more text.
		 * @return string read more text
		 */
		function royal_shop_read_more_text( $text ) {

			$read_more = esc_html(get_theme_mod( 'royal_shop_blog_read_more_txt' ));

			if ( '' != $read_more ) {
				$text = $read_more;
			}

			return $text;
		}
      add_filter( 'royal_shop_post_read_more', 'royal_shop_read_more_text');
/**
 * Function to get Read More Link of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'royal_shop_post_link' ) ){

	/**
	 * Function to get Read More Link of Post
	 *
	 * @param  string $output_filter Filter string.
	 * @return html                Markup.
	 */
	function royal_shop_post_link( $output_filter = '' ){

		$enabled = apply_filters( 'royal_shop_post_link_enabled', '__return_true' );
		if ( ( is_admin() && ! wp_doing_ajax() ) || ! $enabled ){
			return $output_filter;
		}
		$royal_shop_read_more_text = apply_filters( 'royal_shop_post_read_more', __( 'Read More', 'royal-shop' ) );
		$read_more_classes        = apply_filters( 'royal_shop_post_read_more_class', array() );
		$post_link = sprintf(
			esc_html( '%s' ),
			'<a class="' . implode( ' ', $read_more_classes ) . ' wzta-readmore button " href="' . esc_url( get_permalink() ) . '"> ' . the_title( '<span class="screen-reader-text">', '</span>', false ) . $royal_shop_read_more_text . '</a>'
		);
		$output = ' &hellip;<p class="read-more"> ' . $post_link . '</p>';
		return apply_filters( 'royal_shop_post_link', $output, $output_filter );
	}
}
add_filter( 'excerpt_more', 'royal_shop_post_link', 1 );
/*******************/
// loader function
/*******************/
if ( ! function_exists( 'royal_shop_post_loader' ) ):
function royal_shop_post_loader(){
$royal_shop_blog_post_pagination = get_theme_mod( 'royal_shop_blog_post_pagination','num');
if($royal_shop_blog_post_pagination=='num'){
the_posts_pagination(array(
    'mid_size'  => 2,
    'prev_text' => __( '', 'royal-shop' ),
    'next_text' => __( '', 'royal-shop' ),
));
}
elseif($royal_shop_blog_post_pagination=='click'){	
royal_shop_load_more_button();
}
elseif($royal_shop_blog_post_pagination=='scroll'){
royal_shop_scrolling_ajax();
}
}
endif;

/**************************************/
// Wrapper of header markup
/**************************************/
if ( !function_exists('royal_shop_full_header_markup') ) {
function royal_shop_full_header_markup() { ?>
  <header>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'royal-shop' ); ?></a>
		<?php do_action( 'royal_shop_sticky_header' ); ?> 
        <!-- sticky header -->
		<?php if(get_theme_mod('royal_shop_above_mobile_disable',true)==true){
			if (wp_is_mobile()!== true):
              do_action( 'royal_shop_top_header' );  
              endif;
		}elseif(get_theme_mod('royal_shop_above_mobile_disable',true)==false){
			 do_action( 'royal_shop_top_header' );  
		} ?> 
		<!-- end top-header -->
        <?php do_action( 'royal_shop_main_header' ); ?> 
		<!-- end main-header -->
   </header> <!-- end header -->
<?php }
add_action('royal_shop_header', 'royal_shop_full_header_markup');
}

if ( !function_exists('royal_shop_full_footer_markup') ) {
function royal_shop_full_footer_markup() { ?>
  	<footer>
         <?php 
          // top-footer 
          do_action( 'royal_shop_top_footer' ); 
          // widget-footer
		      do_action( 'royal_shop_widget_footer' );
		      // below-footer
          do_action( 'royal_shop_below_footer' );  
        ?>
     </footer> <!-- end footer -->
    <?php }

// Hook the custom footer function into 'zita_footer'
add_action('royal_shop_footer', 'royal_shop_full_footer_markup');
}