@extends('backend.layouts.master')
@section('title') {{'Add New Supplier'}} @endsection
@section('content')
    @include('backend.partials.alert')

    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Add New Supplier</h1>
    </div>
    <!-- End::page-header -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body add-products p-0">
                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf
                        <div class="p-4">
                            <div class="row gx-5">
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="row gy-3">
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Name</label>
                                                    <input type="text" class="@error('name') is-invalid @enderror form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Email</label>
                                                    <input type="text" class="@error('email') is-invalid @enderror form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-name-add" class="form-label">Note</label>
                                                    <input type="text" class="@error('note') is-invalid @enderror form-control" name="note" placeholder="Note" value="{{ old('note') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                            <input type="submit" class="btn btn-success m-1 save-button" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
@endsection
