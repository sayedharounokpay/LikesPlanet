    //If using image buttons as controls, Set image buttons' image preload here true
    //(use false for no preloading and for when using no image buttons as controls):

    var preload_ctrl_images=true;

    //And configure the image buttons' images here:

    var previmg='http://likesplanet.com/img/ico_16.png';
    var stopimg='http://likesplanet.com/img/ico_16.png';
    var playimg='http://likesplanet.com/img/ico_16.png';
    var nextimg='http://likesplanet.com/img/ico_16.png';

    var slideShow=[]; // SLIDESHOW

    //configure the below images and descriptions to your own, note optional links, target and window specifications.

    slideShow[0] = ["logo.jpg", "aaa", "http://www.2webvideo.com", "_new", "top=250, left=300, width=500, height=300, location, resizable, scrollbars"];
slideShow[1] = ["logo.jpg", "bbb"];
slideShow[2] = ["logo.jpg", "ccc", "http://www.yahoo.com"];
slideShow[3] = ["logo.jpg", "ddd", "http://www.google.com", "_new"];
slideShow[4] = ["logo.jpg", "eee"];
slideShow[5] = ["logo.jpg", "fff", "http://www.bing.com", "_new"];

    //optional properties for these images:

    slideShow.no_descriptions=0; //use for no descriptions displayed
    slideShow.pause=1; //use for pause onmouseover
    slideShow.image_controls=1; //use images for controls
    slideShow.button_highlight='#ffcccc'; //onmouseover background-color for image buttons (requires image_controls=1)
    slideShow.specs='width=300, height=250' //global specifications for this show's new window(s)
    slideShow.random=0; //set a random slide sequence on each page load
    slideShow.manual_start=1; //start show in manual mode (stopped)
    slideShow.delay=2000; //sets miliseconds delay between slides
    slideShow.no_added_linebreaks=1; //use for not adding line breaks in formatting of texts and controls
