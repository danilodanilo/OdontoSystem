/* 
    Document   :  playSlider
    Created on :  Aug, 2011
    Author     :  Andrei Dinca, AA-Team
    Description:  Slider javascript class here.
	Version	   :  1.0
*/
(function ($) {
    $.fn.playSlider = function (options) {
        var defaults = {
            content: ".slide-content", // container where sliding contents
            children: "li", // children items (default: li)
            transition: "fade", // transition effect (defaut: fade)
            animationSpeed: 300, // transition speed
            easing: 'swing', // easing of animation (default. 'swing')
			indicatorEasing: 'linear', // easing of animation (default. 'linear')
            autoplay: false, // autoplay easing
            autoplaySpeed: 3000, // autoplay interval speed
            navigation: true, // show navigation (default: true)
            arrows: true, // show arrows (default: true)
            arrowsHide: false, // hide arrow on mouse out (default: true)
            keyBrowse: true, // allow key browsing (default: true)
            preloadImages: true, // allow preload images browsing (default: true)
            itemSize: {
                width: 960, // item width in px
                height: 496 // item width in px
            },
            prev: "prev", // prev btn item
            next: "next", // next btn item
            play: "play", // next btn item
            pause: "pause", // next btn item
            running: false, // static usage
			auto_running: false,
			speed: 0, // static usage in code
            animationStart: function () {},
            animationComplete: function () {}
        };
        var option = $.extend({}, defaults, options);
        return this.each(function () {
            var $t = $(this),
            item = $t.children(option.content).children(option.children),
            item_img = item.find('img'),
            sliderContent = $t.find(option.content),
            l = item.length - 1,
            w = item.outerWidth(),
            h = item.height(),
            allImage = [],
            step = 0,
            indicator = jQuery('.progressIndicator'),
            is_stop = false, front_item, front_item_img, next_item, next_item_img, navigation, arrows, z, on, bullet, evt, cc=0;
				
            var slider = {
                init: function () {

                    if(option.preloadImages){
                        $(".prealoadImages").remove();
                        $t.append('<img src="images/loading.gif" class="prealoadImages" />');
                        item_img.hide();
                        item_img.each(function(i){
                            allImage[i] =  $(this).attr('src');
                        });
                        
                        slider.preLoadImages(allImage, function(){
                            item_img.show();
                            $("img.prealoadImages").hide();
                            slider.load_slider();

                        });
                    }else{
                        slider.load_slider();
                    }
                },

                load_slider: function(){
                    slider.data();

                    if (option.navigation === true) {
                        slider.navigation.create();
                    }
                    if (option.arrows === true) {
                        slider.arrows.create();
                    }
                    if (option.autoplay === true) {
                        slider.autoplay();
                    }
                    slider.triggers();
                },
				
                data: function () {
                    item.each(function (i) {
                        var $this = $(this);
						
                        $this.css("z-index", -(i - l));
                        $this.find('img').css("opacity", 0);
                    });
					
                    if (option.transition === "fade") {
                        item.eq(0)
                        .addClass('on')
                        .find('img')
                        .css("opacity", 1)
                    ;
                    }
                },
                
                preLoadImages: function(imageList, callback) {    
                    var pic = [], i, total, loaded = 0;
                    if (typeof imageList !== 'undefined') {
                        if ($.isArray(imageList)) {
                            total = imageList.length; // used later
                            for (i=0; i < total; i++) {
                                pic[i] = new Image();
                                pic[i].onload = function() {
                                    loaded++; // should never hit a race condition due to JS's non-threaded nature
                                    if (loaded === total) {
                                        if ($.isFunction(callback)) {
                                            callback();
                                        }
                                    }
                                }
                                pic[i].src = imageList[i];
                            }
                        }
                        else {
                            pic[0] = new Image();
                            pic[0].onload = function() {
                                if ($.isFunction(callback)) {
                                    callback();
                                }
                            };
                            pic[0].src = imageList;
                        }
                    }
                    pic = undefined;
                },
				
                zindex: {
                    prev: function () {
                        if(step === l){
                            item.eq(0).css("z-index", l + 3);
                        }else{
                            item.css("z-index", l + 1);
                        }
                        item.eq(step).css("z-index", l + 4).next(item).css("z-index", l + 2);
                    },
                    next: function () {
                        item.css("z-index", l + 1).eq(step).css("z-index", l + 3).prev(item).css("z-index", l + 2);
                    },
                    navigation: function () {
                        item.css("z-index", l + 1).eq(on).css("z-index", l + 2);
                        item.eq(step).css("z-index", l + 3);
                    },
                    trigger: function () {
                        if (z === 1) {
                            slider.zindex.next();
                        } else {
                            if (z === -1) {
                                slider.zindex.prev();
                            } else {
                                if (z === 0) {
                                    slider.zindex.navigation();
                                }
                            }
                        }
                    }
                },

                slide: {
					progressBar: function(fromStart) {
						
						// if running go out from function
						if(option.auto_running === true) return false;
						
						// move navigation
						var onElement 		= navigation.find('li').eq(step),
							onElement_pos	= onElement.position(),
							toLeft = parseInt(onElement_pos.left) < 0 ? 0 : parseInt(onElement_pos.left);
						
						navigation.find('.textOverlay').animate({
							left: toLeft + "px"
						}, (option.animationSpeed / 2));
						
						// find element with .on class and remove class
						sliderContent.find('.on').removeClass('on');
						navigation.find('.on').removeClass('on');
						
						// add .on class on current navigation on item
						navigation.find('li').eq(step).find('a').addClass('on');
						var toWidth = 0;
						toWidth = (parseInt(onElement.width()) * (parseInt(step) + 1));
						
						if(fromStart === true) {
							// css to step 0 pos
							indicator.css({
								width: toLeft + "px"
							});
						}
						
						// if is stoped (button) go out from function
						if(is_stop == true) return false;
						
						var space = toWidth - indicator.width();
						if(option.speed == 0) {
							option.speed = toWidth / option.autoplaySpeed;
						}
						// speed optimization
						var new_time = (space / option.speed);
						
						// start indicator
						indicator.animate({width : toWidth }, { 
							duration	: new_time, 
							easing		: option.indicatorEasing,
							complete	: function(){
								slider.animation.next_item(true);
							}
						});
					},
					
                    fade: function (fromStart) {
                        
                        option.animationStart.call(this);
						
                        front_item = sliderContent.find('.on');
                        front_item_img = front_item.find('img');
                        next_item  = item.eq(step);
                        next_item_img = next_item.find('img');
						
                        slider.zindex.trigger();
						
						// start slider progress bar aniamtion & next slider
						slider.slide.progressBar(fromStart === true ? true : false);
						
						// add .on class to current element
						next_item.addClass('on');
						
						// fron item img animate
						front_item_img.animate({
							opacity: 0
						}, option.animationSpeed, option.easing);
						
						// start autoplay
                        next_item_img.animate({
                            opacity: 1
                        }, option.animationSpeed, option.easing, function () {
                            
							option.animationComplete.call(this);
							
                            // release running
                            option.running = false;
                        });
                    }
                },

                animation: {
                    previous: function (fromStart) {
                        if(step === 0){
                            step = l;
                        } else {
                            step--;
                        }
                        z = -1;
                        switch (option.transition) {
                            case "fade":
                                slider.slide.fade(fromStart);
                                break;
                        }
                    },
                    next_item: function (fromStart) {
                        if(step >= l){
                            step = 0;
                        }else{
                            step++;
                        }
                        z = 1;
                        switch (option.transition) {
                            case "fade":
                                slider.slide.fade(fromStart);
                                break;
                        }
                    }
                },
				
                keyBrowse: function () {	
                    $(document).keyup(function(e) {
           
                        if (e.keyCode === 37){
                            // exit if animations still running
                            if(option.running){
                                return false;
                            }

                            // set up true running script
                            option.running = true;
							option.auto_running = false;
							
							// stop indicator
							indicator.stop();
                        
                            slider.animation.previous(true);
                            if (option.navigation === true) {
                                slider.navigation.update();
                            }
                            return false;
                        }
                        if (e.keyCode === 39){
                            // exit if animations still running
                            if(option.running){
                                return false;
                            }

                            // set up true running script
                            option.running = true;
							option.auto_running = false;
							
							// stop indicator
							indicator.stop();
                            
                            slider.animation.next_item(true);
                            if (option.navigation === true) {
                                slider.navigation.update();
                            }
                            return false;
                        }
                        return false;
                    });
                },

                autoplay: function () {
                    if (option.autoplay === true) { 
                        // start slider progress bar aniamtion & next slider
						slider.slide.progressBar(true);
                    }
                },
				
                navigation: {
                    create: function () {
						
                        $t.find(".navigation").remove();
                        $t.append($("<ul />").addClass("navigation"));
                        navigation = $t.find(".navigation");
                        for (i = 0; i <= l; i++) {
							// <li style="width: 234px;">
							navigation.append($("<li />").css({
                                width: (w / (l + 1)) + "px",
								overflow: 'hidden'
                            }).append($("<a />").attr({
                                href: "#",
                                rel: i
                            }).text(item.eq(i).find('h3').text())));
                        }
						// remove last item border right
						navigation.find('a:last').css('background', 'none');
                        
						// add overlay
						navigation.append($("<li />").addClass('textOverlay').css({
							width: (w / (l + 1)) + "px",
							height: '49px',
							left: '0px'
						}));
                    },
                    trigger: function () {
                        bullet = navigation.find("a");
                        bullet.eq(0).addClass("on");
                        bullet.click(function () {
                            var b = $(this),
                            rel = b.attr("rel");
                            on = bullet.filter(".on").attr("rel");
                            step = rel;
                            sign = rel > on ? "+" : "-";
							
							option.auto_running = false;
                            z = 0;
                            if (!b.hasClass("on")) {
                                switch (option.transition) {
                                    case "fade":
										// stop indicator
										indicator.stop();
										
                                        slider.slide.fade(true);
                                        break;
                                }
                            }
                            
                            bullet.removeClass("on");
                            b.addClass("on");
                            return false;
                        });
                    },
                    update: function () {
                        bullet.removeClass("on").eq(step).addClass("on");
                    }
                },
				
                arrows: {
                    create: function () {
                        $(".nextBackControllers").remove();
                        $t.append($("<div />").addClass("nextBackControllers"));
                        arrows = $t.find(".nextBackControllers");
                        arrows.append($("<a />").attr("href", "#").addClass(option.prev).text("Previous"));
						arrows.append($("<a />")
							.attr("href", "#")
							.addClass(option.pause)
							.text("Pause")
							.css('display', (option.autoplay === true ? 'block' : 'none') )
						);
						arrows.append($("<a />")
							.attr("href", "#")
							.addClass(option.play)
							.text("Play")
							.css('display', (option.autoplay !== true ? 'block' : 'none') )
						);
						arrows.append($("<a />").attr("href", "#").addClass(option.next).text("Next"));
                    },
                    trigger: function () {
						arrows.find("." + option.pause).click(function () {
                            // exit if animations still running
                            if(option.auto_running){
                                return false;
                            }

                            // set up true running script
                            option.auto_running = true;
							
							// set is_stop status to true
							is_stop = true;
							
							// hide pause btn
							$(this).css('display', 'none')
							arrows.find("." + option.play).css('display', 'block')
							
							// stop indicator
							indicator.stop();
                        
                            return false;
                        });
						arrows.find("." + option.play).click(function () {
                            // set up true running script
                            option.auto_running = false;
							
							// set is_stop status to true
							is_stop = false;
							
							// hide pause btn
							$(this).css('display', 'none')
							arrows.find("." + option.pause).css('display', 'block')
							
							// go indicator
							slider.slide.progressBar(false);
                        
                            return false;
                        });
						 arrows.find("." + option.prev).click(function () {
                            // exit if animations still running
                            if(option.running){
                                return false;
                            }

                            // set up true running script
                            option.running = true;
							option.auto_running = false;
							
							// stop indicator
							indicator.stop();
                        
                            slider.animation.previous(true);
                            if (option.navigation === true) {
                                slider.navigation.update();
                            }
                            return false;
                        });
                        arrows.find("." + option.next).click(function () {
                            // exit if animations still running
                            if(option.running){
                                return false;
                            }

                            // set up true running script
                            option.running = true;
							option.auto_running = false;
							
							// stop indicator
							indicator.stop();
                            
                            slider.animation.next_item(true);
                            if (option.navigation === true) {
                                slider.navigation.update();
                            }
                            return false;
                        });
                        if (option.arrowsHide === true) {
                            arrows.find('a').hide();
                            $t.hover(function () {
                                $t.mousemove(function(e) {
                                    var offset = $(this).offset();
                                    var x = e.pageX - (offset.left);
									
                                    if(x < w / 2){
                                        // left side (prev)
                                        arrows.find("." + option.next).hide();
                                        arrows.find("." + option.prev).fadeIn(150);
                                    }else{
                                        // right side (next)
                                        arrows.find("." + option.prev).hide();
                                        arrows.find("." + option.next).fadeIn(150);
                                    }
                                });
                            }, function () {
                                arrows.find('a').hide();
                            });
                        }
                    }
                },
				
                triggers: function () {
                    if (option.arrows === true) {
                        slider.arrows.trigger();
                    }
                    if (option.navigation === true) {
                        slider.navigation.trigger();
                    }
                    if (option.keyBrowse === true) {
                        slider.keyBrowse();
                    }
                }
            };
			
            slider.init();
        });
    };
}(jQuery));

// Save me from console.log errors
if(typeof(console) === 'undefined') {
    var console = {}
    console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};
}