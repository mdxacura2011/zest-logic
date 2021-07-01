define([
    'jquery',
    'owlcarousel'
], function ($) {
    'use strict';

    return function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            autoplay: 3000,
        });
    };
});
