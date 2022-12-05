<?php

add_action( 'woocommerce_before_shop_loop' , 'subcategory_thumb_list');
function subcategory_thumb_list(){
	if(is_product_category()){
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
  
			$args = array(
			   'hierarchical' => 1,
			   'show_option_none' => '',
			   'hide_empty' => 0,
			   'parent' => $cat_obj->term_id,
			   'taxonomy' => 'product_cat'
			);
			$subcats = get_categories($args);
			if(!empty($subcats)){
				echo '<div class="wrapper_thumb_list">';
				foreach ($subcats as $sc) {
					$category_thumbnail = get_woocommerce_term_meta($sc->term_id, 'thumbnail_id', true);
					$image = wp_get_attachment_url($category_thumbnail);
					if($image==''){
						$image = plugins_url( 'img/image.png', __FILE__ );
					}
					$link = get_term_link( $sc->slug, $sc->taxonomy );
					echo '<div class="single_cat_thumb_list">';
					echo '<div class="cat_title_thumb_list"><a href="'. $link .'">'.$sc->name.'</a></div>';
					echo '</div>';
				}
				echo '</div>';
			}
	}
}

add_action( 'wp_enqueue_scripts', 'scripts_thumb_list' );
function scripts_thumb_list(){
	wp_enqueue_style( 'style_thumb_list', plugins_url('css/style.css', __FILE__) );
}
?>
