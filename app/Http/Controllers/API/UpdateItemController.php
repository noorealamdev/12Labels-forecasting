<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Supplier;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use SellingPartnerApi\Api\CatalogItemsV0Api;
use SellingPartnerApi\Api\FbaInventoryV1Api;
use Throwable;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class UpdateItemController extends Controller
{
    public function run()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $apiController = new ApiController();
        //$skus = ['KS-1104-SL', 'KS-1104-S', 'KS-4'];

        $items = Item::all()->take(2);

        if ( $items->isEmpty() ) {
            echo 'No Item found';
        }
        else {
            foreach ($items as $index => $item) {

                $startMessage = 'Processing '.$index .'--'.$item->sku.'';
                Log::channel('stderr')->info($startMessage);

                try {
                    //SkuVault
                    $skuVaultInventory = $apiController->getSkuVaultData($item->sku);
                    $skuVaultPoInboundQuantity = $apiController->getPoInboundQuantity($item->sku);
                    $po_quantity = 0;
                    if ($skuVaultPoInboundQuantity) {
                        $po_quantity = $skuVaultPoInboundQuantity;
                    }
                    $wh_inventory = $skuVaultInventory->Product->QuantityOnHand;
                    $quantity_total_fba = $skuVaultInventory->Product->QuantityTotalFBA;
                    $fba_inventory = $quantity_total_fba;
                    $on_hand_inventory = $wh_inventory + $fba_inventory;

                    $supplier_name_api = $skuVaultInventory->Product->Supplier;
                    $suppliers = Supplier::all();
                    $supplier_id = 1; // id 6 is for "Unknown" supplier
                    foreach ($suppliers as $supplier) {
                        if ($supplier->name === $supplier_name_api) {
                            $supplier_id = $supplier->id;
                        }
                    }

                    //Amazon
                    $spOrderMetrics = $apiController->getOrderMetrics($item->sku);
                    $spFbaInventory = $apiController->getFbaInventory($item->sku);
                    $amazon_inventory = $spFbaInventory['total_quantity'];
                    $amazon_90_day_sales = $spOrderMetrics['unit_count'];
                    $amazon_30_day_sales = floor($amazon_90_day_sales / 3);

                    //Other columns
                    $total_inventory = $wh_inventory + $fba_inventory + $po_quantity;
                    $cover_in_months_including_inbound = divisionNum($total_inventory, $amazon_30_day_sales);
                    $cover_in_months_not_including_inbound = divisionNum($on_hand_inventory, $amazon_30_day_sales);
                    $order_quantity = ($amazon_30_day_sales * 12) - $total_inventory;

                }  catch (Throwable $e) {
                    // Handle exception
                    $amazon_inventory = 0;
                }

                Item::where('sku', $item->sku)->update([
                    'supplier_id' => $supplier_id,
                    'fbaInventory' => $fba_inventory,
                    'whInventory' => $wh_inventory,
                    'amazonInventory' => $amazon_inventory,
                    'inboundOrders' => $po_quantity,
                    'totalInventory' => $total_inventory,
                    'thirtyDaysSales' => $amazon_30_day_sales,
                    'ninetyDayAmazon' => $amazon_90_day_sales,
                    'coverInMonths' => $cover_in_months_not_including_inbound,
                    'coverInMonthsInbound' => $cover_in_months_including_inbound,
                    'orderQuantity' => $order_quantity,
                ]);

                $endMessage = 'Processing '.$index .'--'.$item->sku.' Completed';
                Log::channel('stderr')->info($endMessage);

                //Sleep 1 seconds, use ob_flush if necessary
                sleep(12);

            } //end foreach loop

            return redirect()->route('items.index')->with(['msg' => 'Task completed successfully', 'type' => 'success']);
        }


    }


    public function check()
    {
        $apiController = new ApiController();
        $suppliers = $apiController->getSkuVaultSuppliers();

        foreach ($suppliers->Suppliers as $supplier) {
            echo $supplier->Name;
        }
    }

    public function finalCheck()
    {
        $apiController = new ApiController();

        //SkuVault
        $skuVaultInventory = $apiController->getSkuVaultData('KS-11');
        $skuVaultPoInboundQuantity = $apiController->getPoInboundQuantity('KS-11');
        $po_quantity = 0;
        if ($skuVaultPoInboundQuantity) {
            $po_quantity = $skuVaultPoInboundQuantity;
        }
        $wh_inventory = $skuVaultInventory->Product->QuantityOnHand;
        $quantity_total_fba = $skuVaultInventory->Product->QuantityTotalFBA;
        $fba_inventory = $quantity_total_fba;
        $on_hand_inventory = $wh_inventory + $fba_inventory;

        //Amazon
        $spOrderMetrics = $apiController->getOrderMetrics('KS-11');
        $spFbaInventory = $apiController->getFbaInventory('KS-11');
        $amazon_inventory = $spFbaInventory['total_quantity'];
        $amazon_90_day_sales = $spOrderMetrics['unit_count'];
        $amazon_30_day_sales = floor($amazon_90_day_sales / 3);

        //Other columns
        $total_inventory = $wh_inventory + $fba_inventory + $po_quantity;
        $cover_in_months_including_inbound = divisionNum($total_inventory, $amazon_30_day_sales);
        $cover_in_months_not_including_inbound = divisionNum($on_hand_inventory, $amazon_30_day_sales);
        $order_quantity = ($amazon_30_day_sales * 12) - $total_inventory;

        echo 'SKU: KS-4';
        echo '<br>';
        echo '<br>';
        echo 'WH Inventory: '.$wh_inventory;
        echo '<br>';
        echo 'FBA Inventory: '.$fba_inventory;
        echo '<br>';
        echo 'Amazon Inventory: '.$amazon_inventory;
        echo '<br>';
        echo 'Inbound Orders: '.$po_quantity;
        echo '<br>';
        echo 'Total Inventory: '.$total_inventory;
        echo '<br>';
        echo '30 Day Amazon Sales: '.$amazon_30_day_sales;
        echo '<br>';
        echo '90 Day Amazon Sales: '.$amazon_90_day_sales;
        echo '<br>';
        echo 'Cover in Months (not including inbound): '.$cover_in_months_not_including_inbound;
        echo '<br>';
        echo 'Cover in Months (including inbound): '.$cover_in_months_including_inbound;
        echo '<br>';
        echo 'Order Quantity: '.$order_quantity;
    }

    public function poCheck()
    {
        $client = new \GuzzleHttp\Client();

        $input_sku = 'KS-4';

        try {
            $skuVaultresponse = $client->request('POST', 'https://app.skuvault.com/api/purchaseorders/getPOs', [
                'body' => '{"PageNumber":0,"IncludeProducts":false,"TenantToken":"Qi5rmltRog9RaxbwpDHOItIAHI5EOhHGe4+zub3Qhb8=","UserToken":"0OlQC7FcDAyY81HaALsKD9i3HWJkVgHXFyaN7cf3/ck="}',
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
                                        echo $item->Quantity;
                                    }
                                }
                            }
                        }
                    }
                }

            } else {
                echo $skuVaultresponse->getStatusCode();
            }

        }
        catch (ClientException $e) {
            echo $e->getMessage();
        }
    }

    // Import all SKUs from SkuVault to Item model
    public function importSKUsfromSkuVault()
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://app.skuvault.com/api/products/getProducts', [
            'body' => '{"ModifiedAfterDateTimeUtc":"minDate","ModifiedBeforeDateTimeUtc":"maxDate","PageNumber":0,"PageSize":10000,"TenantToken":"Qi5rmltRog9RaxbwpDHOItIAHI5EOhHGe4+zub3Qhb8=","UserToken":"0OlQC7FcDAyY81HaALsKD9i3HWJkVgHXFyaN7cf3/ck="}',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        $all_items = $result['Products'];

        //$all_items = array_slice($all_items,0,50);

        foreach ($all_items as $item) {

            $title = $item['Description'];
            $sku = $item['Sku'];
            $supplier_name_api = $item['Supplier'];
            $wh_inventory = $item['QuantityOnHand'];
            $quantity_total = $item['QuantityTotalFBA'];
            $fba_total = $wh_inventory + $quantity_total;

            $local_item = new Item();

            $local_item->sku = $sku;
            $local_item->title = $title;
            $local_item->supplier_id = 6;
            $local_item->whInventory = $wh_inventory;
            $local_item->fbaInventory = $fba_total;

            $local_item->save();

        }; //end foreach

        return redirect()->route('items.index')->with(['msg' => 'SKUs Added Successfully from SkuVault', 'type' => 'success']);
    }

    // Import all SKUs from SkuVault to Item model
    public function importSKUsfromAmazon()
    {
        $spApiconfig = ConfigController::getSpApiConfiguration();
        $apiInstance = new FbaInventoryV1Api($spApiconfig);

        //$seller_id = 'A3N5N00P1KH2I6';
        //$sku = 'KS-1104-SL';
        $granularity_type = 'Marketplace';
        $granularity_id = 'ATVPDKIKX0DER';
        $marketplace_ids = array('ATVPDKIKX0DER');
        $details = 'true';
        $start_date_time = null;
        $seller_skus = null;
        $next_token = null;
        $seller_sku = '';

        try {
            $result = $apiInstance->getInventorySummaries($granularity_type, $granularity_id, $marketplace_ids, $details, $start_date_time, $seller_skus, $next_token, $seller_sku);

            echo "<pre>";
            print_r($result->getPayload()['inventory_summaries']);
            echo "</pre>";

        } catch (Exception $e) {
            //echo 'Exception when calling FbaInventoryV1Api->getInventorySummaries: ', $e->getMessage(), PHP_EOL;
        }

        //$result = json_decode($response->getBody(), true);

        //$all_items = $result['Products'];
        //$all_items = array_slice($all_items,0,50);

//        foreach ($all_items as $item) {
//
//            $title = $item['Description'];
//            $sku = $item['Sku'];
//            $supplier_name_api = $item['Supplier'];
//            $wh_inventory = $item['QuantityOnHand'];
//            $quantity_total = $item['QuantityTotalFBA'];
//            $fba_total = $wh_inventory + $quantity_total;
//
//            $local_item = new Item();
//
//            $local_item->sku = $sku;
//            $local_item->title = $title;
//            $local_item->item_category_id = 1;
//            $local_item->supplier_id = 6;
//            $local_item->whInventory = $wh_inventory;
//            $local_item->fbaInventory = $fba_total;
//
//            $local_item->save();
//
//        }; //end foreach

        //return redirect()->route('items.index')->with(['msg' => 'SKUs Added Successfully from Amazon', 'type' => 'success']);
    }

    // Add ASIN based on each SKUs and update it on the Item model upcAsinFnsku column
    public function addASINsfromAmazon()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $apiController = new ApiController();

        $items = Item::all();

        if ( $items->isEmpty() ) {
            echo 'No Item found';
        }
        else {
            foreach ( $items as $item ) {
                try {
                    $spAsinNumber = $apiController->getFbaInventory($item->sku);
                    $asin = $spAsinNumber['asin'];
                } catch (Throwable $e) {
                    $asin = null;
                }

                Item::where('sku', $item->sku)->update(
                    [
                        'upcAsinFnsku' => $asin,
                    ]
                );
            }
        }

        return redirect()->route('items.index')->with(['msg' => 'Task completed successfully', 'type' => 'success']);

    }


    //Import all suppliers from SkuVault
    public function importSkuVaultSuppliers()
    {
        $apiController = new ApiController();
        $suppliers = $apiController->getSkuVaultSuppliers();

        foreach ($suppliers->Suppliers as $supplier) {
            $suppliersModel = new Supplier();
            $suppliersModel->name = $supplier->Name;

            $suppliersModel->save();
        }

        return redirect()->route('suppliers.index')->with(['msg' => 'Suppliers Added Successfully from SkuVault', 'type' => 'success']);
    }

}
