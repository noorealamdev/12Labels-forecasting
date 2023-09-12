<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SellingPartnerApi\Configuration;
use SellingPartnerApi\Endpoint;

class ConfigController extends Controller
{
    public static function getSpApiConfiguration()
    {
        return new Configuration([
            'lwaClientId'           => env('LWA_CLIENT_ID'),
            'lwaClientSecret'       => env('LWA_CLIENT_SECRET'),
            'lwaRefreshToken'       => env('LWA_REFRESH_TOKEN'),
            'awsAccessKeyId'        => env('AWS_ACCESS_KEY_ID'),
            'awsSecretAccessKey'    => env('AWS_SECRET_ACCESS_KEY'),
            'endpoint' => Endpoint::NA,
        ]);
    }
}
