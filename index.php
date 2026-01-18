<?php
session_start();

$isAjax = ($_GET['page'] ?? '') === 'signup' && ($_GET['action'] ?? '') === 'checkDuplicate';

require_once "./model/utils/connexion.php";
require_once "./model/utils/auth.php";

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

    case "admin-dashboard":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminDashboardController();
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-craftmen":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminCraftmenController();
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-customers":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminCustomersController();
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-products":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminProductsController();
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-orders":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminOrdersController();
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-reviews":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminReviewsController();
            break;
        } else {
            $page = "home";
            break;
        }

    case "admin-support":
        if (isAdmin()) {
            require "./controller/adminController.php";
            adminSupportController();
            break;
        } else {
            $page = "home";
            break;
        }

    default:
        require "./view/layout/header.php";
        require "./view/pages/{$page}.php";
        require "./view/layout/footer.php";
        break;
}
