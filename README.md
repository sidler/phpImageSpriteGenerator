phpImageSpriteGenerator
=======================

CSS / Image Sprite Generator written in PHP. First version to be used on the CLI, web based view may follow.

(c) by Stefan Idler, MulchProductions, sidler@mulchprod.de, http://www.mulchprod.de

Usage
-----

phpImageSpriteGenerator requires at least PHP 5.3 and the gd-lib module.
Place all tiles (so all source images) in the "sourceimages"-folder and call the "generator.php"-script using the
command line.
The script will generate a sprite-image in the folder "output".
In addition to the sprite, two files are generated:
 - a css-file with the matching background-position values
 - a php-file with an array of source-images to background-positions.

The last one is extremely useful if you need the positions directly in your php-script, e.g. to process the values.