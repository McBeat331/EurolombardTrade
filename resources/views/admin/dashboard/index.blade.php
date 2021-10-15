@extends('layouts.admin')

@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Привет Админ!</h4>
                    <p class="mb-0">Главная панель</p>
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
                            <div class="stat-digit">1,012</div>
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
                            <div class="stat-digit">961</div>
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
                            <div class="stat-digit">100</div>
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
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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
                                </tr>
                                <tr>
                                    <td>
                                        Какой то пользователь
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


    <!-- Vectormap -->
    <script src="{{ asset('adminAssets/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('adminAssets/vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('adminAssets/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('adminAssets/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('adminAssets/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('adminAssets/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('adminAssets/vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('adminAssets/vendor/owl-carousel/js/owl.carousel.min.js') }}."></script>

    <!-- Counter Up -->
    <script src="{{ asset('adminAssets/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('adminAssets/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('adminAssets/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ asset('adminAssets/js/dashboard/dashboard-1.js') }}"></script>
    <script>
        Morris.Bar({
            element: 'morris-bar-chart',
            data: [{
                y: '10.10.2021',
                a: 220
            }, {
                y: '11.10.2021',
                a: 75
            }, {
                y: '12.10.2021',
                a: 50
            }, {
                y: '13.10.2021',
                a: 75
            }, {
                y: '14.10.2021',
                a: 50
            }, {
                y: '15.10.2021',
                a: 75
            },{
                y: '10.10.2021',
                a: 220
            },{
                y: '10.10.2021',
                a: 220
            },{
                y: '10.10.2021',
                a: 220
            }, {
                y: '16.10.2021',
                a: 100
            }],
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