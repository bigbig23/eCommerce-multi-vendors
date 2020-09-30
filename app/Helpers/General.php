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


//saving photo
function savePhoto($folder,$image){
    $image->store('/', $folder);//to save it only ex brands file
    $filename = $image->hashName();//to hash like _ plus the photo
    //$path = 'images/' . $folder . '/' . $filename;
    return  $filename;
}

function saveImage($photo, $path){
    $file_extension = $photo->getClientOriginalExtension();
    $file_name = time().'.'.$file_extension;
    $photo->move($path, $file_name);
    return $file_name;
}


