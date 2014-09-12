
(function(Modernizr) {

    var THEMEMAKERS_AJAX = function() {

        var init_modules = {
         
            fb_com: function() {

                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(window.document, 'script', 'facebook-jssdk'));
                if (jQuery('#facebook-jssdk').length) {
                    jQuery('#content').ajaxComplete(function() {
                        //re-render the facebook icons (in a div with id of 'content')
                        FB.XFBML.parse();
                    });
                }
               
            },
            scrollBox_bar: function() {
                var scroller = jQuery('<div class="scroller"></div>');
                var scrollerBar = jQuery('<div class="scroller_bar"></div>');
                if (jQuery('.scroll-box').length) {
                    jQuery('.scroll-box').append(scrollerBar);
                    scrollerBar.append(scroller);
                }
                var content = jQuery('.grid');
                var menu = jQuery('.scroll-box');
                var objectWidth = jQuery(window).width();
                var objectTrackWidth = content.width();
                var scrollerTrackWidth = 900;
                var scrollerWidth = Math.round((objectWidth * objectTrackWidth) / (scrollerTrackWidth));
                scrollerWidth = (scrollerWidth > scrollerTrackWidth) ? scrollerTrackWidth : scrollerWidth;
                scroller.css({'width': '' + scrollerWidth + 'px'});
                scroller.on('mousedown', function(event) {
                    drag(event);
                });
                jQuery(window).on('mousemove', function(event) {
                    move(event);
                });
                jQuery(window).on('mouseup', function(event) {
                    drop(event);
                });
                content.on('mousewheel', function(event, delta) {
                    wheel(event, delta);
                });
                var canDrag = false;
                var shift_x;
                function drag(event)
                {
                    if (!event)
                    {
                        event = window.event;
                    }
                    canDrag = true;
                    shift_x = event.clientX - parseInt(scroller.position().left);
                    blockEvent(event);
                    return false;
                }

                function move(event)
                {
                    if (!event)
                    {
                        event = window.event;
                    }

                    if (canDrag)
                    {
                        setPosition(event.clientX - shift_x);
                        blockEvent(event);
                    }
                    return false;
                }

                function drop()
                {
                    canDrag = false;
                }

                function setPosition(newPosition)
                {
                    var left;

                    if ((newPosition <= objectWidth - scrollerWidth) && (newPosition >= 0))
                    {
                        left = newPosition;
                    }
                    else if (newPosition > (objectWidth - scrollerWidth))
                    {
                        left = objectWidth - scrollerWidth;
                    }
                    else
                    {
                        left = 0;
                    }
                    scroller.css({'left': left + "px"});
                    var delta = ((jQuery('.grid').width() - jQuery(window).width()) / (jQuery(window).width() - scrollerWidth));
                    var cleft = Math.round(parseInt(scroller.position().left) * delta * (-1));
                    content.css({'left': cleft + "px"});
                    return false;
                }
                function blockEvent(event)
                {
                    if (!event)
                    {
                        event = window.event;
                    }
                    if (event.stopPropagation)
                        event.stopPropagation();
                    else
                        event.cancelBubble = true;
                    if (event.preventDefault)
                        event.preventDefault();
                    else
                        event.returnValue = false;
                }
                function wheel(event, delta)
                {
                    var wheelDelta = -delta;
                    var step = 100;
                    if (!event)
                    {
                        event = window.event;
                    }
                    if (event.wheelDelta)
                    {
                        wheelDelta = event.wheelDelta / 120;
                    }
                    if (wheelDelta)
                    {
                        var currentPosition = parseInt(scroller.position().left);
                        var newPosition = wheelDelta * step + currentPosition;
                        setPosition(newPosition);
                    }
                    if (event.preventDefault)
                    {
                        event.preventDefault();
                    }
                    event.returnValue = false;
                    blockEvent(event);
                }
                if (Modernizr.touch) {

                    var IMG_WIDTH = 50,
                            currentImg = 0,
                            maxImages = 2,
                            win = jQuery(window),
                            speed = 500,
                            grid = jQuery('div.grid'),
                            imgs = jQuery('div.scroll-box');
                    maxImages = grid.width() / win.width();
                    IMG_WIDTH = win.width();
                    //Init touch swipe
                    imgs.swipe({
                        triggerOnTouchEnd: true,
                        swipeStatus: swipeStatus,
                        allowPageScroll: "vertical"
                    });

                    /**
                     * Catch each phase of the swipe.
                     * move : we drag the div.
                     * cancel : we animate back to where we were
                     * end : we animate to the next image
                     */
                    function swipeStatus(event, phase, direction, distance, fingers)
                    {
                        //If we are moving before swipe, and we are going L or R, then manually drag the images
                        if (phase == "move" && (direction == "left" || direction == "right"))
                        {
                            var duration = 0;

                            if (direction == "left")
                                scrollImages((IMG_WIDTH * currentImg) + distance, duration);

                            else if (direction == "right")
                                scrollImages((IMG_WIDTH * currentImg) - distance, duration);
                        }

                        //Else, cancel means snap back to the begining
                        else if (phase == "cancel")
                        {
                            scrollImages(IMG_WIDTH * currentImg, speed);
                        }

                        //Else end means the swipe was completed, so move to the next image
                        else if (phase == "end")
                        {
                            if (direction == "right")
                                previousImage()
                            else if (direction == "left")
                                nextImage()
                        }
                    }

                    function previousImage()
                    {
                        currentImg = Math.max(currentImg - 1, 0);
                        scrollImages(IMG_WIDTH * currentImg, speed);
                    }

                    function nextImage()
                    {
                        currentImg = Math.min(currentImg + 1, maxImages - 1);
                        scrollImages(IMG_WIDTH * currentImg, speed);
                    }

                    /**
                     * Manually update the position of the imgs on drag
                     */
                    function scrollImages(distance, duration)
                    {
                        grid.css("-webkit-transition-duration", (duration / 1000).toFixed(1) + "s");

                        //inverse the number we set in the css
                        var value = (distance < 0 ? "" : "-") + Math.abs(distance).toString();
                        grid.css("-webkit-transform", "translate3d(" + value + "px,0px,0px)");
                    }

                }
            },
            scrollBox: function() {
                var scroll_box = jQuery('div.scroll-box'),
                grid = jQuery('div.grid'),
                win = jQuery(window),
                to_right=jQuery('<div class="to_right"></div>'),
                to_left=jQuery('<div class="to_left"></div>'),
                m = 100;
        scroll_box.on('mousedown', function(event) {
            jQuery(this).data('down', true).data('x', event.clientX).data('scrollLeft', this.scrollLeft);
            return false;
        }).on('mouseup', function(event) {
            jQuery(this).data('down', false);
        }).mousemove(function(event) {
            var win_w = win.width(),
                    grid_w = grid.width(),
                    l = 0, d = 0;
            if (grid_w > win_w) {
                if (event.clientX > (win.width() - win.width() / 4)) {
                    scroll_box.append(to_right);
                    to_right.fadeIn(300).css({'opacity':'0.8'});
                    l = win_w - grid_w;
                    d = (grid_w - (-grid.position().left + win_w));
                } else if (event.clientX < win.width() / 4) {
                    scroll_box.append(to_left);
                    to_left.fadeIn(300).css({'opacity':'0.8'});                  
                    l = 0;
                    d = (-grid.position().left);
                } else {
                    to_left.hide().remove();
                    to_right.hide().remove();
                    grid.stop(true);
                    return;
                }
                if (d > win_w) {
                    d = d / 2;
                } else {
                    d = d / 1.5;
                }
                           
                if (scrolling_speed>5){
                    d=-d/(5-scrolling_speed);
                }else if(scrolling_speed<5){
                    d=d*(5-scrolling_speed);
                }  
                
                grid.stop(true).animate({
                    'left': l
                }, {
                    queue: false,
                    duration: d,
                    easing: 'quadEaseOut'
                });
            }
        }).on('mousewheel', function(event, delta) {
            grid.stop(true);
            this.scrollLeft -= (delta * 100);
        }).css({
            'overflow': 'hidden',
            'cursor': '-moz-grab'
        });
                if (Modernizr.touch) {

                    var IMG_WIDTH = 50,
                            currentImg = 0,
                            maxImages = 2,
                            win = jQuery(window),
                            speed = 500,
                            grid = jQuery('div.grid'),
                            imgs = jQuery('div.scroll-box');
                    maxImages = grid.width() / win.width();
                    IMG_WIDTH = win.width();
                    //Init touch swipe
                    imgs.swipe({
                        triggerOnTouchEnd: true,
                        swipeStatus: swipeStatus,
                        allowPageScroll: "vertical"
                    });

                    /**
                     * Catch each phase of the swipe.
                     * move : we drag the div.
                     * cancel : we animate back to where we were
                     * end : we animate to the next image
                     */
                    function swipeStatus(event, phase, direction, distance, fingers)
                    {
                        //If we are moving before swipe, and we are going L or R, then manually drag the images
                        if (phase == "move" && (direction == "left" || direction == "right"))
                        {
                            var duration = 0;

                            if (direction == "left")
                                scrollImages((IMG_WIDTH * currentImg) + distance, duration);

                            else if (direction == "right")
                                scrollImages((IMG_WIDTH * currentImg) - distance, duration);
                        }

                        //Else, cancel means snap back to the begining
                        else if (phase == "cancel")
                        {
                            scrollImages(IMG_WIDTH * currentImg, speed);
                        }

                        //Else end means the swipe was completed, so move to the next image
                        else if (phase == "end")
                        {
                            if (direction == "right")
                                previousImage()
                            else if (direction == "left")
                                nextImage()
                        }
                    }

                    function previousImage()
                    {
                        currentImg = Math.max(currentImg - 1, 0);
                        scrollImages(IMG_WIDTH * currentImg, speed);
                    }

                    function nextImage()
                    {
                        currentImg = Math.min(currentImg + 1, maxImages - 1);
                        scrollImages(IMG_WIDTH * currentImg, speed);
                    }

                    /**
                     * Manually update the position of the imgs on drag
                     */
                    function scrollImages(distance, duration)
                    {
                        grid.css("-webkit-transition-duration", (duration / 1000).toFixed(1) + "s");

                        //inverse the number we set in the css
                        var value = (distance < 0 ? "" : "-") + Math.abs(distance).toString();
                        grid.css("-webkit-transform", "translate3d(" + value + "px,0px,0px)");

                    }
                }

            },
            load_folio: function() {

                var fancyBox = function() {

                    if (jQuery('.single-image').length) {

                        function touchHandler(e) {

                            if (jQuery(this).hasClass('active')) {
                                jQuery(this).removeClass('active');
                                return true;
                            } else {
                                jQuery(this).addClass('active');
                                return false;
                            }
                            /*
                             var target = $(e.currentTarget);
                             
                             if (target.hasClass('active')) {
                             target.removeClass('active');
                             return true;
                             } else {
                             target.addClass('active');
                             return false;
                             }
                             */
                        }

                        if (Modernizr.touch) {
                            jQuery('.single-image').on('click', touchHandler);
                        }
                        // Single Image
                        jQuery('.single-image.plus-icon, .single-image.link-icon').fancybox({
                            openEffect: 'fade',
                            closeEffect: 'fade'
                        }).each(function() {
                            jQuery(this).append('<span class="curtain"></span>');
                        });

                        // Iframe
                        jQuery('.single-image.video-icon').fancybox({
                            type: 'iframe',
                            openEffect: 'fade',
                            closeEffect: 'fade',
                            nextEffect: 'fade',
                            prevEffect: 'fade',
                            helpers: {
                                title: {
                                    type: 'over'
                                }
                            },
                            width: '70%',
                            height: '70%',
                            maxWidth: 800,
                            maxHeight: 600,
                            fitToView: false,
                            autoSize: false,
                            closeClick: false
                        }).each(function() {
                            jQuery(this).append('<span class="curtain"></span>');
                        });
                    }
                };

                jQuery('#folio_categories_bar li').on('click', 'a', function() {
                    var $this = jQuery(this),
                            folio_post_id = $this.data('post-id'),
                            layout = $this.data('layout');

                    $this.parent().siblings('li').removeClass('active').end().addClass('active');
                    jQuery('#folio_images_area').fadeOut(200);
                    jQuery('#wrapper').append('<div class="folio-loader"></div>');

                    var data = {
                        action: 'folio_get_by_folio_id',
                        folio_post_id: folio_post_id,
                        layout: layout
                    };

                    jQuery.post(ajaxurl, data, function(response) {

                        jQuery(function() {

                            if (jQuery('#folio_images_area').length) {

                                jQuery('body').css('overflow', 'hidden');

                                var folioArea = jQuery('#folio_images_area');
                                folioArea.html(response).hide(0).fadeIn(500, function() {

                                    jQuery('.folio-loader').remove();

                                });

                                jQuery('#folio_images_area a').each(function() {

                                    var this_menu_link = jQuery(this).attr('href');
                                    if ((this_menu_link != "#") && (this_menu_link != undefined)) {
                                        this_menu_link = this_menu_link.split('/?');
                                        if (this_menu_link['1'] != undefined) {
                                            this_menu_link = this_menu_link['1'];
                                            var data_type = this_menu_link.split('=');
                                            var data_id = data_type['1'];

                                            if ((data_type['0'] == '?post_type') || (data_type['0'] == 'post_type')) {
                                                data_id = data_type['2'];
                                                data_type = data_type['1'];
                                                data_type = data_type.split('&');
                                                data_type = data_type['0'];

                                            }
                                            else {
                                                data_type = data_type['0'];
                                                //	data_type=data_type.slice(1);				
                                            }
                                            if ((data_type == 'folio') && (data_id == undefined)) {
                                                data_id = 'archive'
                                                jQuery(this).attr('data-load', true);
                                            }

                                            jQuery(this).attr('data-type', data_type);
                                            jQuery(this).attr('data-id', data_id);

                                            if (data_id == undefined) {
                                                jQuery(this).attr('data-load', false);
                                            }

                                        }
                                        else {
                                            jQuery(this).attr('data-load', false);
                                        }

                                    }
                                    else {
                                        jQuery(this).attr('data-load', false);
                                    }

                                });

                                jQuery('.scroll-box').resizeGrid();
                                fancyBox();
                              //  init_modules.scrollBox();
                                (enable_scrolling_bar=='true') ? init_modules.scrollBox_bar() : init_modules.scrollBox();

                            }

                        });
                    });

                    return false;

                });

            },
            single_image: function() {

                function touchHandler(e) {

                    if (jQuery(this).hasClass('active')) {
                        jQuery(this).removeClass('active');
                        return true;
                    } else {
                        jQuery(this).addClass('active');
                        return false;
                    }

                    /*
                     var target = $(e.currentTarget);
                     if (target.hasClass('active')) {
                     target.removeClass('active');
                     return true;
                     } else {
                     target.addClass('active');
                     return false;
                     }
                     */
                }
                if (Modernizr.touch) {

                    jQuery('.single-image').on('click', touchHandler);
                }

                // Single Image
                jQuery('.single-image.plus-icon, .single-image.link-icon').fancybox({
                    openEffect: 'fade',
                    closeEffect: 'fade'
                }).each(function() {
                    jQuery(this).append('<span class="curtain"></span>');
                });
                 // fancybox video

            jQuery(".single-image.video-icon").click(function() {
                jQuery.fancybox({
                    'padding': 0,
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'title': this.title,
                    'width': '70%',
                    'height': '70%',
                    'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                    'type': 'swf',
                    'swf': {
                        'wmode': 'transparent',
                        'allowfullscreen': 'true'
                    }
                });
                return false;
            });

            jQuery(".single-image.video-icon.vimeo").click(function() {
                jQuery.fancybox({
                    'padding': 0,
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'title': this.title,
                    'width': '70%',
                    'height': '70%',
                    'href': this.href.replace(new RegExp("([0-9])", "i"), 'moogaloop.swf?clip_id=$1'),
                    'type': 'swf',
                    'swf': {
                        'wmode': 'transparent',
                        'allowfullscreen': 'true'
                    }
                });
                return false;
            });
                // Iframe
                jQuery('.single-image.video-icon').fancybox({
                    type: 'iframe',
                    openEffect: 'fade',
                    closeEffect: 'fade',
                    nextEffect: 'fade',
                    prevEffect: 'fade',
                    helpers: {
                        title: {
                            type: 'over'
                        }
                    },
                    width: '70%',
                    height: '70%',
                    maxWidth: 800,
                    maxHeight: 600,
                    fitToView: false,
                    autoSize: false,
                    closeClick: false
                }).each(function() {
                    jQuery(this).append('<span class="curtain"></span>');
                });
            },
            add_content: function(response, dataId) {

                var html = jQuery(response).find('div.ajax').html();

                var sidebar = jQuery(response).find('div.ajax').parent().parent().attr('class');

                if (html != undefined) {
                    var body_class = /body([^>]*)class=(["']+)([^"']*)(["']+)/gi.exec(response.substring(response.indexOf("<body"), response.indexOf("</body>") + 7))[3];
                }

                jQuery('body').attr('class', body_class);
                jQuery('#wrapper').attr('class', sidebar);
                jQuery('#content').append('<div class="container ajax">' + html + '</div>');
                jQuery('#content>div.container.ajax').hide();
                jQuery('.folio-loader').remove();
                jQuery('#content>div.container.ajax').fadeIn(1000);


                if (jQuery('#tp-grid').length) {
                    init_modules.stapel();
                }
                if (jQuery('#gallery-items').length) {
                    init_modules.gallery();
                }
                if (jQuery('.cycle-slider > ul').length) {
                    init_modules.cycleSlider();
                }
                if (jQuery('.epicSlider').length) {
                    init_modules.epicslider();
                }
                if (jQuery('.image-post-slider > ul').length) {
                    init_modules.postSlider();

                }
                if (jQuery('.scroll-box').length) {
                    init_modules.homeGrid();
                }
                if (jQuery('.content-tabs').length) {
                    init_modules.tabs();
                }
                if (jQuery('.acc-box').length) {
                    init_modules.toggles();

                }
                if (jQuery('#commentform').length) {
                    init_modules.comments();
                }
                if (jQuery('.sudo').length) {
                    init_modules.sudoslider();
                }
                if (jQuery('#masonry').length) {
                    //	init_modules.masonry();
                }
                if (jQuery('.quotes').length) {
                    init_modules.testimonials();
                }
                if (jQuery('.contact-form').length) {
                    init_modules.contact_form();
                }
                if (jQuery('.google_map').length) {
                    init_modules.google_map();
                }
                if (jQuery('.flexslider').length) {
                    init_modules.flexslider();
                }
                if (jQuery('.submit-search').length) {
                    init_modules.search();
                }
                if (jQuery('audio, video').length) {
                    init_modules.media();
                }
                if (jQuery('.single-image').length) {
                    init_modules.single_image();
                }
                if (jQuery('#folio_categories_bar li').length) {
                    init_modules.load_folio();
                }
                if (jQuery('.fb-comments').length){
                    init_modules.fb_com();
                }
                if (jQuery('.social-likes').length){
                   
                        jQuery('.social-likes').socialLikes();
                    
                }
                if (jQuery(".post-like").length) {
                    jQuery(".post-like a").click(function() {

                        var heart = jQuery(this);
                        var post_id = heart.data("post_id");

                        // Ajax call  

                        jQuery.ajax({
                            type: "post",
                            url: ajaxurl,
                            data: "action=post-like&nonce=" + ajax_nonce + "&post_like=&post_id=" + post_id,
                            success: function(count) {

                                if (count != "already")
                                {
                                    heart.addClass("voted");
                                    heart.siblings(".count").text(count);
                                }
                            }
                        });

                        return false;
                    })
                }
                if (jQuery('#gallery-items').length) {
                    var listing_id = jQuery('#gallery-items').data('listing-page-id');
                    jQuery('.project-meta').live('click', function() {                        
                        data = {
                            action: 'ajax_load_single_gall',
                            listing_page_id: listing_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            setTimeout(function() {
                                var tp_back = jQuery('<div class="tp-back" id="close">Back</div>');        

                                if (!jQuery('.page-header .tp-back').length) {
                                    var a = jQuery('<a href=""  data-type="page_id" data-id="' + response + '"></a>');
                                    jQuery('.page-header').append(tp_back);
                                    tp_back.css({'display': 'block'});
                                    jQuery('#close').append(a);
                                    a.css({'display': 'block', 'height': '100%', 'width': '100%', 'position': 'absolute', 'left': '0', 'top': '0'});
                                }
                            }, 700);                         

                        });

                    });
                };
                
                if (jQuery('.masonry').length) {

                    var listing_id = jQuery('.masonry').data('listing-page-id');
                    jQuery('.project-meta').live('click', function() {

                        data = {
                            action: 'ajax_load_single_gall',
                            listing_page_id: listing_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            
                            setTimeout(function(){
                                 var tp_back = jQuery('<div class="tp-back" id="close">Back</div>');

                            var a = jQuery('<a href="" data-type="page_id" data-id="' + response + '"></a>');

                            if (!jQuery('.page-header .tp-back').length) {
                                jQuery('.page-header').append(tp_back);
                                tp_back.css({'display': 'block'});
                                jQuery('#close').append(a);
                                a.css({'display': 'block', 'height': '100%', 'width': '100%', 'position': 'absolute', 'left': '0', 'top': '0'});
                            }
                            },1000);
                           

                        });

                    });
                };
                
                var selectors = [
                    "iframe[src^='http://player.vimeo.com']",
                    "iframe[src^='http://www.youtube.com']",
                    "object",
                    "embed"
                ], allVideos = jQuery('#wrapper').find(selectors.join(','));

                if (allVideos.length) {
                    init_modules.adjust_videos();
                }

                jQuery('#wrapper a').each(function() {

                    var this_menu_link = jQuery(this).attr('href');
                    if ((this_menu_link != "#") && (this_menu_link != undefined)) {
                        this_menu_link = this_menu_link.split('/?');
                        if (this_menu_link['1'] != undefined) {
                            this_menu_link = this_menu_link['1'];
                            var data_type = this_menu_link.split('=');
                            var data_id = data_type['1'];

                            if ((data_type['0'] == '?post_type') || (data_type['0'] == 'post_type')) {
                                data_id = data_type['2'];
                                data_type = data_type['1'];
                                data_type = data_type.split('&');
                                data_type = data_type['0'];

                            }
                            else {
                                data_type = data_type['0'];
                                //	data_type=data_type.slice(1);				
                            }
                            if ((data_type == 'folio') && (data_id == undefined)) {
                                data_id = 'archive'
                                jQuery(this).attr('data-load', true);
                            }

                            jQuery(this).attr('data-type', data_type);
                            jQuery(this).attr('data-id', data_id);

                            if (data_id == undefined) {
                                jQuery(this).attr('data-load', false);
                            }

                        }
                        else {
                            jQuery(this).attr('data-load', false);
                        }

                    }
                    else {
                        jQuery(this).attr('data-load', false);
                    }

                });

                if (jQuery('.wp-pagenavi').length) {
                    jQuery('.wp-pagenavi a').each(function() {

                        var paged = jQuery(this).attr('href');
                        paged = paged.split('=');
                        paged = paged['1'];
                        jQuery(this).attr('data-id', dataId);
                        jQuery(this).attr('data-paged', paged);
                        jQuery(this).attr('data-type', 'page_id');
                        jQuery(this).attr('data-load', true);

                    });
                }

                jQuery('body').css({
                    'overflow': 'visible'
                });

            },
            comments: function() {
                var commentform = jQuery('#commentform'); // find the comment form
                commentform.prepend('<div id="comment-status" ></div>'); // add info panel before the form to provide feedback or errors
                var statusdiv = jQuery('#comment-status'); // define the infopanel

                commentform.submit(function() {
                    //serialize and store form data in a variable
                    var formdata = commentform.serialize();
                    //Add a status message
                    statusdiv.html('<p>Processing...</p>');
                    //Extract action URL from commentform
                    var formurl = commentform.attr('action');
                    //Post Form with data
                    jQuery.ajax({
                        type: 'post',
                        url: formurl,
                        data: formdata,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            statusdiv.html('<p class="ajax-error" >You might have left one of the fields blank, or be posting too quickly</p>');
                        },
                        success: function(data, textStatus) {
                            if (data == "success")
                                statusdiv.html('<p class="ajax-success" >Thanks for your comment. We appreciate your response.</p>');
                            else
                                statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
                            commentform.find('textarea[name=comment]').val('');
                        }
                    });
                    return false;

                });

            },
            search: function() {

                jQuery('.submit-search').click(function() {

                    var content = jQuery('input[name="s"]').val();
                    data = {
                        action: 'ajax_load_search',
                        data_content: content

                    };
                    jQuery('#content>div.ajax').fadeOut(700);
                    jQuery('#content>div.ajax').remove();
                    jQuery('#wrapper').append('<div class="folio-loader"></div>');
                    jQuery('.nicescroll-rails').remove();
                    jQuery.post(ajaxurl, data, function(response) {

                        init_modules.add_content(response, content);

                    });

                    return false;
                });

            },
            google_map: function() {
                var latitude = jQuery('.google_map').data('latitude');
                var longitude = jQuery('.google_map').data('longitude');
                var inique_id = jQuery('.google_map').data('inique_id');
                var zoom = jQuery('.google_map').data('zoom');
                var maptype = jQuery('.google_map').data('maptype');
                var content = jQuery('.google_map').data('content');
                var enable_marker = jQuery('.google_map').data('enable_marker');
                var enable_popup = jQuery('.google_map').data('enable_popup');
                var enable_scrollwheel = jQuery('.google_map').data('enable_scrollwheel');
                var js_controls = jQuery('.google_map').data('js_controls');
                var marker_is_draggable = jQuery('.google_map').data('marker_is_draggable');

                jQuery(function() {
                    gmt_init_map(latitude, longitude, 'google_map_' + inique_id, zoom, maptype, content, enable_marker, enable_popup, enable_scrollwheel, js_controls, marker_is_draggable);
                });
            },
            flexslider: function() {
                var $flex = jQuery('.flexslider');

                if ($flex.length) {
                    var animation = $flex.data('animation');
                    var controlnav = $flex.data('controlnav');
                    var slideshow_speed = $flex.data('slideshow_speed');
                    var animation_speed = $flex.data('animation_speed');
                    var init_delay = $flex.data('init_delay');
                    var directionNav = $flex.data('directionNav');
                    var direction = $flex.data('direction');
                    var slideshow = $flex.data('slideshow');

                    $flex.flexslider({
                        animation: animation,
                        slideshow: slideshow,
                        controlNav: controlnav,
                        slideshowSpeed: slideshow_speed,
                        animationSpeed: animation_speed,
                        initDelay: init_delay,
                        directionNav: directionNav,
                        direction: direction
                    });

                }
            },
            media: function() {
                var $player = jQuery('audio, video');

                $player.mediaelementplayer({
                    audioWidth: '100%',
                    audioHeight: '30px',
                    videoWidth: '100%',
                    videoHeight: '100%'
                });


            },
            adjust_videos: function() {
                function adjustVideos() {

                    var $videos = jQuery('.video-container');

                    $videos.each(function() {

                        var $this = jQuery(this),
                                playerWidth = $this.parent().actual('width'),
                                playerHeight = playerWidth / $this.data('aspectRatio');

                        $this.css({
                            'height': playerHeight,
                            'width': playerWidth
                        });

                    });

                }

                var selectors = [
                    "iframe[src^='http://player.vimeo.com']",
                    "iframe[src^='http://www.youtube.com']",
                    "object",
                    "embed"
                ], $allVideos = jQuery('#wrapper').find(selectors.join(','));

                $allVideos.each(function() {

                    var $this = jQuery(this),
                            videoHeight = $this.attr('height') || $this.actual('width'),
                            videoWidth = $this.attr('width') || $this.actual('width');

                    $this.css({
                        'height': '100%',
                        'width': '100%'
                    }).removeAttr('height').removeAttr('width')
                            .wrap('<div class="video-container"></div>').parent('.video-container').css({
                        'height': videoHeight,
                        'width': videoWidth
                    }).data('aspectRatio', videoWidth / videoHeight);

                    adjustVideos();
                });


                jQuery(window).on('resize', function() {
                    var timer = window.setTimeout(function() {
                        window.clearTimeout(timer);
                        adjustVideos();
                    }, 30);
                });
            },
            contact_form: function() {
                var $form = jQuery('.contact-form');

                $form.submit(function() {

                    $response = jQuery(this).next(jQuery(".contact_form_responce"));
                    $response.find("ul").html("");
                    $response.find("ul").removeClass();

                    var data = {
                        action: "contact_form_request",
                        values: jQuery(this).serialize()
                    };

                    var form_self = this;
                    //send data to server
                    jQuery.post(ajaxurl, data, function(response) {

                        response = jQuery.parseJSON(response);
                        jQuery(form_self).find(".wrong-data").removeClass("wrong-data");

                        if (response.is_errors) {

                            jQuery($response).find("ul").addClass("error type-2");
                            jQuery.each(response.info, function(input_name, input_label) {
                                jQuery(form_self).find("[name=" + input_name + "]").addClass("wrong-data");
                                jQuery($response).find("ul").append('<li>' + lang_enter_correctly + ' "' + input_label + '"!</li>');
                            });

                            $response.show(450);

                        } else {

                            jQuery($response).find("ul").addClass("success type-2");

                            if (response.info == 'succsess') {
                                jQuery($response).find("ul").append('<li>' + lang_sended_succsessfully + '!</li>');
                                $response.show(450).delay(1800).hide(400);
                            }

                            if (response.info == 'server_fail') {
                                jQuery($response).find("ul").append('<li>' + lang_server_failed + '!</li>');
                            }

                            jQuery(form_self).find("[type=text],[type=email],textarea").val("");

                        }

                        // Scroll to bottom of the form to show respond message
                        var bottomPosition = jQuery(form_self).offset().top + jQuery(form_self).outerHeight() - jQuery(window).height();

                        if (jQuery(document).scrollTop() < bottomPosition) {
                            jQuery('html, body').animate({
                                scrollTop: bottomPosition
                            });
                        }

                        update_capcha(form_self, response.hash);
                    });
                    return false;
                });
                function update_capcha(form_object, hash) {
                    jQuery(form_object).find("[name=verify]").val("");
                    jQuery(form_object).find("[name=verify_code]").val(hash);
                    jQuery(form_object).find(".contact_form_capcha").attr('src', capcha_image_url + '?hash=' + hash);
                }

            },
            testimonials: function() {
                function swipeFunc(e, dir) {
                    var $quotes = jQuery(e.currentTarget);
                    if ($quotes.data('slideCount') > 1) {
                        $quotes.data('dir', '');
                        if (dir === 'left') {
                            $quotes.cycle('next');
                        }
                        if (dir === 'right') {
                            $quotes.data('dir', 'prev');
                            $quotes.cycle('prev');
                        }
                    }
                }


                var $quotes = jQuery('.quotes');

                $quotes.each(function(i) {

                    var $this = jQuery(this);

                    $this.css('height', $this.children('li:first').height())
                            .after('<div class="quotes-nav"><a class="prevBtn quotes-nav-prev-' + i + '">Prev</a><a class="nextBtn quotes-nav-next-' + i + '">Next</a></div>')
                            .cycle({
                        before: function(curr, next, opts) {
                            var $this = jQuery(this);
                            $this.parent().stop().animate({
                                height: $this.height()
                            }, opts.speed);
                        },
                        containerResize: false,
                        easing: 'easeInOutExpo',
                        fit: true,
                        next: '.quotes-nav-next-' + i,
                        pause: true,
                        prev: '.quotes-nav-prev-' + i,
                        slideResize: true,
                        speed: $this.data('speed'),
                        timeout: $this.data('timeout'),
                        width: '100%'
                    }).data('slideCount', $quotes.children('li').length);

                    // Pause on Nav Hover
                    jQuery('.quotes-nav a').on('mouseenter', function() {
                        jQuery(this).parent().prev().cycle('pause');
                    }).on('mouseleave', function() {
                        jQuery(this).parent().prev().cycle('resume');
                    });

                    // Hide Navigation if only a Single Slide
                    if ($quotes.data('slideCount') <= 1) {
                        $quotes.next('.quotes-nav').hide();
                    }

                    // Resize
                    jQuery(window).on('resize', function() {
                        $this.css('height', $this.find('li:visible').height());
                    });

                    // Include Swipe
                    if (Modernizr.touch) {

                        $quotes.swipe({
                            swipeLeft: swipeFunc,
                            swipeRight: swipeFunc,
                            allowPageScroll: 'auto'
                        });
                    }

                });


            },
            masonry: function() {


            },
            sudoslider: function() {
                
                jQuery('.sudo').sudoSlider({
                    prevNext: true,
                    continuous: true,
                    autowidth: false,
                    autoheight: false,
                    clickableAni: false,
                    ease: 'swing',
                    speed: 800
                });
                var closeBtn = jQuery('.closeOverlayBtn');
                var actSlider = jQuery('.activeSlider');
               
                function animOutSlider() {
                    if (actSlider.is('.active')) {
                        
                        jQuery('#header').css({
                            zIndex: 10
                        });
                        
                        actSlider.animate({
                            top: '100%',
                           opacity: 0
                        }, 600, function() {
                            jQuery(this).removeClass('active');
                             actSlider.css({ visibility:'hidden'});
                        });
                    }
                }
                closeBtn.click(function() {
                    animOutSlider();
                });

            },
            toggles: function() {

                var $box = jQuery('.acc-box');

                $box.each(function() {

                    var $trigger = jQuery('.acc-trigger', this);
                    $trigger.first().addClass('active').next().show();

                    $trigger.on('click', function() {
                        var $this = jQuery(this);
                        if ($this.data('mode') === 'toggle') {
                            $this.toggleClass('active').next().stop(true, true).slideToggle(300);
                        } else if ($this.next().is(':hidden')) {
                            $trigger.removeClass('active').next().slideUp(300);
                            $this.toggleClass('active').next().slideDown(300);
                        }
                        return false;
                    });

                });

            },
            tabs: function() {

                var $contentTabs = jQuery('.content-tabs');
                $contentTabs.each(function(idx, elem) {

                    var $tabsNav = jQuery('.tabs-nav', jQuery(elem)),
                            $tabsNavLis = $tabsNav.children('li'),
                            $tabsContainer = jQuery('.tabs-container', jQuery(elem));

                    $tabsNav.each(function() {
                        var $this = jQuery(this);
                        $this.next().children('.tab-content').stop(true, true).hide().first().show();
                        $this.children('li').first().addClass('active').stop(true, true).show();
                    });

                    $tabsNavLis.on('click', function() {
                        var $this = jQuery(this);
                        $this.siblings().removeClass('active').end().addClass('active');
                        $this.parent().next().children('.tab-content').stop(true, true)
                                .hide()
                                .siblings($this.find('a').attr('href'))
                                .fadeIn(250, function() {
                            $this = jQuery(this);
                            $this.parent('.tabs-container').animate({
                                height: $this.outerHeight(true)
                            }, 200);
                        });
                        return false;
                    }).children(window.location.hash ? 'a[href=' + window.location.hash + ']' : 'a:first').trigger('click');

                    function adjustTabs() {

                        $tabsContainer.each(function() {
                            var $this = jQuery(this);
                            $this.height($this.children('.tab-content:visible').outerHeight());
                        });

                    }

                    // Init
                    adjustTabs();

                    // Window resize
                    jQuery(window).on('resize', function() {

                        var timer = window.setTimeout(function() {
                            window.clearTimeout(timer);
                            adjustTabs();
                        }, 30);

                    });

                });

            },
            homeGrid: function() {

                if (jQuery('div.scroll-box').length) {
                  //  init_modules.scrollBox();
                     (enable_scrolling_bar=='true') ? init_modules.scrollBox_bar() : init_modules.scrollBox();
                };

                jQuery('#content').children().attr('class', 'ajax');
                var $scrollBox = jQuery('.scroll-box');
                $scrollBox.resizeGrid();

                if (jQuery('.scroll-box-nav').length) {
                    var $scrollNav = jQuery('.scroll-box-nav');
                    if ($scrollNav.has('li')) {
                        $scrollNav.children('li:first').addClass('active');
                    }
                }
            },
            postSlider: function() {

                function swipeFunc(e, dir) {
                    var $postslider = $(e.currentTarget);
                    // Enable swipes if more than one slide
                    if ($postslider.data('slideCount') > 1) {
                        $postslider.data('dir', '');
                        if (dir === 'left') {
                            $postslider.cycle('next');
                        }
                        if (dir === 'right') {
                            $postslider.data('dir', 'prev');
                            $postslider.cycle('prev');
                        }
                    }
                }


                var $postslider = jQuery('.image-post-slider > ul');

                $postslider.each(function(i) {

                    var $this = jQuery(this);

                    $this.css('height', $this.children('li:first').height())
                            .after('<div class="post-slider-nav"><a class="prevBtn post-nav-prev-' + i + '">Prev</a><a class="nextBtn post-nav-next-' + i + '">Next</a></div>')
                            .cycle({
                        before: function(curr, next, opts) {
                            var $this = jQuery(this);
                            $this.parent().stop().animate({
                                height: $this.height()
                            }, opts.speed);
                        },
                        containerResize: false,
                        easing: 'easeInOutExpo',
                        fx: 'fixedScrollHorz',
                        fit: true,
                        next: '.post-nav-next-' + i,
                        pause: true,
                        prev: '.post-nav-prev-' + i,
                        slideResize: true,
                        speed: 600,
                        timeout: 5000,
                        width: '100%'
                    }).data('slideCount', $postslider.children('li').length);
                });

                // Pause on Nav Hover
                jQuery('.post-slider-nav a').on('mouseenter', function() {
                    jQuery(this).parent().prev().cycle('pause');
                }).on('mouseleave', function() {
                    jQuery(this).parent().prev().cycle('resume');
                });

                // Hide navigation if only a single slide
                if ($postslider.data('slideCount') <= 1) {
                    $postslider.next('.post-slider-nav').hide();
                }



                // Resize
                jQuery(window).on('resize', function() {
                    $postslider.css('height', $postslider.find('li:visible').height());
                });

                // Include Swipe
                if (Modernizr.touch) {

                    $postslider.swipe({
                        swipeLeft: swipeFunc,
                        swipeRight: swipeFunc,
                        allowPageScroll: 'auto'
                    });

                }


            },
            cycleSlider: function() {
                // Fixed scrollHorz effect

                jQuery('.cycle-slider').css({
                    'min-height': '480px'
                });

                jQuery.fn.cycle.transitions.fixedScrollHorz = function($cont, $slides, opts) {

                    jQuery('.cycle-slider-nav a').on('click', function(e) {
                        $cont.data('dir', '')
                        if (e.target.className.indexOf('prev') > -1)
                            $cont.data('dir', 'prev');
                    });
                    $cont.css('overflow', 'hidden');
                    opts.before.push(jQuery.fn.cycle.commonReset);
                    var w = $cont.width();
                    opts.animIn.left = 0;
                    opts.animOut.left = 0 - w;
                    opts.cssFirst.left = 0;
                    opts.cssBefore.left = w;
                    opts.cssBefore.top = 0;

                    if ($cont.data('dir') === 'prev') {
                        opts.cssBefore.left = -w;
                        opts.animOut.left = w;
                    }

                };

                function swipeFunc(e, dir) {

                    var $cycleslider = $(e.currentTarget);

                    // Enable swipes if more than one slide
                    if ($cycleslider.data('slideCount') > 1) {
                        $cycleslider.data('dir', '');
                        if (dir === 'left') {
                            $cycleslider.cycle('next');
                        }
                        if (dir === 'right') {
                            $cycleslider.data('dir', 'prev');
                            $cycleslider.cycle('prev');
                        }
                    }
                }
                if (jQuery('.cycle-slider').length) {
                    //jQuery('.page-header').next().children().first().append('<div class="folio-loader"></div>');
                    jQuery('.cycle-slider').append('<div class="folio-loader"></div>');
                    jQuery('.folio-loader').css({
                        'top': '50%'
                    });
                 
                }

                setTimeout(function() {
                    jQuery('.folio-loader').remove();
                }, 5000);

                var $cycleslider = jQuery('.cycle-slider > ul');

                $cycleslider.each(function(i) {

                    var $this = jQuery(this);

                    $this.css('height', $this.children('li:first').height())
                            .after('<div class="cycle-slider-nav"><a href="#" class="prevBtn cycle-nav-prev-' + i + '">Prev</a><a href="" class="nextBtn cycle-nav-next-' + i + '">Next</a></div>')
                            .cycle({
                        before: function(curr, next, opts) {
                            var $this = jQuery(this);
                            $this.parent().stop().animate({
                                height: $this.height()
                            }, opts.speed);
                        },
                        containerResize: false,
                        easing: 'easeInOutExpo',
                        fx: 'fixedScrollHorz',
                        fit: true,
                        next: '.cycle-nav-next-' + i,
                        pause: true,
                        prev: '.cycle-nav-prev-' + i,
                        slideResize: true,
                        speed: 600,
                        timeout: 5000,
                        width: '100%'
                    }).data('slideCount', $cycleslider.children('li').length);
                });

                // Pause on Nav Hover
                jQuery('.cycle-slider-nav a').on('mouseenter', function() {
                    jQuery(this).parent().prev().cycle('pause');
                }).on('mouseleave', function() {
                    jQuery(this).parent().prev().cycle('resume');
                })

                // Hide navigation if only a single slide
                if ($cycleslider.data('slideCount') <= 1) {
                    $cycleslider.next('.cycle-slider-nav').hide();
                }

                // Resize
                jQuery(window).on('resize', function() {
                    $cycleslider.css('height', $cycleslider.find('li:visible').height());
                });

                // Include Swipe
                if (Modernizr.touch) {

                    $cycleslider.swipe({
                        swipeLeft: swipeFunc,
                        swipeRight: swipeFunc,
                        allowPageScroll: 'auto'
                    });

                }



            },
            epicslider: function() {
                jQuery('#content').children().attr('class', 'ajax');
                (jQuery('.epicSlider').length ? true : false) ? jQuery('body').addClass('epic') : jQuery('body').removeClass('epic');
                jQuery('.epicSlider').epicSlider({
                    loop: true, //Boolean: whether slideshow should loop or not	
                    slideShow: true, //Boolean: use slideshow or not
                    autoPlay: true, //Boolean: autoplay uplon load or not
                    slideShowInterval: 5000, //Integer: slideshow cycling speed, in milliseconds
                    transitionSpeed: 600, //Integer: transitions speed, in milliseconds
                    startSlide: 0, //Integer: starts at 0
                    shuffleSlides: false, //Boolean: shuffle slides or not
                    easing: 'swing', //String: easing method - see http://jqueryui.com/demos/effect/easing.html
                    fx: 'leftToRight', //String: none, fade, leftToRight, topToBottom 
                    fxmobile: 'leftToRight', //String: mobile effect -  none, fade, leftToRight, topToBottom 
                    pattern: true				//Boolean: add pattern or not
                });

            },
            stapel: function() {

                var tp_back = jQuery('<div class="tp-back" id="close">Back</div>');           
                var desc = jQuery('.description');
                var item_desc = jQuery('.item_description');

                jQuery('.page-header').append(tp_back);

                var $grid = jQuery('#tp-grid'),
                        $name = jQuery('#name'),
                        $close = jQuery('#close'),
                        $loader = jQuery('<div class="folio-loader"></div>').insertAfter($grid),
                        stapel = $grid.stapel({
                    delay: 50,
                    onLoad: function() {
                        $loader.remove();
                    },
                    onBeforeOpen: function(pileName) {
                        $name.html(pileName);
                        desc.empty(); 
                        var temp;
                        item_desc.each(function(){                           
                            if ((jQuery(this).data('title') == pileName)&& (temp != pileName)){ 
                                temp = pileName;
                                desc.append(jQuery(this).data('exerpt'));                               
                            }
                        });
                    },
                    onAfterOpen: function(pileName) {
                        $close.show();
                    }
                });
                $grid.css({'height':'200px'});
                $close.on('click', function() {
                    $close.hide();
                    $name.empty();
                    stapel.closePile();
                });                
               
                tp_back.on('click', function(){
                    desc.empty();
                });

            },
            gallery: function() {


                /* Standart Pagination */

                function GetPagedCategories() {

                    if (jQuery(this).attr('active-load') != 'true') {

                        if (jQuery(this).parent().attr('id') == 'gallery-filter') {
                            jQuery('#gallery-filter li').each(function() {
                                jQuery(this).attr('active-load', false);
                            });
                            jQuery(this).attr('active-load', true);
                        }

                        jQuery('#content').append('<div class="folio-loader"></div>');

                        var cat_id = jQuery(this).children().data('categories'),
                                post_per_page = jQuery(this).children().data('post-per-page'),
                                page_number = jQuery(this).children().data('page-namber');
                        data = {
                            action: 'ajax_load_gall_bycat',
                            cat_id: cat_id,
                            post_per_page: post_per_page,
                            page: page_number,
                            layout: layout
                        }

                        jQuery.post(ajaxurl, data, function(response) {

                            jQuery('.folio-loader').remove();

                            var uniq_id = jQuery(response).find('#uniq_id').attr('data-uniq-id');
                            if (uniq_id != jQuery('#gallery-items').attr('uniq-id')) {

                                jQuery('#gallery-items').children().remove();
                                jQuery('#gallery-items').append(jQuery(response).html());
                                jQuery('#gallery-items').hide().fadeIn(1000);
                            }

                            jQuery('#gallery-items').attr('uniq-id', uniq_id);


                            jQuery('.single-image.plus-icon, .single-image.link-icon').fancybox({
                                openEffect: 'fade',
                                closeEffect: 'fade'
                            }).each(function() {
                                jQuery(this).append('<span class="curtain"></span>');
                            });

                            jQuery('#wrapper a').each(function() {

                                var this_menu_link = jQuery(this).attr('href');
                                if ((this_menu_link != "#") && (this_menu_link != undefined)) {
                                    this_menu_link = this_menu_link.split('/?');
                                    if (this_menu_link['1'] != undefined) {
                                        this_menu_link = this_menu_link['1'];
                                        var data_type = this_menu_link.split('=');
                                        var data_id = data_type['1'];

                                        if ((data_type['0'] == '?post_type') || (data_type['0'] == 'post_type')) {
                                            data_id = data_type['2'];
                                            data_type = data_type['1'];
                                            data_type = data_type.split('&');
                                            data_type = data_type['0'];

                                        }
                                        else {
                                            data_type = data_type['0'];
                                            //	data_type=data_type.slice(1);				
                                        }
                                        if ((data_type == 'folio') && (data_id == undefined)) {
                                            data_id = 'archive'
                                            jQuery(this).attr('data-load', true);
                                        }

                                        jQuery(this).attr('data-type', data_type);
                                        jQuery(this).attr('data-id', data_id);



                                        if (data_id == undefined) {
                                            jQuery(this).attr('data-load', false);
                                        }

                                    }
                                    else {
                                        jQuery(this).attr('data-load', false);
                                    }

                                }
                                else {
                                    jQuery(this).attr('data-load', false);
                                }

                            });

                        });
                        return false;
                    }
                }

                var $cont = jQuery('#gallery-items'),
                        pagination = jQuery('#gallery-items').data('pagination'),
                        filterLink = jQuery('#gallery-filter li'),
                        naviLink = jQuery('.wp-pagenavi.gall li'),
                        layout = jQuery('#gallery-items').data('layout'),
                        $itemsFilter = jQuery('#gallery-filter');



                if (pagination == 2) {

                    filterLink.live('click', GetPagedCategories);
                    naviLink.live('click', GetPagedCategories);
                }

                /* end Standard Pagination */
                function resizeFilter() {
                    var $windowWidth = jQuery(window).width();
                    if ($windowWidth < 767) {
                        jQuery.fn.slideMarginLeft;
                    }
                }
                var $cont = jQuery('#gallery-items'),
                        $itemsFilter = jQuery('#gallery-filter'),
                        mouseOver;

                jQuery.fn.slideVertShow = function(speed) {
                    var that = jQuery(this);
                    that.animate({
                        paddingTop: 'show',
                        paddingBottom: 'show',
                        height: 'show'
                    }, speed);
                    setTimeout(function() {
                        $itemsFilter.animate({
                            width: 140
                        }, 300);
                    }, 10);
                };

                jQuery.fn.slideVertHide = function(speed) {
                    var that = jQuery(this);
                    that.not('.active').animate({
                        paddingTop: 'hide',
                        paddingBottom: 'hide',
                        height: 'hide'
                    }, speed);
                    if (that.hasClass('active')) {
                        var $filter = that.filter('.active');
                        setTimeout(function() {
                            $itemsFilter
                                    .css({
                                marginLeft: -($filter.children('a').outerWidth() + 30) / 2
                            })
                                    .animate({
                                width: $filter.children('a').outerWidth() + 30
                            }, 300);
                        }, 10);
                    }
                };

                jQuery.fn.slideMarginLeft = function() {
                    $itemsFilter.css({
                        marginLeft: $itemsFilter.width() / 2
                    });
                };

                // Copy categories to item classes
                jQuery('article', $cont).each(function(i) {
                    var $this = jQuery(this);
                    $this.addClass($this.attr('data-categories'));
                });

                // Run Isotope when all images are fully loaded
                if (pagination == 0) {
                    $cont.isotope({
                        itemSelector: 'article',
                        layoutMode: 'fitRows'
                    });
                }

                jQuery(window).on('resize', function() {
                    resizeFilter();
                });

                $itemsFilter.find('li').first().addClass('active').end().stop(true, true).slideVertHide(300);

                $itemsFilter.on('mouseenter', function() {
                    var $this = jQuery(this);
                    clearTimeout(mouseOver);

                    // Wait 100ms before animating to prevent unnecessary flickering
                    mouseOver = setTimeout(function() {
                        $itemsFilter.find('li').stop(true, true).slideVertShow(300);
                    }, 200);

                }).on('mouseleave', function() {
                    clearTimeout(mouseOver);
                    jQuery(this).find('li').stop(true, true).slideVertHide(300);
                });

                // Filter projects
                $itemsFilter.on('click', 'li', function(e) {
                    var $this = jQuery(this).children('a'),
                            currentOption = $this.attr('data-categories');

                    $itemsFilter.find('li').removeClass('active');
                    $this.parent().addClass('active');

                    if (currentOption) {
                        if (currentOption !== '*') {
                            currentOption = currentOption.replace(currentOption, '.' + currentOption);
                        }
                        if (pagination == 0) {
                            $cont.isotope({
                                filter: currentOption
                            }, function() {
                                if (currentOption == '*') {
                                    jQuery('.single-image', $cont).attr('rel', 'gallery');
                                } else {
                                    jQuery(currentOption, $cont).find('.single-image').attr('rel', currentOption.substring(1));
                                }
                            });
                        }
                    }
                    e.preventDefault();
                });
            }

        };

        return {
            init_menu: function() {

                var menu_link = jQuery('#navigation a');
                var content_link = jQuery('#wrapper a');

                function initLink(link) {

                    link.each(function() {

                        var this_menu_link = jQuery(this).attr('href');

                        if ((this_menu_link != "#") && (this_menu_link != undefined)) {
                            this_menu_link = this_menu_link.split('/?');
                            if (this_menu_link['1'] != undefined) {
                                this_menu_link = this_menu_link['1'];
                                var data_type = this_menu_link.split('=');
                                var data_id = data_type['1'];
                                if ((data_type['0'] == '?post_type') || (data_type['0'] == 'post_type')) {
                                    data_id = data_type['2'];
                                    data_type = data_type['1'];
                                    data_type = data_type.split('&');
                                    data_type = data_type['0'];
                                }
                                else {
                                    data_type = data_type['0'];

                                }
                                if ((data_type == 'folio') && (data_id == undefined)) {
                                    data_id = 'archive'
                                    jQuery(this).attr('data-load', true);
                                }

                                jQuery(this).attr('data-type', data_type);
                                jQuery(this).attr('data-id', data_id);

                                if (data_id == undefined) {
                                    jQuery(this).attr('data-load', false);
                                }

                            }
                            else {
                                jQuery(this).attr('data-load', false);
                            }

                        }
                        else {
                            jQuery(this).attr('data-load', false);
                        }

                    });

                }

                initLink(menu_link);
                initLink(content_link);
                jQuery('.flex-direction-nav').live('hover', function() {
                    jQuery('.flex-direction-nav a').each(function() {
                        jQuery(this).attr('data-load', false);
                    });
                });


                if (jQuery('.wp-pagenavi').length) {
                    var body_class = jQuery('body').attr('class');
                    body_class = body_class.split(' ');
                    var page_id;
                    for (var i = 0; i < body_class.length; i++) {
                        if (body_class[i].indexOf('page-id-') != -1) {
                            page_id = body_class[i];
                            page_id = page_id.split('-');
                            page_id = page_id['2'];
                        }
                    }

                    jQuery('.wp-pagenavi a').each(function() {
                        var paged = jQuery(this).attr('href');
                        paged = paged.split('=');
                        paged = paged['1'];
                        jQuery(this).attr('data-id', page_id);
                        jQuery(this).attr('data-paged', paged);
                        jQuery(this).attr('data-type', 'page_id');
                        jQuery(this).attr('data-load', true);

                    });
                }

                function ajaxLoad() {

                    if (jQuery(this).parent().attr('class') != undefined) {
                        if (jQuery(this).parent().attr('class').indexOf('menu-item') != -1) {

                            jQuery('.menu-item').each(function() {
                                jQuery(this).removeClass('current-menu-item');
                                jQuery(this).removeClass('current_page_item');
                                jQuery(this).removeClass('current-menu-ancestor');
                                jQuery(this).removeClass('current-menu-parent');
                                jQuery(this).removeClass('current_page_parent');
                                jQuery(this).removeClass('current_page_ancestor');

                            });
                            jQuery(this).parent().addClass('current-menu-item');
                            if (jQuery(this).parent().parent().attr('class').indexOf('sub-menu') != -1) {
                                jQuery(this).parent().parent().parent().addClass('current-menu-item');
                            }
                        }

                    }

                    if ((jQuery(this).attr('data-load') != 'false') && (jQuery(this).attr('data-categories') == undefined)) {

                        var href = jQuery(this).attr('href');
                        href = href.split('/?');
                        var url = site_url;
                        if (enable_hash == 'true') {
                            url = site_url + '/?' + href['1'];
                        }

                        function getInternetExplorerVersion() {
                            var rv = -1;
                            if (navigator.appName == 'Microsoft Internet Explorer') {
                                var ua = navigator.userAgent;
                                var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
                                if (re.exec(ua) != null)
                                    rv = parseFloat(RegExp.$1);
                            }
                            return rv;
                        }
                        var ie = getInternetExplorerVersion();

                        function changeHash(id) {
                            try {
                                history.replaceState(null, null, '' + id);
                            }
                            catch (e) {
                                location.hash = '#id_' + id;
                            }
                        }


                        if ((ie > 8.0) || (ie == '-1')) {
                            changeHash(url);
                        }

                        var dataType = jQuery(this).attr('data-type');
                        var dataId = jQuery(this).attr('data-id');
                        var datapaged = jQuery(this).attr('data-paged');
                        var data;
                        if (datapaged != undefined) {
                            data = {
                                datapaged: datapaged,
                                action: 'ajax_load_content',
                                data_type: dataType,
                                data_id: dataId
                            };
                        }
                        else {
                            data = {
                                action: 'ajax_load_content',
                                data_type: dataType,
                                data_id: dataId
                            };
                        }                 
                       

                        jQuery('#content>div.ajax').fadeOut(700);
                        jQuery('#content>div.ajax').remove();
                        jQuery('#wrapper').append('<div class="folio-loader"></div>');
                        jQuery('.nicescroll-rails').remove();

                        jQuery.post(ajaxurl, data, function(response) {
                            init_modules.add_content(response, dataId);
                        });


                        return false;
                    }

                }
                ;
                menu_link.live('click', ajaxLoad);

                content_link.live('click', ajaxLoad);

            }
        }

    }

    new THEMEMAKERS_AJAX().init_menu();


})(Modernizr)

