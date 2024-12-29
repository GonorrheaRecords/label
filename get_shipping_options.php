<?php
require_once 'bulk-cds.php';

$country = $_POST['country'] ?? '';
$state = $_POST['state'] ?? '';
$postalCode = $_POST['postalCode'] ?? '';
$products = json_decode($_POST['products'], true) ?? [];

$options = getShippingOptions($country, $state, $postalCode, $products);

echo json_encode($options);

