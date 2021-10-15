@extends('layouts.admin')
@section('style')

@endsection
@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Основные настройки сайта</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Основные настройки сайта</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Настройки сайта</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form  method="POST" action="{{ route('admin.setting.index') }}">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email Администратора</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control"name="admin_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Номер телефона</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone" placeholder="Номер телефона">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Ссылка на Телеграм Бот</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="telegram_link" placeholder="Url">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection