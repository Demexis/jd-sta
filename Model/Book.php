<?php

    namespace Vendor\Model;

    class Book extends Item
    {
        private $weight;

        function getWeight()
        {
            return $this->weight;
        }

        function setWeight($weight)
        {
            $this->weight = $weight;
        }

        function __construct($weight, $sku, $name, $price)
        {
            parent::__construct($sku, $name, $price);

            $this->weight = $weight;
        }
        
        static function getChildTypesStr()
        {
            return "sd";
        }

        function getStr()
        {
            return $this->sku . "<br>" . $this->name . "<br>" . "<br>" . $this->price . " $ <br>" . "Weight: " . $this->weight . " KG";
        }
    }

?>