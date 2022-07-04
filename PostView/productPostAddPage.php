<?php 

use Vendor\Model\Item;

use Vendor\Misc\ItemReflection;
use Vendor\Misc\PrepareCustomQueries;
use Vendor\Misc\DatabaseHelper;

require_once(realpath(dirname(__FILE__) . '/../Model/Item.php'));
require_once(realpath(dirname(__FILE__) . '/../Model/DVD.php'));

require_once(realpath(dirname(__FILE__) . '/../Misc/processItemReflection.php'));
require_once(realpath(dirname(__FILE__) . '/../Misc/prepareMySqlQueries.php'));
require_once(realpath(dirname(__FILE__) . '/../Misc/dbHelper.php'));


$itemSql = PrepareCustomQueries::prepareInsertItemByPostVarsQuery($_POST);
$childItemSql = PrepareCustomQueries::prepareInsertChildItemByPostVarsQuery($_POST);

$itemTypesStr = Item::getSqlTypesStr();
$childItemTypesStr = ItemReflection::getChildTypesStr($_POST["productType"]);

$itemBindParams = ItemReflection::getBindParams($_POST);
$childItemBindParams = ItemReflection::getChildBindParams($_POST);

DatabaseHelper::validateAndExecuteInsertQuery($itemSql, $itemTypesStr, $itemBindParams);
DatabaseHelper::validateAndExecuteInsertQuery($childItemSql, $childItemTypesStr, $childItemBindParams);

header("Location: /../View/productListPage.php");
exit();

?>