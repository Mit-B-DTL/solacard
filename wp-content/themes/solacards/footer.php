<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Solacards
 */

?>
	<footer class="site__footer">
      <div class="card-item__site-footer font-family__monserrat">
        <div class="card-item__container">
          <div class="card-item__site-content">
            <div class="card-item__footer--img">
              <a href="<?php echo site_url();?>"> <img src="<?php echo get_template_directory_uri();?>/assets/img/Solacards-logo.png" alt="site footer-logo" /></a>
            </div>
            <!--<div class="footer__nav">-->
                <?php
                    wp_nav_menu(array(
                      'menu'  => '20',
                      'menu_class'      => 'footer__nav',
                      'container'       => false, // Removes the default `div` container
                      'walker'         => new Custom_Nav_Walker_footer(), // Custom walker for submenus
                    ));
                    ?>
            <!--</div>-->
          </div>
        </div>
      </div>
      <div class="card-item__site--bottom font-family__monserrat">
        <div class="card-item__container">
          <p class="card-item__site--bottom-disc font-16">Copyright <?php echo date("Y");?> solacards.<a href="#" class="footer__bottom-link"></a></p>
        </div>
      </div>
    </footer>
</div><!-- #page -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
  integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/assets/js/custom.js"></script>

<?php wp_footer(); ?>

</body>
</html>
