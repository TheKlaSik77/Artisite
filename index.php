<?php session_start();

$isAjax = ($_GET['page'] ?? '') === 'signup' && ($_GET['action'] ?? '') === 'checkDuplicate';

require_once "./model/utils/connexion.php";
require_once "./model/utils/auth.php";

$page = $_GET['page'] ?? 'home';
$ajaxPages = ['admin-delete-craftman', 'admin-validate-craftman', 'admin-delete-customer', 'admin-delete-product', 'admin-delete-order', 'admin-order-details'];

if (in_array($page, $ajaxPages, true)) {
    if (!isAdmin()) {
        http_response_code(403);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["success" => false, "error" => "forbidden"]);
        exit;
    }

    require "./controller/adminController.php";
    switch ($page) {
        case 'admin-delete-craftman':
            adminDeleteCraftmanController($pdo);
            break;

        case 'admin-validate-craftman':
            adminValidateCraftmanController($pdo);
            break;

        case 'admin-delete-customer':
            adminDeleteCustomerController($pdo);
            break;

        case 'admin-delete-product':
            adminDeleteProductController($pdo);
            break;

        case 'admin-delete-order':
            adminDeleteOrderController($pdo);
            break;

        case 'admin-order-details':
            adminOrderDetailsController($pdo);
            break;
    }
    exit;
}

if ($isAjax) {
    $page = $_GET['page'] ?? '';
    if ($page === "signup") {
        require_once "./controller/signupController.php";
        signupController($pdo);
        exit;
    }
    http_response_code(404);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arti'Site</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/variables.css">
</head>

<?php
# Décommenter pour ajouter un admin
// require_once "create_admin.php";

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case "home":
        require "./view/layout/header.php";
        require "./view/pages/homepage.php";
        require "./view/layout/footer.php";
        break;

    case "products":
        require_once "./controller/productController.php";
        productsController($pdo);
        break;

    case "product":
        require_once "./controller/productController.php";
        $id = (int)($_GET['id'] ?? 0);
        productController($pdo, $id);
        break;

    case "cart":
        require_once "./controller/cartController.php";
        cartController($pdo);
        break;

    case "profil":
        require_once "./controller/profilController.php";
        profilController($pdo);
        break;

    case "signup":
        require_once "./controller/signupController.php";
        signupController($pdo);
        break;

    case "signin":
        require_once "./controller/signinController.php";
        signinController($pdo);
        break;

    case "logout":
        require_once "./controller/logoutController.php";
        logoutController();
        break;

    case "craftman-products":
        if (isCraftman()) {
            require_once "./controller/craftmanProductsController.php";
            craftmanProductsController($pdo);
            break;
        } else {
            die("Vous n'êtes pas artisan");
        }

    case "add-product-craftman":
        require_once "./controller/addProductCraftmanController.php";
        addProductCraftmanController($pdo);
        break;
    
    case "edit-product":
        require_once "./controller/craftmanProductsController.php";
         editCraftmanProductController($pdo);
        break;

    case "craftmen":
        require_once "./controller/craftmenController.php";
        craftmenController($pdo);
        break;

    case "craftman":
        // ✅ IMPORTANT: uses the dedicated craftman page controller
        require_once __DIR__ . "/controller/craftmanController.php";
        craftmanController($pdo);
        break;

    case "order":
        require_once "./controller/orderController.php";
        orderController($pdo);
        break;

    case "checkout":
        require_once "./controller/checkoutController.php";
        checkoutController($pdo);
        break;

    case "order-success":
        require "./view/layout/header.php";
        require "./view/pages/order-success.php";
        require "./view/layout/footer.php";
        break;

    case "faq":
        require_once "./controller/faqController.php";
        faqController($pdo);
        break;

    case "support":
        require_once "./controller/supportController.php";
        supportController($pdo);
        break;

    case "craftman-support":
        require_once "./controller/craftmanSupportController.php";
        craftmanSupportController($pdo);
        break;

    /*------------------------------------ 
                PAGES ADMIN 
    -------------------------------------*/
    
    case "admin-craftmen":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminCraftmenController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-customers":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminCustomersController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-products":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminProductsController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-orders":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminOrdersController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-reviews":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminReviewsController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-support":
        if (isAdmin()) {
            require_once "./controller/adminSupportController.php";
            adminSupportController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-faq":
        if (isAdmin()) {
            require_once "./controller/adminFaqController.php";
            adminFaqController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

    default:
        require "./view/layout/header.php";
        require "./view/pages/homepage.php";
        require "./view/layout/footer.php";
        break;
}
