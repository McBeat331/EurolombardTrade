
<b>Новый заказ</b><br />
Город: {{$order->city->name}}<br /><br />
ФИО: {{$order->fio}}<br />
Email: {{$order->email}}<br />
Телефон: {{$order->phone}}<br /><br />
ОПТ: {{$order->isOpt ? 'Да' : 'Нет'}}<br />
Продажа: {{$order->rate_sale}}<br />
Покупка: {{$order->rate_buy}}<br />
Обмен: {{$order->price_sale}}{{$order->currency_buy}} => {{$order->price_buy}}{{$order->currency_sale}}

