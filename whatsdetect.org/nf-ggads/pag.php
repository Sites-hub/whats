<?php
// Inclua o SDK do Mercado Pago
require 'vendor/autoload.php';

// Configure o Mercado Pago com seu Access Token
MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN"); // Substitua pelo seu Access Token

// Crie a preferência de pagamento
$preference = new MercadoPago\Preference();

// Crie o item (produto ou serviço) a ser pago
$item = new MercadoPago\Item();
$item->title = "Detector de WhatsApp";
$item->quantity = 1;
$item->unit_price = 29.90;  // Preço do produto

// Adicione o item à preferência
$preference->items = array($item);

// Defina as URLs de retorno (após o pagamento)
$preference->back_urls = array(
    "success" => "https://www.suapagina.com/success",
    "failure" => "https://www.suapagina.com/failure",
    "pending" => "https://www.suapagina.com/pending"
);

// Defina os métodos de pagamento permitidos (somente Pix)
$preference->payment_methods = array(
    "excluded_payment_types" => array(
        array("id" => "ticket"),  // Exclui boleto
        array("id" => "credit_card"),  // Exclui cartão de crédito
    ),
    "default_payment_method" => "pix"  // Define Pix como a forma de pagamento padrão
);

// Salve a preferência
$preference->save();

// O link de pagamento gerado
echo "Link de pagamento: " . $preference->init_point;
?>
