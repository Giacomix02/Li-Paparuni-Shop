<!DOCTYPE html>
<html class="no-js" lang="en">

@component("modules.head")@endcomponent

<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="<?=ASSETS?>/images/preloader.png" alt=""></div>
    </div>

    <!--====== Main App ======-->
    <div id="app">

        <!--====== Main Header ======-->
        @component("modules.navbar-all")@endcomponent
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

                                        <a href="<?=ROOT?>signin">Signin</a></li>
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
                                        {{ $top_message }}
                                        <h1 class="gl-h1">NEW CUSTOMER?</h1>

                                        <div class="u-s-m-b-15">

                                            <a class="l-f-o__create-link btn--e-transparent-brand-b-2" href="<?=ROOT?>signup">CREATE AN ACCOUNT</a></div>
                                        <h1 class="gl-h1">SIGN IN</h1>
                                        
                                        <form class="l-f-o__form" method="post">
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="login-email">E-MAIL *</label>

                                                <input class="input-text input-text--primary-style" type="email" name="email" placeholder="nome@dominio"></div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="login-password">PASSWORD *</label>

                                                <input class="input-text input-text--primary-style" type="password" name="password" placeholder="*?^&!@#$%"></div>
                                                    <div class="error-identity"> 
                                                        {{$error}}
                                                        {{$debug}}
                                                    </div>
                                    
                                                    <div class="elongate">

                                                        <button class="btn btn--e-transparent-brand-b-2 align_button_sign" type="submit">LOGIN</button>
                                                    </div>

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
        @component("modules.footer")@endcomponent
    <!--====== End - Main App ======-->


    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
    @component("modules.scripts")@endcomponent

</body>
</html>