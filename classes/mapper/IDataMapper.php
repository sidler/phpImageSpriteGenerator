<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sidler
 * Date: 12.08.13
 * Time: 09:31
 * To change this template use File | Settings | File Templates.
 */

interface IDataMapper {

    /**
     * @return mixed
     */
    public function writeHeader();

    /**
     * @param ImageData[] $arrImageData
     *
     * @return mixed
     */
    public function writeToFile(array $arrImageData);

    /**
     * @return mixed
     */
    public function writeFooter();

}