<?php session_start(); 

require_once "./model/utils/connexion.php";
require_once "./model/utils/auth.php";

$page = $_GET['page'] ?? 'home';
$ajaxPages = ['admin-delete-craftman', 'admin-validate-craftman'];

if (in_array($page, $ajaxPages, true)) {
    if (!isAdmin()) {
        http_response_code(403);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["success" => false, "error" => "forbidden"]);
        exit;
    }

    require "./controller/adminController.php";

    if ($page === 'admin-delete-craftman') {
        adminDeleteCraftmanController($pdo);
        exit;
    }

    if ($page === 'admin-validate-craftman') {
        adminValidateCraftmanController($pdo);
        exit;
    }
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
    <!-- Intègre toutes les variables css nécéssaires aux autres fichiers css -->
    <link rel="stylesheet" href="./assets/css/variables.css">
</head>

<?php

# Ajouter liste de page autorisées pour sécurité
# Décommenter pour ajouter un admin
# require_once "create_admin.php";


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
        $id = $_GET['id'];
        productController($pdo, $id);
        break;

    case "cart":
        require_once "./controller/cartController.php";
        cartController($pdo);
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
        require_once "./controller/craftmanProductsController.php";
        craftmanProductsController($pdo);
        break;

    case "add-product-craftman":
        require_once "./controller/addProductCraftmanController.php";
        addProductCraftmanController($pdo);
        break;

    case "craftmen":
        require_once "./controller/craftmenController.php";
        craftmenController($pdo);
        break;

    case "craftman":
        require_once "./controller/craftmenController.php";
        getCraftmanController($pdo);
        break;

    case "order":
        require_once "./controller/orderController.php";
        orderController($pdo);
        break;

    case "checkout":
        require_once "./controller/checkoutController.php";
        checkoutController($pdo);
        break;

    case "admin-dashboard":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminDashboardController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }

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
            require "./controller/adminController.php";
            adminSupportController($pdo);
            break;
        } else {
            $page = "home";
            break;
        }
    case "faq":
    require_once "./controller/faqController.php";
    faqController($pdo);
    break;

    case "admin-faq":
    if (isAdmin()) {
        require_once "./controller/adminFaqController.php";
        adminFaqController($pdo);
        break;
    } else {
        $page = "home";
        break;
    }

    case "admin-validate-craftman":
        require "./controller/adminController.php";
        adminValidateCraftmanController($pdo);
        break;

    default:
        require "./view/layout/header.php";
        require "./view/pages/homepage.php";
        require "./view/layout/footer.php";
        break;
}

