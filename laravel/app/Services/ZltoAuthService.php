<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class ZltoAuthService
{
    protected $url;
    protected $http;
    protected $headers;

    public function __construct(Client $client)
    {
        $this->url = 'https://api.uptimerobot.com/v2/';
        $this->http = $client;
        $this->headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded',
        ];
    }

    private function getResponse(string $uri = null)
    {
        $full_path = $this->url;
        $full_path .= $uri;

        $request = $this->http->get($full_path, [
            'headers'         => $this->headers,
            'timeout'         => 30,
            'connect_timeout' => true,
            'http_errors'     => true,
        ]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            return (object) json_decode($response);
        }

        return null;
    }

    private function postResponse(string $uri = null, array $post_params = [])
    {
        $full_path = $this->url;
        $full_path .= $uri;

        $request = $this->http->post($full_path, [
            'headers'         => $this->headers,
            'timeout'         => 30,
            'connect_timeout' => true,
            'http_errors'     => true,
            'form_params'     => $post_params,
        ]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            return (object) json_decode($response);
        }

        return null;
    }

    public function getMonitors()
    {
        return $this->getResponse('getMonitors');
    }

    /**********************************************************************************************
    * ZLTO GET OAUTH TOKEN
    ***********************************************************************************************
    *
    *
    */
    public function get_zlto_auth_token($client_id,$client_secret,$scope)
    {
        $client = new Client(); 
        $data=[
                    'grant_type' => 'client_credentials',
                    //'client_id' => 'zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX',//$_ENV['ZLTO_CLIENT_ID'], // get id from the env file
                    //'client_secret' =>'hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v' ,//$_ENV["ZLTO_CLIENT_SECRET"], // get secret from the env file
                    /*'client_id'=> 'zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX',
                    'client_secret'=> 'hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v',*/
                    'client_id' => $client_id,
                    'client_secret' => $client_secret,
                    'redirect_uri' => 'https://bana.vision',
                    "scope" => $scope
                ];

        $response = $client->post('https://staging-api.zlto.co/oauth/token/', ['json'=> $data] );
        //$response = $client->post('https://api.zlto.co/oauth/token/', ['json'=> $data] );






            $res_data = json_decode($response->getBody(), true);
            /*dd($res_data);*/
            session(['access_token'=>$res_data['access_token']]);
            //dd(session('access_token'));
            $token = $res_data['access_token'];

            return $token;

    }
}