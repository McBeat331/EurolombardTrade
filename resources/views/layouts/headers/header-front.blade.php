
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
                    <a href="#">
                        <span>{{ trans('main.cources') }}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#">
                        <span>{{ trans('main.ourServices') }}</span>
                    </a>
                  </li>
                  <li class="nav-item"><a href="#">{{ trans('main.ourAdvantages') }}</a></li>
                  <li class="nav-item"><a href="#">{{ trans('main.contacts') }}</a></li>
                  <li class="callback-section-header">
                       <div class="callback-phone">
                           <div class="callback-item-phone">
                               <a href="tel:0730183284">073 018 32 84</a>
                               <div class="callback-drop-box"> <span class="call-drop-title">{{ trans('main.call_drop_title') }}</span> 
                                    <div class="callback-dropdown-phone">
                                        @include('includes.callback-questions-form-front')
                                        <div class="social-mobile-form">
                                             <ul class="social-mobile-list">
                                                 <li>
                                                     <span class="icon-social-fb"></span>
                                                     <a target="blank" href="#" class="social-item-link"></a>
                                                 </li>
                                                 <li>
                                                     <span class="icon-social-inst"></span>
                                                     <a target="blank" href="#" class="social-item-link"></a>
                                                 </li>
                                                 <!-- <li>
                                                     <span class="icon-social-yt"></span>
                                                     <a href="#" class="social-item-link"></a>
                                                 </li> -->
                                                 <li>
                                                     <span class="icon-social-telegram"></span>
                                                     <a  target="blank" href="#" class="social-item-link"></a>
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