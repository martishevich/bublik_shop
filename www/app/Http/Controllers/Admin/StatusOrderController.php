<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Req;
use GuzzleHttp\Client as Client;

class StatusOrderController extends Controller
{

    public function index()
    {
        $client   = new Client(['base_url' => 'http://localhost']);
        $data     = [
            'form_params' => [
                'name' => 'Slavik',
                'tag'  => 'tapok'
            ]
        ];
        $responce = $client->request('POST',
            'http://localhost/payment',
            $data);
        echo $responce->getBody();
    }
}