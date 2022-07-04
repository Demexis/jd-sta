<?php

    namespace Vendor\Model;

    class DVD extends Item
    {
        private $size;

        function getSize()
        {
            return $this->size;
        }

        function setSize($size)
        {
            $this->size = $size;
        }

        function __construct($size, $sku, $name, $price)
        {
            parent::__construct($sku, $name, $price);

            $this->size = $size;
        }
        
        static function getChildTypesStr()
        {
            return "sd";
        }

        function getStr()
        {
            return $this->sku . "<br>" . $this->name . "<br>" . "<br>" . $this->price . " $ <br>" . "Size: " . $this->size . " MB";
        }
    }

?>