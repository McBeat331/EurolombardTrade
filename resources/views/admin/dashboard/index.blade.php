@extends('layouts.admin')

@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Главная панель</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Гавная панель</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-money text-success border-success"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Всего заявок</div>
                            <div class="stat-digit">{{ $ordersCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user text-primary border-primary"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Пользователей</div>
                            <div class="stat-digit">{{ $usersCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-layout-grid2 text-pink border-pink"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Комментариев</div>
                            <div class="stat-digit">{{ $reviewsCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Статистика заявок</h4>
                    </div>
                    <div class="card-body">
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Последние заявки</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                <thead>
                                <tr>
                                    <th class="col-4">Пользователь</th>
                                    <th class="col-2">Дата</th>
                                    <th class="col-1">Сдаёт</th>
                                    <th class="col-1">Валюта</th>
                                    <th class="col-1">Получает</th>
                                    <th class="col-1">Валюта</th>
                                    <th class="col-2">Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.order.edit',$order->id) }}" class="mr-4" data-toggle="tooltip"
                                               data-placement="top" title="Edit">{{ $order->user->name }}</a>
                                        </td>
                                        <td>
                                            {{ $order->created_at }}
                                        </td>
                                        <td>
                                            {{ $order->price_from }}
                                        </td>
                                        <td>
                                            {{ $order->currency_from }}
                                        </td>
                                        <td>
                                            {{ $order->price_to }}
                                        </td>
                                        <td>
                                            {{ $order->currency_to }}
                                        </td>
                                        <td>
                                            @if($order->status && $order->status==0)
                                                <span class="badge badge-warning">Не обработано</span>
                                            @else
                                                <span class="badge badge-success">Обработано</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
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


    <!-- Vectormap -->
    <script src="{{ asset('adminAssets/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('adminAssets/vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('adminAssets/vendor/circle-progress/circle-progress.min.js') }}"></script>





    <script src="{{ asset('adminAssets/js/dashboard/dashboard-1.js') }}"></script>
    <script>
        var arrayFromPHP = {!! json_encode($ordersCountLastTenDays) !!};
        var lastArray = [];
        var jsonObj = new Object();
        $.each(arrayFromPHP, function (index, value) {
            lastArray.push({y:index,a:value});
        });
        Morris.Bar({
            element: 'morris-bar-chart',
            data: lastArray,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Заявок'],
            barColors: ['#5873FE', '#5873FE'],
            hideHover: 'auto',
            gridLineColor: '#5873FE',
            resize: true
        });
    </script>
@endsection