<?php
  // Importação das classes do MercadoPago
  use MercadoPago\Client\Payment\PaymentClient;
  use MercadoPago\Client\Common\RequestOptions;
  use MercadoPago\MercadoPagoConfig;

  // Definir o token de acesso do MercadoPago (substitua pelo seu token real)
  MercadoPagoConfig::setAccessToken("YOUR_ACCESS_TOKEN");

  // Obter os dados do formulário enviado via POST
  $transactionAmount = (float) $_POST['transactionAmount'];  // Valor da transação
  $paymentMethodId = $_POST['paymentMethodId'];  // ID do método de pagamento
  $email = $_POST['email'];  // E-mail do comprador

  // Criação do cliente e das opções de requisição
  $client = new PaymentClient();
  $request_options = new RequestOptions();
  $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

  // Criando o pagamento com os dados do formulário
  $payment = $client->create([
    "transaction_amount" => $transactionAmount,  // Valor da transação
    "payment_method_id" => $paymentMethodId,  // Método de pagamento (como "visa", "master" etc.)
    "payer" => [
      "email" => $email,  // E-mail do comprador
      "identification" => [
        "type" => $_POST['identificationType'],  // Tipo de documento (ex: CPF)
        "number" => $_POST['identificationNumber'],  // Número do documento (ex: CPF)
      ]
    ]
  ], $request_options);

  // Exibindo a resposta do pagamento (em formato JSON)
  echo json_encode($payment);
?>
