<!DOCTYPE html>
<html class="no-js" lang="en">
@component('modules.head')@endcomponent
<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="<?=ASSETS?>/images/preloader.png" alt=""></div>
    </div>

    <!--====== Main App ======-->
    <div id="app">

        <!--====== Main Header ======-->
        @component('modules.navbar-all')@endcomponent
        <!--====== End - Main Header ======-->


        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">
                                        <a href="<?= ROOT?>">Home</a></li>
                                    <li class="is-marked">

                                        <a href="<?=ROOT?>signup">Signup</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">



                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row row--center">
                            <div class="col-lg-6 col-md-8 u-s-m-b-30">
                                <div class="l-f-o">
                                    <div class="l-f-o__pad-box">
                                        <h1 class="gl-h1">ALREADY REGISTERED?</h1>

                                        <div class="u-s-m-b-15">

                                            <a class="l-f-o__create-link btn--e-transparent-brand-b-2" href="<?=ROOT?>signin">SIGN IN</a></div>
                                        <h1 class="gl-h1">REGISTER</h1>
                                        <form class="l-f-o__form" method="post">
                                            
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="username">USERNAME</label>

                                                <input class="input-text input-text--primary-style" type="text" name="username" placeholder="Username"></div>
                                            <div class="gl-inline">
                                                
                                            </div>

                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="email">E-MAIL *</label>

                                                <input class="input-text input-text--primary-style" type="email" name="email" placeholder="nome@dominio"></div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="password">PASSWORD *</label>

                                                <input class="input-text input-text--primary-style" type="password" name="password" placeholder="*?^&!@#$%"></div>
                                                <div class="error-identity"> 
                                                        {{$error}}
                                                        {{$debug}}
                                                    </div>
                                                <div class="elongate">

<button class="btn btn--e-transparent-brand-b-2 align_button_sign" type="submit">CREATE</button>
</div>
                                            <a class="gl-link align_button_sign" style="margin-top: 1rem" href="<?=ROOT?>">Return to Store</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
        @component('modules.footer')@endcomponent
    </div>
    <!--====== End - Main App ======-->


    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
    @component("modules.scripts")@endcomponent

</body>
</html>