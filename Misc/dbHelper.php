<?php

namespace Vendor\Misc;

class DatabaseHelper
{
    public static function executeQuery($sql)
    {
        require(realpath(dirname(__FILE__) . '/../config.php'));

        if ($conn->query($sql) === TRUE) 
        {
            $conn->close();
        } 
        else 
        {
            die(mysqli_error($conn));
        }
    }

    public static function executeQueryAndReturnResult($sql)
    {
        require(realpath(dirname(__FILE__) . '/../config.php'));

        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public static function validateAndExecuteInsertQuery($sql, $sqlTypesStr, $bindParams)
    {
        require(realpath(dirname(__FILE__) . '/../config.php'));

        // Init
        $stmt = mysqli_stmt_init($conn);

        // Validate MySQL-query
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            die(mysqli_error($conn));
        }

        $stmt->bind_param($sqlTypesStr, ...$bindParams);
        $stmt->execute();

        $conn->close();
    }
}

?>