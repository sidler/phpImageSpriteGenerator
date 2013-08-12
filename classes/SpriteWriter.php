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
    private $strImageName = "sprite.png";


    function __construct($strTargetDir, $strImageName) {
        $this->strTargetDir = $strTargetDir;
        $this->strImageName = $strImageName;
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

        foreach($arrImageData as $objOneImageDate) {
            //read the source image
            $objSingleImage = imagecreatefrompng($objOneImageDate->getStrAbsPath());

            //imagealphablending($objSingleImage, true);
            imagecopy(
                $objSpriteImage,
                $objSingleImage,
                $objOneImageDate->getIntSpriteX(),
                $objOneImageDate->getIntSpriteY(),
                0,
                0,
                $objOneImageDate->getIntWidth(), $objOneImageDate->getIntHeight()
            );

            imagealphablending($objSpriteImage, true);

            imagedestroy($objSingleImage);
        }

        imagealphablending($objSpriteImage, true);
        imagepng($objSpriteImage, $this->strTargetDir.DIRECTORY_SEPARATOR.$this->strImageName);
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