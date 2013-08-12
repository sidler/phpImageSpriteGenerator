<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sidler
 * Date: 12.08.13
 * Time: 09:30
 * To change this template use File | Settings | File Templates.
 */

class DirectoryReader {

    private $strSourceDir = "";
    private $strSourceSuffix = ".png";

    /**
     * @param $strSourceDir
     */
    function __construct($strSourceDir) {
        $this->strSourceDir = $strSourceDir;
    }

    /**
     * @return ImageData[]
     */
    public function getFolderContent() {
        $arrImageData = array();

        foreach(scandir($this->strSourceDir) as $strOneImage) {
            if(substr($strOneImage, (strlen($this->strSourceSuffix) * -1)) == $this->strSourceSuffix)
                $arrImageData[] = $this->image2ImageData($strOneImage);
        }

        return $arrImageData;
    }


    /**
     * @param $strOneImage
     *
     * @return ImageData
     */
    private function image2ImageData($strOneImage) {
        $objImageData = new ImageData($this->strSourceDir.DIRECTORY_SEPARATOR.$strOneImage);
        return $objImageData;
    }
}