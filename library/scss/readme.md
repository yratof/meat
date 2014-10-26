# HOW TO GRID THIS SHIT

> We use two files for the grid.

`_gridmath.scss` and `_grid.scss`

---

## Gridmath

This is where you can set up the grid. and by setup, i mean change upto 2 whole options!

---

`$gutter_em: 1rem !global;`

The `$gutter_em` is set to `1rem` which is the base font size (which is a good thing). 
It's also `rem` because the math gets fucked up using `em`.

---

`$divisor: 12 / $n;`

This one is how you split your grid. I use `12` because it's fucking perfect. You can change it to `16` or something, but you'd be a right arsehole.

---

## Grid

This is where we keep the classes. Though nowadays, I find it easier to do this:

`@include width(6);` which will give you 6 columns. Then you can give it some extra shit like `& + .sameClass { margin-left: $gutter_em }` which will add the gutter on all items after your first class.

Fucking simple.