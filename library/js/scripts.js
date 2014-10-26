/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

/* global min_width */

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
  window.getComputedStyle = function(el) {
    this.el = el;
    this.getPropertyValue = function(prop) {
      var re = /(\-([a-z]){1})/g;
      if (prop === 'float') {prop = 'styleFloat';}
      if (re.test(prop)) {
        prop = prop.replace(re, function () {
          return arguments[2].toUpperCase();
        });
      }
      return el.currentStyle[prop] ? el.currentStyle[prop] : null;
    };
    return this;
  };
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

  /*
  Responsive jQuery is a tricky thing.
  There's a bunch of different ways to handle
  it, so be sure to research and find the one
  that works for you best.
  */
  
  /* getting viewport width */
  var resize = function() {
  
    /* if is below 481px */
    if (min_width('30.0625em')) {
    
    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (min_width('30.0625em')) {
      
    } /* end larger than 481px */
    
    /* if is above or equal to 768px */
    if (min_width('48em')) {
    
      /* load gravatars */
      $('.comment img[data-gravatar]').each(function(){
        if (!$(this).attr('src')) {
          $(this).attr('src',$(this).attr('data-gravatar'));
        }
      });
      
    }
    
    /* iPad landscape and larger */
    if (min_width('64em')) {
      
    }

    // Adjust menu top position:
    // I dont understand this section here
    //$('.nav').css('top', $('.nav').prev().outerHeight());
    
  };
  $(window).resize(resize);
  resize();
  
  
  // add all your scripts here
  
	/*

		//This makes all links that start with # scrolling links
		$('a[href^="#"]').on('click',function (e) {
			e.preventDefault();
			var target = this.hash,
			$target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top - 100
			}, 900, 'swing', function () {
			window.location.hash = target - 100;
			});
		});
		
		//back to top link scrolls back to the top of the page
		$(".BackToTop").click(function() {
			$('html, body').animate({scrollTop: 0}, 1000);
		});


	*/

}); /* end of as page load scripts */

// This function swaps out all .svg files and replaces them with .png files. Not ideal if you don't support PNG aswell, but you can't get transparencies with jpgs.

function supportsSVG() {
    return !! document.createElementNS && !! document.createElementNS('http://www.w3.org/2000/svg','svg').createSVGRect;
}
if (!supportsSVG()) {
    var imgs = document.getElementsByTagName('img');
    var dotSVG = /.*\.svg$/;
    for (var i = 0; i !== imgs.length; ++i) {
        if(imgs[i].src.match(dotSVG)) {
            imgs[i].src = imgs[i].src.slice(0, -3) + 'png';
        }
    }
}

/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
  // This fix addresses an iOS bug, so return early if the UA claims it's something else.
  if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
  var doc = w.document;
  if( !doc.querySelector ){ return; }
  var meta = doc.querySelector( "meta[name=viewport]" ),
    initialContent = meta && meta.getAttribute( "content" ),
    disabledZoom = initialContent + ",maximum-scale=1",
    enabledZoom = initialContent + ",maximum-scale=10",
    enabled = true,
    x, y, z, aig;
  if( !meta ){ return; }
  function restoreZoom(){
    meta.setAttribute( "content", enabledZoom );
    enabled = true; }
  function disableZoom(){
    meta.setAttribute( "content", disabledZoom );
    enabled = false; }
  function checkTilt( e ){
    aig = e.accelerationIncludingGravity;
    x = Math.abs( aig.x );
    y = Math.abs( aig.y );
    z = Math.abs( aig.z );
    // If portrait orientation and in one of the danger zones
    if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
      if( enabled ){ disableZoom(); } }
    else if( !enabled ){ restoreZoom(); } }
  w.addEventListener( "orientationchange", restoreZoom, false );
  w.addEventListener( "devicemotion", checkTilt, false );
})( this );