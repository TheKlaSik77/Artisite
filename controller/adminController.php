<?php

$isAjax = in_array($_GET['page'] ?? '', [
    'admin-delete-craftman',
    'admin-validate-craftman',
    'admin-delete-customer',
    'admin-delete-product'
]);


if (!$isAjax) {
    require "./view/layout/admin-layout-start.php";
}
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

function adminDeleteCraftmanController(PDO $pdo)
{
    header("Content-Type: application/json; charset=utf-8");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $craftman_id = $data['craftman_id'] ?? null;

    if (!$craftman_id) {
        echo json_encode(["success" => false]);
        exit;
    }

    require_once "./model/requests.craftmen.php";
    deleteCraftman($pdo, $craftman_id);

    echo json_encode(["success" => true]);
    exit;
}

function adminValidateCraftmanController(PDO $pdo)
{
    header("Content-Type: application/json; charset=utf-8");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $craftman_id = $data['craftman_id'] ?? null;

    if (!$craftman_id) {
        echo json_encode(["success" => false]);
        exit;
    }

    require_once "./model/requests.craftmen.php";

    $adminId = $_SESSION["user"]["id"] ?? null;
    if (!$adminId) {
        echo json_encode(["success" => false]);
        exit;
    }
    try {
        validateCraftman($pdo, (int) $craftman_id, (int) $adminId);
        echo json_encode(["success" => true]);
    } catch (Throwable $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }

    exit;
}

function adminDeleteProductController(PDO $pdo) {
    header("Content-Type: application/json; charset=utf-8");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $product_id = $data['product_id'] ?? null;

    if (!$product_id) {
        echo json_encode(["success" => false]);
        exit;
    }

    require_once "./model/requests.products.php";
    deleteProduct($pdo, $product_id);

    echo json_encode(["success" => true]);
    exit;
}

function adminDeleteCustomerController(PDO $pdo) {
    header("Content-Type: application/json; charset=utf-8");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $customer_id = $data['customer_id'] ?? null;

    if (!$customer_id) {
        echo json_encode(["success" => false]);
        exit;
    }

    require_once "./model/requests.users.php";
    deleteUser($pdo, $customer_id);

    echo json_encode(["success" => true]);
    exit;
}

function adminCustomersController(PDO $pdo)
{
    require_once "./model/requests.users.php";
    $customers = getAllUsers($pdo);
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
function adminFaqController()
{
    require "./view/pages/admin/admin-faq.php";

}

if (!$isAjax) {
    require "./view/layout/admin-layout-end.php";
}