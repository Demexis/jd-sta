<?php 

use Vendor\Misc\ItemReflection;
use Vendor\Misc\PrepareCustomQueries;
use Vendor\Misc\DatabaseHelper;

require_once(realpath(dirname(__FILE__) . '/../Misc/processItemReflection.php'));
require_once(realpath(dirname(__FILE__) . '/../Misc/prepareMySqlQueries.php'));
require_once(realpath(dirname(__FILE__) . '/../Misc/dbHelper.php'));


if(isset($_POST['submit'])){

    require(realpath(dirname(__FILE__) . '/../config.php'));

    if(!empty($_POST['toDelete'])) {    
        foreach($_POST['toDelete'] as $productId){

            $sqlChild = PrepareCustomQueries::prepareDeleteChildItemByIdQuery($productId);
            $sql = PrepareCustomQueries::prepareDeleteItemByIdQuery($productId);

            DatabaseHelper::executeQuery($sqlChild);
            DatabaseHelper::executeQuery($sql);
        }
    }

    $conn->close();

    header("Location: /../View/productListPage.php");
    exit();

}

?>