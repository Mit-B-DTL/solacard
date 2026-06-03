jQuery(document).ready(function ($) {
    $(".list-layout").click(function () {
        $(".card-item__grid").addClass("list_layout");
    });
    $(".grid-layout").click(function () {
        $(".card-item__grid").removeClass("list_layout");
    });
    $(".toggle-menu").click(function () {
        $(".card-header__nav-menu").toggleClass("nav-menu-active");
    });

    $(".list-layout").click(function () {
        $(".card-item__grid").addClass("list_layout");
    });

    // toggle open
    $(".toggle-menu").click(function () {
        $(".toggle-menu").toggleClass("toggle-open");
    });
    // toggle resize
    $(window).resize(function () {
        if ($(window).width() > 991) {
            $(".card-header__nav-menu").css("display", "flex");
        } else {
            $(".card-header__nav-menu").css("display", "none");
            $(".card-header__nav-menu").removeClass("nav-menu-active");
            $(".toggle-menu").removeClass("toggle-open");

        }
    });
    // FAQ
    $(".faq-discription__list").hide();
    $(".faq-discription__item").click(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active").next(".faq-discription__list").slideUp();
        } else {
            $(".faq-discription__item").removeClass("active");
            $(".faq-discription__list").slideUp();
            $(this).addClass("active").next(".faq-discription__list").slideDown();
        }
    });


    let oldInput = $(".quantity-number");
    let newValue = parseInt(oldInput.val());
    $(".quantity-btn-increment").on("click", function () {
        newValue++;
        oldInput.val(newValue);
    });

    $(".quantity-btn-decrement").on("click", function () {
        newValue--;
        oldInput.val(newValue);

        if (newValue < 1) {
            newValue = 1;
            oldInput.val(newValue);
        }
    });

// home banner slider

     $('.card__home-slider').slick({
            dots: true,
            arrows: false,
            autoplay:false,
            autoplaySpeed: 6000,
            pauseOnHover: true, 
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
        
        $(".quantity-select__style").select2({
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "select2-selection__choice",  // custom class name add
            // placeholder: "Select item ",    //placeholder class name add
            // multiple: true, //for multiple select
        });

});