<?php

namespace Vendor\Misc;

use Vendor\Model\Item;
use Vendor\Model\DVD;
use Vendor\Model\Furniture;
use Vendor\Model\Book;

require_once(realpath(dirname(__FILE__) . '/../Model/Item.php'));
require_once(realpath(dirname(__FILE__) . '/../Model/DVD.php'));
require_once(realpath(dirname(__FILE__) . '/../Model/Furniture.php'));
require_once(realpath(dirname(__FILE__) . '/../Model/Book.php'));

class ItemReflection 
{
    public static function getChildBindParams($postVars)
    {
        $className = "Vendor\\Model\\" . $postVars["productType"];
        $props = ItemReflection::getClassArgs($className, $postVars);

        // Add an element at the start of the array
        array_unshift($props, $postVars["sku"]);

        return $props;
    }

    public static function getBindParams($postVars)
    {
        $className = "Vendor\\Model\\" . "Item";
        $props = ItemReflection::getClassArgs($className, $postVars);

        $props[] = $postVars["productType"];
        $props[] = $postVars["sku"];

        return $props;
    }

    public static function getClassProperties($className)
    {
        $reflect = new \ReflectionClass($className);
        $props = $reflect->getProperties();

        $properties = [];

        foreach ($props as $prop) {
            if ($prop->class === $className) 
            {
                $properties[] = $prop->getName();
            }
        }

        return $properties;
    }

    public static function getClassArgs($className, $postVars)
    {
        $reflect = new \ReflectionClass($className);
        $props = $reflect->getProperties();

        $args = [];

        foreach ($props as $prop) {
            if ($prop->class === $className) 
            {
                $args[] = $postVars[$prop->getName()];
            }
        }

        return $args;
    }

    public static function getChildTypesStr($productType)
    {
        $className = "Vendor\\Model\\" . $productType;
        // $reflect = new ReflectionClass($className);
        return call_user_func($className .'::getChildTypesStr');
    }

    public static function instantiateItemFromTypeAndArgs($itemType, $args)
    {
        $className = "Vendor\\Model\\" . $itemType;
        $ref = new \ReflectionClass($className);
        $obj = $ref->newInstanceArgs($args);

        return $obj;
    }
}

?>