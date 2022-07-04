<?php

    namespace Vendor\Model;

    class Furniture extends Item
    {
        private $height;
        private $width;
        private $length;

        function getHeight()
        {
            return $this->height;
        }

        function setHeight($height)
        {
            $this->height = $height;
        }

        function getWidth()
        {
            return $this->width;
        }

        function setWidth($width)
        {
            $this->width = $width;
        }

        function getLength()
        {
            return $this->length;
        }

        function setLength($length)
        {
            $this->length = $length;
        }

        function __construct($height, $width, $length, $sku, $name, $price)
        {
            parent::__construct($sku, $name, $price);

            $this->height = $height;
            $this->width = $width;
            $this->length = $length;
        }
        
        static function getChildTypesStr()
        {
            return "sddd";
        }

        function getStr()
        {
            return $this->sku . "<br>" . $this->name . "<br>" . "<br>" . $this->price . " $ <br>" . "Dimension: " . $this->height . "x" . $this->width . "x" . $this->length;
        }
    }

?>