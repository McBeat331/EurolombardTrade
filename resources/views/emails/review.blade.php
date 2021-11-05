
<b>Новый отзыв</b><br />
Город: {{$review->city->name}}<br />
ФИО: {{$review->name}}<br />
Отзыв: {{$review->description}}<br />
@if($review->rating)
Рейтинг: @for($i = 1; $i<=$review->rating; $i++)&#9733;@endfor
@endif
