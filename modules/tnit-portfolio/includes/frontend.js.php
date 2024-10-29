(function($) {

    var tl = new TimelineLite(),
        preview = null;
    //tl.seek(0).clear();
    //tl = new TimelineLite();

    <?php if($settings->portfolio_layout == 'grid' || ($settings->portfolio_layout == 'masonry' || $settings->portfolio_layout == 'mosaic')){ ?>

    // init cubeportfolio
    $('.fl-node-<?php echo $id; ?> .tnit-cbp-portfolio').cubeportfolio({
        filters: '.fl-node-<?php echo $id; ?> .tnit-portfolio-filter',
        layoutMode: '<?php echo ( 'masonry' === $settings->portfolio_layout ) ? 'grid' : $settings->portfolio_layout; ?>',
        defaultFilter: '*',
        animationType: '<?php echo $settings->filter_animation; ?>',
        gridAdjustment: 'responsive',
        sortByDimension: <?php echo $settings->sort_by_dimension; ?>,
        mediaQueries: [{
            width: <?php echo $global_settings->medium_breakpoint + 1; ?>,
            cols: <?php echo ( '' !== $settings->grid_numbers ) ? $settings->grid_numbers : '2'; ?>,
            options: {
                gapHorizontal: <?php echo ( '' !== $settings->items_spacing ) ? $settings->items_spacing : '30'; ?>,
                gapVertical: <?php echo ( '' !== $settings->items_spacing ) ? $settings->items_spacing : '30'; ?>,
            }
        }, {
            width: <?php echo $global_settings->responsive_breakpoint + 1; ?>,
            cols: <?php echo ( '' !== $settings->grid_numbers_medium ) ? $settings->grid_numbers_medium : '2'; ?>,
            options: {
                gapHorizontal: <?php echo ( '' !== $settings->items_spacing_medium ) ? $settings->items_spacing_medium : '15'; ?>,
                gapVertical: <?php echo ( '' !== $settings->items_spacing_medium ) ? $settings->items_spacing_medium : '15'; ?>,
            }
        }, {
            width: 0,
            cols: <?php echo ( '' !== $settings->grid_numbers_responsive ) ? $settings->grid_numbers_responsive : '1'; ?>,
            options: {
                gapHorizontal: <?php echo ( '' !== $settings->items_spacing_responsive ) ? $settings->items_spacing_responsive : '15'; ?>,
                gapVertical: <?php echo ( '' !== $settings->items_spacing_responsive ) ? $settings->items_spacing_responsive : '15'; ?>,
            }
        }],
        caption: '<?php echo $settings->overlay_hover_effect; ?>',
        displayType: 'sequentially',
        displayTypeSpeed: 80,
    });

    /* ===================================
		 Gallery Filter DropDown
	 ====================================== */

    function portfolio_mobile_filter() {

        var content = $('.fl-node-<?php echo $id; ?> .tnit-portfolio-dropdown .select-content');
        content.text($('.fl-node-<?php echo $id; ?> .tnit-portfolio-dropdown .cbp-l-filters-button > li.cbp-filter-item-active').text());

        var list = $('.fl-node-<?php echo $id; ?> .tnit-portfolio-dropdown .cbp-l-filters-button > li');

        list.on('click',function () {
            content.text($(this).text());
        });

        var dropdown = $('.fl-node-<?php echo $id; ?> .tnit-portfolio-dropdown');

        dropdown.on('click',function () {
            $('.fl-node-<?php echo $id; ?> .tnit-portfolio-dropdown').toggleClass('active');
        });

    }

    portfolio_mobile_filter();


    $(window).on('load', function(){
        var win = $(this); //this = window
        if (win.width() <= <?php echo $global_settings->medium_breakpoint; ?>) {
            $('.fl-node-<?php echo $id; ?> .tnit-md-dropdown:not(.tnit-portfolio-dropdown)').addClass('tnit-portfolio-dropdown');
            portfolio_mobile_filter();
        }else{
            $('.fl-node-<?php echo $id; ?> .tnit-md-dropdown.tnit-portfolio-dropdown').removeClass('tnit-portfolio-dropdown');
        }
        if (win.width() <= <?php echo $global_settings->responsive_breakpoint; ?>) {
            $('.fl-node-<?php echo $id; ?> .tnit-sm-dropdown:not(.tnit-portfolio-dropdown)').addClass('tnit-portfolio-dropdown');
            portfolio_mobile_filter();
        }else{
            $('.fl-node-<?php echo $id; ?> .tnit-sm-dropdown.tnit-portfolio-dropdown').removeClass('tnit-portfolio-dropdown');
        }
    });

    $(window).on('resize', function(){
        var win = $(this); //this = window
        if (win.width() <= <?php echo $global_settings->medium_breakpoint; ?>) {
            $('.fl-node-<?php echo $id; ?> .tnit-md-dropdown:not(.tnit-portfolio-dropdown)').addClass('tnit-portfolio-dropdown');
            portfolio_mobile_filter();
        }else{
            $('.fl-node-<?php echo $id; ?> .tnit-md-dropdown.tnit-portfolio-dropdown').removeClass('tnit-portfolio-dropdown');
        }
        if (win.width() <= <?php echo $global_settings->responsive_breakpoint; ?>) {
            $('.fl-node-<?php echo $id; ?> .tnit-sm-dropdown:not(.tnit-portfolio-dropdown)').addClass('tnit-portfolio-dropdown');
            portfolio_mobile_filter();
        }else{
            $('.fl-node-<?php echo $id; ?> .tnit-sm-dropdown.tnit-portfolio-dropdown').removeClass('tnit-portfolio-dropdown');
        }
    });

    <?php } ?>

    <?php if($settings->portfolio_layout == 'carousel'){ ?>

    /* ===================================
		 Slider
	 ====================================== */

    var b;
    if ($('.fl-builder-edit').length) {
        b = '.fl-builder-content-primary'
    }

    $('.fl-node-<?php echo $id; ?> .tnit-portfolio-slider').owlCarousel({
        loop: <?php echo $settings->slide_loop; ?>,
        autoWidth:<?php echo $settings->auto_width; ?>,
        center:<?php echo $settings->item_center; ?>,
        navText: [$('.fl-node-<?php echo $id; ?> .tnit-slide-next'), $('.fl-node-<?php echo $id; ?> .tnit-slide-prev')],
        autoplay: <?php echo $settings->autoplay; ?>,
        <?php if( $settings->autoplay ){ ?>
        autoplayHoverPause: <?php echo $settings->autoplay_hover_pause; ?>,
        autoplayTimeout: <?php echo ( '' != $settings->speed ) ? $settings->speed : '2000'; ?>,
        <?php } ?>
        lazyLoad: <?php echo $settings->lazy_load; ?>,
        <?php if($settings->slide_loop){ ?>
        startPosition: <?php echo ( '' != $settings->start_position) ? $settings->start_position : 1 ; ?>,
        <?php } ?>
        smartSpeed: 1000,
        itemClass: 'owl-item portfolio-preview-<?php echo esc_attr($settings->preview_type); ?>',
        mouseDrag: true,
        touchDrag: true,
        responsiveClass: true,
        //responsiveRefreshRate: 10,
        responsiveBaseElement:b,
        responsive: {
            0: {
                items: <?php echo ( $settings->grid_numbers_responsive != '' ) ? $settings->grid_numbers_responsive : '1'; ?>,
                margin: <?php echo ( $settings->items_spacing_responsive != '' ) ? $settings->items_spacing_responsive : '15'; ?>,
                stagePadding: <?php echo ( $settings->items_spacing_responsive != '' ) ? $settings->items_spacing_responsive / 2 : '7.5'; ?>,
                nav: <?php
                if( $settings->nav_arrows_responsive != '' ){
                    echo $settings->nav_arrows_responsive;
                } else if( $settings->nav_arrows_responsive == '' && $settings->nav_arrows_medium != '' ){
                    echo $settings->nav_arrows_medium;
                } else {
                    echo $settings->nav_arrows;
                } ?>,
                dots: <?php
                if( $settings->nav_dots_responsive != '' ){
                    echo $settings->nav_dots_responsive;
                } else if( $settings->nav_dots_responsive == '' && $settings->nav_dots_medium != '' ){
                    echo $settings->nav_dots_medium;
                } else {
                    echo $settings->nav_dots;
                } ?>,
            },
    <?php echo ('' != $global_settings->responsive_breakpoint) ? $global_settings->responsive_breakpoint + 1 : '769'; ?>: {
        items: <?php echo ( $settings->grid_numbers_medium != '' ) ? $settings->grid_numbers_medium : '2'; ?>,
        margin: <?php echo ( $settings->items_spacing_medium != '' ) ? $settings->items_spacing_medium : '15'; ?>,
        stagePadding: <?php echo ( $settings->items_spacing_medium != '' ) ? $settings->items_spacing_medium / 2 : '7.5'; ?>,
        nav: <?php echo ( $settings->nav_arrows_medium != '' ) ? $settings->nav_arrows_medium : $settings->nav_arrows; ?>,
        dots: <?php echo ( $settings->nav_dots_medium != '' ) ? $settings->nav_dots_medium : $settings->nav_dots; ?>,
    },
    <?php echo ('' != $global_settings->medium_breakpoint) ? $global_settings->medium_breakpoint + 1 : '993'; ?>: {
        items: <?php echo ( $settings->grid_numbers != '' ) ? $settings->grid_numbers : '2'; ?>,
        margin: <?php echo ( $settings->items_spacing != '' ) ? $settings->items_spacing : '30'; ?>,
        stagePadding: <?php echo ( $settings->items_spacing != '' ) ? $settings->items_spacing / 2 : '15'; ?>,
        nav: <?php echo $settings->nav_arrows; ?>,
        dots: <?php echo $settings->nav_dots; ?>,
    }
}
});

    <?php } ?>

    <?php if($settings->portfolio_layout == 'innovative'){ ?>

    /* ===================================
		 Slider
	 ====================================== */

    var b;
    if ($('.fl-builder-edit').length) {
        b = '.fl-builder-content-primary'
    }

    $('.fl-node-<?php echo $id; ?> .tnit-slider-innovative').owlCarousel({
        loop: <?php echo $settings->slide_loop; ?>,
        autoplay: <?php echo $settings->autoplay; ?>,
        autoWidth:<?php echo $settings->auto_width; ?>,
        center:<?php echo $settings->item_center; ?>,
        navText: [$('.fl-node-<?php echo $id; ?> .tnit-slide-next'), $('.fl-node-<?php echo $id; ?> .tnit-slide-prev')],
        <?php if( $settings->autoplay ){ ?>
        autoplayHoverPause: <?php echo $settings->autoplay_hover_pause; ?>,
        autoplayTimeout: <?php echo ( '' != $settings->speed ) ? $settings->speed : '2000'; ?>,
        <?php } ?>
        lazyLoad: <?php echo $settings->lazy_load; ?>,
        smartSpeed: 1000,
        itemClass: 'owl-item portfolio-preview-<?php echo esc_attr($settings->preview_type); ?>',
        <?php if($settings->slide_loop){ ?>
        startPosition: <?php echo ( '' != $settings->start_position) ? $settings->start_position : 1 ; ?>,
        <?php } ?>
        mouseDrag: true,
        touchDrag: true,
        responsiveClass: true,
        //responsiveRefreshRate: 10,
        responsiveBaseElement:b,
        responsive: {
            0: {
                items: <?php echo ( $settings->grid_numbers_responsive != '' ) ? $settings->grid_numbers_responsive : '1'; ?>,
                nav: <?php
                if( $settings->nav_arrows_responsive != '' ){
                    echo $settings->nav_arrows_responsive;
                } else if( $settings->nav_arrows_responsive == '' && $settings->nav_arrows_medium != '' ){
                    echo $settings->nav_arrows_medium;
                } else {
                    echo $settings->nav_arrows;
                } ?>,
                dots: <?php
                if( $settings->nav_dots_responsive != '' ){
                    echo $settings->nav_dots_responsive;
                } else if( $settings->nav_dots_responsive == '' && $settings->nav_dots_medium != '' ){
                    echo $settings->nav_dots_medium;
                } else {
                    echo $settings->nav_dots;
                } ?>,
            },
    <?php echo ('' != $global_settings->responsive_breakpoint) ? $global_settings->responsive_breakpoint + 1 : '769'; ?>: {
        items: <?php echo ( $settings->grid_numbers_medium != '' ) ? $settings->grid_numbers_medium : '2'; ?>,
        nav: <?php echo ( $settings->nav_arrows_medium != '' ) ? $settings->nav_arrows_medium : $settings->nav_arrows; ?>,
        dots: <?php echo ( $settings->nav_dots_medium != '' ) ? $settings->nav_dots_medium : $settings->nav_dots; ?>,
    },
    <?php echo ('' != $global_settings->medium_breakpoint) ? $global_settings->medium_breakpoint + 1 : '993'; ?>: {
        items: <?php echo ( $settings->grid_numbers != '' ) ? $settings->grid_numbers : '2'; ?>,
        nav: <?php echo $settings->nav_arrows; ?>,
        dots: <?php echo $settings->nav_dots; ?>,
    }
}
});

    <?php } ?>

    <?php if($settings->portfolio_layout == 'minimal'){ ?>

    /* =====================================
         slick for slider
    ====================================== */

    $('.fl-node-<?php echo $id; ?> .tnit-slick-detail').slick({
        infinite: <?php echo $settings->slide_loop; ?>,
        pauseOnHover:<?php echo $settings->autoplay_hover_pause; ?>,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        active:true,
        dots:false,
        asNavFor: '.fl-node-<?php echo $id; ?> .tnit-slick-detail-image',
    });

    $('.fl-node-<?php echo $id; ?> .tnit-slick-detail-image').slick({
        infinite: <?php echo $settings->slide_loop; ?>,
        autoplay: <?php echo $settings->autoplay; ?>,
        autoplaySpeed: <?php echo ( '' != $settings->speed ) ? $settings->speed : '2000'; ?>,
        pauseOnHover:<?php echo $settings->autoplay_hover_pause; ?>,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.fl-node-<?php echo $id; ?> .tnit-slick-detail',
        dots: false,
        arrows: true,
        nextArrow: '.fl-node-<?php echo $id; ?> .tnit-slide-next',
        prevArrow: '.fl-node-<?php echo $id; ?> .tnit-slide-prev',
        focusOnSelect: true,
    });

    <?php } ?>

    <?php if($settings->portfolio_layout == 'agency'){ ?>

    var url = $('.fl-node-<?php echo $id; ?> .tnit-slider-full-half .tnit-portfolio-menu li > a.active').attr('data-image-url');

    $(".fl-node-<?php echo $id; ?> .tnit-slider-full-half .tnit-image-area").css("background-image", "url(" + url + ")");

    $('.fl-node-<?php echo $id; ?> .tnit-slider-full-half .tnit-portfolio-menu li > a').on('mouseover', function () {

        $('.fl-node-<?php echo $id; ?> .tnit-slider-full-half .tnit-portfolio-menu li > a').removeClass('active');

        $(this).addClass('active');

        url = $(this).attr('data-image-url');

        $(".fl-node-<?php echo $id; ?> .tnit-slider-full-half .tnit-image-area").css("background-image", "url(" + url + ")");

        $(".fl-node-<?php echo $id; ?> .tnit-slider-full-half .tnit-image-area").toggleClass('animate');

    });

    <?php } ?>

    <?php if($settings->portfolio_layout == 'modern'){ ?>

    $(".fl-node-<?php echo $id; ?> .tnit-slider-full .tnit-portfolio-menu li > a").hover(function () {

        $('.fl-node-<?php echo $id; ?> .tnit-slider-full .tnit-portfolio-menu li > a').removeClass('active');
        $(this).addClass('active');

        var url = $(this).attr('data-image-url');

        $(".fl-node-<?php echo $id; ?> .tnit-slider-full .tnit-full-content").addClass('animate');

        var image = $('.fl-node-<?php echo $id; ?> .tnit-slider-full .tnit-image-area');
        image.fadeOut(200, function () {
            image.css("background-image", "url(" + url + ")");
            image.css({"background-image": "url(" + url + ")", "z-index": "3"});
            image.fadeIn(300);
        });

    }, function () {
        $('.fl-node-<?php echo $id; ?> .tnit-slider-full .tnit-portfolio-menu li > a').removeClass('active');
        $(".fl-node-<?php echo $id; ?> .tnit-slider-full .tnit-full-content").removeClass('animate');
        $(".fl-node-<?php echo $id; ?> .tnit-slider-full .tnit-image-area").css({"background-image": "none", "z-index": "1"});
    });


    <?php } ?>

    <?php if($settings->preview_type == 'link'){ ?>

    $('.fl-node-<?php echo $id; ?> .portfolio-preview-link').on('click',function (e){

        e.preventDefault();
        e.stopPropagation();

        var url = '';

        <?php if($settings->portfolio_layout == 'carousel' || $settings->portfolio_layout == 'innovative'): ?>
        url = $(this ).find('.portfolio-preview-inner').data( 'src-preview' );
        <?php else: ?>
        url = $(this ).data( 'src-preview' );
        <?php endif; ?>

        if(url !== ""){
            window.open(url,'<?php echo $settings->page_target; ?>');
        }

    });

    <?php } ?>

    <?php if($settings->preview_type == 'popup'){?>

    $('.fl-node-<?php echo $id; ?> .xpro-preview-iframe').on('load', function () {
        $(this).contents().find('body').css('overflow-y','scroll');
        $(this).contents().find('html').attr('style', 'margin-top: 0 !important');
        $(this).contents().find('#wpadminbar').css('display','none');
    });

    /*
     * Open preview.
     */
    function OpenPreview( $this, e ) {
        let  name = $( $this ).data( 'preview-title' );

        <?php if($settings->portfolio_layout == 'carousel' || $settings->portfolio_layout == 'innovative'): ?>
        name = $( $this ).find('.portfolio-preview-inner').data( 'preview-title' );
        preview = $( $this ).find('.portfolio-preview-inner').data( 'src-preview' );
        <?php else: ?>
        preview = $( $this ).data( 'src-preview' );
        <?php endif; ?>

        if(typeof preview == 'undefined' || 'false' === preview) {
            return false;
        }

        popupOpenTransition();

        // Remove current class from siblings items.
        $( $this ).siblings().removeClass( 'xpro-preview-demo-item-open' );

        // Current item.
        $( $this ).addClass( 'xpro-preview-demo-item-open' );

        // Prev Next Buttons.
        $( '.fl-node-<?php echo $id; ?> .xpro-preview' ).find( '.xpro-preview-prev-demo, .xpro-preview-next-demo' ).removeClass( 'xpro-preview-inactive' );
        $( '.fl-node-<?php echo $id; ?> .xpro-preview' ).find( '.xpro-preview-prev-thumb, .xpro-preview-next-thumb' ).removeClass( 'xpro-preview-inactive' );

        let prev = $( $this ).prev( '.portfolio-preview-popup' );

        if ( prev.length <= 0 ) {
            $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-prev-demo' ).addClass( 'xpro-preview-inactive' );
            $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-prev-thumb' ).addClass( 'xpro-preview-inactive' );
        }

        let next = $( $this ).next( '.portfolio-preview-popup' );
        if ( next.length <= 0 ) {
            $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-next-demo' ).addClass( 'xpro-preview-inactive' );
            $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-next-thumb' ).addClass( 'xpro-preview-inactive' );
        }

        <?php if($settings->popup_layout == 'layout-5' || $settings->popup_layout == 'layout-6'): ?>
        let prev_src = prev.find('.tnit-image').attr('src');
        let next_src = next.find('.tnit-image').attr('src');

        <?php if($settings->portfolio_layout == 'carousel' || $settings->portfolio_layout == 'innovative'): ?>
        prev_src = prev.find('.tnit-image').attr('src');
        next_src = next.find('.tnit-image').attr('src');
        <?php endif; ?>

        <?php if($settings->portfolio_layout == 'agency' || $settings->portfolio_layout == 'modern'): ?>
        prev_src = prev.find('a').attr('data-image-url');
        next_src = next.find('a').attr('data-image-url');
        <?php endif; ?>

        <?php if($settings->portfolio_layout == 'minimal'): ?>
        prev_src = prev.attr('data-image-url');
        next_src = next.attr('data-image-url');
        <?php endif; ?>

        if(prev_src) {
            $('.fl-node-<?php echo $id; ?> .xpro-preview').find('.xpro-preview-prev-demo .xpro-preview-nav-img').css('background-image', 'url(' + prev_src + ')');
        }
        if(next_src) {
            $('.fl-node-<?php echo $id; ?> .xpro-preview').find('.xpro-preview-next-demo .xpro-preview-nav-img').css('background-image', 'url(' + next_src + ')');
        }
        <?php endif; ?>

        <?php if($settings->popup_layout == 'layout-9'): ?>
        let prev_title = prev.find('.title').text();
        let next_title = next.find('.title').text();

        if(prev_title) {
            $('.fl-node-<?php echo $id; ?> .xpro-preview').find('.xpro-preview-prev-demo .xpro-preview-footer-text > .title').text(prev_title);
        }
        if(next_title) {
            $('.fl-node-<?php echo $id; ?> .xpro-preview').find('.xpro-preview-next-demo .xpro-preview-footer-text > .title').text(next_title);
        }
        <?php endif; ?>

        <?php if($settings->popup_layout == 'layout-10'): ?>
        let last_prev_src = prev.find('.tnit-image').attr('src');
        let last_curr_src = $($this).find('.tnit-image').attr('src');
        let last_next_src = next.find('.tnit-image').attr('src');

        <?php if($settings->portfolio_layout == 'carousel' || $settings->portfolio_layout == 'innovative'): ?>
        last_prev_src = prev.find('.tnit-image').attr('src');
        last_curr_src = $($this).find('.tnit-image').attr('src');
        last_next_src = next.find('.tnit-image').attr('src');
        <?php endif; ?>

        <?php if($settings->portfolio_layout == 'agency' || $settings->portfolio_layout == 'modern'): ?>
        last_prev_src = prev.find('a').attr('data-image-url');
        last_curr_src = $($this).find('a').attr('data-image-url');
        last_next_src = next.find('a').attr('data-image-url');
        <?php endif; ?>

        <?php if($settings->portfolio_layout == 'minimal'): ?>
        last_prev_src = prev.attr('data-image-url');
        last_curr_src = $($this).attr('data-image-url');
        last_next_src = next.attr('data-image-url');
        <?php endif; ?>

        if(last_prev_src) {
            $('.fl-node-<?php echo $id; ?> .xpro-preview').find('.xpro-preview-thumbnails .xpro-preview-prev-thumb').css('background-image', 'url(' + last_prev_src + ')');
        }
        if(last_curr_src) {
            $('.fl-node-<?php echo $id; ?> .xpro-preview').find('.xpro-preview-thumbnails .xpro-preview-current-thumb').css('background-image', 'url(' + last_curr_src + ')');
        }
        if(last_next_src) {
            $('.fl-node-<?php echo $id; ?> .xpro-preview').find('.xpro-preview-thumbnails .xpro-preview-next-thumb').css('background-image', 'url(' + last_next_src + ')');
        }
        <?php endif; ?>

        // Reset header info.
        $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-header-info' ).html( '' );

        // Add name to info.
        if ( name ) {
            $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-header-info' ).append( `<div class="xpro-preview-demo-name">${name}</div>` );
        }

        // Set url in iframe.
        $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-iframe' ).attr( 'src', preview );

        // Body preview.
        $( 'body' ).addClass( 'xpro-preview-active' );
        $( '.fl-node-<?php echo $id; ?> .xpro-preview' ).addClass( 'active' );

    }

    /*
     * Open preview demo.
     */
    $( document ).on( 'click', '.fl-node-<?php echo $id; ?> .portfolio-preview-popup', function( e ) {
        if ( ! $( e.target ).is( '.fl-node-<?php echo $id; ?> .xpro-preview-demo-import-open' ) ) {

            OpenPreview( this, e );
            e.preventDefault();
        }
    } );

    /*
     * Open preview prev demo.
     */
    $( document ).on( 'click', '.fl-node-<?php echo $id; ?> .xpro-preview-prev-demo', function( e ) {

        var prev = $( '.fl-node-<?php echo $id; ?> .xpro-preview-demo-item-open' ).prev( '.portfolio-preview-popup' );

        if ( prev.length > 0 ) {
            OpenPreview( prev, e );
        }

        e.preventDefault();
    } );

    /*
     * Open preview next demo.
     */
    $( document ).on( 'click', '.fl-node-<?php echo $id; ?> .xpro-preview-next-demo', function( e ) {

        var next = $( '.fl-node-<?php echo $id; ?> .xpro-preview-demo-item-open' ).next( '.portfolio-preview-popup' );

        if ( next.length > 0 ) {
            OpenPreview( next, e );
        }

        e.preventDefault();
    } );

    /*
     * Close preview.
     */
    $( document ).on( 'click', '.fl-node-<?php echo $id; ?> .xpro-preview-close,.fl-node-<?php echo $id; ?> .tnit-portfolio-loader li', function( e ) {

        e.preventDefault();

        popupOpenTransition();

        setTimeout(function () {

            // Remove current class from items.
            $( '.fl-node-<?php echo $id; ?> .xpro-preview-demo-item' ).removeClass( 'xpro-preview-demo-item-open' );

            // Remove preview from body.
            $( 'body' ).removeClass( 'xpro-preview-active' );

            $( '.fl-node-<?php echo $id; ?> .xpro-preview' ).removeClass( 'active' );

            $( '.fl-node-<?php echo $id; ?> .xpro-preview .xpro-preview-iframe' ).attr( 'src', ' ' );

        },2000);

    } );


    //Popup Open Transition
    function popupOpenTransition(){

        //Slice
        <?php if($settings->preview_animation == 'style-1'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-1 li',{duration:0.4, scaleX:1, transformOrigin:"bottom right"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-2'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-2 li',{duration:0.4, scaleX:1, transformOrigin:"bottom left"});
        <?php } ?>

        //Slot
        <?php if($settings->preview_animation == 'style-3'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-3 li',{duration:0.4, scaleY:1, transformOrigin:"top left", stagger: 0.2});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-4'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-4 li',{duration:0.4, scaleY:1, transformOrigin:"bottom left", stagger: 0.2});
        <?php } ?>

        //Reveal
        <?php if($settings->preview_animation == 'style-5'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-5 li',{duration:0.4, scaleX:1, transformOrigin:"bottom right"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-6'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-6 li',{duration:0.4, scaleX:1, transformOrigin:"bottom left"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-7'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-7 li',{duration:0.4, scaleY:1, transformOrigin:"top right"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-8'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-8 li',{duration:0.4, scaleY:1, transformOrigin:"bottom right"});
        <?php } ?>

        setTimeout(function () {
            popupCloseTransition();
        },2500);

    }

    //Popup Close Transition
    function popupCloseTransition(){

        //Slice
        <?php if($settings->preview_animation == 'style-1'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-1 li',{duration:0.4, scaleX:0, transformOrigin:"bottom left"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-2'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-2 li',{duration:0.4, scaleX:0, transformOrigin:"bottom right"});
        <?php } ?>

        //Slot
        <?php if($settings->preview_animation == 'style-3'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-3 li',{duration:0.4, scaleY:0, transformOrigin:"bottom left", stagger: 0.2});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-4'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-4 li',{duration:0.4, scaleY:0, transformOrigin:"top left", stagger: 0.2});
        <?php } ?>

        //Reveal
        <?php if($settings->preview_animation == 'style-5'){ ?>
        tl.to('.tnit-portfolio-loader-style-5 li',{duration:0.4, scaleX:0, transformOrigin:"bottom left"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-6'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-6 li',{duration:0.4, scaleX:0, transformOrigin:"bottom right"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-7'){ ?>
        tl.to('.tnit-portfolio-loader-style-7 li',{duration:0.4, scaleY:0, transformOrigin:"bottom right"});
        <?php } ?>

        <?php if($settings->preview_animation == 'style-8'){ ?>
        tl.to('.fl-node-<?php echo $id; ?> .tnit-portfolio-loader-style-8 li',{duration:0.4, scaleY:0, transformOrigin:"top right"});
        <?php } ?>

    }

    <?php } ?>

})(jQuery);
