   <!-- START FOOTER -->
   <footer class="bg_gray">
       <div class="footer_top small_pt pb_20">
           <div class="container">
               <div class="row">
                   <div class="col-lg-4 col-md-12 col-sm-12">
                       <div class="widget">
                           <div class="footer_logo">
                               <a href="#"><img src="{{ asset('front/assets/images/logo.png') }}"
                                       alt="logo" /></a>
                           </div>
                           <p class="mb-3">Nuestra colección de bolsos y carteras combina diseño exclusivo y calidad
                               premium.</p>
                           <ul class="contact_info">
                               <li>
                                   <i class="ti-location-pin"></i>
                                   <p>{{ get_configuracion()->direccion }}</p>
                               </li>
                               <li>
                                   <i class="ti-email"></i>
                                   <a href="mailto:info@sitename.com">{{ get_configuracion()->email }}</a>
                               </li>
                               <li>
                                   <i class="ti-mobile"></i>
                                   <p>{{ get_configuracion()->telefono }}</p>
                               </li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-2 col-md-4 col-sm-6">
                       <div class="widget">
                           <h6 class="widget_title">Enlaces Rapidos</h6>
                           <ul class="widget_links">
                               <li><a href="{{ route('acerca.de') }}">Nosotros</a></li>
                               <li><a href="{{ route('preguntas') }}">Preguntas</a></li>
                               <li><a href="{{ route('terminos.condiciones') }}">Terminos</a></li>
                               <li><a href="{{ route('politicas.privacidad') }}">Privacidad</a></li>
                               <li><a href="{{ route('contactenos') }}">Contáctenos</a></li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-2 col-md-4 col-sm-6">
                       <div class="widget">
                           <h6 class="widget_title">Mi Cuenta</h6>
                           <ul class="widget_links">
                               <li><a href="{{ route('login') }}">Login</a></li>
                               <li><a href="{{ route('register') }}">Registrese</a></li>
                               <li><a href="/">Tracking</a></li>
                               <li><a href="/blog">Blog</a></li>
                               <li><a href="/intranet">Intranet</a></li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-4 col-sm-12">
                       <div class="widget">
                           <h6 class="widget_title">Instagram</h6>
                           <ul class="widget_instafeed instafeed_col4">
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img1.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img2.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img3.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img4.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img5.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img6.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img7.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                               <li><a target="_new" href="https://www.instagram.com/amryluxe/"><img src="{{ asset('front/assets/images/insta_img8.jpg') }}"
                                           ><span class="insta_icon"><i
                                               class="ti-instagram"></i></span></a></li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="middle_footer">
           <div class="container">
               <div class="row">
                   <div class="col-12">
                       <div class="shopping_info">
                           <div class="row justify-content-center">
                               <div class="col-md-4">
                                   <div class="icon_box icon_box_style2">
                                       <div class="icon">
                                           <i class="flaticon-shipped"></i>
                                       </div>
                                       <div class="icon_box_content">
                                           <h5>Envío Gratis</h5>
                                           <p>Disfruta de envíos sin costo en todas tus compras superiores a un monto
                                               mínimo.</p>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="icon_box icon_box_style2">
                                       <div class="icon">
                                           <i class="flaticon-money-back"></i>
                                       </div>
                                       <div class="icon_box_content">
                                           <h5>Garantía de 30 Días</h5>
                                           <p>Tu satisfacción es nuestra prioridad; tienes 30 días para realizar cambios
                                               o devoluciones.</p>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="icon_box icon_box_style2">
                                       <div class="icon">
                                           <i class="flaticon-support"></i>
                                       </div>
                                       <div class="icon_box_content">
                                           <h5>Atención Personalizada</h5>
                                           <p>¿Dudas con tu compra? Escríbenos y nuestro equipo te asesorará de
                                               inmediato.</p>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="bottom_footer border-top-tran">
           <div class="container">
               <div class="row align-items-center">
                   <div class="col-lg-4">
                       <p class="mb-lg-0 text-center">© 2026 Derechos reservados |
                           {{ get_configuracion()->copyright }}</p>
                   </div>
                   <div class="col-lg-4 order-lg-first">
                       <div class="widget mb-lg-0">
                            <ul class="social_icons text-center text-lg-start">
                                <li><a target="_new" href="{{ get_configuracion()->facebook }}" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>                               
                                <li><a target="_new" href="{{ get_configuracion()->instagram }}" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                                <li>
                                    <a target="_new" href="{{ get_configuracion()->tiktok }}" class="sc_tiktok" title="TikTok" 
                                    style="display: inline-flex; align-items: center; justify-content: center; background-color: #333; width: 32px; height: 32px; border-radius: 2px; transition: 0.3s;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 18px; height: 18px; fill: #ffffff;">
                                            <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                       </div>
                   </div>
                   <div class="col-lg-4">
                       <ul class="footer_payment text-center text-lg-end">
                           <li><a href="#"><img src="{{ asset('front/assets/images/visa.png') }}"
                                       alt="visa"></a></li>
                           <li><a href="#"><img src="{{ asset('front/assets/images/discover.png') }}"
                                       alt="discover"></a></li>
                           <li><a href="#"><img src="{{ asset('front/assets/images/master_card.png') }}"
                                       alt="master_card"></a></li>
                           <li><a href="#"><img src="{{ asset('front/assets/images/paypal.png') }}"
                                       alt="paypal"></a></li>
                           <li><a href="#"><img src="{{ asset('front/assets/images/amarican_express.png') }}"
                                       alt="amarican_express"></a></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </footer>
   <!-- END FOOTER -->


   <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7TypZFTl4Z3gVtikNOdGSfNTpnmq-ahQ&amp;callback=initMap"></script>

   <!-- Latest jQuery -->
   <script src="{{ asset('front/assets/js/jquery-3.7.0.min.js') }}"></script>
   <!-- popper min js -->
   <script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
   <!-- Latest compiled and minified Bootstrap -->
   <script src="{{ asset('front/assets/bootstrap/js/bootstrap.min.js') }}"></script>
   <!-- owl-carousel min js  -->
   <script src="{{ asset('front/assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
   <!-- magnific-popup min js  -->
   <script src="{{ asset('front/assets/js/magnific-popup.min.js') }}"></script>
   <!-- waypoints min js  -->
   <script src="{{ asset('front/assets/js/waypoints.min.js') }}"></script>
   <!-- parallax js  -->
   <script src="{{ asset('front/assets/js/parallax.js') }}"></script>
   <!-- countdown js  -->
   <script src="{{ asset('front/assets/js/jquery.countdown.min.js') }}"></script>
   <!-- imagesloaded js -->
   <script src="{{ asset('front/assets/js/imagesloaded.pkgd.min.js') }}"></script>
   <!-- isotope min js -->
   <script src="{{ asset('front/assets/js/isotope.min.js') }}"></script>
   <!-- jquery.dd.min js -->
   <script src="{{ asset('front/assets/js/jquery.dd.min.js') }}"></script>
   <!-- slick js -->
   <script src="{{ asset('front/assets/js/slick.min.js') }}"></script>
   <!-- elevatezoom js -->
   <script src="{{ asset('front/assets/js/jquery.elevatezoom.js') }}"></script>
   <!-- scripts js -->
   <script src="{{ asset('front/assets/js/scripts.js') }}"></script>
   <script src="{{ asset('front/assets/js/toastr.min.js') }}"></script>
