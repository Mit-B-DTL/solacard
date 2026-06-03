<?php

/**
 * template Name: Home
 */
get_header();
?>
<?php $image = get_field('banner'); ?>
<?php $button = get_field('button'); ?>
  <!-- banner section -->
  <section class="card__home-page-wrapper">
    <div class="card__home-page">
        <div class="card__home-slider">
            <?php if (have_rows('banner')): ?>
                <?php while (have_rows('banner')): the_row(); ?>
                    <?php  
			
                        $img = get_sub_field('banner_image');
                        $link = get_sub_field('button');
                        $title = get_sub_field('title');
                        $sub_title = get_sub_field('description');
                    ?>
			 <?php if ($img): ?>
                    <div class="cards__home-banner-slide" style="background-image: url('<?php echo ($img['url']); ?>'); background-position: center">
                        <div class="card-home-wrapper">
                            <div class="card-item__container">
                                <div class="card__home-banner-content font-family__monserrat">
                                    <div class="card__home-banner-logo-text">
                                        <img class="card__home-banner-logo--img" src="<?php echo get_template_directory_uri(); ?>/assets/img/Solacards-logo.png" alt="logo" />
                                    </div>
                                    <div class="card__home-banner-title font-family__monserrat">
                                        <h1 class="card__home-banner-title-text"><?php echo($title); ?></h1>
                                        <p class="card__home-banner-title-disc"><?php echo($sub_title); ?></p> 
                                    </div>
                                    <div class="card__home-banner-btn">
                                         <?php if ($link && !empty($link['url'])): ?>
                                            <a href="<?php echo esc_url($link['url']); ?>"  class="home__page-btn text-uppercase"  target="<?php echo esc_attr($link['target']); ?>">
                                                <?php echo esc_html($link['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
 

<?php get_footer(); ?>