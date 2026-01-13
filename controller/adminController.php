<?php

require "./view/layout/admin-layout-start.php";
require "./view/layout/admin-header.php";
function adminDashboardController()
{
    require "./view/pages/admin/admin-dashboard.php";
}

function adminCraftmenController()
{
    require "./view/pages/admin/admin-craftmen.php";
}

function adminCustomersController()
{
    require "./view/pages/admin/admin-customers.php";
}

function adminProductsController()
{
    require "./view/pages/admin/admin-products.php";
}

function adminOrdersController()
{
    require "./view/pages/admin/admin-orders.php";

}

function adminReviewsController()
{
    require "./view/pages/admin/admin-reviews.php";

}

function adminSupportController()
{
    require "./view/pages/admin/admin-support.php";

}
function adminFaqController()
{
    require "./view/pages/admin/admin-faq.php";

}

require "./view/layout/admin-layout-end.php";