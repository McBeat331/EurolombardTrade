import lang from './lang';
import departmentsLocationInMap from './maps';

export {
    lang,
    departmentsLocationInMap,
}




let site = null;
let ValidationModule = null;
document.addEventListener("DOMContentLoaded", function (event) {


    if (!document.getElementsByTagName("body")) { console.log('js error') }

    site = (function () {

        const win = window,

            dom = document,
            body = document.body,
            $thisPage = $(".mainWrapper"),
            $overlayContainer = $(".overlay-wrapper"),
            $scrollTopButton = $('#scrollTopButton'),

            menuBtn = document.querySelector(".menu-btn"),
            headerNavList = document.querySelector(".header-nav-list"),
            navItems = document.querySelectorAll(".nav-item"),
            callbackDropPopap = document.querySelector(".callback-drop-box"),
            callDropTitle = document.querySelector(".call-drop-title"),
            $btnModalReview = $(".btn-modal_review"),
            $btnModalService = $(".link-news"),
            $qestionsItems = $(".questions-item"),
            $mapSection = $(".office-departments"),
            $calcTab = $(".calc-tab"),
            $select = $(".select"),

            $resultList = $(".result-body-list"),
            $forms = $('.calc-form')

        const fn = {

            toggleScrollTopButton() {

                var scrollTop = $(window).scrollTop();
                const $btnScroll = $("#scrollTopButton")

                if(scrollTop > 300){
                    $btnScroll.addClass("js_scrollVisible")
                }

                $(window).scroll(function() {
                    if($(window).scrollTop() > scrollTop){
                        $btnScroll.addClass("js_scrollVisible")
                        scrollTop = $(window).scrollTop();
                    }
                    if($(window).scrollTop() < 300){
                        $btnScroll.removeClass("js_scrollVisible")
                        scrollTop = $(window).scrollTop();
                    }
                });
            },

            handlerScrollTopPage() {
                if (document.documentElement.clientWidth > 1169) {
                    $("#scrollTopButton").on("click", function(e) {
                        e.preventDefault();
                        $('html, body').animate({ scrollTop: 0 }, "slow");
                    });
                }
                if (document.documentElement.clientWidth < 1169) {
                    $("#scrollTopButton").on("mousedown touchstart", function(e) {
                        e.preventDefault();
                        $('html, body').animate({ scrollTop: 0 }, "slow");
                    });
                }
            },

            visibleViewportContent() {
                const $visivleChecked = $('.visible-viewportchecker')
                // $visivleChecked.each(function() {
                $visivleChecked.viewportChecker({

                    classToAdd: 'visible animated bounceInLeft',
                    classToRemove: 'hidden',
                    offset: 30,
                    //     repeat: true,
                    // });
                });

                // const $visivleChecked = $('.visible-viewportchecker')
                // $visivleChecked.each( function(k, v) {
                //     var el = this;
                //     setTimeout(function () {
                //         $(el).viewportChecker({
                //             classToAdd: 'visible animated bounceInLeft',
                //             offset: 30,
                //         });
                //     }, k*300);
                // });
            },

            handlerActiveHamburgerMenu() {
                menuBtn.onclick = function () {
                    let line1 = document.querySelector(".line--1");
                    let line2 = document.querySelector(".line--2");
                    let line3 = document.querySelector(".line--3");
                    this.closest(".nav").classList.toggle("nav-open");
                    line1.classList.toggle("line-cross");
                    line2.classList.toggle("line-fade-out");
                    line3.classList.toggle("line-cross");
                    headerNavList.classList.toggle("fade-in");
                }
            },

            activedDropDownSubMenuNavItem() {
                navItems.forEach(function(el){
                    el.addEventListener("mouseover", function() {
                        var elSubMenuLength = this.getElementsByClassName("nav-item_submenu").length;
                        var elSubMenu = this.querySelector(".nav-item_submenu");

                        if (elSubMenuLength > 0) {
                            if (!el.matches('.active')) {
                                el.classList.toggle("active");
                                elSubMenu.classList.toggle("actived__submenu")
                            }
                        }
                    });

                    el.addEventListener("mouseout", function() {

                        var elSubMenu = this.querySelector(".nav-item_submenu");
                        if (el.matches('.active')) {
                            el.classList.remove("active");
                            elSubMenu.classList.remove("actived__submenu");
                        }
                    });
                });
            },
            ajaxFormCallback() {
                $('.common-questions .callback-content-forms form .button, .callback-dropdown-phone .callback-content-forms form .button').on('click', function(e) {
                    e.preventDefault();

                    if (ValidationModule.isValid(this.form)){
                        var form = this.form;
                        // var urlget   = $(this.form).attr('action');
                        let html = document.querySelector('html');
                        let lang =html.getAttribute("lang");
                        let langPrefix = '';
                        if(lang == 'ru') {
                            langPrefix = '/ru'
                        }


                        $.post( '/callbackMail', $(this.form).serialize(), function(data) {
                                window.location.href = window.location.origin + langPrefix + '/thankYou';

                                // $(form).next('.description-form').prepend('<div class="successForm">'+$(form).data('successtext')+'</div>');
                                // $('.description-form .successForm').slideDown('slow');
                                // setTimeout(function () {
                                //     $('.description-form .successForm').slideUp('slow', function() {
                                //         $(this).remove();
                                //     });
                                //     callbackDropPopap.classList.remove("active");
                                //     $overlayContainer.hide();
                                // },6000);
                                // $(form)[0].reset();
                            },
                            'json'
                        );
                    }

                });
            },
            ajaxFormReview() {
                $('.review-modal .modal-content-forms form .button').on('click', function(e) {
                    e.preventDefault();

                    if (ValidationModule.isValid(this.form)){
                        console.log($(this.form).serialize());
                        var form = this.form;
                        $.post( '/reviewMail', $(this.form).serialize(), function(data) {
                                //window.location.href = window.location.origin + '/thankYou';
                                $(form).next('.description-form').prepend('<div class="successForm">'+$(form).data('successtext')+'</div>');
                                $('.description-form .successForm').slideDown('slow');
                                setTimeout(function () {
                                    $('.description-form .successForm').slideUp('slow', function() {
                                        $(this).remove();
                                    });
                                    $(".review-modal").hide()
                                },3000);
                                $(form)[0].reset();
                            },
                            'json'
                        );
                    }

                });
            },
            ajaxFormFeedback() {
                $('.service-modal .modal-content-forms form .button').on('click', function(e) {
                    e.preventDefault();

                    if (ValidationModule.isValid(this.form)){
                        console.log($(this.form).serialize());
                        var form = this.form;
                        $.post( '/feedbackMail', $(this.form).serialize(), function(data) {
                                //window.location.href = window.location.origin + '/thankYou';
                                $(form).next('.description-form').prepend('<div class="successForm">'+$(form).data('successtext')+'</div>');
                                $('.description-form .successForm').slideDown('slow');
                                setTimeout(function () {
                                    $('.description-form .successForm').slideUp('slow', function() {
                                        $(this).remove();
                                    });
                                    $(".service-modal").hide()
                                },3000);
                                $(form)[0].reset();
                            },
                            'json'
                        );
                    }

                });
            },
            activedDropDownPopapCallbackHeader() {
                callDropTitle.addEventListener("click", function() {
                    if (!callbackDropPopap.matches('.active')) {
                        callbackDropPopap.classList.add("active");
                        $overlayContainer.show();
                    } else {
                        callbackDropPopap.classList.remove("active");
                        $overlayContainer.hide();
                    }
                });

            },

            initSlickSliderMainBanner() {
                var time = 3;
                var quantityLiDots = 0;
                var itemBanner = $('.wrap-content-banners .item-banner');
                var wrapDots = $(".wrap-content-banners .slick__nav");
                var totalDots = $(".wrap-content-banners .total-dots");
                var $bar,
                    $slick,
                    isPause,
                    tick,
                    liDots,
                    percentTime;

                $slick = $('.wrap-content-banners .init-banner-slick');

                $slick.slick({
                    dots: true,
                    appendDots: wrapDots,
                    customPaging : function(slider, i) {
                        if (i > 9) {
                            return `<i> ${i+1} </i>`;
                        } else {
                            return `<i> 0${i+1} </i>`;
                        }
                    },
                    arrows: true,
                    prevArrow: $('.next-main-banner'),
                    nextArrow: $('.prev-main-banner'),
                    speed: 1200,
                    fade: true,
                    adaptiveHeight: false
                });


                $slick.on("beforeChange", function() {
                    const $itemTitle = itemBanner.find(".title-content-banner");
                    const $itemSubTitle = itemBanner.find(".subtitle-content-banner");
                    const $itemBtn = itemBanner.find("button.button");

                    $itemTitle.removeClass('fadeInTop');
                    $itemSubTitle.removeClass('fadeInTop');
                    $itemBtn.removeClass('fadeInTop');

                    $itemTitle.addClass('hide-banner-cont');
                    $itemSubTitle.addClass('hide-banner-cont');
                    $itemBtn.addClass('hide-banner-cont');
                });

                $slick.on("afterChange", function() {
                    let $itemActived = $('.item-banner.slick-active');
                    const $itemTitleActived = $itemActived.find(".title-content-banner");
                    const $itemSubTitleActived = $itemActived.find(".subtitle-content-banner");
                    const $itemBtnActived = $itemActived.find("button.button");

                    setTimeout(() => {
                        if (itemBanner.hasClass('slick-active')) {
                        $itemTitleActived.removeClass("hide-banner-cont");
                        $itemTitleActived.addClass("fadeInTop");
                    }
                }, 100);
                    setTimeout(() => {
                        if (itemBanner.hasClass('slick-active')) {
                        $itemSubTitleActived.removeClass("hide-banner-cont");
                        $itemSubTitleActived.addClass("fadeInTop");
                    }
                }, 500);
                    setTimeout(() => {
                        if (itemBanner.hasClass('slick-active')) {
                        $itemBtnActived.removeClass("hide-banner-cont");
                        $itemBtnActived.addClass("fadeInTop");
                    }
                }, 900);

                })

                $bar = $('.wrap-content-banners .slider-progress .progress');

                function startProgressbar() {
                    resetProgressbar();
                    percentTime = 0;
                    isPause = false;
                    tick = setInterval(interval, 45);
                }

                function interval() {
                    if (isPause === false) {
                        percentTime += 1 / (time + 0.1);
                        $bar.css({
                            width: percentTime + "%"
                        });
                        if (percentTime >= 100) {
                            $slick.slick('slickNext');

                            startProgressbar();
                        }
                    }
                }

                function resetProgressbar() {
                    $bar.css({
                        width: 0 + '%'
                    });
                    clearTimeout(tick);
                }

                startProgressbar();

                $('.wrap-content-banners .next-main-banner, .prev-main-banner').click(function() {
                    startProgressbar();
                });

                liDots = $(".slick-dots li");
                liDots.each(function(){
                    quantityLiDots += 1
                });

                if (quantityLiDots > 9) {
                    totalDots.html(`${quantityLiDots}`);
                } else {
                    totalDots.html(` 0${quantityLiDots}`);
                }

            },

            initActionSmallSlide() {
                const $container = $('.new-action-section');
                const $prevArrow = $container.find('.next-card');
                const $nextArrow = $container.find('.prev-card');


                var time = 1;
                var quantityLiDots = 0;
                var wrapDots = $container.find(".slick__nav");
                var totalDots = $container.find(".total-dots");

                var $bar,
                    $slick,
                    isPause,
                    tick,
                    liDots,
                    percentTime;

                $slick =  $container.find(".init-small-slide");

                $slick.slick({
                    infinite: true,
                    dots: true,
                    appendDots: wrapDots,
                    customPaging : function(slider, i) {
                        if (i > 8) {
                            return `<i> ${i+1} </i>`;
                        } else {
                            return `<i> 0${i+1} </i>`;
                        }
                    },
                    arrows: true,
                    prevArrow: $prevArrow,
                    nextArrow: $nextArrow,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    speed: 1200,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    touchMove: false,
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    draggable: false,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 468,
                            settings: {
                                touchMove: false,
                                pauseOnHover: false,
                                pauseOnFocus: false,
                                draggable: false,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: true
                            }
                        },
                    ]
                });

                // function beforeChangeOptions(event, currentSlide, nextSlide) {
                // }

                // function afterChangeOptions() {
                // }

                $('[data-slick-index="3"]').addClass('slick-now');
                $('[data-slick-index="4"]').addClass('slick-now');
                $('[data-slick-index="5"]').addClass('slick-now');

                // $slick.on('beforeChange', beforeChangeOptions);
                // $slick.on('afterChange', afterChangeOptions);

                $bar = $container.find('.slider-progress .progress');

                function startProgressbar() {
                    resetProgressbar();
                    percentTime = 0;
                    isPause = false;
                    tick = setInterval(interval, 45);
                }

                function interval() {
                    if (isPause === false) {
                        percentTime += 1 / (time + 0.1);
                        $bar.css({
                            width: percentTime + "%"
                        });
                        if (percentTime >= 100) {
                            $slick.slick('slickNext');

                            startProgressbar();
                        }
                    }
                }

                function resetProgressbar() {
                    $bar.css({
                        width: 0 + '%'
                    });
                    clearTimeout(tick);
                }

                startProgressbar();

                $(".next-card").click(function() {
                    startProgressbar();
                });
                $('.prev-card').click( function() {
                    startProgressbar();
                });

                liDots = $container.find(".slick-dots li");
                liDots.each(function(){
                    quantityLiDots += 1
                });

                if (quantityLiDots > 9) {
                    totalDots.html(`${quantityLiDots}`);
                } else {
                    totalDots.html(` ${quantityLiDots}`);
                }

            },

            initNewsSmallSlide() {
                const $container = $('.new-news-section');
                const $prevArrow = $container.find('.next-card');
                const $nextArrow = $container.find('.prev-card');

                var time = 1;
                var quantityLiDots = 0;
                var wrapDots = $container.find(".slick__nav");
                var totalDots = $container.find(".total-dots");

                var $bar,
                    $slick,
                    isPause,
                    tick,
                    liDots,
                    percentTime;

                $slick =  $container.find(".init-small-slide");

                $slick.slick({
                    infinite: true,
                    dots: true,
                    appendDots: wrapDots,
                    customPaging : function(slider, i) {
                        if (i > 8) {
                            return `<i> ${i+1} </i>`;
                        } else {
                            return `<i> 0${i+1} </i>`;
                        }
                    },
                    arrows: true,
                    prevArrow: $prevArrow,
                    nextArrow: $nextArrow,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    speed: 1200,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    touchMove: false,
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    draggable: false,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 468,
                            settings: {
                                touchMove: false,
                                pauseOnHover: false,
                                pauseOnFocus: false,
                                draggable: false,
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                    ]
                });



                // function beforeChangeOptions(event, currentSlide, nextSlide) {
                // let selectors = [nextSlide].map(n => `[data-slick-index="${n - 1}"]`).join(', ');
                // let selectors1 = [nextSlide].map(n => `[data-slick-index="${n + 3}"]`).join(', ');
                // let selectors2 = [nextSlide].map(n => `[data-slick-index="${n + 4}"]`).join(', ');

                // $('.slick-now').removeClass('slick-now');
                // $('.slick-now').removeClass('hidden');
                // $(selectors).addClass('slick-now');
                // $(selectors1).addClass('slick-now');
                // $(selectors2).addClass('slick-now');
                // }

                $('[data-slick-index="3"]').addClass('slick-now');
                $('[data-slick-index="4"]').addClass('slick-now');
                $('[data-slick-index="5"]').addClass('slick-now');

                // $slick.on('beforeChange', beforeChangeOptions);
                // $slick.on('afterChange', afterChangeOptions);

                $bar = $container.find('.slider-progress .progress');

                function startProgressbar() {
                    resetProgressbar();
                    percentTime = 0;
                    isPause = false;
                    tick = setInterval(interval, 45);
                }

                function interval() {
                    if (isPause === false) {
                        percentTime += 1 / (time + 0.1);
                        $bar.css({
                            width: percentTime + "%"
                        });
                        if (percentTime >= 100) {
                            $slick.slick('slickNext');

                            startProgressbar();
                        }
                    }
                }

                function resetProgressbar() {
                    $bar.css({
                        width: 0 + '%'
                    });
                    clearTimeout(tick);
                }

                startProgressbar();


                $(".next-card").click(function() {
                    startProgressbar();
                });

                $('.prev-card').click(function () {
                    startProgressbar();
                });

                liDots = $container.find(".slick-dots li");
                liDots.each(function(){
                    quantityLiDots += 1
                });

                if (quantityLiDots > 9) {
                    totalDots.html(`${quantityLiDots}`);
                } else {
                    totalDots.html(` 0${quantityLiDots}`);
                }

            },

            initReviewmainSlide() {
                const $container = $('.review-submission');
                const $prevArrow = $container.find('.next-card');
                const $nextArrow = $container.find('.prev-card');

                var time = 1;
                var quantityLiDots = 0;
                var wrapDots = $container.find(".slick__nav");
                var totalDots = $container.find(".total-dots");

                var $bar,
                    $slick,
                    isPause,
                    tick,
                    liDots,
                    percentTime;

                $slick =  $container.find(".init-review-slide");

                $slick.slick({
                    dots: true,
                    appendDots: wrapDots,
                    customPaging : function(slider, i) {
                        if (i > 8) {
                            return `<i> ${i+1} </i>`;
                        } else {
                            return `<i> 0${i+1} </i>`;
                        }
                    },
                    arrows: true,
                    prevArrow: $prevArrow,
                    nextArrow: $nextArrow,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    speed: 1200,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    touchMove: false,
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    draggable: false,

                });

                $bar = $container.find('.slider-progress .progress');

                function startProgressbar() {
                    resetProgressbar();
                    percentTime = 0;
                    isPause = false;
                    tick = setInterval(interval, 45);
                }

                function interval() {
                    if (isPause === false) {
                        percentTime += 1 / (time + 0.1);
                        $bar.css({
                            width: percentTime + "%"
                        });
                        if (percentTime >= 100) {
                            $slick.slick('slickNext');

                            startProgressbar();
                        }
                    }
                }

                function resetProgressbar() {
                    $bar.css({
                        width: 0 + '%'
                    });
                    clearTimeout(tick);
                }

                startProgressbar();


                $(".next-card").click(function() {
                    startProgressbar();
                });

                $('.prev-card').click(function () {
                    startProgressbar();
                });

                liDots = $container.find(".slick-dots li");
                liDots.each(function(){
                    quantityLiDots += 1
                });

                if (quantityLiDots > 9) {
                    totalDots.html(`${quantityLiDots}`);
                } else {
                    totalDots.html(` 0${quantityLiDots}`);
                }
            },

            visibilityQestionsItem() {
                $qestionsItems.each( function() {
                    const el = $(this);
                    const $btnEl = el.find(".header-item");
                    const $btnClose = el.find(".icon-wrap-block");
                    $btnEl.on("click", function() {
                        el.toggleClass("active");
                        if (!el.find(".info-drop-questions").is(':visible')) {
                            el.find(".info-drop-questions").slideDown();
                        } else {
                            el.find(".info-drop-questions").slideUp();
                        }
                    });
                    $btnClose.on("click", function() {
                        const $container = $(this).closest(".questions-item")
                        const $dropInfo = $container.find(".info-drop-questions");
                        if(el.hasClass("active")) {
                            $container.removeClass("active");
                            $dropInfo.slideUp();
                        } else {
                            $container.addClass("active");
                            $dropInfo.slideDown();
                        }
                    });

                });
            },

            handlerActivedModalReview() {
                $btnModalReview.on("click", function() {
                    $(".review-modal").show();
                });
                $(".btn-close-modal").on("click", function() {
                    $(".review-modal").hide()
                });
                $btnModalService.on("click", function(e) {
                    e.preventDefault();
                    $('#service_id').val($(this).attr('data-servicesId'));
                    $(".service-modal").show();
                });
                $(".btn-close-modal").on("click", function() {
                    $(".service-modal").hide()
                });
            },

            handlerHideOverlay() {
                $(".overlay_js").on("click", function() {
                    $overlayContainer.hide();
                    if (callbackDropPopap.matches('.active')) {
                        callbackDropPopap.classList.remove("active");
                    };
                });

                $(".overlay_modal").on("click", function() {
                    $(".modal-el").hide();
                });
            },

            maskTelNum() {
                if ( ! $('input[type=tel]').length ) return;

                const $inputTelephs = $('input[type=tel]');
                for (let i = 0; i < $inputTelephs.length; i++) {
                    let cleave = new Cleave($inputTelephs[i], {
                        numericOnly: true,
                        blocks: [0, 3, 0, 3, 2, 2],
                        delimiters: ["(", ")", " ", "-"],
                    });
                }

            },

            handlerActivedCalculateTab() {
                // const arrIdForm = [];
                // const $calculatorWrapForm = $(".calculatorWrapForm");
                // const $formCalc
                // $calculatorWrapForm.find("form").attr("id");
                // console.log(arrIdForm);
                // function visibleForm(el) {
                //   let dataId = "";
                //   // if () {

                //   // }
                // }

                /*    $calcTab.each(function() {
                     $calcTab.on("click", function() {
                       $calcTab.removeClass("activeTab");
                       $(this).addClass("activeTab");

                       // dataId = $(this).attr("data-id");
                       // if (dataId)
                       // console.log(dataId);
                     });
                   }); */
            },

            activedDepartmentsBlock() {
                const tabBlock1 = $("#tabBlock1");
                const tabBlock2 = $("#tabBlock2");
                $("button.category").each(function() {
                    const $tab = $(this);
                    let $toggleId = "tabBlock1";
                    $tab.on("click", function() {
                        $("button.category").removeClass("active");
                        $tab.addClass("active");
                        $toggleId = $tab.attr("data-target");
                        if ($toggleId === "tabBlock1") {
                            tabBlock2.removeClass("active");
                            tabBlock1.addClass("active");
                        } else if ($toggleId === "tabBlock2") {
                            tabBlock1.removeClass("active");
                            tabBlock2.addClass("active");
                        }
                    });

                });
            },

            handlerHeightCardProduct() {

                const $cardBlocks = $(".el-card  .content-card");
                const $arrElements = [];
                let rowArr = [];
                let $flag = 0;

                for (let i = 0; i < $cardBlocks.length; i++) {
                    const $element = $cardBlocks[i];
                    const $top = $element.getBoundingClientRect().top;

                    if (i === 0) $flag = $top;

                    if ($flag === $top) {
                        rowArr.push($element);
                    }

                    if ($flag !== $top) {
                        $arrElements.push(rowArr);

                        rowArr = [];

                        $flag = $top;
                        rowArr.push($element);
                    }

                    if (i === $cardBlocks.length - 1) {
                        $arrElements.push(rowArr);
                    }

                }

                $arrElements.forEach((rowArr) => {
                    const $rowArr = $(rowArr);

                var mh = 0;
                $rowArr.each(function () {
                    var h_block = parseInt($(this).height());
                    if(h_block > mh) {
                        mh = h_block;
                    };

                });
                $rowArr.height(mh);
            })


            },

            handlerVisibleSelect() {
                //   $(".select").each(function() {
                // const $btnSel = $(".select");
                // $(".select").on("click", function() {
                // const sel = $btnSel.find("select")
                // $("select").trigger("mousedown");
                // $(this).find("select").trigger( event );
                // open($('#city_id'));
                // });
                // });
                //   function open(elem) {
                //     if (document.createEvent) {
                //         var e = document.createEvent("MouseEvents");
                //         e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                //         elem[0].dispatchEvent(e);
                //         console.log(dispatchEvent(e));
                //     } else if (element.fireEvent) {
                //         elem[0].fireEvent("onmousedown");
                //     }
                // }

                // window.addEventListener('DOMContentLoaded', () => {
                //   openSelect('.select', 'select')
                // })

                // const openSelect = (triggerSelector, selectSelector) => {
                //   const trigger = document.querySelector(triggerSelector) // Достаем нужные елементы
                //   const select = document.querySelector(selectSelector)
                //   let selectSize = select.options.length // сохраняем первоначальное количество елементов в селекте
                //   trigger.addEventListener('click', () => {
                //     select.focus()
                //     select.size = selectSize //по клику выставляем высоту селекта
                //   })

                //   select.addEventListener('blur', () => {
                //     select.size = 1 // тут сбрасываем обратно
                //   })
                // }

            },

            domReady() {
                departmentsLocationInMap();
                fn.toggleScrollTopButton();
                fn.handlerScrollTopPage();
                fn.visibleViewportContent();
                fn.maskTelNum();
                fn.handlerHideOverlay();
                fn.initSlickSliderMainBanner();

                if (document.querySelectorAll('.menu-btn').length > 0 && document.documentElement.clientWidth < 1169) {
                    fn.handlerActiveHamburgerMenu();
                }

                if (document.documentElement.clientWidth > 1169) {
                    fn.activedDropDownSubMenuNavItem();
                    fn.activedDropDownPopapCallbackHeader();
                }

                if ($(".new-action-section").length)
                    fn.initActionSmallSlide();

                if ($(".new-news-section").length)
                    fn.initNewsSmallSlide();

                if ($(".common-questions-wrap-list").length)
                    fn.visibilityQestionsItem();

                if ($(".review-submission").length) {
                    fn.handlerActivedModalReview();
                    fn.initReviewmainSlide();
                }

                if ($(".office-departments").length) {
                    fn.activedDepartmentsBlock();
                }
                // if ($(".calculatorWrapForm").length)
                //   fn.handlerActivedCalculateTab();

                if ($(".select").length)
                    fn.handlerVisibleSelect();

                if ($('.el-card').length)
                    fn.handlerHeightCardProduct();

                if ($('.callback-content-forms').length)
                    fn.ajaxFormCallback();

                if ($('.service-modal .callback-content-forms').length)
                    fn.ajaxFormFeedback();

                if ($('.modal-el').length)
                    fn.ajaxFormReview();
                // if ($mapSection.length) {
                // fn.initMapContactPage();
                // }

                // if ($(".calc-form").length) {
                // fn.initNoUiSlideBottom();
                // fn.isFillCheckInputs();
                // }

                // if ( $('meta[name="csrf-token"]').length )
                // fn.initAjaxHeaders();

                // if ( $forms.length )
                // fn.handleCalc();

            }
        }

        dom.addEventListener("DOMContentLoaded", fn.domReady());

        return fn;

    })();
    ValidationModule = (function() {

        function validate(inputElement, validationsArray) {
            const validations = validationsArray;
            let messages = [];

            function isNumber(input) {
                return !isNaN(parseFloat(input.value)) && isFinite(input.value);
            }

            function isNumberSecondary(input) {
                var value = input.value;
                var regEx = /[^0-9|.|,]/g;
                var prepearedValue = value.replace(regEx, "")

                return prepearedValue;
            }

            function isPhoneNumber(input) {
                var value = input.value;
                var regEx =/\D/g;
                var prepearedValue = value.replace(regEx, "")
                var isNumber = !isNaN(parseFloat(prepearedValue)) && isFinite(prepearedValue);
                var isPhone = prepearedValue.length == 12 ? true : false;

                return isNumber && isPhone;
            }

            function isEmail(input) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                return regex.test(input.value);
            }

            function isNotEmpty(input) {
                let isNotEmpty = input.value.replace(/\s/g,"").length ? true : false;
                let isNotWrongVal = input.value == "placeholder" ? false : true;
                return isNotEmpty && isNotWrongVal;
            }

            function isRadioChecked(input) {
                return input.querySelectorAll('input:checked').length ? true : false;
            }

            function isChecked(input) {
                return input.checked ? true : false;
            }

            function isShort(input) {
                let value = input.value;
                let splitArr = value.split('');
                return splitArr.length <= 3 ? false : true;
            }



            // ---------------------

            for (let i = 0; i < validations.length; i++) {

                switch (validations[i]) {
                    case 'required':
                        if ( !isNotEmpty(inputElement) ) {
                            messages.push(inputElement.dataset.errorText)
                        }
                        break;

                    case 'isNumber':
                        if ( !isNumber(inputElement) ) {
                            messages.push(inputElement.dataset.errorText)
                        }
                        break;

                    case 'isNumberSecondary':
                        if ( !isNumberSecondary(inputElement) ) {
                            messages.push(inputElement.dataset.errorText)
                        }
                        break;

                    case 'isPhoneNumber':
                        if ( !isPhoneNumber(inputElement) ) {
                            // messages.push(inputElement.dataset.errorText)
                            messages.push('неправильный номер телефона')
                        }
                        break;

                    case 'isEmail':
                        if ( !isEmail(inputElement) ) {
                            messages.push(inputElement.dataset.errorText);
                        }
                        break;

                    case 'requiredRadio':
                        if ( !isRadioChecked(inputElement) ) {
                            messages.push(inputElement.dataset.errorText)
                        }
                        break;

                    case 'requiredCheck':
                        if ( !isChecked(inputElement) ) {
                            messages.push(inputElement.dataset.errorText)
                        }
                        break;

                    case 'isShort':
                        if ( !isShort(inputElement) ) {
                            messages.push(inputElement.dataset.errorText);
                        }
                        break;

                    default: console.error('invalid input data-validate value')

                }
            }
            // console.log(messages.length ? messages : null)
            return messages.length ? messages : null;
        }

        function showWarning(inputElement, messages, textColor) {
            inputElement.classList.add('js_containsError');
            let warningList = $('<ul class="js_warning-list"></ul>');

            for (let i = 0; i < messages.length; i++) {
                let listElement = $("<li></li>").text(messages[i]);
                textColor ? listElement.css('color', textColor) : null;
                warningList.append(listElement)
            }

            if (inputElement.nextElementSibling) {
                inputElement.nextElementSibling.tagName == 'LABEL' ?
                    $(inputElement.nextElementSibling).after(warningList) :
                    $(inputElement).after(warningList);
            } else {
                $(inputElement).after(warningList);
            }
        }

        function isValid(formElement) {
            const form = formElement instanceof jQuery ? formElement[0] : formElement;
            const inputs = form.querySelectorAll('[data-validate]');
            const checkboxesCheckedLength = form.querySelectorAll('[type=checkbox][data-validate-checkbox]:checked').length;
            const checkboxes = form.querySelectorAll('[type=checkbox][data-validate-checkbox]:not(:disabled)');

            let errorsCounter = 0;

            for (let i = 0; i < inputs.length; i++) {
                let errorMessages = [];
                let textColor = inputs[i].dataset.textColor;

                $(inputs[i]).removeClass("js_containsError");
                $(inputs[i]).siblings('.js_warning-list').remove();

                let validationsArray = [];
                let inputData = inputs[i].dataset.validate ? inputs[i].dataset.validate.split(' ') : false;
                // ---------
                inputs[i].value ? inputs[i].value = inputs[i].value.trim() : null;
                // ---------

                validationsArray = inputData ? inputData : null;
                // inputs[i].required ? validationsArray.push('required') : null;

                if (validationsArray.length) {
                    let validationResult = validate(inputs[i], validationsArray);
                    validationResult ? errorMessages = validationResult : null;
                }

                if (errorMessages.length) {
                    showWarning(inputs[i], errorMessages, textColor);
                    errorsCounter++;
                }
            }

            if ( checkboxes.length ) {
                const lastCheckbox = checkboxes[checkboxes.length - 1];

                function isValidCheckboxes() {
                    $(lastCheckbox).siblings('.js_warning-list').remove();

                    if ( !checkboxesCheckedLength ) {
                        let errorMessages = [];
                        errorMessages.push(lastCheckbox.dataset.errorText);

                        showWarning(lastCheckbox, errorMessages);
                        errorsCounter++;
                    }
                }
                isValidCheckboxes();
            }


            return errorsCounter > 0 ? false : true;
            console.log('end for');
        }

        // ---------------
        return {
            isValid: isValid,
        }
    })();

});
// $(window).on("load", function() {
// let $cityItems = $('.chosen-results');

// $cityItems.on('click', function(e) {
//   // loadLocations();
//   console.log(e.target);
//   initMap();
//   locationZoom({lat: 47.857599, lng: 35.104645});
// });

// // loadLocations();

// // delete
// let locations = [
//   { lat: 47.857599, lng: 35.104645, title: 'hey', description: 'hey', address_ru: 'г. Запорожье, пр. Соборний, 181', phone: '(067) 617-41-42', time: 'Пн-Вс, 8:00-20:00', more: 'Подробнее...', image: 'img/lombard_metall_1.jpg', number: '№55' },
//   { lat: 47.858599, lng: 35.124645, title: 'fifafo', description: 'fifafo', address_ru: 'г. Запорожье, пр. Соборний, 181', phone: '(067) 617-41-42', time: 'Пн-Вс, 8:00-20:00', more: 'Подробнее...', image: 'img/lombard_metall_2.jpg', number: '№143' },
//   { lat: 48.857599, lng: 34.104645, title: 'elo', description: 'ole', address_ru: 'г. Запорожье, пр. Соборний, 181', phone: '(067) 617-41-42', time: 'Пн-Вс, 8:00-20:00', more: 'Подробнее...', image: 'img/lombard_metall_3.jpg', number: '№245' },
//   { lat: 49.857599, lng: 36.104645, title: 'raz', description: 'raz', address_ru: 'г. Запорожье, пр. Соборний, 181', phone: '(067) 617-41-42', time: 'Пн-Вс, 8:00-20:00', more: 'Подробнее...', image: 'img/Gulyajpole-276x300.jpg', number: '№3' },
// ];
// initMap(locations);
// // end delete
// });

window.onload = function () {


    var countersList = $('.section-pictorial-val-wrap');
    var counterBlocks = $('.pictorial-section .i-num');

    function formateNumber(number) {
        var numStr = number + '';
        return numStr.replace(new RegExp("^(\\d{" + (numStr.length%3?numStr.length%3:0) + "})(\\d{3})", "g"), "$1 $2").replace(/(\d{3})+?/gi, "$1 ").trim();
    };

    function startCounting(counterElements) {
        counterElements.each(function() {
            // console.log(counterElements);
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({ countNum: 0 }).animate(
                { countNum: countTo, formatedNum: countTo },
                {
                    duration: 2000,
                    step: function() {
                        var num = Math.floor(this.countNum);
                        this.formatedNum = formateNumber(num);
                        $this.text(this.formatedNum)
                    },
                    complete: function() {
                        var num = Math.floor(this.countNum);
                        this.formatedNum = formateNumber(num);
                        $this.text(this.formatedNum)
                    }
                }
            );
        });
    };

    function isVisible(tag, option) {
        let opt;
        option ? opt = option : opt = "whole";
        var t = $(tag);
        var w = $(window);
        var wt = w.scrollTop();
        var tt = t.offset().top;
        var tb = tt + t.height();

        if (opt == "whole") {
            if (document.documentElement.clientWidth > 991) {
                return (tb <= wt + w.height()) && (tt >= wt);
            } else {
                return ( tt <= (wt + w.height() / 2) ) && (tt >= wt);
            }
        }

        if (opt == "topBorder") {
            return tt <= wt + w.height() - 89;
        }
    };

    if (countersList.length) {
        if (!countersList.prop("shown") && isVisible(countersList)) {
            countersList.prop("shown", true);
            startCounting(counterBlocks);
        }
    }
    $(window).scroll(function () {

        if (countersList.length) {
            if (!countersList.prop("shown") && isVisible(countersList)) {
                countersList.prop("shown", true);
                startCounting(counterBlocks);
            }
        }
    });
    $('a[href*="#"]')
    // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            event.preventDefault();
            if($('.nav').hasClass('nav-open'))
            {
                let line1 = $(".line--1");
                let line2 = $(".line--2");
                let line3 = $(".line--3");
                $(".nav").toggleClass("nav-open");
                line1.toggleClass("line-cross");
                line2.toggleClass("line-fade-out");
                line3.toggleClass("line-cross");
                $(".header-nav-list").toggleClass("fade-in");
            }
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
                else
                {
                    window.location.href = '/';
                }
            }
        });
};
