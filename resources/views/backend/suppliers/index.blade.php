@extends('backend.layouts.master')
@section('title') {{'Suppliers'}} @endsection
@section('content')
    @include('backend.partials.alert')

    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Suppliers <a href="{{ route('suppliers.create') }}"
                                                                      class="btn btn-primary-light m-1 ml-4">Add New<i
                        class="bi bi-plus-lg ms-2"></i></a></h1>
    </div>
    <!-- End::page-header -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table id="datatable-basic" class="table text-nowrap table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Note</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr class="product-list">
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->note }}</td>
                                    <td>
                                        <div class="hstack gap-2 fs-15">
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-icon btn-sm btn-info-light"><i
                                                        class="ri-edit-line"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                               data-bs-target="#deleteModal{{ $supplier->id }}" data-original-title="Delete" class="btn btn-icon btn-sm btn-danger-light product-btn">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal{{ $supplier->id }}" tabindex="-1" role="dialog"
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
                                                      action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
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
@endsection
