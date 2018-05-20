<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 20.05.2018
 * Time: 17:50
 */

namespace models;


class DataModel
{
    public $dataType;
    public $time;
    public $content;

    /**
     * DataModel constructor.
     * @param $dataType
     * @param $time
     * @param $content
     */
    public function __construct($dataType, $time, $content)
    {
        $this->dataType = $dataType;
        $this->time = $time;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param mixed $dataType
     */
    public function setDataType($dataType): void
    {
        $this->dataType = $dataType;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }
}
