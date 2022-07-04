<?php

namespace Vendor\Misc;

require_once(realpath(dirname(__FILE__) . '/processItemReflection.php'));

class PrepareCustomQueries 
{
    #region Prepare queries for Product List Page

    public static function prepareSelectAllItemsQuery()
    {
        $sql = "SELECT sku, name, price, productType, productId FROM products";

        return $sql;
    }

    public static function prepareSelectChildItemByIdQuery($productType, $productId)
    {
        $childItemProps = ItemReflection::getClassProperties("Vendor\\Model\\" . $productType);

        $sqlSelectPropsStr = "id_" . strtolower($productType);

        foreach($childItemProps as $childItemProp)
        {
            $sqlSelectPropsStr .= ", " . $childItemProp;
        }

        $loweredType = strtolower($productType);

        $sql = "SELECT " . $sqlSelectPropsStr . " FROM products, products_" . $loweredType .
               " WHERE products_" . $loweredType . ".id_" . $loweredType . " = products.productId" . 
               " and products_" . $loweredType . ".id_" . $loweredType . " = \"" . $productId . "\" ;";


        return $sql;
    }

    public static function prepareSelectProductTypeBySkuQuery($sku)
    {
        $sql = "SELECT productType FROM products WHERE sku = \"" . $sku . "\"";

        return $sql;
    }

    public static function prepareDeleteChildItemByIdQuery($productId)
    {
        $sql = "DELETE FROM products_" . strtolower(PrepareCustomQueries::getProductTableName($productId)) . 
               " WHERE id_" . strtolower(PrepareCustomQueries::getProductTableName($productId)) . "=" . "\"" . $productId . "\"";

        return $sql;
    }

    public static function prepareDeleteItemByIdQuery($productId)
    {
        $sql = "DELETE FROM products WHERE sku=" . "\"" . $productId. "\"";

        return $sql;
    }

    public static function getProductTableName($sku)
    {
        require(realpath(dirname(__FILE__) . '/../config.php'));

        // sql to delete a record
        $sql = PrepareCustomQueries::prepareSelectProductTypeBySkuQuery($sku);

        $result = $conn->query($sql);

        $conn->close();

        return $result->fetch_assoc()["productType"];
    }

    #endregion


    #region Prepare queries for Product Add Page

    public static function prepareInsertChildItemByPostVarsQuery($postVars) 
    {
        $productType = $_POST["productType"];

        $className = "Vendor\\Model\\" . $postVars["productType"];
        $ownProps = ItemReflection::getClassProperties($className);


        $extendedClassArgsQ = "?";

        for ($x = 0; $x < count($ownProps); $x++) 
        {
            $extendedClassArgsQ = $extendedClassArgsQ . ", ?";
        }

        $extendedClassTableName = "products_" . strtolower($productType);

        $extendedClassArgs = "id_" . strtolower($productType);
        foreach($ownProps as $ownProp)
        {
            $extendedClassArgs = $extendedClassArgs . ", " . $ownProp;
        }

        $extendedClassSqlQuery = "INSERT INTO " . $extendedClassTableName . " (" . $extendedClassArgs . ") VALUES (" . $extendedClassArgsQ . ")";

        return $extendedClassSqlQuery;
    }

    public static function prepareInsertItemByPostVarsQuery($postVars)
    {
        $className = "Vendor\\Model\\" . "Item";
        $ownProps = ItemReflection::getClassProperties($className);

        $itemClassArgsQ = "?, ?";

        for ($x = 0; $x < count($ownProps); $x++) 
        {
            $itemClassArgsQ = $itemClassArgsQ . ", ?";
        }

        $itemClassTableName = "products";

        $itemClassArgs = "";

        for ($x = 0; $x < count($ownProps); $x++) 
        {
            if($x == count($ownProps) - 1)
            {
                $itemClassArgs = $itemClassArgs . $ownProps[$x];
            }
            else
            {
                $itemClassArgs = $itemClassArgs . $ownProps[$x] . ", ";
            }
        }

        $itemClassArgs = $itemClassArgs . ", " . "productType, " . "productId";

        $itemClassSqlQuery = "INSERT INTO " . $itemClassTableName . " (" . $itemClassArgs . ") VALUES (" . $itemClassArgsQ . ")";

        return $itemClassSqlQuery;
    }

    #endregion

}

?>