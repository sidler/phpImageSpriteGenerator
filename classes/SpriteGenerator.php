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

    public static $CONFIG_SPRITEGEN_SOURCEPATH = "";
    public static $CONFIG_SPRITEGEN_OUTPATH = "";
    public static $CONFIG_SPRITE_FULLRES_NAME = "sprite.png";
    public static $CONFIG_SPRITE_LOWRES_NAME = "sprite.png";

    public static $CONFIG_CUR_SPRITE_NAME = "";

    public static $CONFIG_GENERATE_LOWRES = false;
    public static $CONFIG_SPRITE_PREFIX = "";

    public static $SPRITE_TOTAL_HEIGHT = 0;
    public static $SPRITE_TOTAL_WIDTH = 0;



    function generateSprite() {

        //read the source images
        $objReader = new DirectoryReader(SpriteGenerator::$CONFIG_SPRITEGEN_SOURCEPATH);
        $arrImageData = $objReader->getFolderContent();

        if(count($arrImageData) == 0)
            die ("No sourceimages available!\n");


        self::$CONFIG_CUR_SPRITE_NAME = self::$CONFIG_SPRITE_FULLRES_NAME;
        $this->processSpritesArray($arrImageData);

        if(self::$CONFIG_GENERATE_LOWRES) {
            self::$CONFIG_CUR_SPRITE_NAME = self::$CONFIG_SPRITE_LOWRES_NAME;
            foreach($arrImageData as $objOneData)
                $objOneData->setBitIsLowRes(true);

            $this->processSpritesArray($arrImageData);
        }

    }


    private function processSpritesArray(array $arrImageData) {
        //generate the sprite
        $objSpriteGenerator = new SpriteWriter(SpriteGenerator::$CONFIG_SPRITEGEN_OUTPATH, SpriteGenerator::$CONFIG_SPRITE_FULLRES_NAME);
        $objSpriteGenerator->generateSprite($arrImageData);

        //call all mappers
        $arrMappers = array(
            new CssMapper(),
            new PHPArrayMapper(),
            new RetinaCssMapper()
        );
        if(self::$CONFIG_GENERATE_LOWRES)
            $arrMappers[] = new CssCombinedMapper();

        foreach($arrMappers as $objOneMapper) {
            if($objOneMapper instanceof IDataMapper) {
                $objOneMapper->writeHeader();
                $objOneMapper->writeToFile($arrImageData);
                $objOneMapper->writeFooter();
            }
        }
    }
}