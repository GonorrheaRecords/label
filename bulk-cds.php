<?php
session_start();
$lang = $_SESSION['lang'] ?? 'es';

function __($key) {
    global $lang;
    $translations = [
        'es' => [
            'title' => 'Comprar CDs en cantidad',
            'description' => 'Aquí puedes comprar CDs en grandes cantidades para distribución o colección.',
            'check_stock' => 'Verificar stock de CDs',
            'shipping_options' => 'Opciones de envío:',
        ],
        'en' => [
            'title' => 'Buy CDs in Bulk',
            'description' => 'Here you can buy CDs in large quantities for distribution or collection.',
            'check_stock' => 'Check CD stock',
            'shipping_options' => 'Shipping options:',
        ]
    ];
    return $translations[$lang][$key] ?? $key;
}

function getShippingOptions($country, $state, $postalCode, $products) {
    $xml = new SimpleXMLElement('<ShippingOptions></ShippingOptions>');
    $xml->addChild('Country', $country);
    $xml->addChild('State_Province', $state);
    $xml->addChild('PostalCode', $postalCode);
    
    foreach ($products as $product) {
        $productXml = $xml->addChild('Product');
        $productXml->addChild('ProductId', $product['id']);
        $productXml->addChild('Quantity', $product['quantity']);
    }

    $ch = curl_init('https://Kunaki.com/XMLService.ASP');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml->asXML());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    $response = new SimpleXMLElement($result);
    return $response->Option;
}
?>

<h1><?php echo __('title'); ?></h1>
<p><?php echo __('description'); ?></p>

<button id="checkStock" class="btn btn-primary"><?php echo __('check_stock'); ?></button>

<div id="shippingOptions" class="mt-4" style="display: none;">
    <h2><?php echo __('shipping_options'); ?></h2>
    <ul id="optionsList"></ul>
</div>

<script>
$(document).ready(function() {
    $('#checkStock').click(function() {
        $.ajax({
            url: 'get_shipping_options.php',
            type: 'POST',
            data: {
                country: 'United States',
                state: 'NY',
                postalCode: '10004',
                products: JSON.stringify([{id: 'PXZZ111111', quantity: 1}])
            },
            success: function(data) {
                var options = JSON.parse(data);
                var optionsList = $('#optionsList');
                optionsList.empty();
                options.forEach(function(option) {
                    optionsList.append('<li>' + option.Description + ' - ' + option.DeliveryTime + ' - $' + option.Price + '</li>');
                });
                $('#shippingOptions').show();
            },
            error: function() {
                alert('Error al obtener las opciones de envío.');
            }
        });
    });
});
</script>

