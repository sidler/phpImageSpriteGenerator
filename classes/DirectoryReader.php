<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sidler
 * Date: 12.08.13
 * Time: 09:30
 * To change this template use File | Settings | File Templates.
 */

class DirectoryReader {

    private $strSourceSuffix = ".png";


    /**
     * @return ImageData[]
     */
    public function getFolderContent() {
        $arrImageData = array();

        foreach(scandir(SpriteGenerator::$CONFIG_SPRITEGEN_SOURCEPATH) as $strOneImage) {
            if(substr($strOneImage, (strlen($this->strSourceSuffix) * -1)) == $this->strSourceSuffix)
                $arrImageData[] = $this->image2ImageData($strOneImage);
        }

        echo "found ".count($arrImageData)." images...\n";
        return $arrImageData;
    }


    /**
     * @param $strOneImage
     *
     * @return ImageData
     */
    private function image2ImageData($strOneImage) {
        $objImageData = new ImageData(SpriteGenerator::$CONFIG_SPRITEGEN_SOURCEPATH.DIRECTORY_SEPARATOR.$strOneImage);
        return $objImageData;
    }
}