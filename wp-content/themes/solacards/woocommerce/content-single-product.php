<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
if (!$product) {
  return;
}

$is_selected_value  = '';
if(isset($_GET['attribute_qty'])){
   $is_selected_value  = $_GET['attribute_qty'];
}elseif(isset($_GET['attribute_color'])){
    $is_selected_value  = $_GET['attribute_color'];
}else{
     $is_selected_value  = '';
}
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
  echo get_the_password_form(); // WPCS: XSS ok.
  return;
}
$variation_names = [];
if ($product->is_type('variable')) {

  $variations = $product->get_available_variations();

  foreach ($variations as $variation) {
    $variation_id = $variation['variation_id'];
    $attributes = $variation['attributes'];
    $variation_name = [];

    foreach ($attributes as $key => $value) {
      $attr_label = wc_attribute_label(str_replace('attribute_', '', $key));
      $variation_name[] =  ucfirst($value);
    }

    $variation_data[] = [
      'id'   => $variation_id,
      'name' => implode(', ', $variation_name),
    ];
  }

  $prices = $product->get_variation_prices();
  // Get min and max regular prices
  $min_regular_price = !empty($prices['regular_price']) ? min($prices['regular_price']) : 0;
  $max_regular_price = !empty($prices['regular_price']) ? max($prices['regular_price']) : 0;

  // Get min and max sale prices (if sale price is empty, set it as regular price)
  $sale_prices = array_filter($prices['sale_price']); // Remove empty sale prices

  $min_sale_price = !empty($sale_prices) ? min($sale_prices) : $min_regular_price;
  $max_sale_price = !empty($sale_prices) ? max($sale_prices) : $max_regular_price;


  if ($min_sale_price == $min_regular_price && $max_sale_price == $max_regular_price) {
    $price_html = '<p class="font-15">' . wc_price($min_regular_price) . ' - ' . wc_price($max_regular_price) . '</p>';
  } else {
    $price_html = '<div class="card-item__price">
			<p class="gray-color"><del>' . wc_price($min_regular_price) . ' - ' . wc_price($max_regular_price) . '</del></p>
			<p class="card-item__offer">' . wc_price($min_sale_price) . ' - ' . wc_price($max_sale_price) . '</p>
		</div>';
  }
} else {
  $price_html = '<p class="font-15">' . $product->get_price_html() . '</p>';
}

$long_description = $product->get_description();
$product_image = has_post_thumbnail() ? get_the_post_thumbnail(get_the_ID(), 'medium') : '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder Image" />';

$gallery_image_ids = $product->get_gallery_image_ids();


$categories = wp_get_post_terms($product->get_id(), 'product_cat');
if (!empty($categories)) {
  $category_names = [];
  foreach ($categories as $category) {
    $category_names[] = esc_html($category->name);
  }
}

?>
<!-- single banner -->
<div class="card-banner font-family__monserrat">
  <div class="card-item__container">
    <div class="card-banner__info font-family__monserrat">
      <p class="font-15"><a href="<?php echo site_url(); ?>" class="banner--link__style">Home</a><span> / </span><span>
          <?php echo implode(', ', $category_names); ?>
        </span></p>
      <h1 class="font-50">
        <?php echo strtoupper(implode(', ', $category_names)); ?>
      </h1>
    </div>
  </div>
</div>
<!-- single layout -->
<div class="card-item__container">
  <div class="msg_html"></div>
  <div class="card-item__main-box font-family__monserrat">
    <div class="card-item__single-box">
      <div class="card-item__img-box">
        <?php echo $product_image; ?>
      </div>
      <?php if (!empty($gallery_image_ids)) { ?>
        <div class="card-item-related-image">
          <div class="card-item-img__list">
            <?php foreach ($gallery_image_ids as $image_id) {
              $image_url = wp_get_attachment_url($image_id);
            ?>
              <img src="<?php echo esc_url($image_url); ?>" class="" alt="Product image" />
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="card-item__single-content-box">
      <h2 class="text-uppercase card-item__single-box-title">
        <?php echo esc_html($product->get_name()); ?>
      </h2>
      <?php //echo $price_html; 
      ?>
      <p class="font-15">
        <?php echo wp_kses_post($product->get_short_description()); ?>
      </p>
      <div class="card-item__get">
        <div class="card-item__quantity">
          <div class="">
            <p class="font-15">Quantity</p>
          </div>
          <?php if (get_post_meta( $product->get_id(), '_sold_individually', true ) == 'no') { ?>
            <div class="card-item__number-of-qty">
              <button class="quantity-btn quantity-btn-decrement">-</button>
              <input type="number" value="1" class="quantity-number" />
              <button class="quantity-btn quantity-btn-increment">+</button>
            </div>
          <?php } ?>
          <?php if (!empty($variation_data)) { ?>
            <div class="quantity-select">
              <select class="quantity-select__style font-family__monserrat" name="card" id="card">
                <?php foreach ($variation_data as $variation) { ?>
                  <option class="select2-selection__choice" data-variation-id="<?php echo $variation['id']; ?>" <?php echo ($variation['name'] ==  $is_selected_value) ? selected : '' ;?> value="<?php echo $variation['name']; ?>">
                    <?php echo $variation['name']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>
        </div>

        <div class="card-item__addcart">
          <button class="card-item__single-box--cart-btn cart--btn">Add To cart</button>
        </div>


      </div>
      <div class="product_price"></div>
      <div class="default_cart_render" style="display: none;">
        <?php do_action('woocommerce_single_product_summary');
        ?>
      </div>
      <div class="card-item__single-box-characteristic">
        <?php if (get_field('open') != '') { ?>
          <div class="card-item__single-characteristic">
            <p class="characteristic-style text-uppercase">Open:</p>
            <p class="font-15">
              <?php echo get_field('open'); ?>
            </p>
          </div>
        <?php } ?>
        <?php if (get_field('folded') != '') { ?>
          <div class="card-item__single-characteristic">
            <p class="characteristic-style text-uppercase">folded:</p>
            <p class="font-15">
              <?php echo get_field('folded'); ?>
            </p>
          </div>
        <?php } ?>
      </div>

      <div class="card-item__faq-discription">
        <?php if ($long_description != '') { ?>
          <div class="faq-discription">
            <div class="faq-discription__item text-uppercase characteristic-style">Description</div>
            <div class="faq-discription__list">
              <?php echo $long_description; ?>
            </div>
          </div>
        <?php } ?>
        <?php if (have_rows('description')): ?>
          <?php while (have_rows('description')) : the_row(); ?>
            <div class="faq-discription">
              <div class="faq-discription__item text-uppercase characteristic-style">
                <?php echo get_sub_field('title'); ?>
              </div>
              <div class="faq-discription__list">
                <p class="vm__margin-0">
                  <?php echo get_sub_field('content'); ?>
                </p>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>


<!-- Variation wise image change -->
<script>
  jQuery(document).ready(function($) {


    function price_html_set() {
      $('.product_price').html('');
      if ($(".woocommerce-variation-price").length == 1) {
        var variation_price_html = $('.woocommerce-variation-price').html();
        $('.product_price').append(variation_price_html);
      } else {
        var price_html = $('.price').html();
        $('.product_price').append(price_html);
      }
    }

    function change_variation_image(variation_id) {
      $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
        data: {
          variation_id: variation_id,
          action: 'get_variation_image'
        },
        success: function(response) {
          if (response.success && response.data.image_url) {
            $('.card-item__single-box .card-item__img-box img').attr('src', response.data.image_url);
            $('.card-item__single-box .card-item__img-box img').attr('srcset', response.data.image_url);
          }
        }
      });
    }


    // Price HTML append
    setTimeout(price_html_set, 2000);

    // Auto fill cart value
    $(".quantity-btn").click(function() {
      var input = $(this).siblings(".quantity-number");
      var qty_value = parseInt(input.val(), 10);
   
      $("input[name='quantity']").val(qty_value+1);


    });

    $(".card-item__single-box--cart-btn").click(function() {
      $(".single_add_to_cart_button").trigger("click");
    });


    var default_selected_option = $(".quantity-select__style").find("option:selected");
    var default_selected_variation_id = default_selected_option.attr("data-variation-id");
    change_variation_image(default_selected_variation_id);


    $(".quantity-select__style").change(function() {
      var selectedOption = $(this).find("option:selected");
      var selected_variation_value = $(this).val();
      var selected_variation_id = selectedOption.attr("data-variation-id");
      console.log('selected_variation_value'+selected_variation_value);
      $("select[name='attribute_qty']").val(selected_variation_value).change();
      $("#qyt").val(selected_variation_value).change();
      $("#color").val(selected_variation_value).change();
      change_variation_image(selected_variation_id);
      setTimeout(price_html_set, 2000);

    });


  });
</script>