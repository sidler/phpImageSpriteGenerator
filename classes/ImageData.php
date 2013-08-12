<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sidler
 * Date: 12.08.13
 * Time: 09:31
 * To change this template use File | Settings | File Templates.
 */

class ImageData {
    private $strAbsPath = "";

    private $intWidth = 0;
    private $intHeight = 0;

    private $intSpriteX = 0;
    private $intSpriteY = 0;

    private $bitIsLowRes = false;

    function __construct($strAbsPath) {
        $this->strAbsPath = $strAbsPath;

        $arrDimensions = getimagesize($strAbsPath);
        $this->intWidth = $arrDimensions[0];
        $this->intHeight = $arrDimensions[1];
    }

    public function getImageName() {
        return basename($this->strAbsPath);
    }

    /**
     * @param int $intHeight
     */
    public function setIntHeight($intHeight) {
        $this->intHeight = $intHeight;
    }

    /**
     * @return int
     */
    public function getIntHeight() {
        return $this->intHeight;
    }

    /**
     * @param int $intWidth
     */
    public function setIntWidth($intWidth) {
        $this->intWidth = $intWidth;
    }

    /**
     * @return int
     */
    public function getIntWidth() {
        return $this->intWidth;
    }

    /**
     * @param int $intSpriteX
     */
    public function setIntSpriteX($intSpriteX) {
        $this->intSpriteX = $intSpriteX;
    }

    /**
     * @return int
     */
    public function getIntSpriteX() {
        return $this->intSpriteX;
    }

    /**
     * @param int $intSpriteY
     */
    public function setIntSpriteY($intSpriteY) {
        $this->intSpriteY = $intSpriteY;
    }

    /**
     * @return int
     */
    public function getIntSpriteY() {
        return $this->intSpriteY;
    }

    /**
     * @param string $strAbsPath
     */
    public function setStrAbsPath($strAbsPath) {
        $this->strAbsPath = $strAbsPath;
    }

    /**
     * @return string
     */
    public function getStrAbsPath() {
        return $this->strAbsPath;
    }

    /**
     * @param boolean $bitIsLowRes
     */
    public function setBitIsLowRes($bitIsLowRes) {
        $this->bitIsLowRes = $bitIsLowRes;
    }

    /**
     * @return boolean
     */
    public function getBitIsLowRes() {
        return $this->bitIsLowRes;
    }





}