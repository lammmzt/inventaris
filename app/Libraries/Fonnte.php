<?php

namespace App\Libraries;

use App\Models\waGatewayModel;

class Fonnte
{
    protected $token;
    protected $sendUrl = 'https://api.fonnte.com/send';
    protected $meUrl   = 'https://api.fonnte.com/me';

    public function __construct()
    {
        $model = new waGatewayModel();

        $setting = $model->getWaGatewayActive();

        if (!$setting) {
            throw new \Exception('Setting WhatsApp tidak ditemukan');
        }

        $this->token = $setting['token_wa_gateway'];
    }

    /**
     * Kirim Pesan WA
     */
    public function send($phone, $message)
    {
        return $this->request($this->sendUrl, [
            'target'  => $phone,
            'message' => $message
        ]);
    }

    /**
     * Tes koneksi / status device
     */
    public function testConnection()
    {
        return $this->request($this->meUrl);
    }

    /**
     * CURL Handler
     */
    private function request($url, $data = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => !empty($data),
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "Authorization: {$this->token}"
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return [
                'error' => true,
                'status' => '500',
                'data'   => curl_error($curl)
            ];
        }

        curl_close($curl);

        return json_decode($response, true);
    }
}