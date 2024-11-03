<div class="header-wrapper">
    <!--====== Main Header ======-->
    <header class="header--style-3">

        <!--====== Nav 1 ======-->
        <nav class="primary-nav-wrapper navbar-image-custom-container">

            <div class="navbar-image-custom">
                <a class="all-unset-sium" href="<?=ROOT?>">
                    <img src="<?=ASSETS?>/images/favicon.png" style="margin-left:15px;" >
                </a>
            </div>

            <div class="container">
                <!--====== Primary Nav ======-->
                <div class="primary-nav">


                    <!--====== Search Form ======-->
                    <form class="main-form enrico-cerca" action="<?=ROOT?>products" method="get">

                        <label for="main-search"></label>

                        <input class="input-text input-text--border-radius input-text--only-white" type="text"
                               id="main-search" placeholder="Search" name="search">

                        <button class="btn btn--icon fas fa-search main-search-button" type="submit" ></button>
                    </form>
                    <!--====== End - Search Form ======-->


                    <!--====== Dropdown Main plugin ======-->
                    <div class="menu-init" id="navigation">

                        <button class="btn btn--icon toggle-button toggle-button--white fas fa-cogs"
                                type="button"></button>

                        <!--====== Menu ======-->

                        <!--====== End - Menu ======-->
                    </div>
                    <!--====== End - Dropdown Main plugin ======-->
                </div>
                <!--====== End - Primary Nav ======-->
            </div>
        </nav>
        <!--====== End - Nav 1 ======-->


        <!--====== Nav 2 ======-->
        <nav class="secondary-nav-wrapper">
            <div class="container">
                <!--====== Secondary Nav ======-->
                <div class="secondary-nav">
                
                    <!--====== Dropdown Main plugin ======-->
                    <div class="menu-init" id="navigation1"> <!--====== End - Menu non cancellare ======-->
                    </div>
                    <!--====== End - Dropdown Main plugin ======-->


                    <!--====== Dropdown Main plugin ======-->
                    <div class="menu-init enrico-trova" id="navigation2">

                        <button class="btn btn--icon toggle-button toggle-button--white fas fa-cog"
                                type="button"></button>

                        <!--====== Menu ======-->
                        <div class="ah-lg-mode">

                            <span class="ah-close">✕ Close</span>

                            <!--====== List ======-->
                            <ul class="ah-list ah-list--design2 ah-list--link-color-white">
                                <li>
                                    <a href="<?= ROOT ?>products?category=&search=&casaEditrice=&orderBy=DataPubblicazione">NUOVI ARRIVI</a>
                                </li>
                                <li>
                                    <a href="<?=ROOT?>products">Prodotti</a>
                                </li>
                                <li>
                                    <a href="<?=ROOT?>Category">Categorie</a>
                                </li>
                            </ul>
                            <!--====== End - List ======-->
                        </div>
                        <!--====== End - Menu ======-->
                    </div>
                    <!--====== End - Dropdown Main plugin ======-->


                    <!--====== Dropdown Main plugin ======-->
                    <div class="menu-init" id="navigation3">

                        <button
                            class="btn btn--icon toggle-button toggle-button--white fas fa-shopping-cart toggle-button-shop"
                            type="button"></button>

                        <span class="total-item-round">2</span>

                        <!--====== Menu ======-->
                        <div class="ah-lg-mode">

                            <span class="ah-close">✕ Close</span>

                            <!--====== List ======-->
                            <ul class="ah-list ah-list--design1 ah-list--link-color-white">
                                <li>

                                <a href="<?=ROOT?>"><i class="fas fa-home u-c-brand"></i></a>
                                </li>
                                <li>

                                    <div class="ah-lg-mode">

                                        <span class="ah-close">✕ Close</span>

                                        <!--====== List ======-->
                                        <ul class="ah-list ah-list--design1 ah-list--link-color-white">
                                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left"
                                                title="{{getGreeting()}}">

                                                <a><i class="far fa-user-circle"></i></a>

                                                <!--====== Dropdown ======-->

                                                <span class="js-menu-toggle"></span>
                                                <ul style="width:120px">
                                                    @set($isLoggedIn = isset($_SESSION['token']))
                                                    @if($isLoggedIn)
                                                    <li>

                                                        <a href="<?=ROOT?>account"><i
                                                                    class="fas fa-user-circle u-s-m-r-6"></i>

                                                            <span>Account</span></a>
                                                    </li>
                                                    @endif
                                                    @unless($isLoggedIn)
                                                    <li>

                                                        <a href="<?=ROOT?>signin"><i class="fas fa-lock u-s-m-r-6"></i>

                                                            <span>Signin</span></a>
                                                    </li>
                                                    <li>

                                                        <a href="<?=ROOT?>signup"><i class="fas fa-user-plus u-s-m-r-6"></i>

                                                            <span>Signup</span></a>
                                                    </li>

                                                    @endunless
                                                    @if($isLoggedIn)
                                                    <li>

                                                        <a href="<?=ROOT?>signout"><i class="fas fa-lock-open u-s-m-r-6"></i>

                                                            <span>Signout</span></a>
                                                    </li>
                                                    @endif
                                                </ul>
                                                <!--====== End - Dropdown ======-->
                                            </li>
                                            <li>
                                                <!--====== End - Dropdown 
                                                
                                                <a href="<?=ROOT?>wishlist"><i class="far fa-heart"></i></a>
                                        </ul>
                                        <!--====== End - List ======-->
                                    </div>
                                </li>
                               @component("modules.mini-cart")@endcomponent
                            </ul>
                            <!--====== End - List ======-->
                        </div>
                        <!--====== End - Menu ======-->
                    </div>
                    <!--====== End - Dropdown Main plugin ======-->
                </div>
                <!--====== End - Secondary Nav ======-->
            </div>
        </nav>
        <!--====== End - Nav 2 ======-->
    </header>
    <!--====== End - Main Header ======-->
</div>