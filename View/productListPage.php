<!doctype html>
<html lang="en">

<head>
    <title>Product List Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device.width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/inputButton.css">
    

    <div class="bg-light mb-4 py-4">
        <div class="container">
            <div class="row">
                <header class="col-md-6 offset-md-3">
                    <nav class="navbar navbar-light navbar-expand-md">
                        <span class="navbar-brand mb-0 h1">Product List</span>

                        <button class="navbar-toggler" type="button" data-bstoggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">

                                <li class="nav-item">
                                    <input id="addButton" type="button" value="ADD">
                                </li>


                                <li class="nav-item">
                                    <input form="product-form" id="deleteButton" type="submit" name="submit" value="MASS DELETE">
                                </li>

                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
    </div>
</head>

<body>

    <form id="product-form" action="../PostView/productPostDeletePage.php" method="post"></form>

    <div class="container">
        <div class="row text-center py-5">
            <?php
                use Vendor\Controller\ItemController;
                require_once('../Controller/itemController.php');
                $itemController = new ItemController();
                $itemController->getAllItems();
            ?>
        </div>
    </div>

    <footer class="mt-5 py-5">
        <div class="container">
            <hr>
            Scandiweb Test Assignment
        </div>
    </footer>

    <script type="text/javascript">
        document.getElementById("addButton").onclick = function () 
        {
                location.href = "productAddPage.html";
        };
    </script>
</body>

</html>