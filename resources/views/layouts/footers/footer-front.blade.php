<footer class="mainFooter">
  <div class="mcontainer">
    <div class="cont-footer">
      <div class="logo visible-viewportchecker visibility--check hidden">
          <a href="{{ route('main') }}"> <img src="/images/logoEuroLombard.svg" alt=""></a>
      </div>
      <div class="contacts visible-viewportchecker visibility--check hidden">
        <div class="title">{{ trans('main.our_contacts') }}</div>
        <p>{{ trans('main.cityLatter') }}{{ addressSelectedCity()->name }}</p>
        <p>{{ addressSelectedCity()->addresses->first()->name }}</p>
        <p>{{ addressSelectedCity()->addresses->first()->phones }}</p>
      </div>
      <div class="social-wrapper visible-viewportchecker visibility--check hidden">
        <div class="title">{{ trans('main.our_social') }}</div>
        <ul class="social-mobile-list">
          <li>
            <span class="icon-social-fb"></span>
            <a target="blank" href="" class="social-item-link"></a>
          </li>
          <li>
            <span class="icon-social-inst"></span>
            <a target="blank" href="" class="social-item-link"></a>
          </li>
          <li>
            <span class="icon-social-telegram"></span>
            <a  target="blank" href="#" class="social-item-link"></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="bottom-footers visible-viewportchecker visibility--check hidden">
      <span>{{ trans('main.all_rights_reserved') }}</span>
      <span><a href="https://zengineers.company">{{ trans('main.developed_in') }} <i>Zengineers.Company</i></a></span>
    </div>
  </div>
</footer>