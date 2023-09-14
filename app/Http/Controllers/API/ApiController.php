<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Exception\ClientException;
use SellingPartnerApi\Api\BaseApi;
use SellingPartnerApi\Api\FbaInventoryV1Api;
use SellingPartnerApi\Api\SalesV1Api;
use Throwable;

class ApiController extends Controller
{
    public function getOrderMetrics($input_sku)
    {
        $spApiconfig = ConfigController::getSpApiConfiguration();

        $apiInstance = new SalesV1Api($spApiconfig);

//        echo date('y:F:d'); // first month
//        echo date('y:F:d', strtotime('-1 month')); // previous month
//        echo date('y:F:d', strtotime('-2 month')); // second previous month
//        echo date('y:F:d', strtotime('-3 month')); // third previous month

        $current_date = date('Y-m-d'); // first month
        $third_previous_month = date('Y-m-d', strtotime('-3 month')); // third previous month
        $three_months_date_range = ''.$third_previous_month.'T00:00:00-05:00--'.$current_date.'T00:00:00-05:00';

        $marketplace_ids = array('ATVPDKIKX0DER');
        $interval = $three_months_date_range;
        $granularity = 'Total';
        $buyer_type = 'All';
        $granularity_time_zone = null;
        $fulfillment_network = null;
        $first_day_of_week = 'monday';
        $asin = null;
        $sku = $input_sku;

        try {
            $result = $apiInstance->getOrderMetrics(
                $marketplace_ids,
                $interval,
                $granularity,
                $granularity_time_zone,
                $buyer_type,
                $fulfillment_network,
                $first_day_of_week,
                $asin,
                $sku
            );

            return $result->getPayload()[0];


        } catch (Exception $e) {
            echo 'Exception when calling SalesV1Api->getOrderMetrics: ', $e->getMessage(), PHP_EOL;
        }
    }


    public function getFbaInventory($input_sku)
    {
        $spApiconfig = ConfigController::getSpApiConfiguration();
        $apiInstance = new FbaInventoryV1Api($spApiconfig);

        //$seller_id = 'A3N5N00P1KH2I6';
        //$sku = 'KS-1104-SL';
        $granularity_type = 'Marketplace';
        $granularity_id = 'ATVPDKIKX0DER';
        $marketplace_ids = array('ATVPDKIKX0DER');
        $details = 'false';
        $start_date_time = null;
        $seller_skus = null;
        $next_token = null;
        $seller_sku = $input_sku;

        try {
            $result = $apiInstance->getInventorySummaries($granularity_type, $granularity_id, $marketplace_ids, $details, $start_date_time, $seller_skus, $next_token, $seller_sku);

            return $result->getPayload()['inventory_summaries'][0];

        } catch (Exception $e) {
            //echo 'Exception when calling FbaInventoryV1Api->getInventorySummaries: ', $e->getMessage(), PHP_EOL;
        }
    }


    public function getSkuVaultData($input_sku)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $skuVaultresponse = $client->request('POST', 'https://app.skuvault.com/api/products/getProduct', [
                'body' => '{"TenantToken":"......","UserToken":"......","ProductSKU":"' . $input_sku . '"}',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if (200 == $skuVaultresponse->getStatusCode()) {
                $skuvault_result_body = $skuVaultresponse->getBody();

                return json_decode($skuvault_result_body);

            } else {
                echo $skuVaultresponse->getStatusCode();
            }

        }
        catch (ClientException $e) {
            echo $e->getMessage();
        }
    }

    public function getPoInboundQuantity($input_sku)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $skuVaultresponse = $client->request('POST', 'https://app.skuvault.com/api/purchaseorders/getPOs', [
                'body' => '{"PageNumber":0,"IncludeProducts":false,"TenantToken":"......","UserToken":"......"}',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if (200 == $skuVaultresponse->getStatusCode()) {
                $skuvault_result_body = $skuVaultresponse->getBody();
                $result = json_decode($skuvault_result_body);
                $purchase_orders = $result->PurchaseOrders;
                if ($purchase_orders) {
                    foreach ($purchase_orders as $po) {
                        if ($po->Status == 'NoneReceived' || $po->Status == 'PartiallyReceived') {
                            $line_items = $po->LineItems;
                            foreach ($line_items as $item) {
                                if ($item->SKU == $input_sku) {
                                    if ($item->Quantity) {
                                        return $item->Quantity;
                                    }
                                }
                            }
                        }
                    }
                }

            } else {
                return $skuVaultresponse->getStatusCode();
            }

        }
        catch (ClientException $e) {
            echo $e->getMessage();
        }
    }


    public function getSkuVaultSuppliers()
    {
        $client = new \GuzzleHttp\Client();

        try {
            $skuVaultresponse = $client->request('POST', 'https://app.skuvault.com/api/products/getSuppliers', [
                'body' => '{"PageNumber":0,"TenantToken":".....","UserToken":"......"}',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if (200 == $skuVaultresponse->getStatusCode()) {
                $skuvault_result_body = $skuVaultresponse->getBody();

                return json_decode($skuvault_result_body);

            } else {
                return $skuVaultresponse->getStatusCode();
            }

        }
        catch (ClientException $e) {
            return $e->getMessage();
        }

    }


}
