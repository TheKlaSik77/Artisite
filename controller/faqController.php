<?php
require_once "./model/requests.faq.php";

function faqController(PDO $pdo)
{
    $faqs = faqGetAllPublic($pdo);

    require "./view/layout/header.php";
    require "./view/pages/faq.php";
    require "./view/layout/footer.php";
}
