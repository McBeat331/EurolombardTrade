@extends('layouts.app')
@include('includes.meta_tags')
@section('content')

    <div class="mcontainer">
        <div class="title visible-viewportchecker visibility--check hidden">Заявка стоврена</div>
    </div>

    <section class="success-order">
        <div class="mcontainer">
            <div class="flexBlock">
                <div class="flexInfoItem">
                    <span class="infoLabel">Віддаєте</span>
                    <span class="infoValue infoCurrency">{{ $order->price_buy }} {{ $order->currency_sale }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">Отримуєте</span>
                    <span class="infoValue infoCurrency">{{ $order->price_sale }} {{ $order->currency_buy }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">Курс</span>
                    <span class="infoValue infoRate">{{ $order->rate_sale }} {{ $order->currency_sale }}/{{ $order->currency_buy }}</span>
                    <span class="infoTip">Діє одну годину з момента підтвердження заявки</span>
                </div>
            </div>
            <div class="flexBlock">
                <div class="flexInfoItem">
                    <span class="infoLabel">Пункт обміну</span>
                    <span class="infoValue">{{ trans('main.cityLatter') }}{{ $currentCity->name }}, {{ $currentCity->addresses->first()->name }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">Ваше ім’я</span>
                    <span class="infoValue">{{ $order->fio }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">Ваш телефон</span>
                    <span class="infoValue">{{ $order->phone }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">Ваш email</span>
                    <span class="infoValue">{{ $order->email }}</span>
                </div>
            </div>
            <div class="linkBlock">
                <a href="{{ route('main') }}">На головну</a>
            </div>
        </div>
    </section>

@endsection