@extends('backend.layouts.master')
@section('title') {{'Edit Item'}} @endsection
@section('content')
    @include('backend.partials.alert')

    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit Item</h1>
    </div>
    <!-- End::page-header -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body add-products p-0">
                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="p-4">
                            <div class="row gx-5">
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="row gy-3">
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Title</label>
                                                    <input type="text" class="@error('title') is-invalid @enderror form-control" name="title" placeholder="Title" value="{{ $item->title }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Select Item Category <span>*</span></label>
                                                    <select class="form-select @error('supplier_id') is-invalid @enderror form-control" name="supplier_id">
                                                        @foreach($item_suppliers as $supplier)
                                                            <option value="{{$supplier->id}}" {{ $supplier->id == $item->supplier_id ? 'selected' : ''}}>{{$supplier->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">SKU <span>*</span></label>
                                                    <input type="text" class="@error('sku') is-invalid @enderror form-control" name="sku" placeholder="SKU" value="{{ $item->sku }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">UPC/ASIN/FNSKU</label>
                                                    <input type="text" class="@error('upcAsinFnsku') is-invalid @enderror form-control" name="upcAsinFnsku" placeholder="UPC/ASIN/FNSKU" value="{{ $item->upcAsinFnsku }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">FBA Inventory</label>
                                                    <input type="text" class="@error('fbaInventory') is-invalid @enderror form-control" name="fbaInventory" placeholder="FBA Inventory" value="{{ $item->fbaInventory }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">WH Inventory</label>
                                                    <input type="text" class="@error('whInventory') is-invalid @enderror form-control" name="whInventory" placeholder="WH Inventory" value="{{ $item->whInventory }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Amazon Inventory</label>
                                                    <input type="text" class="@error('amazonInventory') is-invalid @enderror form-control" name="amazonInventory" placeholder="Amazon Inventory" value="{{ $item->amazonInventory }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Inbound Orders</label>
                                                    <input type="text" class="@error('inboundOrders') is-invalid @enderror form-control" name="inboundOrders" placeholder="Inbound Orders" value="{{ $item->inboundOrders }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Total Inventory</label>
                                                    <input type="text" class="@error('totalInventory') is-invalid @enderror form-control" name="totalInventory" placeholder="Total Inventory" value="{{ $item->totalInventory }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">30 Days Sales</label>
                                                    <input type="text" class="@error('thirtyDaysSales') is-invalid @enderror form-control" name="thirtyDaysSales" placeholder="30 Days Sales" value="{{ $item->thirtyDaysSales }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">90 Day Amazon</label>
                                                    <input type="text" class="@error('ninetyDayAmazon') is-invalid @enderror form-control" name="ninetyDayAmazon" placeholder="90 Day Amazon" value="{{ $item->ninetyDayAmazon }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Cover in Months (not including inbound)</label>
                                                    <input type="text" class="@error('coverInMonths') is-invalid @enderror form-control" name="coverInMonths" placeholder="Cover in Months (not including inbound)" value="{{ $item->coverInMonths }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Cover in Months (including inbound)</label>
                                                    <input type="text" class="@error('coverInMonthsInbound') is-invalid @enderror form-control" name="coverInMonthsInbound" placeholder="Cover in Months (including inbound)" value="{{ $item->coverInMonthsInbound }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Order Quantity</label>
                                                    <input type="text" class="@error('orderQuantity') is-invalid @enderror form-control" name="orderQuantity" placeholder="Order Quantity" value="{{ $item->orderQuantity }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Units to Order</label>
                                                    <input type="text" class="@error('unitsToOrder') is-invalid @enderror form-control" name="unitsToOrder" placeholder="Units to Order" value="{{ $item->unitsToOrder }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-check form-check-lg form-switch mt-3">
                                                        <label class="form-check-label" for="switch-lg">Need to airship?</label>
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                               name="needAirShip" id="switch-lg" {{ $item->needAirShip == 'true' ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                            <input type="submit" class="btn btn-success m-1 save-button" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
@endsection
