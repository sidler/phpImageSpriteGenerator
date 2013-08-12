#!/usr/bin/php
<?php
/**
 * Copyright (c) 2013 sidler@mulchprod.de
 *
 * Licensed under the MIT License (MIT)
 */

include_once __DIR__."/classes/SpriteGenerator.php";



//CONFIG VARS ------------------------------------

//source folder, containing the source pngs
SpriteGenerator::$CONFIG_SPRITEGEN_SOURCEPATH   = __DIR__."/sourceimages";

//output folder, the generated files will be placed here
SpriteGenerator::$CONFIG_SPRITEGEN_OUTPATH      = __DIR__."/output";

//name of the generated sprite image, full res
SpriteGenerator::$CONFIG_SPRITE_FULLRES_NAME    = "sprite2x";

//name of the generated sprite images, low res, so scaled down by 50%
SpriteGenerator::$CONFIG_SPRITE_LOWRES_NAME     = "sprite1x";

//if enabled, the script will produce 2 sprites, on based on the original source-images sprites,
//and one with the tiles scaled by 50%.
//In addition, a combined-css files is generated, making use of both sprites depending on the browsers
//pixel density
SpriteGenerator::$CONFIG_GENERATE_LOWRES        = true;

//If you'll keep the css and the png files in separate directories, you may add a prefix
//to the png file. This prefix is included in the generated css file, e.g. "../pics/".
SpriteGenerator::$CONFIG_SPRITE_PREFIX          = "";

// /CONFIG VARS ----------------------------------











include_once __DIR__."/classes/DirectoryReader.php";
include_once __DIR__."/classes/ImageData.php";
include_once __DIR__."/classes/SpriteWriter.php";
include_once __DIR__."/classes/mapper/IDataMapper.php";
include_once __DIR__."/classes/mapper/CssMapper.php";
include_once __DIR__."/classes/mapper/PHPArrayMapper.php";
include_once __DIR__."/classes/mapper/CssCombinedMapper.php";
include_once __DIR__."/classes/mapper/RetinaCssMapper.php";


$objGenerator = new SpriteGenerator();
$objGenerator->generateSprite();