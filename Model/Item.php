<?php

    namespace Vendor\Model;

    abstract class Item
    {
        protected $sku;
        protected $name;
        protected $price;

        function getSku()
        {
            return $this->sku;
        }

        function setSku($sku)
        {
            $this->sku = $sku;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getPrice()
        {
            return $this->price;
        }

        function setPrice($price)
        {
            $this->price = $price;
        }

        function __construct($sku, $name, $price)
        {
            $this->sku = $sku;
            $this->name = $name;
            $this->price = $price;
        }
        
        static function getSqlTypesStr()
        {
            return "ssdss";
        }

        static abstract function getChildTypesStr();

        function getStr()
        {
            return $this->sku . "<br>" . $this->name . "<br>" . "<br>" . $this->price . " $";
        }
    }

?>