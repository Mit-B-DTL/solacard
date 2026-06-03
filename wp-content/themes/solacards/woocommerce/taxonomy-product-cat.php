<?php get_header(); ?>

<?php
$current_category = get_queried_object();
$category_id = $current_category->term_id;

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => -1,
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => $category_id,
		),
	),
);
$products = new WP_Query($args);

?>
<!-- banner section -->
<div class="card-banner font-family__monserrat">
	<div class="card-item__container">
		<div class="card-banner__info font-family__monserrat">
			<p><a href="<?php echo site_url(); ?>" class="banner--link__style">Home</a><span> / </span><span><?php echo $current_category->name; ?></span></p>
			<h1 class="font-50"><?php echo strtoupper($current_category->name); ?></h1>
		</div>
	</div>
</div>
<!-- item box section -->
<?php if ($products->have_posts()) { ?>
	<div class="card-item-box font-family__monserrat">
		<div class="card-item__container">
			<div class="card-item__layout">
				<button class="card-item__layout--btn grid-layout"><i class="fas fa-th"></i></button>
				<button class="card-item__layout--btn list-layout"><i class="fas fa-list"></i></button>
			</div>
			<div class="card-item__grid">
				<?php while ($products->have_posts()) {

					$products->the_post();
					global $product;

					$product_image = has_post_thumbnail() ? get_the_post_thumbnail(get_the_ID(), 'full') : '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder Image" />';
					if ($product->is_type('variable')) {
						$prices = $product->get_variation_prices();
						// Get min and max regular prices
						$min_regular_price = !empty($prices['regular_price']) ? min($prices['regular_price']) : 0;
						$max_regular_price = !empty($prices['regular_price']) ? max($prices['regular_price']) : 0;

						// Get min and max sale prices (if sale price is empty, set it as regular price)
						$sale_prices = array_filter($prices['sale_price']); // Remove empty sale prices

						$min_sale_price = !empty($sale_prices) ? min($sale_prices) : $min_regular_price;
						$max_sale_price = !empty($sale_prices) ? max($sale_prices) : $max_regular_price;


						if ($min_sale_price == $min_regular_price && $max_sale_price == $max_regular_price) {
							$price_html = '<div class="card-item__price"><p class="gray-color">' . wc_price($min_regular_price) . ' - ' . wc_price($max_regular_price) . '</p></div>';
						} else {
							$price_html = '<div class="card-item__price">
								<p class="gray-color"><del>' . wc_price($min_regular_price) . ' - ' . wc_price($max_regular_price) . '</del></p>
								<p class="card-item__offer">' . wc_price($min_sale_price) . ' - ' . wc_price($max_sale_price) . '</p>
							</div>';
						}
					} else {
						$price_html = '<div class="card-item__price"><p class="gray-color">' . $product->get_price_html() . '</p></div>';
					}

					$add_to_cart_url = esc_url($product->add_to_cart_url());
					$add_to_cart_class = esc_attr(implode(' ', array_filter(array(
						'button',
						'ajax_add_to_cart',
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
					))));

				?>
					<div class="card-item-list">
						<div class="card-item--img">
							<a href="<?php echo get_the_permalink(); ?>">
								<?php echo $product_image; ?>
							</a>
						</div>

						<div class="card-item-list__info">
							<?php //echo $price_html; ?>
							<a class="card-item__name" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
						
							<?php 
							/*
							<div class="card-item__cart-button">
								<button class="cart--btn font-family__monserrat">Add to cart</button>
								<!-- <?php if ($product->is_type('variable')) { ?>
									<a href="<?php echo get_the_permalink(); ?>" class="cart--btn font-family__monserrat">Add to cart</a>
								<?php } else {
								?>
									<button class="<?php echo $add_to_cart_class; ?>" data-quantity="1" data-product_id="<?php echo esc_attr($product_id); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" aria-label="<?php echo esc_attr(sprintf(__('Add %s to cart', 'woocommerce'), get_the_title())); ?>" rel="nofollow">
										Add to cart <?php //echo esc_html($product->add_to_cart_text()); 
													?>
									</button>
								<?php } ?> -->
							</div>
							*/
							?>
							
						</div>
					</div>
				<?php
				} ?>
			</div>
		</div>
	</div>
<?php
} else {
	echo '<p>No Prodcut found.</p>';
}

wp_reset_postdata();
?>

<?php get_footer(); ?>