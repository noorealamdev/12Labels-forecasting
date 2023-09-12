<?php

namespace App\Http\Controllers;

use App\Models\CosmicComfort;
use App\Models\JarWrestler;
use App\Models\JiangxiZhicheng;
use App\Models\JianxingShoe;
use App\Models\KingInsoles;
use App\Models\LongxinInsoles;
use App\Models\PostFlag;
use App\Models\SpottedSocks;
use App\Models\Zerosock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelController extends Controller
{
    public function start()
    {
        $excel_file = public_path('file.xlsx');

        // $rows is an instance of Illuminate\Support\LazyCollection

        //King Insoles Spreadsheet
//        $kingInsolesRows = SimpleExcelReader::create($excel_file)->fromSheet(1)->getRows();
//
//        foreach ($kingInsolesRows as $rowProperties) {
//            $title = $rowProperties['Title'];
//            $sku = $rowProperties['SKU'];
//            $upcasinfnsku = $rowProperties['UPC/ASIN/FNSKU'];
//            $wh_inventory = $rowProperties['WH Inventory'];
//            $amazon_inventory = $rowProperties['Amazon Inventory'];
//            $inboundorders = $rowProperties['Inbound Orders'];
//            $totalinventory = $rowProperties['Total Inventory'];
//            $thirtydayssales = $rowProperties['30 Days Sales'];
//            $ninetydayamazon = $rowProperties['90 Day Amazon'];
//            $coverinmonths = $rowProperties['Cover in Months (not including inbound)'];
//            $coverinmonthsinbound = $rowProperties['Cover in Months (including inbound)'];
//            $orderquantity = $rowProperties['Order Quantity'];
//            $casestoorder = $rowProperties['Cases to Order'];
//            $needairship = $rowProperties['Need to airship?'];
//
//            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
//                //skip to next iteration if item value is 0
//                continue;
//            }
//
//            $kingInsoles = new KingInsoles();
//
//            $kingInsoles->title = $title;
//            $kingInsoles->sku = $sku;
//            $kingInsoles->upcasinfnsku = $upcasinfnsku;
//            $kingInsoles->whinventory = $wh_inventory;
//            $kingInsoles->amazoninventory = $amazon_inventory;
//            $kingInsoles->inboundorders = $inboundorders;
//            $kingInsoles->totalinventory = $totalinventory;
//            $kingInsoles->thirtydayssales = $thirtydayssales;
//            $kingInsoles->ninetydayamazon = $ninetydayamazon;
//            $kingInsoles->coverinmonths = $coverinmonths;
//            $kingInsoles->coverinmonthsinbound = $coverinmonthsinbound;
//            $kingInsoles->orderquantity = $orderquantity;
//            $kingInsoles->casestoorder = intval($casestoorder);
//            if ($needairship == 1 ) {
//                $kingInsoles->needairship = 'true';
//            } else {
//                $kingInsoles->needairship = 'false';
//            }
//
//            $kingInsoles->save();
//
//        }; //end foreach
//
//        return redirect()->route('kingInsoles.index')->with(['msg' => 'Insoles Added Successfully from Spreadsheet', 'type' => 'success']);


        // Cosmic Comfort (FUSGO) Spreadsheet
//        $cosmicComfortRows = SimpleExcelReader::create($excel_file)->fromSheet(2)->getRows();
//
//        foreach ($cosmicComfortRows as $rowProperties) {
//
//            $title = $rowProperties['Title'];
//            $sku = $rowProperties['SKU'];
//            $upcasinfnsku = $rowProperties['UPC/ASIN/FNSKU'];
//            $wh_inventory = $rowProperties['WH Inventory'];
//            $amazon_inventory = $rowProperties['Amazon Inventory'];
//            $inboundorders = $rowProperties['Inbound Orders'];
//            $totalinventory = $rowProperties['Total Inventory'];
//            $thirtydayssales = $rowProperties['30 Days Sales'];
//            $ninetydayamazon = $rowProperties['90 Day Amazon'];
//            $coverinmonths = $rowProperties['Cover in months (not including inbound)'];
//            $coverinmonthsinbound = $rowProperties['Cover in Months (including inbound)'];
//            $orderquantity = $rowProperties['Order Quantity'];
//            $casestoorder = $rowProperties['Cases to Order'];
//            $needairship = $rowProperties['Need to airship?'];
//
//            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
//                //skip to next iteration if item value is 0
//                continue;
//            }
//
//            $cosmicComfort = new CosmicComfort();
//
//            $cosmicComfort->title = $title;
//            $cosmicComfort->sku = $sku;
//            $cosmicComfort->upcasinfnsku = $upcasinfnsku;
//            $cosmicComfort->whinventory = $wh_inventory;
//            $cosmicComfort->amazoninventory = $amazon_inventory;
//            $cosmicComfort->inboundorders = $inboundorders;
//            $cosmicComfort->totalinventory = $totalinventory;
//            $cosmicComfort->thirtydayssales = $thirtydayssales;
//            $cosmicComfort->ninetydayamazon = $ninetydayamazon;
//            $cosmicComfort->coverinmonths = $coverinmonths;
//            $cosmicComfort->coverinmonthsinbound = $coverinmonthsinbound;
//            $cosmicComfort->orderquantity = $orderquantity;
//            $cosmicComfort->casestoorder = intval($casestoorder);
//            if ($needairship == 1 ) {
//                $cosmicComfort->needairship = 'true';
//            } else {
//                $cosmicComfort->needairship = 'false';
//            }
//
//            $cosmicComfort->save();
//
//        }; //end foreach
//
//        return redirect()->route('cosmicComfort.index')->with(['msg' => 'Cosmic Comfort Added Successfully from Spreadsheet', 'type' => 'success']);



        // Zerosock Spreadsheet
//        $zerosockRows = SimpleExcelReader::create($excel_file)->fromSheet(3)->getRows();
//
//        foreach ($zerosockRows as $rowProperties) {
//
//            $sku = $rowProperties['SKU'];
//            $wh_inventory = $rowProperties['WH Inventory'];
//            $amazon_inventory = $rowProperties['Amazon Inventory'];
//            $inboundorders = $rowProperties['Inbound Orders'];
//            $totalinventory = $rowProperties['Total Inventory'];
//            $thirtydayssales = $rowProperties['30 Days Sales'];
//            $ninetydayamazon = $rowProperties['90 Day Amazon'];
//            $coverinmonths = $rowProperties['Cover in Months (not including inbound)'];
//            $coverinmonthsinbound = $rowProperties['Cover in Months'];
//            $orderquantity = $rowProperties['Order Quantity'];
//            $unitstoorder = $rowProperties['Units to Order'];
//            $needairship = $rowProperties['Need to airship?'];
//
//            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
//                //skip to next iteration if item value is 0
//                continue;
//            }
//
//            $zerosock = new Zerosock();
//
//            $zerosock->sku = $sku;
//            $zerosock->whinventory = $wh_inventory;
//            $zerosock->amazoninventory = $amazon_inventory;
//            $zerosock->inboundorders = $inboundorders;
//            $zerosock->totalinventory = $totalinventory;
//            $zerosock->thirtydayssales = $thirtydayssales;
//            $zerosock->ninetydayamazon = $ninetydayamazon;
//            $zerosock->coverinmonths = $coverinmonths;
//            $zerosock->coverinmonthsinbound = $coverinmonthsinbound;
//            $zerosock->orderquantity = $orderquantity;
//            $zerosock->unitstoorder = intval($unitstoorder);
//            if ($needairship == 1 ) {
//                $zerosock->needairship = 'true';
//            } else {
//                $zerosock->needairship = 'false';
//            }
//
//            $zerosock->save();
//
//        }; //end foreach
//
//        return redirect()->route('zerosock.index')->with(['msg' => 'Zerosock Added Successfully from Spreadsheet', 'type' => 'success']);



        // Longxin Insoles Spreadsheet
//        $longxinInsoleRows = SimpleExcelReader::create($excel_file)->fromSheet(4)->getRows();
//
//        foreach ($longxinInsoleRows as $rowProperties) {
//
//            $title = $rowProperties['Title'];
//            $upc = $rowProperties['UPC'];
//            $fnsku = $rowProperties['FNSKU'];
//            $sku = $rowProperties['SKU'];
//            $wh_inventory = $rowProperties['WH Inventory'];
//            $amazon_inventory = $rowProperties['Amazon Inventory'];
//            $inboundorders = $rowProperties['Inbound Orders'];
//            $totalinventory = $rowProperties['Total Inventory'];
//            $thirtydayssales = $rowProperties['30 Days Sales'];
//            $ninetydayamazon = $rowProperties['90 Day Amazon'];
//            $coverinmonths = $rowProperties['Cover in months (not including inbound)'];
//            $coverinmonthsinbound = $rowProperties['Cover in Months'];
//            $orderquantity = $rowProperties['Order Quantity'];
//            $unitstoorder = $rowProperties['Units to Order'];
//            $needairship = $rowProperties['Need to airship?'];
//
//            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
//                //skip to next iteration if item value is 0
//                continue;
//            }
//
//            $longxinInsoles = new LongxinInsoles();
//
//            $longxinInsoles->title = $title;
//            $longxinInsoles->upc = $upc;
//            $longxinInsoles->sku = $sku;
//            $longxinInsoles->fnsku = $fnsku;
//            $longxinInsoles->whinventory = $wh_inventory;
//            $longxinInsoles->amazoninventory = $amazon_inventory;
//            $longxinInsoles->inboundorders = $inboundorders;
//            $longxinInsoles->totalinventory = $totalinventory;
//            $longxinInsoles->thirtydayssales = $thirtydayssales;
//            $longxinInsoles->ninetydayamazon = $ninetydayamazon;
//            $longxinInsoles->coverinmonths = $coverinmonths;
//            $longxinInsoles->coverinmonthsinbound = $coverinmonthsinbound;
//            $longxinInsoles->orderquantity = intval($orderquantity);
//            $longxinInsoles->unitstoorder = null;
//            if ( $needairship == 1 ) {
//                $longxinInsoles->needairship = 'true';
//            } else {
//                $longxinInsoles->needairship = 'false';
//            }
//
//            $longxinInsoles->save();
//
//        }; //end foreach
//
//        return redirect()->route('longxinInsoles.index')->with(['msg' => 'Longxin Insoles Added Successfully from Spreadsheet', 'type' => 'success']);




        // Jiangxi Zhicheng Health Spreadsheet
//        $jiangxiZhichengRows = SimpleExcelReader::create($excel_file)->fromSheet(5)->getRows();
//
//        foreach ($jiangxiZhichengRows as $rowProperties) {
//
//            $title = $rowProperties['Title'];
//            $upcfnsku = $rowProperties['UPC/FNSKU'];
//            $sku = $rowProperties['SKU'];
//            $wh_inventory = $rowProperties['WH Inventory'];
//            $amazon_inventory = $rowProperties['Amazon Inventory'];
//            $inboundorders = $rowProperties['Inbound Orders'];
//            $totalinventory = $rowProperties['Total Inventory'];
//            $thirtydayssales = $rowProperties['30 Days Sales'];
//            $ninetydayamazon = $rowProperties['90 Day Amazon'];
//            $coverinmonths = $rowProperties['Cover in Months (Not Including inbound)'];
//            $coverinmonthsinbound = $rowProperties['Cover in Months (Including inbound)2'];
//            $orderquantity = $rowProperties['Order Quantity'];
//            $unitstoorder = $rowProperties['Units to Order'];
//            $needairship = $rowProperties['Need to airship?'];
//
//            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
//                //skip to next iteration if item value is 0
//                continue;
//            }
//
//            $jiangxiZhicheng = new JiangxiZhicheng();
//
//            $jiangxiZhicheng->title = $title;
//            $jiangxiZhicheng->upcfnsku = $upcfnsku;
//            $jiangxiZhicheng->sku = $sku;
//            $jiangxiZhicheng->whinventory = $wh_inventory;
//            $jiangxiZhicheng->amazoninventory = $amazon_inventory;
//            $jiangxiZhicheng->inboundorders = $inboundorders;
//            $jiangxiZhicheng->totalinventory = $totalinventory;
//            $jiangxiZhicheng->thirtydayssales = $thirtydayssales;
//            $jiangxiZhicheng->ninetydayamazon = $ninetydayamazon;
//            $jiangxiZhicheng->coverinmonths = $coverinmonths;
//            $jiangxiZhicheng->coverinmonthsinbound = $coverinmonthsinbound;
//            $jiangxiZhicheng->orderquantity = intval($orderquantity);
//            $jiangxiZhicheng->unitstoorder = null;
//            if ($needairship == 1) {
//                $jiangxiZhicheng->needairship = 'true';
//            } else {
//                $jiangxiZhicheng->needairship = 'false';
//            }
//
//            $jiangxiZhicheng->save();
//
//        }; //end foreach
//
//        return redirect()->route('jiangxiZhicheng.index')->with(['msg' => 'Jiangxi Zhicheng Added Successfully from Spreadsheet', 'type' => 'success']);



        // Spotted Socks Health Spreadsheet
        $spottedSocksRows = SimpleExcelReader::create($excel_file)->fromSheet(6)->getRows();

        foreach ($spottedSocksRows as $rowProperties) {

            $sku = $rowProperties['SKU'];
            $fnsku = $rowProperties['FNSKU'];
            $wh_inventory = $rowProperties['WH Inventory'];
            $amazon_inventory = $rowProperties['Amazon Inventory'];
            $inboundorders = $rowProperties['Inbound Orders'];
            $totalinventory = $rowProperties['Total Inventory'];
            $thirtydayssales = $rowProperties['30 Days Sales'];
            $ninetydayamazon = $rowProperties['90 Day Amazon'];
            $coverinmonths = $rowProperties['Cover in Months (not including inbound)'];
            $coverinmonthsinbound = $rowProperties['Cover in Months (including inbound)2'];
            $orderquantity = $rowProperties['Order Quantity'];
            $unitstoorder = $rowProperties['Units to Order'];
            $needairship = $rowProperties['Need to airship?'];

            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
                //skip to next iteration if item value is 0
                continue;
            }

            $spottedSocks = new SpottedSocks();

            $spottedSocks->fnsku = $fnsku;
            $spottedSocks->sku = $sku;
            $spottedSocks->whinventory = $wh_inventory;
            $spottedSocks->amazoninventory = $amazon_inventory;
            $spottedSocks->inboundorders = $inboundorders;
            $spottedSocks->totalinventory = $totalinventory;
            $spottedSocks->thirtydayssales = $thirtydayssales;
            $spottedSocks->ninetydayamazon = $ninetydayamazon;
            $spottedSocks->coverinmonths = $coverinmonths;
            $spottedSocks->coverinmonthsinbound = $coverinmonthsinbound;
            $spottedSocks->orderquantity = intval($orderquantity);
            $spottedSocks->unitstoorder = null;
            if ($needairship == 1) {
                $spottedSocks->needairship = 'true';
            } else {
                $spottedSocks->needairship = 'false';
            }

            $spottedSocks->save();

        }; //end foreach

        return redirect()->route('spottedSocks.index')->with(['msg' => 'Spotted Socks Added Successfully from Spreadsheet', 'type' => 'success']);



        // Jianxing Shoe Health Spreadsheet
//        $jianxingShoeRows = SimpleExcelReader::create('./file.xlsx')->fromSheet(7)->getRows();
//
//        foreach ($jianxingShoeRows as $rowProperties) {
//
//            $title = $rowProperties['Tital'];
//            $sku = $rowProperties['SKU'];
//            $fnsku = $rowProperties['FNSKU'];
//            $wh_inventory = $rowProperties['WH Inventory'];
//            $amazon_inventory = $rowProperties['Amazon Inventory'];
//            $inboundorders = $rowProperties['Inbound Orders'];
//            $totalinventory = $rowProperties['Total Inventory'];
//            $thirtydayssales = $rowProperties['30 Days Sales'];
//            $ninetydayamazon = $rowProperties['90 Day Amazon'];
//            $coverinmonths = $rowProperties['Cover in Months (not including inbound)'];
//            $coverinmonthsinbound = $rowProperties['Cover in Months (including inbound)'];
//            $orderquantity = $rowProperties['Order Quantity'];
//            $unitstoorder = $rowProperties['Units to Order'];
//            $needairship = $rowProperties['Need to airship?'];
//
//            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
//                //skip to next iteration if item value is 0
//                continue;
//            }
//
//            $jianxingShoe = new JianxingShoe();
//
//            $jianxingShoe->title = $title;
//            $jianxingShoe->sku = $sku;
//            $jianxingShoe->fnsku = $fnsku;
//            $jianxingShoe->whinventory = $wh_inventory;
//            $jianxingShoe->amazoninventory = $amazon_inventory;
//            $jianxingShoe->inboundorders = $inboundorders;
//            $jianxingShoe->totalinventory = $totalinventory;
//            $jianxingShoe->thirtydayssales = $thirtydayssales;
//            $jianxingShoe->ninetydayamazon = $ninetydayamazon;
//            $jianxingShoe->coverinmonths = $coverinmonths;
//            $jianxingShoe->coverinmonthsinbound = $coverinmonthsinbound;
//            $jianxingShoe->orderquantity = intval($orderquantity);
//            $jianxingShoe->unitstoorder = null;
//            if ($needairship == 1) {
//                $jianxingShoe->needairship = 'true';
//            } else {
//                $jianxingShoe->needairship = 'false';
//            }
//
//            $jianxingShoe->save();
//
//        }; //end foreach
//
//        return redirect()->route('jianxingShoe.index')->with(['msg' => 'Jianxing Shoe Added Successfully from Spreadsheet', 'type' => 'success']);



        // Post Flag Spreadsheet
//        $postFlagRows = SimpleExcelReader::create('./file.xlsx')->fromSheet(9)->getRows();
//
//        foreach ($postFlagRows as $rowProperties) {
//
//            $title = $rowProperties['Title'];
//            $sku = $rowProperties['SKU'];
//            $wh_inventory = $rowProperties['WH Inventory'];
//            $amazon_inventory = $rowProperties['Amazon Inventory'];
//            $inboundorders = $rowProperties['Inbound Orders'];
//            $totalinventory = $rowProperties['Total Inventory'];
//            $thirtydayssales = $rowProperties['30 Days Sales'];
//            $ninetydayamazon = $rowProperties['90 Day Amazon'];
//            $coverinmonths = $rowProperties['Cover in Months (not including inbound)'];
//            $coverinmonthsinbound = $rowProperties['Cover in Months (including inbound)'];
//            $orderquantity = $rowProperties['Order Quantity'];
//            $unitstoorder = $rowProperties['Units to Order'];
//
//            if( $wh_inventory == 0 && $amazon_inventory == 0 && $totalinventory == 0 ){
//                //skip to next iteration if item value is 0
//                continue;
//            }
//
//            $postFlag = new PostFlag();
//
//            $postFlag->title = $title;
//            $postFlag->sku = $sku;
//            $postFlag->whinventory = $wh_inventory;
//            $postFlag->amazoninventory = $amazon_inventory;
//            $postFlag->inboundorders = $inboundorders;
//            $postFlag->totalinventory = $totalinventory;
//            $postFlag->thirtydayssales = $thirtydayssales;
//            $postFlag->ninetydayamazon = $ninetydayamazon;
//            $postFlag->coverinmonths = $coverinmonths;
//            $postFlag->coverinmonthsinbound = $coverinmonthsinbound;
//            $postFlag->orderquantity = intval($orderquantity);
//            $postFlag->unitstoorder = null;
//
//            $postFlag->save();
//
//        }; //end foreach
//
//        return redirect()->route('postFlag.index')->with(['msg' => 'Post Flag Added Successfully from Spreadsheet', 'type' => 'success']);


    }
}
