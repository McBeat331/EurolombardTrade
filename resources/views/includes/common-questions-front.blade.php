<div class="common-questions-wrap-list shell-form">
  <div class="title visible-viewportchecker visibility--check hidden">{{ trans('main.faqs') }}</div>
  @if(isset($faq))
  @forelse($faq as $faqItem)
  <div class="questions-item visible-viewportchecker visibility--check hidden active">
    <div class="header-item">
      {{ $faqItem['title_'.$locale] }}
    </div>
    <div class="info-drop-questions" style="display: block">
      {{ $faqItem['description_'.$locale] }}
    </div>
    <div class="icon-wrap-block">
      <span class="icon-questions-plus"></span>
    </div>
  </div>
  @empty
    Нет вопросов
  @endforelse
  @endif
  <div class="visible-viewportchecker visibility--check hidden">
    @include('includes.callback-questions-form-front')
  </div>
</div>