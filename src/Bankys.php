<?php

namespace Bankys;

class Bankys
{
    private $client = null;

    public function __construct(
        private string $username,
        private string $password,
        private string $clientId,
        private string $clientSecret,
        private string|null $token = null
    ) {
        $this->client = new Client();

        if (!$this->token) {
            $this->getToken();
        }
    }

    public function dynamicPix(
        string $pixKey,
        string $identifier,
        float $value
    ) {
        return $this->createTypedPix(
            'GerarQRCodePix',
            $pixKey,
            $identifier,
            $value
        );
    }

    public function staticPix(
        string $pixKey,
        string $identifier,
        float|null $value = null
    ) {
        return $this->createTypedPix(
            'GerarQRCodeEstatico',
            $pixKey,
            $identifier,
            $value
        );
    }

    public function getPixKey(string $pixKey)
    {
        return $this->sendPost('GetPixKey', [
            'chavePix' => $pixKey
        ]);
    }

    public function sendPix(
        string $payerPixKey,
        string $receiverPixKey,
        float $value
    ) {
        return $this->sendPost('EnviarPixChave', [
            'chavePixPagador' => $payerPixKey,
            'chavePixRecebedor' => $receiverPixKey,
            'valor' => $value
        ]);
    }

    public function getExtract(string $startAt, string $endAt)
    {
        return $this->sendPost('consultaExtrato', [
            'dataInicial' => $startAt,
            'dataFinal' => $endAt
        ]);
    }

    public function getTransaction(string $transactionId)
    {
        return $this->sendPost('consultaTransacaoPixOut', [
            'transactionId' => $transactionId
        ]);
    }

    public function getToken()
    {
        if ($this->token) {
            return $this->token;
        }

        $data = $this->sendPost('GetToken', []);

        $this->token = $data['Token'];

        return $this->token;
    }

    private function createTypedPix(
        string $endpoint,
        string $pixKey,
        string $identifier,
        float|null $value
    ) {
        return $this->sendPost($endpoint, [
            'chavePixRecebedor' => $pixKey,
            'identificador' => $identifier,
            'valor' => $value,
        ]);
    }

    private function sendPost(
        string $endpoint,
        array $data
    ) {
        $data = array_merge($data, [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'token' => $this->token,
        ]);

        try {
            $response = $this->client->post($endpoint, [
                'json' => $data,
                'auth' => [
                    $this->username,
                    $this->password
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
