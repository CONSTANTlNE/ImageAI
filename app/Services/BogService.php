<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class BogService
{
    protected $clientId;
    protected $clientSecret;


    public function __construct()
    {
        $this->clientId     = config('apikeys.BOG_ID');
        $this->clientSecret = config('apikeys.BOG_SECRET');
    }

    public function BogAuth()
    {
        $client   = new Client();
        $response = $client->post('https://oauth2.bog.ge/auth/realms/bog/protocol/openid-connect/token', [
            'auth'        => [$this->clientId, $this->clientSecret],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
            'headers'     => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if ($data) {
            $token = $data['access_token'];
            session(['bog_token' => $token]);
        }

        return $data['access_token'];
    }

    public function PaymentRequest($amount, $userid)
    {
        $client = new Client();

        $response = $client->post('https://api.bog.ge/payments/v1/ecommerce/orders', [
            'headers' => [
                'Accept-Language' => 'ka',
                'Authorization'   => 'Bearer '.session('bog_token'),
                'Content-Type'    => 'application/json',
            ],
            'json'    => [
                'buyer'             => [
                    'full_name' => '',
                ],
                'capture'           => 'automatic',
                'callback_url'      => 'https://local.ews.ge/api/bog/webhook',
                'external_order_id' => $userid,
                'purchase_units'    => [
                    'currency'     => 'GEL',
                    'total_amount' => $amount,
                    'basket'       => [
                        [
                            'quantity'    => 1,
                            'unit_price'  => $amount,
                            'total_price' => $amount,
                            'product_id'  => 'balance',
                            'tin'         => auth()->user()->id,
                        ],
                    ],
                ],
                'redirect_urls'     => [
                    'fail'    => 'https://google.com',
                    'success' => 'https://local.ews.ge',
                ],
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);


        return redirect($body['_links']['redirect']['href']);
    }

    public function GetPaymentStatus($order_id)
    {
        $token     = $this->BogAuth();
        $response2 = Http::withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->get('https://api.bog.ge/payments/v1/receipt/'.$order_id);

        return json_decode($response2->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function Refund($order_id, $amount) {

        $token     = $this->BogAuth();
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Content-Type'  => 'application/json',
        ])->post('https://api.bog.ge/payments/v1/payment/refund/'.$order_id,
                ['amount' => $amount]
        );

        return $response->json();
    }

}
