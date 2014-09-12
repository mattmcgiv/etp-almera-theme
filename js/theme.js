
(function($, win, Modernizr, doc) {

    //	"use strict";

    // DOM READY
 
    if (jQuery('.scroll-box').length) {
        jQuery('.gr-caption').live('click', function() {

            var listing_id = jQuery('.scroll-box').data('listing-page-id');
            data = {
                action: 'ajax_load_single_gall',
                listing_page_id: listing_id
            };
            jQuery.post(ajaxurl, data, function(response) {
                setTimeout(function() {
                    var tp_back = jQuery('<div class="tp-back" id="close">Back</div>');
                    var a = jQuery('<a href="" data-type="page_id" data-id="' + response + '"></a>');

                    jQuery('.page-header').append(tp_back);
                    tp_back.css({'display': 'block'});
                    jQuery('#close').append(a);
                    a.css({'display': 'block', 'height': '100%', 'width': '100%', 'position': 'absolute', 'left': '0', 'top': '0'});
                }, 1000);

            });

        });
    };
    if (jQuery('.masonry').length){
             var listing_id=jQuery('.masonry').data('listing-page-id');
            jQuery('.project-meta').live('click', function(){
            
            data = {        
                    action: 'ajax_load_single_gall',
                    listing_page_id: listing_id                    
                   };
            jQuery.post(ajaxurl, data, function(response) {
                           setTimeout(function(){
                           var tp_back = jQuery('<div class="tp-back" id="close">Back</div>');                             
                           var a=jQuery('<a href="" data-type="page_id" data-id="'+ response +'"></a>');
                           
                                jQuery('.page-header').append(tp_back);
                                tp_back.css({'display': 'block'});
                                jQuery('#close').append(a);
                                a.css({'display':'block', 'height':'100%', 'width':'100%', 'position':'absolute', 'left':'0', 'top':'0'});    
                           },1000);                         
                            
                     });   
                
            });
        };


        /* ---------------------------------------------------- */
        /* Resize Grid                                          */
        /* ---------------------------------------------------- */

        (function() {

            if ($('.scroll-box').length) {

                $('.scroll-box').resizeGrid();

                if ($('.scroll-box-nav').length) {
                    var $scrollNav = $('.scroll-box-nav');
                    if ($scrollNav.has('li')) {
                        $scrollNav.children('li:first').addClass('active');
                    }
                }

            }

        }());

        /* end Resize Grid */



/*   ------------------ New scroll bar ---------------------------  */

    function scrollBox_bar() {

       

        var scroller = jQuery('<div class="scroller"></div>');
        var scrollerBar = jQuery('<div class="scroller_bar"></div>');
        var isMobile = false;
        if (jQuery('.scroll-box').length) {
            jQuery('.scroll-box').append(scrollerBar);
            scrollerBar.append(scroller);
        }

        if (/android|iphone|ipad|ipod|blackberry/i.test(navigator.userAgent.toLowerCase())){
           scrollerBar.css({'display':'none'});
           isMobile = true;
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
        }).on('mouseup', function(event) {
            drop(event);
        }).on('resize', function(){
            if(isMobile){                
                setPosition(0);
            }
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

            var currentImg = 0,
                    maxImages = 2,
                    win = jQuery(window),
                    speed = 500,
                    grid = jQuery('div.grid'),
                    imgs = jQuery('div.scroll-box');
            //Init touch swipe
            imgs.swipe({
                triggerOnTouchEnd: true,
                allowPageScroll: "vertical"
            });

            function previousImage()
            {
                currentImg = Math.max(currentImg - 1, 0);
                scrollImages(win.width() * currentImg, speed);
            }

            function nextImage()
            {
                currentImg = Math.min(currentImg + 1, grid.width() / win.width() - 1);
                scrollImages(win.width() * currentImg, speed);
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

    };

/* --------------------- End new scroll bar ---------------------------  */

    function scrollBox() {
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
    };

    $(function() {
        
      
        
        /* Facebook comments*/
        if (jQuery('.fb-comments').length) {
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }
      
        
        /* end facebook comments*/

        /* ---------------------------------------------------- */
        /*	Other Functions										*/
        /* ---------------------------------------------------- */

        (function() {

            ($('.epicSlider').length ? true : false) ? $('body').addClass('epic') : $('body').removeClass('epic');

        }());

        /* Scroll */


        if ($('div.scroll-box').length) {
           
            (enable_scrolling_bar=='true') ? scrollBox_bar() : scrollBox();
           
        }
        ;


        /* end scroll */

        /* ---------------------------------------------------- */
        /* Navigation											*/
        /* ---------------------------------------------------- */

        (function() {

            var $nav = $('#navigation'),
                    $mainNav = $nav.find('ul').eq(0),
                    optionsList = '',
                    $submenu = $mainNav.find('ul').parent();

            $submenu.on('mouseenter', function() {
                var $this = $(this),
                        $subMenu = $this.children('ul');
                if ($subMenu.length) {
                    $this.addClass('hover');
                }
                $subMenu.stop(true, true).delay(250).slideDown(250);
            }).on('mouseleave', function() {
                $(this).removeClass('hover').children('ul').stop(true, true).delay(100).slideUp(100);
            });

            $.fn.lamp = function(options) {

                var defaults = {
                    'target': 'li',
                    'container': '',
                    'speed': 500,
                    'fx': '',
                    'click': function() {
                        return true;
                    },
                    'setOnClick': false,
                    'selectClass': ['current-menu-item', 'current-menu-parent', 'current-menu-ancestor']
                }, o = $.extend({}, defaults, options);

                if (o.container === '') {
                    o.container = o.target;
                }

                return this.each(function(index, el) {

                    var $selected, $back, $backSubMenu, $lt;

                    for (var i = 0; i < o.selectClass.length; i++) {
                        if ($('.' + o.selectClass[i]).length) {
                            $selected = $(o.target + '.' + o.selectClass[i], this);
                        }
                    }

                    if ($selected == undefined) {
                        $selected = '';
                    }

                    $lt = $(this).children('li');

                    function move($el, cbType) {

                        if (!$el) {
                            $el = $selected;
                        }

                        var $sub = $el.find('ul'), newWidth = '';
                        $el.hasClass('hover') ? newWidth = $sub.outerWidth() : newWidth = $el.outerWidth();

                        var styleCss = {
                            'left': $el.position().left,
                            'width': newWidth
                        };

                        $back.stop().animate(styleCss, o.speed);

                    }

                    if ($selected.length < 1) {
                        $selected = $lt.eq(0);
                    }

                    $lt.on('mouseenter focusin', function() {
                        move($(this));
                    }).on('click', function(e) {

                        $selected.removeClass(o.selectClass);
                        $selected = $(this).addClass(o.selectClass);

                        if (Modernizr.touch) {
                            var $parent = $(this);
                            $parent.removeClass('hover').children('ul').stop(true, true).fadeOut(100);
                            move($(this));
                        }
                        return o.click.apply(this, [e, this]);
                    });

                    $back = $('<' + o.container + ' class="back"></' + o.container + '>').prependTo(this);

                    $back.css({
                        'left': $selected.position().left,
                        'width': $selected.width()
                    })

                    $selected = $($selected.eq(0).addClass(o.selectClass));

                    $(this).on('mouseleave focusout', function() {
                        var $returnEl = null;
                        move($returnEl);
                        return true;
                    });

                    $(win).on('resize', function() {
                        move($selected);
                    });

                });

            };

            $mainNav.lamp({
                speed: 250
            });

            // Responsive
            $mainNav.find('li').each(function(idx, val) {
                var $this = $(this),
                        $anchor = $this.children('a'),
                        depth = $this.parents('ul').length - 1,
                        indent = '';

                if (depth) {
                    while (depth > 0) {
                        indent += '-';
                        depth = depth - 1;
                    }
                }

                if ($(val).hasClass('current-menu-item')) {
                    optionsList += '<option selected="" value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
                } else {                    
                    if ($anchor.attr('href')!=undefined){
                        optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
                    }                    
                }
            });
            
            $mainNav.after('<div class="select-style responsive-nav"><select>' + optionsList + '</select></div>');

            $('.responsive-nav').on('change', function() {
                win.location = $(this).find('select').val();
            });

            if (!Modernizr.touch) {
                $(win).scroll(function() {
                    $('#header').headerToFixed();
                });
            }

        }());

        /* end Navigation */


        /* ---------------------------------------------------- */
        /* Fancybox												*/
        /* ---------------------------------------------------- */

        (function() {
            fancyBox();
        }());

        /* end Fancybox */

        

        /* ---------------------------------------------------- */
        /* Epic Slider											*/
        /* ---------------------------------------------------- */
        
      

        if ($('.epicSlider').length) {

            if (jQuery('.video-icon').length) {
                var icon = jQuery('<div class="video_holder"><div class="video_icon"></div></div>');

                jQuery('.video_icon').live('click', function() {
                    jQuery('.video_icon').css({'display': 'none'});
                    jQuery('#slides').css({'opacity': '0'});
                    var video_attr_youtube = jQuery(this).data('video-youtube');
                    var video_attr_vimeo = jQuery(this).data('video-vimeo');
                    if ((video_attr_youtube != undefined) && (video_attr_youtube != '')) {
                        jQuery('.video_holder').append('<iframe id="player"  width="100%" height="100%" src="http://www.youtube.com/embed/' + video_attr_youtube + '?wmode=transparent" frameborder="0" allowfullscreen></iframe>');
                    }
                    if ((video_attr_vimeo != undefined) && (video_attr_vimeo != '')) {
                        jQuery('.video_holder').append('<iframe id="player" src="http://player.vimeo.com/video' + video_attr_vimeo + '" width="100%" height="100%" frameborder="0"  webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
                    }
                });
                jQuery('.nav-button').live('click', function() {
                    jQuery('#slides').css({'opacity': '1'});
                    jQuery('.video_holder').remove();

                    jQuery('#player').each(function() {
                        jQuery(this).remove();
                    });
                });
            }

            jQuery('#slides img').mouseover(function() {
                if (jQuery(this).hasClass("video-icon")) {

                    var video_attr_youtube = jQuery(this).data('video-youtube');
                    var video_attr_vimeo = jQuery(this).data('video-vimeo');
                    icon.children().attr('data-video-youtube', '');
                    icon.children().attr('data-video-vimeo', '');

                    if ((video_attr_youtube != '') && (video_attr_youtube != undefined)) {
                        icon.children().attr('data-video-youtube', video_attr_youtube);
                    }
                    if ((video_attr_vimeo != '') && (video_attr_vimeo != undefined)) {
                        icon.children().attr('data-video-vimeo', video_attr_vimeo);
                    }
                    jQuery('#epicSlider').append(icon);
                    jQuery('.video_holder .video_icon').css({'display': 'block'});
                    jQuery('#player').each(function() {
                        jQuery(this).remove();
                    });

                } else {
                    jQuery('#player').each(function() {
                        jQuery(this).remove();
                    });
                    jQuery('.video_holder').remove();

                }
            });

            jQuery('#wrapper').append('<div class="folio-loader"></div>');

            setTimeout(function() {

                $('.epicSlider').epicSlider({
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

                jQuery('.folio-loader').remove();
            }, 500);


        }

        /* end Epic Slider */
        
        /* ---------------------------------------------------- */
        /* Post Like										*/
        /* ---------------------------------------------------- */
        
        jQuery(".post-like a").click(function(){  
      
        var heart = jQuery(this);        
        var post_id = heart.data("post_id");  
          
        // Ajax call  
        
        jQuery.ajax({  
            type: "post",  
            url: ajaxurl,  
            data: "action=post-like&nonce="+ ajax_nonce +"&post_like=&post_id="+post_id,  
            success: function(count){  
                
                if(count != "already")  
                {  
                    heart.addClass("voted");  
                    heart.siblings(".count").text(count);  
                }  
            }  
        });  
          
        return false;  
        }) 
        
        /* End Post Like*/

        /* ---------------------------------------------------- */
        /* Sudo Slider											*/
        /* ---------------------------------------------------- */

        if ($('.sudo').length) {
            $('.sudo').sudoSlider({
                prevNext: true,
                continuous: true,
                autowidth: false,
                autoheight: false,
                clickableAni: false,
                ease: 'swing',
                speed: 800
            });
        }

        /* end Sudo Slider */

        /* ---------------------------------------------------- */
        /* Stapel												*/
        /* ---------------------------------------------------- */

        (function() {

            if ($('#tp-grid').length) {
                
                var tp_back = $('<div class="tp-back" id="close">Back</div>');           
                var desc = $('.description');
                var item_desc = $('.item_description');

                $('.page-header').append(tp_back);

                var $grid = $('#tp-grid'),
                        $name = $('#name'),
                        $close = $('#close'),
                        $loader = $('<div class="folio-loader"></div>').insertAfter($grid),
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
                            if (($(this).data('title') == pileName)&& (temp != pileName)){ 
                                temp = pileName;
                                desc.append($(this).data('exerpt'));                               
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
            }

        }());

        /* end Stapel */

        /* ---------------------------------------------------- */
        /* Tabs													*/
        /* ---------------------------------------------------- */

        (function() {

            var $contentTabs = $('.content-tabs');

            if ($contentTabs.length) {

                $contentTabs.each(function(idx, elem) {

                    var $tabsNav = $('.tabs-nav', $(elem)),
                            $tabsNavLis = $tabsNav.children('li'),
                            $tabsContainer = $('.tabs-container', $(elem));

                    $tabsNav.each(function() {
                        var $this = $(this);
                        $this.next().children('.tab-content').stop(true, true).hide().first().show();
                        $this.children('li').first().addClass('active').stop(true, true).show();
                    });

                    $tabsNavLis.on('click', function() {
                        var $this = $(this);
                        $this.siblings().removeClass('active').end().addClass('active');
                        $this.parent().next().children('.tab-content').stop(true, true)
                                .hide()
                                .siblings($this.find('a').attr('href'))
                                .fadeIn(250, function() {
                            $this = $(this);
                            $this.parent('.tabs-container').animate({
                                height: $this.outerHeight(true)
                            }, 200);
                        });
                        return false;
                    }).children(win.location.hash ? 'a[href=' + win.location.hash + ']' : 'a:first').trigger('click');

                    function adjustTabs() {

                        $tabsContainer.each(function() {
                            var $this = $(this);
                            $this.height($this.children('.tab-content:visible').outerHeight());
                        });

                    }

                    // Init
                    adjustTabs();

                    // Window resize
                    $(win).on('resize', function() {

                        var timer = win.setTimeout(function() {
                            win.clearTimeout(timer);
                            adjustTabs();
                        }, 30);

                    });

                });

            }

        }());

        /* end Tabs */

        /* ---------------------------------------------------- */
        /* Toggles												*/
        /* ---------------------------------------------------- */

        (function() {

            if ($('.acc-box').length) {

                var $box = $('.acc-box');

                $box.each(function(idx, val) {

                    var $trigger = $('.acc-trigger', $(val));

                    $trigger.on('click', function() {
                        var $this = $(this);
                        if ($this.data('mode') === 'toggle') {
                            $this.toggleClass('active').next().stop(true, true).slideToggle(300);
                        } else {
                            if ($this.next().is(':hidden')) {
                                $trigger.removeClass('active').next().slideUp(300);
                                $this.toggleClass('active').next().slideDown(300);
                            } else if ($this.hasClass('active')) {
                                $this.removeClass('active').next().slideUp(300);
                            }
                        }
                        return false;
                    });

                });

            }

        }());

        /* end Toggles */

        /* ---------------------------------------------------- */
        /* Gallery												*/
        /* ---------------------------------------------------- */

        (function() {

            if ($('#gallery-items').length) {

                /* Standart Pagination */

                function GetPagedCategories() {
                    jQuery('#gallery-filter').next().append('<div class="folio-loader"></div>');
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
                        jQuery('#gallery-items').children().remove();
                        jQuery('#gallery-items').append(jQuery(response).html());
                        jQuery('#gallery-items').hide().fadeIn(1000);

                        jQuery('.single-image.plus-icon, .single-image.link-icon').fancybox({
                            scrolling: 'no',
                            openEffect: 'fade',
                            closeEffect: 'fade'
                        }).each(function() {
                            jQuery(this).append('<span class="curtain"></span>');
                        });

                    });
                    return false;
                }

                var $cont = $('#gallery-items'),
                        pagination = $('#gallery-items').data('pagination'),
                        layout = $('#gallery-items').data('layout'),
                        filterLink = $('#gallery-filter li'),
                        naviLink = $('.wp-pagenavi.gall li'),
                        $itemsFilter = $('#gallery-filter');

                if (pagination == 2) {

                    filterLink.live('click', GetPagedCategories);
                    naviLink.live('click', GetPagedCategories);
                }

                /* end Standard Pagination */

                $.fn.slideVertShow = function(speed) {
                    var that = $(this);
                    that.animate({
                        paddingTop: 'show',
                        paddingBottom: 'show',
                        height: 'show'
                    }, speed);
                    win.setTimeout(function() {
                        $itemsFilter.animate({
                            width: 140
                        }, 300);
                    }, 10);
                };

                $.fn.slideVertHide = function(speed) {
                    var that = $(this), $filter;
                    that.not('.active').animate({
                        paddingTop: 'hide',
                        paddingBottom: 'hide',
                        height: 'hide'
                    }, speed);
                    if (that.hasClass('active')) {
                        $filter = that.filter('.active');
                        win.setTimeout(function() {
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

                // Copy categories to item classes
                $('article', $cont).each(function(i) {
                    var $this = $(this);
                    $this.addClass($this.attr('data-categories'));
                });

                // Run Isotope when all images are fully loaded
                if (pagination == 0) {
                    $(win).on('load', function() {
                        $cont.isotope({
                            itemSelector: 'article',
                            layoutMode: 'fitRows'
                        });
                    });
                }
                if ($(win).width() > 767) {

                    var mouseOver;

                    $itemsFilter.find('li').first().addClass('active').end().stop(true, true).slideVertHide(300);

                    $itemsFilter.on('mouseenter', function() {
                        var $this = $(this);
                        win.clearTimeout(mouseOver);

                        // Wait 100ms before animating to prevent unnecessary flickering
                        mouseOver = win.setTimeout(function() {
                            $itemsFilter.find('li').stop(true, true).slideVertShow(300);
                        }, 200);

                    }).on('mouseleave', function() {
                        win.clearTimeout(mouseOver);
                        $(this).find('li').stop(true, true).slideVertHide(300);
                    });

                } else {
                    $itemsFilter.find('li').first().addClass('active');
                }

                // Filter projects
                $itemsFilter.on('click', 'li', function(e) {
                    var $this = $(this).children('a'),
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
                                    $('.single-image', $cont).attr('rel', 'gallery');
                                } else {
                                    $(currentOption, $cont).find('.single-image').attr('rel', currentOption.substring(1));
                                }
                            });
                        }
                    }
                    e.preventDefault();
                });

            }

        }());

        /* end Gallery */

        /* ---------------------------------------------------- */
        /* FitVids												*/
        /* ---------------------------------------------------- */

        function adjustVideos() {

            var $videos = $('.video-container');

            $videos.each(function() {

                var $this = $(this),
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
        ], $allVideos = $(this).find(selectors.join(','));

        $allVideos.each(function() {

            var $this = $(this),
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


        $(win).on('resize', function() {
            var timer = win.setTimeout(function() {
                win.clearTimeout(timer);
                adjustVideos();
            }, 30);
        });

        /* end FitVids */

        /* ---------------------------------------------------- */
        /* Cycle Functions										*/
        /* ---------------------------------------------------- */

        // Fixed scrollHorz effect
        $.fn.cycle.transitions.fixedScrollHorz = function($cont, $slides, opts) {

            $('.cycle-slider-nav a, .post-slider-nav a').on('click', function(e) {
                $cont.data('dir', '');
                if (e.target.className.indexOf('prev') > -1) {
                    $cont.data('dir', 'prev');
                }
            });
            $cont.css('overflow', 'hidden');
            opts.before.push($.fn.cycle.commonReset);
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

        /* ---------------------------------------------------- */
        /* Cycle Slider											*/
        /* ---------------------------------------------------- */

        (function() {

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

            if ($('.cycle-slider > ul').length) {

                if (jQuery('.cycle-slider').length) {
                    //jQuery('.page-header').next().append('<div class="folio-loader"></div>');
                    jQuery('.cycle-slider').append('<div class="folio-loader"></div>');
                    jQuery('.folio-loader').css({
                        'top': '50%'
                    });
                                  }

                setTimeout(function() {
                    jQuery('.folio-loader').remove();
                }, 3000);

                var $cycleslider = $('.cycle-slider > ul');

                $(win).load(function() {

                    $cycleslider.each(function(i) {

                        var $this = $(this);

                        $this.css('height', $this.children('li:first').height())
                                .after('<div class="cycle-slider-nav"><a href="#" class="prevBtn cycle-nav-prev-' + i + '">Prev</a><a href="" class="nextBtn cycle-nav-next-' + i + '">Next</a></div>')
                                .cycle({
                            before: function(curr, next, opts) {
                                var $this = $(this);
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
                    $('.cycle-slider-nav a').on('mouseenter', function() {
                        $(this).parent().prev().cycle('pause');
                    }).on('mouseleave', function() {
                        $(this).parent().prev().cycle('resume');
                    });

                    // Hide navigation if only a single slide
                    if ($cycleslider.data('slideCount') <= 1) {
                        $cycleslider.next('.cycle-slider-nav').hide();
                    }

                });

                // Resize
                $(win).on('resize', function() {
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
            }

        }());

        /* end Cycle Slider */

        /* ---------------------------------------------------- */
        /* Post Slider											*/
        /* ---------------------------------------------------- */

        (function() {

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

            if ($('.image-post-slider > ul').length) {

                var $postslider = $('.image-post-slider > ul');

                $(win).load(function() {

                    $postslider.each(function(i) {

                        var $this = $(this);

                        $this.css('height', $this.children('li:first').height())
                                .after('<div class="post-slider-nav"><a class="prevBtn post-nav-prev-' + i + '">Prev</a><a class="nextBtn post-nav-next-' + i + '">Next</a></div>')
                                .cycle({
                            before: function(curr, next, opts) {
                                var $this = $(this);
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
                    $('.post-slider-nav a').on('mouseenter', function() {
                        $(this).parent().prev().cycle('pause');
                    }).on('mouseleave', function() {
                        $(this).parent().prev().cycle('resume');
                    });

                    // Hide navigation if only a single slide
                    if ($postslider.data('slideCount') <= 1) {
                        $postslider.next('.post-slider-nav').hide();
                    }

                });

                // Resize
                $(win).on('resize', function() {
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
            }

        }());

        /* end Post Slider */

        /* ---------------------------------------------------- */
        /* Testimonials											*/
        /* ---------------------------------------------------- */

        (function() {

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

            if (jQuery('.quotes').length) {

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
                    $('.quotes-nav a').on('mouseenter', function() {
                        $(this).parent().prev().cycle('pause');
                    }).on('mouseleave', function() {
                        $(this).parent().prev().cycle('resume');
                    });

                    // Hide Navigation if only a Single Slide
                    if ($quotes.data('slideCount') <= 1) {
                        $quotes.next('.quotes-nav').hide();
                    }

                    // Resize
                    $(win).on('resize', function() {
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

            }

        }());

        /* end Testimonials */

        /* ---------------------------------------------------- */
        /* Notifications										*/
        /* ---------------------------------------------------- */

        (function() {

            var $notice = $('.error, .success, .info, .notice');
            $notice.notifications({
                speed: 300
            });

        }());

        /* end Notifications */

        /* ---------------------------------------------------- */
        /* Placeholder for IE									*/
        /* ---------------------------------------------------- */

        if (typeof doc.createElement('input').placeholder === 'undefined') {
            $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() === input.attr('placeholder')) {
                    input.val('');
                    input.removeClass('placeholder');
                }
            }).blur(function() {
                var input = $(this);
                if (input.val() === '' || input.val() === input.attr('placeholder')) {
                    input.addClass('placeholder');
                    input.val(input.attr('placeholder'));
                }
            }).blur().parents('form').submit(function() {
                $(this).find('[placeholder]').each(function() {
                    var input = $(this);
                    if (input.val() === input.attr('placeholder')) {
                        input.val('');
                    }
                });
            });
        }

        /* end Placeholder */

        /* ---------------------------------------------------- */
        /*	Media Element										*/
        /* ---------------------------------------------------- */

        (function() {

            var $player = $('audio, video');

            if ($player.length) {

                $player.mediaelementplayer({
                    audioWidth: '100%',
                    audioHeight: '30px',
                    videoWidth: '100%',
                    videoHeight: '100%'
                });

            }
        }());

        /* end Media Element */

    });

    /* ---------------------------------------------------------------------- */
    /*	Plugins																  */
    /* ---------------------------------------------------------------------- */

    /* ---------------------------------------------------- */
    /*	Header to Fixed										*/
    /* ---------------------------------------------------- */

    $.fn.headerToFixed = function() {

        var $this = $(this),
                o = $(win).scrollTop(),
                w = $(win).outerWidth(),
                $h = $this.outerHeight(true);

        if (w > 960) {
            o > ($h / 3) ? $this.addClass('scrolltop') : $this.removeClass('scrolltop');
        }

    };

    /* ---------------------------------------------------- */
    /*	Notifications										*/
    /* ---------------------------------------------------- */

    $.fn.notifications = function(options) {

        var defaults = {
            speed: 300
        },
        o = $.extend({}, defaults, options);

        return $(this).each(function() {

            var closeBtn = $('<a class="alert-close" href="#"></a>'),
                    closeButton = $(this).append(closeBtn).children('.alert-close');

            closeButton.on('click', function(e) {
                $(this).parent('p').fadeTo(o.speed, 0, function() {
                    $(this).slideUp(o.speed);
                });

                e.preventDefault();

            });
        });

    };

    /* end Notifications */

    

    /* ---------------------------------------------------- */
    /*	Min Height											*/
    /* ---------------------------------------------------- */

    (function() {

        function setMinHeight() {

            $('#wrapper').css('min-height',
                    $(win).outerHeight(true)
                    - $('#header').outerHeight(true)
                    - $('#footer').outerHeight() - 42
                    );

        }

        setMinHeight();

        $(win).on('resize', function() {
            var timer = win.setTimeout(function() {
                win.clearTimeout(timer);
                setMinHeight();
            }, 50);
        });

    }());

    /* end Min-height */

    /* ---------------------------------------------------- */
    /*	Actual Plugin										*/
    /* ---------------------------------------------------- */

    // jQuery Actual Plugin - Version: 1.0.13 (http://dreamerslab.com/)
    ;
    (function(a) {
        a.fn.extend({
            actual: function(b, l) {
                if (!this[b]) {
                    throw'$.actual => The jQuery method "' + b + '" you called does not exist';
                }
                var f = {
                    absolute: false,
                    clone: false,
                    includeMargin: false
                };
                var i = a.extend(f, l);
                var e = this.eq(0);
                var h, j;
                if (i.clone === true) {
                    h = function() {
                        var m = "position: absolute !important; top: -1000 !important; ";
                        e = e.clone().attr("style", m).appendTo("body");
                    };
                    j = function() {
                        e.remove();
                    };
                } else {
                    var g = [];
                    var d = "";
                    var c;
                    h = function() {
                        c = e.parents().andSelf().filter(":hidden");
                        d += "visibility: hidden !important; display: block !important; ";
                        if (i.absolute === true) {
                            d += "position: absolute !important; ";
                        }
                        c.each(function() {
                            var m = a(this);
                            g.push(m.attr("style"));
                            m.attr("style", d);
                        });
                    };
                    j = function() {
                        c.each(function(m) {
                            var o = a(this);
                            var n = g[m];
                            if (n === undefined) {
                                o.removeAttr("style");
                            } else {
                                o.attr("style", n);
                            }
                        });
                    };
                }
                h();
                var k = /(outer)/g.test(b) ? e[b](i.includeMargin) : e[b]();
                j();
                return k;
            }
        });
    })(jQuery);

    /* end jQuery Actual Plugin */


    /* ---------------------------------------------------- */
    /* Touch Handler										*/
    /* ---------------------------------------------------- */

    function touchHandler(e) {
        var target = $(e.currentTarget);
        if (target.hasClass('active')) {
            target.removeClass('active');
            return true;
        } else {
            target.addClass('active');
            return false;
        }
    }

    /* end Touch Handler */

    /* ---------------------------------------------------- */
    /* Fancybox                                             */
    /* ---------------------------------------------------- */

    var fancyBox = function() {
        
        

        if ($('.single-image').length) {
            
            

            if (Modernizr.touch) {
                $('.single-image').on('click', touchHandler);             
            }

            // Single Image
            
            jQuery('.single-image.plus-icon, .single-image.link-icon').fancybox({
                'openEffect': 'fade',
                'closeEffect': 'fade'                
            }).each(function() {
                $(this).append('<span class="curtain"></span>');                
            });
            
            // fancybox video

            $(".single-image.video-icon").click(function() {
                
                                
                $.fancybox({
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

            $(".single-image.video-icon.vimeo").click(function() {
                $.fancybox({
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
            $('.single-image.video-icon').fancybox({
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
                $(this).append('<span class="curtain"></span>');
            });
        }

    };

    /* end Fancybox */

    /* ---------------------------------------------------- */
    /*	Ajax Response for Folio								*/
    /* ---------------------------------------------------- */

    $('#folio_categories_bar li').on('click', 'a', function() {

        var $this = $(this),
                folio_post_id = $this.data('post-id'),
                layout = $this.data('layout');

        $this.parent().siblings('li').removeClass('active').end().addClass('active');
        $('#folio_images_area').fadeOut(200);
        $('#wrapper').append('<div class="folio-loader" />');


        var data = {
            action: 'folio_get_by_folio_id',
            folio_post_id: folio_post_id,
            layout: layout
        };

        $.post(ajaxurl, data, function(response) {

            $(function() {

                if ($('#folio_images_area').length) {

                    $('body').css('overflow', 'hidden');

                    var folioArea = $('#folio_images_area');
                    folioArea.html(response).hide(0).fadeIn(500, function() {

                        $('.folio-loader').remove();

                    });
                    jQuery('#folio_images_area a').each(function() {

                        jQuery(this).attr('data-load', false);

                    });

                    $('.scroll-box').resizeGrid();
                    fancyBox();
                    
                    (enable_scrolling_bar=='true') ? scrollBox_bar() : scrollBox();
                }

            });

        });

        return false;

    });
    
    
    
        
    
    /* ---------------------------------------------------- */
    /* Back to Top											*/
    /* ---------------------------------------------------- */

    (function() {

        var extend = {
            button: '#back-top',
            text: 'Back to Top',
            min: 200,
            fadeIn: 400,
            fadeOut: 400,
            speed: 800,
            'class': 'active'
        }, oldiOS = false, oldAndroid = false;

        // Detect if older iOS device, which doesn't support fixed position
        if (/(iPhone|iPod|iPad)\sOS\s[0-4][_\d]+/i.test(navigator.userAgent)) {
            oldiOS = true;
        }

        // Detect if older Android device, which doesn't support fixed position
        if (/Android\s+([0-2][\.\d]+)/i.test(navigator.userAgent)) {
            oldAndroid = true;
        }

        $('body').append('<a href="#" id="' + extend.button.substring(1) + '" title="' + extend.text + '">' + extend.text + '</a>');

        $(win).scroll(function() {
            var pos = $(win).scrollTop();

            if (oldiOS || oldAndroid) {
                $(extend.button).css({
                    'position': 'absolute',
                    'top': pos + $(win).height()
                });
            }

            if (pos > extend.min) {
                $(extend.button).addClass(extend['class']);
            } else {
                $(extend.button).removeClass(extend['class']);
            }

        });

        $(extend.button).click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, extend.speed);
            return false;
        });

    }());

    /* end Back to Top */

}(jQuery, window, Modernizr, document));


