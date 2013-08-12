<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sidler
 * Date: 12.08.13
 * Time: 09:34
 * To change this template use File | Settings | File Templates.
 */

class PHPArrayMapper implements IDataMapper {

    private $strSpriteName = "";

    private $strOutputBuffer = "";
    private $strOutName = "sprite.php";
    private $strOutputDir = "";

    /**
     * @param $strOutputDir
     *
     * @return mixed
     */
    public function setStrOutputDir($strOutputDir) {
        $this->strOutputDir = $strOutputDir;
    }


    public function setStrSpriteName($strSpriteName) {
        $this->strSpriteName = $strSpriteName;
    }

    /**
     * @return mixed
     */
    public function writeHeader() {
        $this->strOutputBuffer .= "<?php \n";
        $this->strOutputBuffer .= <<<PHP

//PHP-Array generated by phpImageSpriteGenerator, https://github.com/sidler/phpImageSpriteGenerator
//Generated on {date('r')}

\$arrSprites = array();

PHP;

    }

    /**
     * @param ImageData[] $arrImageData
     *
     * @return mixed
     */
    public function writeToFile(array $arrImageData) {
        foreach($arrImageData as $objOneData) {

            $strClassName = substr($objOneData->getImageName(), 0, -4);

            $this->strOutputBuffer .= <<<PHP
\$arrSprites["{$strClassName}"] = array('height' => {$objOneData->getIntHeight()}, 'width' => {$objOneData->getIntWidth()}, 'posX' => {$objOneData->getIntSpriteX()}, 'posY' => {$objOneData->getIntSpriteY()});

PHP;

        }
    }

    /**
     * @return mixed
     */
    public function writeFooter() {
        $this->strOutputBuffer .= "\n\n";
        file_put_contents($this->strOutputDir.DIRECTORY_SEPARATOR.$this->strOutName, $this->strOutputBuffer);
    }

}