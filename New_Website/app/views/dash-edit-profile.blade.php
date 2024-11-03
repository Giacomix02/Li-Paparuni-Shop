<!DOCTYPE html>
<html class="no-js" lang="en">

@component('modules.head')@endcomponent

<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="images/preloader.png" alt=""></div>
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

                                        <a href="<?=ROOT?>account">Home</a>
                                    </li>
                                    <li class="has-separator">

                                        <a href="<?=ROOT?>accountProfile">My Profile</a>
                                    </li>
                                    <li class="is-marked">

                                        <a href="">Edit Profile</a>
                                    </li>
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
                    <div class="dash">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    @component('modules.account-dashboard-features', array_merge($data["infos"],$data["orders"],$data["wishlist"]))@endcomponent
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Edit Profile</h1>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="dash-edit-p" method="POST">
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="reg-fname">USERNAME</label>

                                                                @if(isset($data["infos"]["username"]))
                                                                    <input required class="input-text input-text--primary-style" name="new_username" type="text" id="reg-fname" placeholder="{!! $data["infos"]["username"] !!}" value="{!! $data["infos"]["username"] !!}">
                                                                @else
                                                                    <input required class="input-text input-text--primary-style" name="new_username" type="text" id="reg-fname" placeholder="Mario Rossi">
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="error-identity">
                                                            {!! $data["userInfo"] !!}
                                                        </div>

                                                        <button class="btn btn--e-brand-b-2" name="edit_username" value="edit_username" type="submit">SAVE</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div style="margin-top: 2rem"  class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="dash-edit-p" method="POST" >

                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="reg-fname">OLD PASSWORD</label>

                                                                <input required class="input-text input-text--primary-style" name="old_password" type="text" id="reg-lname" placeholder="">
                                                            </div>
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="reg-lname">NEW PASSWORD</label>

                                                                <input required class="input-text input-text--primary-style" name="new_password" type="text" id="reg-lname" placeholder="">
                                                            </div>
                                                        </div>


                                                        <div class="error-identity">
                                                            {!! $data["passInfo"] !!}
                                                        </div>


                                                        <button class="btn btn--e-brand-b-2" name="edit_password" value="edit_password" type="submit">SAVE</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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

        <!--====== Main Footer ======-->
        @component('modules.footer')@endcomponent

        <!--====== Modal Section ======-->

        <!--====== End - Modal Section ======-->
    </div>
    <!--====== End - Main App ======-->


    @component('modules.scripts')@endcomponent
</body>
</html>