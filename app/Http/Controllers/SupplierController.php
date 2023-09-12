<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('backend.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $supplier = new Supplier();
            $supplier->name = $request->input('name');
            $supplier->email = $request->input('email');
            $supplier->note = $request->input('note');
            $supplier->save();

            return redirect()->route('suppliers.index')->with(['msg' => 'Supplier Added Successfully', 'type' => 'success']);

        } catch (\Throwable $e) {
            return redirect()->back()->with(['msg' => 'Something went wrong, please check and try again', 'type' => 'failed']);
        }
    }


    public function show(Supplier $supplier)
    {
        //
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('backend.suppliers.edit', compact('supplier',));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $supplier = Supplier::find($id);
            $supplier->name = $request->input('name');
            $supplier->email = $request->input('email');
            $supplier->note = $request->input('note');
            $supplier->save();

            return redirect()->route('suppliers.edit', $supplier->id )->with(['msg' => 'Supplier Updated Successfully', 'type' => 'success']);

        } catch (\Throwable $e) {
            //dd($e);
            return redirect()->back()->with(['msg' => 'Something went wrong, please check and try again', 'type' => 'failed']);
        }
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with(['msg' => 'Supplier Deleted Successfully', 'type' => 'success']);
    }
}
