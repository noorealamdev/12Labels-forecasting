@extends('backend.layouts.master')
@section('title') {{'All Items'}} @endsection
@section('content')
    @include('backend.partials.alert')

{{--    @if(session()->has('msg'))--}}
{{--        <div class="alert alert-success mt-3" style="font-size: 20px; font-weight: bold">{!! session('msg') !!}</div>--}}
{{--    @endif--}}

    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">All Items <a href="{{ route('items.create') }}"
                                                                      class="btn btn-primary-light m-1 ml-4">Add New<i
                        class="bi bi-plus-lg ms-2"></i></a></h1>
        <div class="ms-md-1 ms-0">
            <a href="{{ route('updateItemsTaskStart') }}" id="fetch-latest-data-btn" class="btn btn-primary m-1 ml-4">Fetch Latest Data<i class="bi bi-arrow-clockwise ms-2"></i></a>
        </div>
    </div>
    <!-- End::page-header -->

    <div class="show-progress"></div>

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive items-table mb-4">
                        <div class="items-custom-section">
                            <div class="select-supplier-dropdown">
                                <select id="select-supplier" class="form-select">
                                    <option value="">All Suppliers</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table id="datatable-items" class="table text-nowrap table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">SKU</th>
{{--                                <th scope="col">UPC/ASIN/FNSKU</th>--}}
                                <th scope="col">ASIN</th>
                                <th scope="col">Title</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">FBA Inventory</th>
                                <th scope="col">WH Inventory</th>
                                <th scope="col">Amazon Inventory</th>
                                <th scope="col">Inbound Orders</th>
                                <th scope="col">Total Inventory</th>
                                <th scope="col">30 Day Amazon</th>
                                <th scope="col">90 Day Amazon</th>
                                <th scope="col">Cover in Months (Not Including Inbound)</th>
                                <th scope="col">Cover in Months (Including Inbound)</th>
                                <th scope="col">Order Quantity</th>
                                <th scope="col">Units to Order</th>
                                <th scope="col">Need to airship?</th>
                                <th scope="col">Last Update</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr class="product-list">
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->upcAsinFnsku }}</td>
                                    <td class="title-column">{{ $item->title }}</td>
                                    <td>{{ $item->item_supplier->name }}</td>
                                    <td>{{ $item->fbaInventory }}</td>
                                    <td>{{ $item->whInventory }}</td>
                                    <td>{{ $item->amazonInventory }}</td>
                                    <td>{{ $item->inboundOrders }}</td>
                                    <td>{{ $item->totalInventory }}</td>
                                    <td>{{ $item->thirtyDaysSales }}</td>
                                    <td>{{ $item->ninetyDayAmazon }}</td>
                                    <td class="{{ ($item->coverInMonths < 6 ? 'bg-dark-red' : ($item->coverInMonths < 12 ? 'bg-light-red' : '')) }}">{{ $item->coverInMonths }}</td>
                                    <td>{{ $item->coverInMonthsInbound }}</td>
                                    <td>{{ $item->orderQuantity }}</td>
                                    <td>{{ $item->unitsToOrder }}</td>
                                    <td>{{ strtoupper($item->needAirShip) }}</td>
                                    <td>{{ strtoupper($item->updated_at) }}</td>
                                    <td>
                                        <div class="hstack gap-2 fs-15">
                                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-icon btn-sm btn-info-light"><i
                                                        class="ri-edit-line"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                               data-bs-target="#deleteModal{{ $item->id }}" data-original-title="Delete" class="btn btn-icon btn-sm btn-danger-light product-btn">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="teamModalCenterTitle" aria-hidden="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="teamModalCenterTitle">Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center"><h5>Are you sure?</h5></div>
                                            <div class="modal-footer">
                                                <form class="d-inline-block"
                                                      action="{{ route('items.destroy', $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-success">Yes, delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    @push('script')
        <script>
            $(function() {
                // Js code
            });
        </script>
    @endpush

@endsection
