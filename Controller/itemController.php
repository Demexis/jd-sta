<?php 

namespace Vendor\Controller;

use Vendor\Model\Item;
use Vendor\Model\DVD;
use Vendor\Model\Furniture;
use Vendor\Model\Book;

use Vendor\Misc\PrepareCustomQueries;
use Vendor\Misc\ItemReflection;
use Vendor\Misc\DatabaseHelper;

require_once(realpath(dirname(__FILE__) . '/../Model/Item.php'));
require_once(realpath(dirname(__FILE__) . '/../Model/DVD.php'));
require_once(realpath(dirname(__FILE__) . '/../Model/Furniture.php'));
require_once(realpath(dirname(__FILE__) . '/../Model/Book.php'));

require_once(realpath(dirname(__FILE__) . '/../Misc/processItemReflection.php'));
require_once(realpath(dirname(__FILE__) . '/../Misc/prepareMySqlQueries.php'));
require_once(realpath(dirname(__FILE__) . '/../Misc/dbHelper.php'));


class ItemController
{
    public function getAllItems()
    {
        $sql = PrepareCustomQueries::prepareSelectAllItemsQuery();

        $result = DatabaseHelper::executeQueryAndReturnResult($sql);;

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $this->getItem($row["sku"], $row["name"], $row["price"], $row["productType"], $row["productId"]);
            }
        } 
        else 
        {
            echo "0 results";
        }
    }

    private function getItem($sku, $name, $price, $productType, $productId){
        
        $childItemProps = ItemReflection::getClassProperties("Vendor\\Model\\" . $productType);

        $sql = PrepareCustomQueries::prepareSelectChildItemByIdQuery($productType, $productId);

        $result = DatabaseHelper::executeQueryAndReturnResult($sql);;

        $paramsResults = [];

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                foreach($childItemProps as $childItemProp)
                {
                    $paramsResults[] = $row[$childItemProp];
                }
            }
        } 
        else 
        {
            echo "0 results";
        }

        $paramsItem = [$sku, $name, $price];

        $args = array_merge($paramsResults, $paramsItem);
        
        $childItem = ItemReflection::instantiateItemFromTypeAndArgs($productType, $args);

        $data = $childItem->getStr();

        $element = '
            <div class="col-md-3 col-sm-6 my-3 my-md-0">
                <form action="index.php" method="post">
                    <div class="card shadow">
                        <div class="card-body">
                            <div>
                                <input form="product-form" class="delete-checkbox" type="checkbox" name=toDelete[] value="' . $sku . '">
                            </div>
                            <h6>
                                ' . $data . '
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
        ';

        echo $element;
    }
}

?>