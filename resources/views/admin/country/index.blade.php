@extends('layouts.admin')
@section('style')
    <link href="{{ asset('adminAssets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Здесь хранятся Города</h4>
                    <div class="row page-titles mx-0">
                        <a href="{{ route('admin.country.create') }}">
                            <button type="button" class="btn btn-primary">
                                <span class="btn-icon-left text-primary">
                                    <i class="fa fa-plus color-primary"></i>
                                </span>
                                <span style="font-weight: bold">Добавить Город</span>
                            </button>
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Город</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Города</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Город</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Днепр</td>
                                        <td><span><a href="{{ route('admin.country.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                     data-placement="top" title="Edit"><i
                                                            class="fa fa-pencil color-muted"></i> </a><a
                                                        href="{{ route('admin.country.destroy',1) }}" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"><i
                                                            class="fa fa-close color-danger"></i></a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Запорожье</td>
                                        <td><span><a href="{{ route('admin.country.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                     data-placement="top" title="Edit"><i
                                                            class="fa fa-pencil color-muted"></i> </a><a
                                                        href="{{ route('admin.country.destroy',1) }}" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"><i
                                                            class="fa fa-close color-danger"></i></a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Киев</td>
                                        <td><span><a href="{{ route('admin.country.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                     data-placement="top" title="Edit"><i
                                                            class="fa fa-pencil color-muted"></i> </a><a
                                                        href="{{ route('admin.country.destroy',1) }}" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"><i
                                                            class="fa fa-close color-danger"></i></a></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('adminAssets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins-init/datatables.init.js') }}"></script>
@endsection
