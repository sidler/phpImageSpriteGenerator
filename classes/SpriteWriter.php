<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sidler
 * Date: 12.08.13
 * Time: 09:31
 * To change this template use File | Settings | File Templates.
 */

class SpriteWriter {

    private $intTotalHeight = 0;
    private $intTotalWidth = 0;

    private $strTargetDir = "";

    private $intYOffset = 10;


    function __construct($strTargetDir, $strImageName) {
        $this->strTargetDir = $strTargetDir;
    }

    /**
     * @param ImageData[] $arrImageData
     */
    public function generateSprite(array $arrImageData) {

        //process all dimensions and set up the map
        $this->calcImageDimensions($arrImageData);

        //generate the plain image
        $this->generateSpriteImage($arrImageData);

    }

    /**
     * @param ImageData[] $arrImageData
     */
    private function generateSpriteImage(array $arrImageData) {
        $objSpriteImage = imagecreatetruecolor($this->intTotalWidth, $this->intTotalHeight);

        imagealphablending($objSpriteImage, false);
        $objColor = imagecolorallocatealpha($objSpriteImage, 255, 255, 255, 127);
        imagefilledrectangle($objSpriteImage, 0, 0, $this->intTotalWidth, $this->intTotalHeight, $objColor);
        imagealphablending($objSpriteImage, true);
        imagesavealpha($objSpriteImage, true);

        SpriteGenerator::$SPRITE_TOTAL_HEIGHT = $this->intTotalHeight;
        SpriteGenerator::$SPRITE_TOTAL_WIDTH = $this->intTotalWidth;

        foreach($arrImageData as $objOneImageData) {
            //read the source image
            $objSingleImage = imagecreatefrompng($objOneImageData->getStrAbsPath());

            if($objOneImageData->getBitIsLowRes()) {
                imagecopyresized(
                    $objSpriteImage,
                    $objSingleImage,
                    $objOneImageData->getIntSpriteX(),
                    $objOneImageData->getIntSpriteY(),
                    0,
                    0,
                    floor($objOneImageData->getIntWidth() / 2),
                    floor($objOneImageData->getIntHeight() / 2),
                    $objOneImageData->getIntWidth(),
                    $objOneImageData->getIntHeight()
                );

                $objOneImageData->setIntWidth(floor($objOneImageData->getIntWidth() / 2));
                $objOneImageData->setIntHeight(floor($objOneImageData->getIntHeight() / 2));
            }
            else {
                imagecopy(
                    $objSpriteImage,
                    $objSingleImage,
                    $objOneImageData->getIntSpriteX(),
                    $objOneImageData->getIntSpriteY(),
                    0,
                    0,
                    $objOneImageData->getIntWidth(),
                    $objOneImageData->getIntHeight()
                );
            }

            imagealphablending($objSpriteImage, true);
            imagedestroy($objSingleImage);
        }

        imagealphablending($objSpriteImage, true);
        imagesavealpha($objSpriteImage, true);
        imagepng($objSpriteImage, $this->strTargetDir.DIRECTORY_SEPARATOR.SpriteGenerator::$CONFIG_CUR_SPRITE_NAME.".png", 1);
        imagedestroy($objSpriteImage);
    }


    /**
     * @param ImageData[] $arrImageData
     */
    private function calcImageDimensions(array $arrImageData) {
        foreach($arrImageData as $objOneImage) {
            if($objOneImage->getIntWidth() > $this->intTotalWidth)
                $this->intTotalWidth = $objOneImage->getIntWidth();

            $objOneImage->setIntSpriteY($this->intTotalHeight);
            $objOneImage->setIntSpriteX(0);

            $this->intTotalHeight += $objOneImage->getIntHeight()+$this->intYOffset;
        }
    }

}