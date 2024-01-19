<?php

/*
Feito por: @claradeb33 
           @lucasdev33
           xspeeddev
 */

class PixPaymentGenerator
{
    private $accessToken;
    private $notificationUrl;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function generatePixPayment($nickname, $email, $message, $valueToPay)
    {
        // Informações
        $payer = [
            "first_name" => $nickname,
            "email"      => $email
        ];

        $informations = [
            "description"        => "Donation from {$nickname}",
            "transaction_amount" => $valueToPay,
            "payment_method_id"  => "pix"
        ];

        $payment = json_encode(array_merge(["payer" => $payer], $informations));

        // Mandar a solicitação pro MP
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.mercadopago.com/v1/payments",
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $payment,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->accessToken,
                'Content-Type: application/json'
            ]
        ]);

        $response = curl_exec($curl);
        // Para mais informações do pagamento descomente
        /*
echo "Request Payload: " . $payment . PHP_EOL;
echo "Response from Mercado Pago: " . $response . PHP_EOL;*/

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode >= 200 && $httpCode < 300) {
            // Mercado Pago response
            $response = json_decode($response, true);
            $code = $response['point_of_interaction']['transaction_data']['qr_code'] ?? '';

            return $this->jsonResponse("success", "", [
                "status" => "success",
                "code"   => $code
            ]);
        } else {
            return $this->jsonResponse("error", "Failed to communicate with Mercado Pago.");
        }
    }

    private function jsonResponse($status, $message, $data = null)
    {
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $data
        ];

        return json_encode($response, JSON_PRETTY_PRINT);
    }
}

// Pegar parametros da urL
$nickname = $_GET['first_name'] ?? '';
$email = $_GET['email'] ?? '';
$message = $_GET['description'] ?? '';
$valueToPay = isset($_GET['transaction_amount']) ? floatval($_GET['transaction_amount']) : 0;

// Example Usage:
$pixPaymentGenerator = new PixPaymentGenerator("SEU-USER-TOKEN ");
$result = $pixPaymentGenerator->generatePixPayment($nickname, $email, $message, $valueToPay);

echo $result;

?>
