@extends('layouts.admin')

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Город @if(isset($entry)) ( {{$entry->city_ru}} ) @else | Создание @endif</h3>
                        <p>* - поля обязательные для заполнения</p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              @if(isset($entry))
                              action="{{ route('admin.city.update', ['post' => $entry->id]) }}"
                              @else
                              action="{{ route('admin.city.store') }}"
                              @endif
                              class="form-group form-valide"  enctype="multipart/form-data">

                            {{ csrf_field() }}
                            @if(isset($entry))
                                {{ method_field('put') }}
                                <input type="hidden" name="url" value="{{ url()->previous() }}">
                            @endif

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label>Город <small>(украинский вариант)</small> *</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><img src="/images/ua.svg" alt="" style="width: 1.5em;"></span>
                                            </div>
                                            <input type="text" name="city_uk" class="form-control"
                                                   @isset($entry)
                                                   value="{{ old('city_uk') ? old('city_uk') : $entry->city_uk }}"
                                                   @else
                                                   value="{{ old('city_uk') }}"
                                                    @endisset
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label>Город <small>(русский вариант)</small> *</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><img src="/images/ru.svg" alt="" style="width: 1.5em;"></span>
                                            </div>
                                            <input type="text" name="city_ru" class="form-control"
                                                   @isset($entry)
                                                   value="{{ old('city_ru') ? old('city_ru') : $entry->city_ru }}"
                                                   @else
                                                   value="{{ old('city_ru') }}"
                                                    @endisset
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <!-- Jquery Validation -->
    <script src="{{ asset('adminAssets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Form validate init -->
    <script src="{{ asset('adminAssets/js/plugins-init/jquery.validate-init.js') }}"></script>
@endsection
