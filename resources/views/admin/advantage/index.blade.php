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
                    <h4>Преимущества</h4>
                    <div class="row page-titles mx-0">
                        <a href="{{ route('admin.advantage.create') }}">
                            <button type="button" class="btn btn-primary">
                                <span class="btn-icon-left text-primary">
                                    <i class="fa fa-plus color-primary"></i>
                                </span>
                                <span style="font-weight: bold">Добавить Преимущества</span>
                            </button>
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Записи</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Преимущества</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Преимущества</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Превью</th>
                                    <th>Порядок сортировки</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($entries as $advantage)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('admin.advantage.edit', $advantage->id) }}">{{ $advantage->title }}</a></td>
                                            <td><img class="mr-3 img-fluid tableImg" src="{{ asset('storage/advantages/'.$advantage->image) }}" alt="Quixkit"></td>
                                            <td>{{ $advantage->slug }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Превью</th>
                                    <th>Порядок сортировки</th>
                                </tr>
                                </tfoot>
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
