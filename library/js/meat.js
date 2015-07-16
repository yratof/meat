/*

Meat + Bones Scripts Enhancements
Author: Forsvunnet + Eddie

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/
/* global is_external, Modernizr  */
/************************
Meat Script begins.
*************************/
(function ($, w) {
    // A helper function to measure heights
    // If you're using borders or outlines
    'use strict';
    var map_height = function () {
        return $(this)
            .outerHeight();
    };
    // Equalise heights
    var equalise = function (element, group_size) {
        // Reset element height
        element.height('');

        // Group results
        if (group_size === undefined) {
            group_size = 0;
        }

        if (group_size === 1) {
            return;
        }
        var groups = [];
        if (group_size) {
            // Not a clone, but a different object of with the same selection
            var clone = $(element);
            while (clone.length > 0) {
                groups.push($(clone.splice(0, group_size)));
            }
        } else {
            groups = [element];
        }

        // Measure the heights and then apply the highest measure to all
        var heights, height;
        for (var i in groups) {
            heights = groups[i].map(map_height)
                .get();
            height = Math.max.apply(null, heights);
            groups[i].height(height);
        }
    };
    // Expose:
    w.equalise = equalise;

    // Add jQuery plugin
    $.fn.equalise = function (size) {
        equalise(this, size);
        return this;
    };

    $.fn.chunk = function(size) {
      var arr = [];
      for (var i = 0; i < this.length; i += size) {
          arr.push(this.slice(i, i + size));
      }
      return this.pushStack(arr, "chunk", size);
    };
    // $(this).chunk(3).wrap('<div class="column-3">')

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
    } else {
        // Fallback for browsers that does not support media queries
        min_width = function (width) {
            return jQuery(window)
                .width() >= width;
        };
    }
    // Expose:
    w.min_width = min_width;
})(jQuery, window);


// as the page loads, call these scripts
jQuery(document)
    .ready(function ($) {

        // Menu (button) script:
        $('body')
            .addClass('js');

		// Sub navigation
        $('.top-nav a')
            .click(function (event) {
                // Android devices consider themselves to be every width. This min_width function doesn't work for them yet. Remove it.
                //if (min_width(1200)) {  alert('I think i\'m a huge desktop...'); return; }
                var sub = $(this)
                    .next();
                if (event.which === 1 && sub.length && sub[0].nodeName.toLowerCase() === 'ul') {
                    if (this.nodeName.toLowerCase() === 'a' || !sub.hasClass('show')) {
                        sub.toggleClass('show');
                        
                        // Toggle .is-active to current submenu
                        sub.parent()
                        	.toggleClass('is-active');
                       
                        // Toggle .is-inactive to current submenu
                        sub.parent()
                        	.siblings()
                        		.toggleClass('is-inactive');
                        
                        return false;
                    }
                }
            });

        // Remove the X animation from clickable when it's open
        $('a.clickable')
            .click(function () {
				$(this)
                    .next()
						.toggleClass('show');
	            
                $('a.clickable.animated')
                    .toggleClass('close');
				// Remove active / non-active classes
                $('.top-nav li')
                	.removeClass('is-inactive is-active');
                // Close all sub-menus
                $('.sub-menu')
                	.removeClass('show');
            });


        if (!Modernizr.svg) {
            // Replace svg file-extention with png.
            $('img[src$=".svg"]')
                .attr('src', function () {
                    return $(this)
                        .attr('src')
                        .replace('.svg', '.png');
                });
        }

        // Give external links a class
        $('a')
            .filter(is_external)
            .addClass('external')
            .attr('target', "_blank");

    });



// Inline block sorted out with javascript. Plain vanilla javascript.
// Technially, this removes unwanted nodes from inside a DOM node

var utils = {};

utils.clean = function(node) {
	var child, i, len = node.childNodes.length;
	if (len === 0) { return; }
	// iterate backwards, as we are removing unwanted nodes
	for (i = len; i > 0; i -= 1) {
		child = node.childNodes[i - 1];
		// comment node? or empty text node
		if (child.nodeType === 8 || (child.nodeType === 3 && !/\S/.test(child.nodeValue) )) {
			node.removeChild(child);
		} else {
			if (child.nodeType === 1) {
				utils.clean(child);
			}
		}
	}
};

document.documentElement.className='js';
utils.clean(document.querySelector('.ib'));
