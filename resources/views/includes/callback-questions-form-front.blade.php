<div class="callback-wrap-content">
  <span class="icon-bg-line"></span>
  <div class="callback-content-forms">
      <div class="title">{{ trans('main.have_questions') }}</div>
      <div class="call-form-description">
          {{ trans('main.call_us') }} <span class="strong-t">2222</span>
          {{ trans('main.callbacks_request_message') }}
      </div>
      <form action="#" data-successText="{{ trans('main.thanks_for_callback') }}">
          <div class="formRow">
              <input name="name" type="text" placeholder="{{ trans('main.your_name') }}" data-validate="required" data-error-text="{{ __('main.field_required') }}" required>
          </div>
          <div class="formRow">
              <input name="phone" type="tel" placeholder="{{ trans('main.your_phone') }}" data-validate="required" data-error-text="{{ __('main.field_required') }}" required>
          </div>
              <button class="button">{{ trans('main.send') }}</button>
      </form>
      <div class="description-form">
          {!! trans('main.callbacks_desc') !!}

      </div>
  </div>
</div>