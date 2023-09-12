<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {

        $suppliers = Supplier::orderBy('id', 'DESC')->get();
        $items = Item::with('item_supplier')->get();
        $item_fields =
            [
                $items->pluck("fbaInventory")->unique()->values()->toArray(),
                $items->pluck("whInventory")->unique()->values()->toArray(),
                $items->pluck("totalInventory")->unique()->values()->toArray()
            ];

        //$items = $items->unique('totalInventory');

        //dd($unique);

        return view('backend.items.index', compact('items','suppliers'));
    }


    public function create()
    {
        $item_suppliers = Supplier::orderBy('name')->get();
        return view('backend.items.create', compact('item_suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'sku' => 'required|string',
            'supplier_id' => 'required|string',
            'upcAsinFnsku' => 'nullable|string',
            'fbaInventory' => 'nullable|numeric',
            'whInventory' => 'nullable|numeric',
            'amazonInventory' => 'nullable|numeric',
            'inboundOrders' => 'nullable|numeric',
            'totalInventory' => 'nullable|numeric',
            'thirtyDaysSales' => 'nullable|numeric',
            'ninetyDayAmazon' => 'nullable|numeric',
            'coverInMonths' => 'nullable|numeric',
            'coverInMonthsInbound' => 'nullable|numeric',
            'orderQuantity' => 'nullable|numeric',
            'unitsToOrder' => 'nullable|numeric',
        ]);

        try {
            $item = new Item();

            $item->title = $request->input('title');
            $item->supplier_id = $request->get('supplier_id');
            $item->sku = $request->input('sku');
            $item->upcAsinFnsku = $request->input('upcAsinFnsku');
            $item->fbaInventory = $request->input('fbaInventory');
            $item->whInventory = $request->input('whInventory');
            $item->amazonInventory = $request->input('amazonInventory');
            $item->inboundOrders = $request->input('inboundOrders');
            $item->totalInventory = $request->input('totalInventory');
            $item->thirtyDaysSales = $request->input('thirtyDaysSales');
            $item->ninetyDayAmazon = $request->input('ninetyDayAmazon');
            $item->coverInMonths = $request->input('coverInMonths');
            $item->coverInMonthsInbound = $request->input('coverInMonthsInbound');
            $item->orderQuantity = $request->input('orderQuantity');
            $item->unitsToOrder = $request->input('unitsToOrder');
            $need_air_ship = $request->has('needAirShip');
            if ($need_air_ship == 'on') {
                $item->needAirShip = 'true';
            } else {
                $item->needAirShip = 'false';
            }

            $item->save();

            return redirect()->route('items.index')->with(['msg' => 'Item Added Successfully', 'type' => 'success']);

        } catch (\Throwable $e) {
            return redirect()->back()->with(['msg' => 'Something went wrong, please check and try again', 'type' => 'failed']);
        }
    }


    public function show(Item $items)
    {
        //
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $item_suppliers = Supplier::orderBy('name')->get();

        return view('backend.items.edit', compact('item', 'item_suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable',
            'sku' => 'required|string',
            'supplier_id' => 'required|string',
            'upcAsinFnsku' => 'nullable|string',
            'fbaInventory' => 'nullable|numeric',
            'whInventory' => 'nullable|numeric',
            'amazonInventory' => 'nullable|numeric',
            'inboundOrders' => 'nullable|numeric',
            'totalInventory' => 'nullable|numeric',
            'thirtyDaysSales' => 'nullable|numeric',
            'ninetyDayAmazon' => 'nullable|numeric',
            'coverInMonths' => 'nullable|numeric',
            'coverInMonthsInbound' => 'nullable|numeric',
            'orderQuantity' => 'nullable|numeric',
            'unitsToOrder' => 'nullable|numeric',
        ]);

        try {
            $item = Item::find($id);

            $item->title = $request->input('title');
            $item->supplier_id = $request->get('supplier_id');
            $item->sku = $request->input('sku');
            $item->upcAsinFnsku = $request->input('upcAsinFnsku');
            $item->whInventory = $request->input('whInventory');
            $item->fbaInventory = $request->input('fbaInventory');
            $item->amazonInventory = $request->input('amazonInventory');
            $item->inboundOrders = $request->input('inboundOrders');
            $item->totalInventory = $request->input('totalInventory');
            $item->thirtyDaysSales = $request->input('thirtyDaysSales');
            $item->ninetyDayAmazon = $request->input('ninetyDayAmazon');
            $item->coverInMonths = $request->input('coverInMonths');
            $item->coverInMonthsInbound = $request->input('coverInMonthsInbound');
            $item->orderQuantity = $request->input('orderQuantity');
            $item->unitsToOrder = $request->input('unitsToOrder');
            $need_air_ship = $request->has('needAirShip');
            if ($need_air_ship == 'on') {
                $item->needAirShip = 'true';
            } else {
                $item->needAirShip = 'false';
            }

            $item->save();

            return redirect()->route('items.edit', $item->id )->with(['msg' => 'Item Updated Successfully', 'type' => 'success']);

        } catch (\Throwable $e) {
            //dd($e);
            return redirect()->back()->with(['msg' => 'Something went wrong, please check and try again', 'type' => 'failed']);
        }
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('items.index')->with(['msg' => 'Item Deleted Successfully', 'type' => 'success']);
    }



}
