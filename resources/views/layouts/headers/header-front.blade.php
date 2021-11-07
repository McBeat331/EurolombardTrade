<listcity></listcity>
<header class="mainHeader">

       <div class="header-content-wrap">
           <div class="header-logo">
               <a href="{{ route('main') }}"> <img src="/images/logoEuroLombard.svg" alt=""></a>
           </div>
           <nav class="nav">
                <div class="menu-btn">
                  <div class="line line--1"></div>
                  <div class="line line--2"></div>
                  <div class="line line--3"></div>   
              </div>

              <ul class="header-nav-list">

                  {!! switcher_locale() !!}

                  <li class="nav-item">
                    <a href="#rateBlock">
                        <span>{{ trans('main.cources') }}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#serviceBlock">
                        <span>{{ trans('main.ourServices') }}</span>
                    </a>
                  </li>
                  <li class="nav-item"><a href="#advantageBlock">{{ trans('main.ourAdvantages') }}</a></li>
                  <li class="nav-item"><a href="{{ route('contact.show') }}">{{ trans('main.contacts') }}</a></li>
                  <li class="nav-item telegramLink"><a href="{{ getTelegramLink() }}"><div class="telegramImg"><img src="../images/telegramIcoWhite.svg"/></div><span>{{ trans('main.ourTelegram') }}</span></a></li>
                  <li class="callback-section-header">
                       <div class="callback-phone">
                           <div class="callback-item-phone">
                               <a href="tel:{{ addressSelectedCity()->addresses->first()->phones }}">{{ addressSelectedCity()->addresses->first()->phones }}</a>
                               <div class="callback-drop-box"> <span class="call-drop-title">{{ trans('main.call_drop_title') }}</span> 
                                    <div class="callback-dropdown-phone">
                                        @include('includes.callback-questions-form-front')
                                        <div class="social-mobile-form">
                                             <ul class="social-mobile-list">
                                                 <!--<li>
                                                     <span class="icon-social-fb"></span>
                                                     <a target="blank" href="#" class="social-item-link"></a>
                                                 </li>
                                                 <li>
                                                     <span class="icon-social-inst"></span>
                                                     <a target="blank" href="#" class="social-item-link"></a>
                                                 </li>-->
                                                 <!-- <li>
                                                     <span class="icon-social-yt"></span>
                                                     <a href="#" class="social-item-link"></a>
                                                 </li> -->
                                                 <li>
                                                     <span class="icon-social-telegram"></span>
                                                     <a  target="blank" href="{{ getTelegramLink() }}" class="social-item-link"></a>
                                                 </li>
                                             </ul>
                                        </div>
                                    </div>
                               </div>
                           </div>
                       </div>
         
                  </li>
              </ul>

           </nav> 

       </div>
</header>