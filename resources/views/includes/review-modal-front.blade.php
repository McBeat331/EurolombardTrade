<div class="modal-el review-modal">
  <div class="modal-content">
    <span class="icon-bg-line"></span>
    <div class="btn-close-modal">
      <span class="icon-questions-plus"></span>
    </div>
    <div class="modal-content-forms">
        <div class="title">{{ trans('main.feedback_send') }}</div>
        <form action="#" data-successtext="{{ trans('main.thanks_for_feedback') }}">
          <div class="input-wraper">
              <div class="formRow">
                  <input type="text" name="name" placeholder="{{ trans('main.your_name') }}" data-validate="required" data-error-text="{{ __('main.field_required') }}" required>
              </div>
              <div class="formRow">
                  <input type="text" name="city" placeholder="{{ trans('main.calc_city') }}" data-validate="required" data-error-text="{{ __('main.field_required') }}" required>
              </div>
              <div class="formRow">
                  <input type="tel" name="phone" placeholder="{{ trans('main.your_phone') }}" data-validate="required" data-error-text="{{ __('main.field_required') }}" required>
              </div>
          </div>
            <div class="formRow">
                <textarea name="body" placeholder="{{ trans('main.comment_text') }}" data-validate="required" data-error-text="{{ __('main.field_required') }}" required></textarea>
            </div>
            <div class="formRow input-none">
                <input name="text" type="text" class="form-item" placeholder="{{ __('main.your_text') }}"
                     data-error-text="{{ __('main.field_required') }}">
            </div>
            <button class="button">{{ trans('main.send') }}</button>
        </form>
        <div class="description-form">
          {!! trans('main.feedbacks_desc') !!}
        </div>
    </div>
  </div>
  <div class="overlay_modal"></div>
</div>