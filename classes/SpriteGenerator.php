<?php
/**
 * Copyright (c) 2013 sidler@mulchprod.de
 *
 * Licensed under the MIT License (MIT)
 */

/**
 * Class SpriteGenerator
 * Base class to handle all further generations
 */
class SpriteGenerator {

    private $CONFIG_SPRITEGEN_SOURCEPATH = "";
    private $CONFIG_SPRITEGEN_OUTPATH = "";
    private $CONFIG_SPRITE_NAME = "";

    function __construct($CONFIG_SPRITEGEN_OUTPATH, $CONFIG_SPRITEGEN_SOURCEPATH, $CONFIG_SPRITE_NAME) {

        $this->CONFIG_SPRITEGEN_OUTPATH = $CONFIG_SPRITEGEN_OUTPATH;
        $this->CONFIG_SPRITEGEN_SOURCEPATH = $CONFIG_SPRITEGEN_SOURCEPATH;
        $this->CONFIG_SPRITE_NAME = $CONFIG_SPRITE_NAME;
    }


    function generateSprite() {

        //read the source images
        $objReader = new DirectoryReader($this->CONFIG_SPRITEGEN_SOURCEPATH);
        $arrImageData = $objReader->getFolderContent();

        if(count($arrImageData) == 0)
            die ("No sourceimages available!\n");

        //generate the sprite
        $objSpriteGenerator = new SpriteWriter($this->CONFIG_SPRITEGEN_OUTPATH, $this->CONFIG_SPRITE_NAME);
        $objSpriteGenerator->generateSprite($arrImageData);

        //call all mappers
        $arrMappers = array(
            new CssMapper(),
            new PHPArrayMapper()
        );

        foreach($arrMappers as $objOneMapper) {
            if($objOneMapper instanceof IDataMapper) {
                $objOneMapper->setStrOutputDir($this->CONFIG_SPRITEGEN_OUTPATH);
                $objOneMapper->setStrSpriteName($this->CONFIG_SPRITE_NAME);
                $objOneMapper->writeHeader();
                $objOneMapper->writeToFile($arrImageData);
                $objOneMapper->writeFooter();
            }
        }
    }

}