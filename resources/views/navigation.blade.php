
        <!-- Header -->

        <header class="header trans_200">

            <!-- Top Bar -->
            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">

                                {{--  <div class="top_bar_item"><a href="#">Heures d&#039ouvertures</a></div>  --}}
                                  </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Content -->
            <div class="header_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                <nav class="main_nav ml-auto">
                                    <ul>
                                        @guest
                                        <li><a href="/">Acceuil</a></li>
                                        <li><a href="/users/login">Connexion</a></li>
                                        <li class="menu_item menu_mm"><a href="/clients/registration">Inscription clients</a></li>
                                        <li class="menu_item menu_mm"><a href="/pharmaciens/registration">Inscription pharmaciens</a></li>
                       
                                        @else

                                        <li><a href="/">Acceuil</a></li>
                                        {{--  <li><a href="services.html">Services</a></li>
                                        <li><a href="news.html">Nouvelles</a></li>
                                        <li><a href="contact.html">Contactez-nous</a></li>  --}}
                                        <li><a class="dropdown-item" >{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</a></li>

                                            <li><a class="dropdown-item" href="{{ route('users.logout') }}">Deconnexion</a></li>
                                        @endguest
                                    </ul>
                                </nav>
                                <div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo -->
            <div class="logo_container_outer">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="logo_container">
                                <a href="#">
                                    <div class="logo_content d-flex flex-column align-items-start justify-content-center">
                                        <div class="logo_line">

                                        </div>
                                        <div class="logo  d-flex flex-row align-items-center justify-content-center">
                                            <img src="/images/dwek.png" width="150px" align="center" height="150px" class="mr-0">
                                            {{--  <div class="logo_text mb-1">Dwek<span> يجيك</span></div>
                                            <div class=" mb-1 logo_box">+</div>  --}}
                                        </div>
                                       
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <!-- Menu -->

        <div class="menu_container menu_mm">

            <!-- Menu Close Button -->
            <div class="menu_close_container">
                <div class="menu_close"></div>
            </div>

            <!-- Menu Items -->
            <div class="menu_inner menu_mm">
                <div class="menu menu_mm">
                    <ul class="menu_list menu_mm">
                        @guest
                        <li class="menu_item menu_mm"><a href="index.html">Acceuil</a></li>
                        <li class="menu_item menu_mm"><a href="/users/login">Connexion</a></li>
                        <li class="menu_item menu_mm"><a href="/clients/registration">Inscription clients</a></li>
                        <li class="menu_item menu_mm"><a href="/pharmaciens/registration">Inscription pharmaciens</a></li>
                        @else

                        <li class="menu_item menu_mm"><a href="/">Acceuil/a></li>
                        {{--  <li class="menu_item menu_mm"><a href="services.html">Services</a></li>
                        <li class="menu_item menu_mm"><a href="news.html">Nouvelles</a></li>
                        <li class="menu_item menu_mm"><a href="contact.html">Contactez-nous</a></li>  --}}
                        <li><a class="dropdown-item" >{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</a></li>

                        <li><a class="dropdown-item" href="{{ route('users.logout') }}">Deconnexion</a></li>
                        @endguest
                    </ul>
                </div>


            </div>

        </div>
