<?php

define('PAGINATION_COUNT',15);

//thiis help us reduce code to change admin panel from righ to left when it comes to arabic and other langauges
function getFolder(){
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

//another of getting the default lang which is valide for all langs
function getAllLangs(){
    return \Mcamara\LaravelLocalization\LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'css-rtl' : 'css';
}
//of just calling this direct in lang variable in html
//lang ="{{app()->getLocale()}}" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}"
