<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sidler
 * Date: 12.08.13
 * Time: 09:33
 * To change this template use File | Settings | File Templates.
 */

class CssCombinedMapper implements IDataMapper {

    private $strOutputBuffer = "";

    /**
     * @return mixed
     */
    public function writeHeader() {
        $this->strOutputBuffer .= "\n";
        $strDate = date('r');
        $this->strOutputBuffer .= <<<CSS

/* CSS generated by phpImageSpriteGenerator, https://github.com/sidler/phpImageSpriteGenerator */
/* Generated on {$strDate} */


CSS;

    }

    /**
     * @param ImageData[] $arrImageData
     *
     * @return mixed
     */
    public function writeToFile(array $arrImageData) {
        $strSpriteLowResName = SpriteGenerator::$CONFIG_SPRITE_PREFIX.SpriteGenerator::$CONFIG_SPRITE_LOWRES_NAME.".png";
        $strSpriteHighResName = SpriteGenerator::$CONFIG_SPRITE_PREFIX.SpriteGenerator::$CONFIG_SPRITE_FULLRES_NAME.".png";

        $intBackWidth = SpriteGenerator::$SPRITE_TOTAL_WIDTH;
        $intBackHeight = SpriteGenerator::$SPRITE_TOTAL_HEIGHT;

        $intBackFullWidth = floor($intBackWidth/2);
        $intBackFullHeight = floor($intBackHeight/2);

        foreach($arrImageData as $objOneData) {

            $strClassName = substr($objOneData->getImageName(), 0, -4);

            $intFullX = floor($objOneData->getIntSpriteX() / 2);
            $intFullY = floor($objOneData->getIntSpriteY() / 2);


            $this->strOutputBuffer .= <<<CSS

.{$strClassName} {
    background: url('{$strSpriteLowResName}') no-repeat {$objOneData->getIntSpriteX()}px -{$objOneData->getIntSpriteY()}px;
    background-size: {$intBackWidth}px {$intBackHeight}px;
}

@media (min--moz-device-pixel-ratio: 1.5),
        (-o-min-device-pixel-ratio: 3/2),
        (-webkit-min-device-pixel-ratio: 1.5),
        (min-device-pixel-ratio: 1.5),
        (min-resolution: 1.5dppx) {
   .{$strClassName} {
        background: url('{$strSpriteHighResName}') no-repeat {$intFullX}px -{$intFullY}px;
        background-size:  {$intBackFullWidth}px {$intBackFullHeight}px;
   }
}
CSS;

            if(SpriteGenerator::$CONFIG_GENERATE_PRINTSTYLES) {
                $strSourceImageName = str_replace(".png", "_print.png", SpriteGenerator::$CONFIG_SPRITE_PREFIX.$objOneData->getImageName());

                $this->strOutputBuffer .= <<<CSS

@media print {
    .{$strClassName}:after {
        content:url('{$strSourceImageName}');
    }
}

CSS;

            }

        }
    }

    /**
     * @return mixed
     */
    public function writeFooter() {
        $this->strOutputBuffer .= "\n\n";
        file_put_contents(SpriteGenerator::$CONFIG_SPRITEGEN_OUTPATH.DIRECTORY_SEPARATOR."combined.css", $this->strOutputBuffer);
    }

}