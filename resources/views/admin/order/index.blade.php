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
                    <h4>Заявки</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Заявки</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Заявки</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered verticle-middle table-responsive-sm">
                                            <thead>
                                            <tr>
                                                <th class="col-2">Пользователь</th>
                                                <th class="col-2">Дата</th>
                                                <th class="col-1">Сдаёт</th>
                                                <th class="col-1">Валюта</th>
                                                <th class="col-1">Получает</th>
                                                <th class="col-1">Валюта</th>
                                                <th class="col-2">Статус</th>
                                                <th scope="col col-2">Действия</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.order.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">Какой то пользователь</a>
                                                </td>
                                                <td>
                                                    14.10.2021
                                                </td>
                                                <td>
                                                    2000
                                                </td>
                                                <td>
                                                    USD
                                                </td>
                                                <td>
                                                    60000
                                                </td>
                                                <td>
                                                    UAH
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Не обработано</span>
                                                </td>
                                                <td><span><a href="{{ route('admin.order.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                             data-placement="top" title="Edit"><i
                                                                    class="fa fa-pencil color-muted"></i> </a><a
                                                                href="{{ route('admin.order.destroy',1) }}" data-toggle="tooltip"
                                                                data-placement="top" title="Delete"><i
                                                                    class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.order.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">Какой то пользователь</a>
                                                </td>
                                                <td>
                                                    14.10.2021
                                                </td>
                                                <td>
                                                    2000
                                                </td>
                                                <td>
                                                    USD
                                                </td>
                                                <td>
                                                    60000
                                                </td>
                                                <td>
                                                    UAH
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">Обработано</span>
                                                </td>
                                                <td><span><a href="{{ route('admin.order.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                             data-placement="top" title="Edit"><i
                                                                    class="fa fa-pencil color-muted"></i> </a><a
                                                                href="{{ route('admin.order.destroy',1) }}" data-toggle="tooltip"
                                                                data-placement="top" title="Delete"><i
                                                                    class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.order.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">Какой то пользователь</a>
                                                </td>
                                                <td>
                                                    14.10.2021
                                                </td>
                                                <td>
                                                    2000
                                                </td>
                                                <td>
                                                    USD
                                                </td>
                                                <td>
                                                    60000
                                                </td>
                                                <td>
                                                    UAH
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Не обработано</span>
                                                </td>
                                                <td><span><a href="{{ route('admin.order.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                             data-placement="top" title="Edit"><i
                                                                    class="fa fa-pencil color-muted"></i> </a><a
                                                                href="{{ route('admin.order.destroy',1) }}" data-toggle="tooltip"
                                                                data-placement="top" title="Delete"><i
                                                                    class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.order.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">Какой то пользователь</a>
                                                </td>
                                                <td>
                                                    14.10.2021
                                                </td>
                                                <td>
                                                    2000
                                                </td>
                                                <td>
                                                    USD
                                                </td>
                                                <td>
                                                    60000
                                                </td>
                                                <td>
                                                    UAH
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Не обработано</span>
                                                </td>
                                                <td><span><a href="{{ route('admin.address.edit',1) }}" class="mr-4" data-toggle="tooltip"
                                                             data-placement="top" title="Edit"><i
                                                                    class="fa fa-pencil color-muted"></i> </a><a
                                                                href="{{ route('admin.address.destroy',1) }}" data-toggle="tooltip"
                                                                data-placement="top" title="Delete"><i
                                                                    class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                            </div>
                                    {{ $entries->links() }}
                        </div>
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
