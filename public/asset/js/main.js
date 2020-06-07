"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

$(document).ready(function () {
  // $(window).on('load resize', function () {
  //   $('.btn-md-lg').toggleClass('btn-lg', $(window).width() > 767)
  // })
  var btn = $('#backToUp');
  $(window).scroll(function () {
    if ($(window).scrollTop() > 100) {
      btn.addClass('show');
    } else {
      btn.removeClass('show');
    }
  });
  btn.on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({
      scrollTop: 0
    }, '300');
  });

  function setActiveVideo(index) {
    var active_iframe = $('.videos-active__iframe');
    var active_title = $('.videos-active__title');
    var active_date = $('.videos-active__date span');
    var video = $('.se-videos-items .videos-item').eq(index);
    var video_title = video.find('.videos-item__title');
    var video_date = video.find('.videos-item__date span');
    active_iframe.attr('src', video.attr('href'));
    active_title.text(video_title.text());
    active_date.text(video_date.text());
  }

  $('.se-videos-items .videos-item').click(function (e) {
    e.preventDefault();
    setActiveVideo($(this).index());
  });
  setActiveVideo(0);
  $('.search-toggle').click(function (e) {
    $('.search-box input').focus();
    $('.search-box').toggleClass('active');
    e.preventDefault();
  });
  $('.search-box__bg').click(function (e) {
    $('.search-box').removeClass('active');
    e.preventDefault();
  });
  $('.search-box__close').click(function (e) {
    $('.search-box').removeClass('active');
    e.preventDefault();
  });
  $('.header .navbar-collapse').on('show.bs.collapse', function () {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    $('body').addClass('navbar-opened');
  });
  $('.header .navbar-collapse').on('hidden.bs.collapse', function () {
    $('body').removeClass('navbar-opened');
  });
  var slHome = new Swiper('.sl-home .swiper-container', {
    navigation: {
      nextEl: '.sl-home .next',
      prevEl: '.sl-home .prev'
    },
    effect: 'fade',
    speed: 500,
    slidesPerView: 1,
    watchSlidesVisibility: true,
    watchSlidesProgress: true
  });
  var slNews = new Swiper('.sl-news .swiper-container', {
    navigation: {
      nextEl: '.sl-news .slider-button-next',
      prevEl: '.sl-news .slider-button-prev'
    },
    spaceBetween: 30,
    slidesPerView: 1,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {
      576: {
        slidesPerView: 2
      },
      768: {
        slidesPerView: 3
      },
      992: {
        slidesPerView: 4
      }
    }
  });
  var slNewsletters = new Swiper('.sl-newsletters .swiper-container', {
    navigation: {
      nextEl: '.sl-newsletters .slider-button-next',
      prevEl: '.sl-newsletters .slider-button-prev'
    },
    spaceBetween: 30,
    slidesPerView: 1,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {
      992: {
        slidesPerView: 2
      }
    }
  });
  var slInterviews = new Swiper('.sl-interviews .swiper-container', {
    navigation: {
      nextEl: '.sl-interviews .slider-button-next',
      prevEl: '.sl-interviews .slider-button-prev'
    },
    spaceBetween: 30,
    slidesPerView: 1,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {
      992: {
        slidesPerView: 2
      }
    }
  });
  new Swiper('#sliderDetail', {
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    navigation: {
      nextEl: '#sliderDetail .swiper-button-next',
      prevEl: '#sliderDetail .swiper-button-prev'
    }
  });
});
/*!
 * c-share.js v1.0.0
 * https://github.com/ycs77/jquery-plugin-c-share
 *
 * Copyright 2019 Chen-shin, Yang
 * Released under the MIT license
 *
 * Date: 2019-01-11T08:41:34.048Z
 */

(function (global, factory) {
  (typeof exports === "undefined" ? "undefined" : _typeof(exports)) === 'object' && typeof module !== 'undefined' ? factory() : typeof define === 'function' && define.amd ? define(factory) : factory();
})(void 0, function () {
  'use strict';

  if ($.fn) {
    $.fn.cShare = function (options) {
      var _this = this;

      var defaults = {
        description: '',
        show_buttons: ['fb', 'gPlus'],
        data: {
          fb: {
            "class": 'bg-facebook',
            fa: 'fab fa-facebook-f',
            name: 'Fb',
            href: function href(url) {
              return 'https://www.facebook.com/sharer/sharer.php?u=' + url;
            },
            show: true
          },
          twitter: {
            "class": 'bg-twitter',
            fa: 'fab fa-twitter',
            name: 'Twitter',
            href: function href(url, description) {
              return 'https://twitter.com/intent/tweet?original_referer=' + url + '&url=' + url + '&text=' + description;
            },
            show: false
          },
          linkedin: {
            "class": 'bg-linkedin',
            fa: 'fab fa-linkedin',
            name: 'LinkedIn',
            href: function href(url, description) {
              return 'https://www.linkedin.com/shareArticle?mini=true&url=' + url + '&url=' + url + '&summary=' + description;
            },
            show: false
          },
          whatsapp: {
            "class": 'bg-whatsapp',
            fa: 'fab fa-whatsapp',
            name: 'Whatsapp',
            href: function href(url, description) {
              return 'whatsapp://send?text=' + encodeURIComponent(url + ' ' + description);
            },
            show: false
          },
          pinterest: {
            "class": 'bg-pinterest',
            fa: 'fab fa-pinterest-p',
            name: 'Pinterest',
            href: function href(url, description) {
              return 'http://pinterest.com/pin/create/button/?url=' + url + '&description=' + description + ' ' + url;
            },
            show: false
          },
          email: {
            "class": 'bg-language',
            fa: 'fas fa-envelope',
            name: 'E-mail',
            href: function href(url, description) {
              return 'mailto:?subject=' + description + '&body=' + description + ' ' + url;
            },
            show: false
          }
        },
        spacing: 6
      };
      var href = location.href.replace(/#\w/, '');
      var mobile = navigator.userAgent.match(/(mobile|android|pad)/i);
      var settings = $.extend({}, defaults, options);

      if (options) {
        settings.data = $.extend({}, defaults.data, options.data);
      }

      settings.show_buttons.forEach(function (shareName) {
        var item = settings.data[shareName];

        _this.append('\n<a class="socials-item ' + item["class"] + '" href="' + item.href.call(null, href, settings.description) + '" title="Share On ' + item.name + '" target="_blank" data-icon="' + shareName + '"><i class="' + item.fa + '"></i></a>\n');
      });
      this.find('a').click(function (e) {
        if (!mobile) {
          e.preventDefault();
          window.open($(this).attr('href'), '_blank', 'height=600,width=500');
        }
      });
      return this;
    };
  }
});

$('#share').cShare({
  description: $('title').text(),
  show_buttons: ['fb', 'twitter', 'pinterest', 'whatsapp', 'linkedin', 'email']
});