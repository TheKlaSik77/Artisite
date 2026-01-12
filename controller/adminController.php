<?php

require "./view/layout/admin-layout-start.php";

function adminDashboardController(PDO $pdo)
{
    require "./view/pages/admin/admin-dashboard.php";
}

function adminCraftmenController(PDO $pdo)
{
    require_once "./model/requests.craftmen.php";
    $craftmen = getAllCraftmen($pdo);
    require "./view/pages/admin/admin-craftmen.php"; 
}

function adminCustomersController(PDO $pdo)
{
    
    
    require "./view/pages/admin/admin-customers.php";
}

function adminProductsController(PDO $pdo)
{
    require "./view/pages/admin/admin-products.php";
}

function adminOrdersController(PDO $pdo)
{
    require "./view/pages/admin/admin-orders.php";

}

function adminReviewsController(PDO $pdo)
{
    require "./view/pages/admin/admin-reviews.php";

}

function adminSupportController(PDO $pdo)
{
    require "./view/pages/admin/admin-support.php";

}

    require "./view/layout/admin-layout-end.php";