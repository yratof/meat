/*
Bones Scripts Enhancements
Author: Forsvunnet

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

/************************
Create all ie elements.
*************************/

(function(l,f){function m(){var a=e.elements;return"string"===typeof a?a.split(" "):a}function i(a){var b=n[a[o]];b||(b={},h++,a[o]=h,n[h]=b);return b}function p(a,b,c){b||(b=f);if(g)return b.createElement(a);c||(c=i(b));b=c.cache[a]?c.cache[a].cloneNode():r.test(a)?(c.cache[a]=c.createElem(a)).cloneNode():c.createElem(a);return b.canHaveChildren&&!s.test(a)?c.frag.appendChild(b):b}function t(a,b){if(!b.cache)b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag();
a.createElement=function(c){return!e.shivMethods?b.createElem(c):p(c,a,b)};a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){b.createElem(a);b.frag.createElement(a);return'c("'+a+'")'})+");return n}")(e,b.frag)}function q(a){a||(a=f);var b=i(a);if(e.shivCSS&&!j&&!b.hasCSS){var c,d=a;c=d.createElement("p");d=d.getElementsByTagName("head")[0]||d.documentElement;c.innerHTML="x<style>article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}</style>";
c=d.insertBefore(c.lastChild,d.firstChild);b.hasCSS=!!c}g||t(a,b);return a}var k=l.html5||{},s=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,r=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,j,o="_html5shiv",h=0,n={},g;(function(){try{var a=f.createElement("a");a.innerHTML="<xyz></xyz>";j="hidden"in a;var b;if(!(b=1==a.childNodes.length)){f.createElement("a");var c=f.createDocumentFragment();b="undefined"==typeof c.cloneNode||
"undefined"==typeof c.createDocumentFragment||"undefined"==typeof c.createElement}g=b}catch(d){g=j=!0}})();var e={elements:k.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:"3.7.0",shivCSS:!1!==k.shivCSS,supportsUnknownElements:g,shivMethods:!1!==k.shivMethods,type:"default",shivDocument:q,createElement:p,createDocumentFragment:function(a,b){a||(a=f);
if(g)return a.createDocumentFragment();for(var b=b||i(a),c=b.frag.cloneNode(),d=0,e=m(),h=e.length;d<h;d++)c.createElement(e[d]);return c}};l.html5=e;q(f)})(this,document);

/************************
Meat Script begins.
*************************/

(function($, w){
  // A helper function to measure heights
  // If you're using borders or outlines
  var map_height = function (index, element) {
    return $(this).outerHeight();
  };
  // Equalise heights
  var equalise = function(element, group_size) {
    // Reset element height
    element.height('');

    // Group results
    if (group_size === undefined) { group_size = 0; }

    if (group_size == 1) {
      return;
    }
    var groups = [];
    if (group_size) {
      // Not a clone, but a different object of with the same selection
      var clone = $(element);
      while (clone.length > 0) {
        groups.push($(clone.splice(0, group_size)));
      }
    }
    else {
      groups = [element];
    }

    // Measure the heights and then apply the highest measure to all
    var heights, height;
    for (var i in groups) {
      heights = groups[i].map(map_height).get();
      height = Math.max.apply(null, heights);
      groups[i].height(height);
    }
  };
  // Expose:
  w.equalise = equalise;

  // Add jQuery plugin
  $.fn.equalise = function(size) {
    equalise(this, size);
    return this;
  };

  // Determine if an url is external:
  var is_external = function () {
    var url = this;
    return (url.hostname && url.hostname.replace(/^www\./, '') !== location.hostname.replace(/^www\./, ''));
  };
  // Expose:
  w.is_external = is_external;


  // Min width detection
  var min_width;
  if (Modernizr.mq('(min-width: 0px)')) {
    // Browsers that support media queries
    min_width = function (width) {
      return Modernizr.mq('(min-width: ' + width + ')');
    };
  }
  else {
    // Fallback for browsers that does not support media queries
    min_width = function (width) {
      return jQuery(window).width() >= width;
    };
  }
  // Expose:
  w.min_width = min_width;
})(jQuery, window);

// as the page loads, call these scripts
jQuery(document).ready(function($) {

  // Menu (button) script:
  $('body').addClass('js');
  var menu_button = $('<p>').addClass('clickable mobile-only'); //.text(window.main_nav_name || ''); <-- This adds the name of the navigation to the nav on mobile
  var menu_icon = '<div class="menu-icon"><div></div><div></div><div></div></div>';
  menu_button.append(menu_icon);
  $('.nav').before(menu_button);

  $('.clickable, .nav a').click(function(event) {
    if (min_width(768)) { return; }
    var sub = $(this).next();
    if (event.which === 1 && sub.length && sub[0].nodeName.toLowerCase() == 'ul') {
      if (this.nodeName.toLowerCase() == 'p' || !sub.hasClass('show')) {
        sub.toggleClass('show');
        return false;
      }
    }
  });
 
  if(!Modernizr.svg) {
    // Replace svg file-extention with png.
    // Note: This is only for browsers that does not support svg
    // and therefore if there is no png available it will not make a difference
    // it will appear just as broken as before.
    $('img[src$=".svg"]').attr('src', function() {
        return $(this).attr('src').replace('.svg', '.png');
    });
  }

  // Give external links a class
  $('a').filter(is_external)
    .addClass('external')
    .attr('target', "_blank");

});