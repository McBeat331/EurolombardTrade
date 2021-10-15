@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!-- Summernote -->
    <link href="{{ asset('adminAssets/vendor/summernote/summernote.css') }}" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{ asset('adminAssets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('adminAssets/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAssets/vendor/pickadate/themes/default.date.css') }}">

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
                <div class="card col-12">
                    <div class="card-header">
                        <h3>Услуга @isset($entry) ( {{$entry->title_uk}} ) @endisset</h3>
                        <p>* - поля обязательные для заполнения</p>
                    </div>

                    <div class="card-body">
                        <form method="POST"
                              @if(isset($address))
                              action="{{ route('admin.address.update', ['address' => $address->id]) }}"
                              @else
                              action="{{ route('admin.address.store') }}"
                              @endif
                              class="form-group form-valide"  enctype="multipart/form-data">

                            {{ csrf_field() }}
                            @if(isset($address))
                                {{ method_field('put') }}
                                <input type="hidden" name="url" value="{{ url()->previous() }}">
                            @endif
                <div class="row">
                    <div class="col-sm-8">
                            <div class="form-row d-flex justify-content-between">

                                <div class="form-group col-md-6">
                                    <label for="">Город *</label>
                                    <select name="city_id" id="city" class="form-control"
                                            @isset($address)
                                            data-selected="{{ old('city_id') ? old('city_id') : $address->city_id }}"
                                            @else
                                            data-selected="{{ old('city_id') }}"
                                            @endisset
                                            @endissetdata-placeholder="Выберите город">
                                    </select>
                                </div>
                            </div>

                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group col-md-6">
                                    <label>Адрес (RU) *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="/images/ru.svg" alt="" style="width: 1.5em;"></span>
                                        </div>
                                        <input type="text" name="address_ru" class="form-control"
                                               @isset($address)
                                               value="{{ old('address_ru') ? old('address_ru') : $address->address_ru }}"
                                               @else
                                               value="{{ old('address_ru') }}"
                                                @endisset
                                        >
                                    </div>

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Адрес (UA) *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="/images/ua.svg" alt="" style="width: 1.5em;"></span>
                                        </div>
                                        <input type="text" name="address_uk" class="form-control"
                                               @isset($address)
                                               value="{{ old('address_uk') ? old('address_uk') : $address->address_uk }}"
                                               @else
                                               value="{{ old('address_uk') }}"
                                                @endisset
                                        >
                                    </div>

                                </div>
                            </div>
                            <div id="map"></div>
                            <input id="pac-input" class="controls input" type="text" placeholder="Поиск адреса">
                            <hr>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Состояние</label>
                            <select name="published" id="" class="form-control">
                                <option value="1" @if(isset($address->published) && $address->published == 1 ) {{ 'selected' }} @endif >
                                    Активен
                                </option>
                                <option value="0" @if(isset($address->published) && $address->published == 0) {{ 'selected' }} @endif >
                                    Не активен
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Телефон *</label>
                            <input type="tel" name="phone" class="form-control"
                                   {{--value="{{ isset($office) ? $office->phone : old('phone') }}">--}}
                                   @isset($address)
                                   value="{{ old('phone') ? old('phone') : $address->phone }}"
                                   @else
                                   value="{{ old('phone') }}"
                                   @endisset
                            >
                        </div>


                        <div class="form-group">
                            <label>График работы</label>
                            <div>
                                <label for="twenty-four">Круглосуточно</label>
                                <input id="twenty-four" type="checkbox" name="full_day" value="1"
                                       @if(old('full_day'))
                                       checked
                                       @elseif(isset($address) and $address->full_day)
                                       checked
                                        @endif
                                >
                            </div>
                            <div id="worktime" class="d-flex align-items-center"
                                 @if(old('full_day'))
                                 style="visibility: hidden;"
                                 @elseif(isset($address) and $address->full_day)
                                 style="visibility: hidden;"
                                    @endif
                            >
                                <input type="text" name="time_start" class="form-control time_start"
                                       @isset($address)
                                       value="{{ old('time_start') ? old('time_start') : $address->time_start }}"
                                       @else
                                       value="{{ old('time_start') }}"
                                        @endisset
                                ><span style="padding: 0 8px">До</span>
                                <input type="text" name="time_end" class="form-control time_end"
                                       @isset($address)
                                       value="{{ old('time_end') ? old('time_end') : $address->time_end }}"
                                       @else
                                       value="{{ old('time_end') }}"
                                        @endisset
                                >
                            </div>
                        </div>
                            <input type="hidden" id="lng" name="lng" value="{{ isset($address) ? $address->lng : old('lng') }}"/>
                            <input type="hidden" id="lat" name="lat" value="{{ isset($address) ? $address->lat : old('lat') }}"/>

                            <br>

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
@endsection

@section('script')
    <!-- momment js is must -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ru.min.js" integrity="sha512-+yvkALwyeQtsLyR3mImw8ie79H9GcXkknm/babRovVSTe04osQxiohc1ukHkBCIKQ9y97TAf2+17MxkIimZOdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('adminAssets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('adminAssets/vendor/summernote/js/summernote.min.js') }}"></script>
    <!-- Material color picker -->
    <script src="{{ asset('adminAssets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <!-- Summernote init -->
    <script src="{{ asset('adminAssets/js/plugins-init/summernote-init.js') }}"></script>
    <!-- Material color picker init -->
    <script src="{{ asset('adminAssets/js/plugins-init/material-date-picker-init.js') }}"></script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAor2gAXYMTj3AqHp0fBM0EjTKXrlEDavw&libraries=places&language=ru-RU&region=UA"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="{{ asset('adminAssets/js/offices.js') }}"></script>
@endsection