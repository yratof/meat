![image](http://www.sciencemediacentre.co.nz/wp-content/upload/2011/02/steak.jpg)

# Meat


A skeleton theme that has some meat. Basically, it's not barebones, because most of the time, i'm not starting from nothing, I'm starting from something.

### Photoshop + SCSS

If you have a photoshop document, find `library/scss/global.scss` and change the gutter from the grid in here. At the moment, this just allows you to have the `$gutter_rem` variable that falls back to `px` when on a shit browser.

### Think Modular

Build elements with the intention of reusing them. This is why we've got the `modules` folder. In here, you've got yourself files that have a hyphenated title. This is so we can pull them in like this:

`<?php get_template_part('modules/half', 'half')?>`

Then you can just reuse that little bit throughout the site. You know, like wordpress used to do.

---

### History

Meat is mainly a collaborative effort between the excellent front-end developers [Eivin Landa](https://www.forsvunnet.co.uk) and [Andrew Lazarus](http://www.eyeversuseye.com/). We produce a lot of wordpress powered websites and our prefered starting theme has been bones, but we've recognized that there is room for improvement and we've set out to make a more fleshed out starting theme.

Meat will feature a more complete mobile design and experience along with a more developed tablet and desktop view. Furthermore it comes packed with a few nifty functions for both PHP and JavaScript.