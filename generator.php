#!/usr/bin/php
<?php
/**
 * Copyright (c) 2013 sidler@mulchprod.de
 *
 * Licensed under the MIT License (MIT)
 */

//CONFIG VARS ------------------------------------

$strSourceFolder = __DIR__."/sourceimages";
$strTargetFolder = __DIR__."/output";
$strSpriteName   = "sprite.png";


// /CONFIG VARS ----------------------------------






//calling the generator-class using all required configs
include_once __DIR__."/classes/DirectoryReader.php";
include_once __DIR__."/classes/ImageData.php";
include_once __DIR__."/classes/SpriteGenerator.php";
include_once __DIR__."/classes/SpriteWriter.php";
include_once __DIR__."/classes/mapper/IDataMapper.php";
include_once __DIR__."/classes/mapper/CssMapper.php";
include_once __DIR__."/classes/mapper/PHPArrayMapper.php";


$objGenerator = new SpriteGenerator(
    $strTargetFolder,
    $strSourceFolder,
    $strSpriteName
);

$objGenerator->generateSprite();