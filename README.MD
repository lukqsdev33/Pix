# Mercado Pago PHP PIX API

## Introdução
Esta classe PHP pura facilita pagamentos automáticos via Pix utilizando a API do Mercado Pago. Utiliza cURL para comunicação com a plataforma, proporcionando uma integração eficiente e direta.

## Modo de Instalação
1. Certifique-se de ter o PHP instalado em seu ambiente.
2. Faça o download da classe e coloque-a na raiz de seu servidor (funciona em localhost).
3. Substitua a marcação `SEU-TOKEN` no código pelo seu AccessToken do Mercado Pago.

## Exemplo de Uso
```$pixPaymentGenerator = new PixPaymentGenerator("SEU-TOKEN ");
$result = $pixPaymentGenerator->generatePixPayment($nickname, $email, $message, $valueToPay);
```

## Suporte e Contribuições
Para dúvidas ou contribuições, sinta-se à vontade para entrar em contato:
- Telegram: [@claradev33](https://t.me/claradev33)
- Discord: @lucasdev33
- Outras redes: @xspeeddev

Agradecemos por escolher a classe Mercado Pago PHP PURO PAGAMENTO AUTOMÁTICO VIA PIX API. Esperamos que facilite suas integrações de pagamento!
