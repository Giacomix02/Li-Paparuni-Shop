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

    <!--====== Header Wrapper ======-->
    @component("modules.navbar-home")@endcomponent
    <!--====== End - Header Wrapper ======-->


    <!--====== App Content ======-->
    <div class="app-content">

        <!--====== Primary Slider ======-->
        <div class="s-skeleton s-skeleton--h-640 s-skeleton--bg-grey">
            <div class="owl-carousel primary-style-3" id="hero-slider">
                @foreach($heroSlides as $heroSlide)
                    <div class="hero-slide hero-slide--{{$heroSlide['NumeroBanner']}}">
                        <div class="primary-style-3-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="slider-content slider-content--animation" style="margin-bottom: 58px;">

                                            <span class="content-span-1 u-c-white"> </span>

                                            <span class="content-span-2 u-c-white" style="max-width: 60%">{{$heroSlide['Riga_1']}}</span>

                                            <span class="content-span-3 u-c-white">{{$heroSlide['Riga_2']}}</span>
                                            @if($heroSlide['Bottone'])
                                            <a class="shop-now-link btn--e-secondary"  href="{{ $heroSlide['Link'] }}" > {{$heroSlide['Testo_Bottone']}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--====== End - Primary Slider ======-->


        <!--====== Section 1 ======-->
        <div class="u-s-p-y-60">

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 u-s-m-b-30">
                            <div class="promotion-o">
                                <div class="aspect aspect--bg-grey aspect--square">

                                    <img class="aspect__img" src="<?=ROOT?>assets/images/custom/manga-imm.jpg" alt=""></div>
                                <div class="promotion-o__content">

                                    <a class="promotion-o__link btn--e-white-brand" href="<?=ROOT?>Section/Manga">Manga</a></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 u-s-m-b-30">
                            <div class="promotion-o">
                                <div class="aspect aspect--bg-grey aspect--square">

                                    <img class="aspect__img" src="<?=ROOT?>assets/images/custom/light-novel-imm.jpg" alt=""></div>
                                <div class="promotion-o__content">

                                    <a class="promotion-o__link btn--e-white-brand" href="<?=ROOT?>Section/Light_Novel">Light Novel</a></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 u-s-m-b-30">
                            <div class="promotion-o">
                                <div class="aspect aspect--bg-grey aspect--square">

                                    <img class="aspect__img" src="<?=ROOT?>assets/images/custom/magazine-imm.jpeg" alt=""></div>
                                <div class="promotion-o__content">

                                    <a class="promotion-o__link btn--e-white-brand" href="<?=ROOT?>Section/Magazine">Magazine</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 1 ======-->


        <!--====== Section 2 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">RECENT PRODUCTS</h1>

                                <span class="section__span u-c-silver">NEWLY ADDED PRODUCTS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->


            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="shop-p__collection">
                            <div class="row is-grid-active">
                                @set ($count=0)
                                @foreach($Section1 as $product)
                                    @if($count==12)
                                        @break
                                    @endif

                                    @component('modules.card-index', $product)@endcomponent
                                    @set ($count=$count+1)
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 2 ======-->


        <!--====== Section 3 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-16">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">BEST SELLING DEL MESE</h1>

                                <span class="section__span u-c-silver u-s-m-b-16">CERCA IL PRODOTTO PIU VENDUTO DELLE CASE EDITRICI ATTUALI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->


            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-category-container">
                                <div class="filter__category-wrapper">

                                    <button class="btn filter__btn filter__btn--style-2 js-checked" type="button"
                                            data-filter="*">ALL
                                    </button>
                                </div>

                                @foreach ($Section3 as $product)
                                    @component('modules.card-index-filter', $product)@endcomponent
                                @endforeach

                            </div>
                            <div class="filter__grid-wrapper u-s-m-t-30">
                                <div class="row">
                                    <div class="row is-grid-active">
                                    @foreach($Section2 as $product)
                                        @component('modules.card-index', $product)@endcomponent
                                    @endforeach
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="load-more">

                                <button id="loadMoreBtn" class="btn btn--e-brand btn--e-transparent-brand-b-2" type="button">Load More</button>                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 3 ======-->


        <!--====== Section 4 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">Le case editrici del momento</h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->


            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
            <div class="row">
                <div class="col-lg-4-custom col-md-4 col-sm-6 u-s-m-b-30">
                    <div class="promotion-o">
                        <div class="aspect aspect--bg-grey aspect--square">

                            <img class="aspect__img" src="<?=ROOT?>assets/images/custom/dokusho-imm.jpg" alt=""></div>
                        <div class="promotion-o__content">

                            <a class="promotion-o__link btn--e-white-brand" href="<?=ROOT?>products?casaEditrice=Dokusho_Edizioni">Dokusho Edizioni</a></div>
                    </div>
                </div>
                <div class="col-lg-4-custom col-md-4 col-sm-6 u-s-m-b-30">
                    <div class="promotion-o">
                        <div class="aspect aspect--bg-grey aspect--square">

                            <img class="aspect__img" src="<?=ROOT?>assets/images/custom/jpop-imm.jpeg" alt=""></div>
                        <div class="promotion-o__content">

                            <a class="promotion-o__link btn--e-white-brand" href="<?=ROOT?>products?casaEditrice=Jpop">Jpop</a></div>
                    </div>
                </div>
                <div class="col-lg-4-custom col-md-4 col-sm-6 u-s-m-b-30">
                    <div class="promotion-o">
                        <div class="aspect aspect--bg-grey aspect--square">

                            <img class="aspect__img" src="<?=ROOT?>assets/images/custom/star-comics-imm.jpg" alt=""></div>
                        <div class="promotion-o__content">

                            <a class="promotion-o__link btn--e-white-brand" href="<?=ROOT?>products?casaEditrice=StarComics">StarComics</a></div>
                    </div>
                </div>
                <div class="col-lg-4-custom col-md-4 col-sm-6 u-s-m-b-30">
                    <div class="promotion-o">
                        <div class="aspect aspect--bg-grey aspect--square">

                            <img class="aspect__img" src="<?=ROOT?>assets/images/custom/panini-imm.jpg" alt=""></div>
                        <div class="promotion-o__content">

                            <a class="promotion-o__link btn--e-white-brand" href="<?=ROOT?>products?casaEditrice=Panini">Panini</a></div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 4 ======-->

        <!--====== End - App Content ======-->

        <!--====== Quick Look Modal ======-->
        @component('modules.quick-look')@endcomponent
        <!--====== End - Quick Look Modal ======-->
        <!--====== Main Footer ======-->
        @component("modules.footer")@endcomponent
        <!--====== Modal Section ======-->

        <!--====== Add to Cart Modal ======-->
        <div class="modal fade" id="add-to-cart">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-radius modal-shadow">

                    <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="success u-s-m-b-30">
                                    <div class="success__text-wrap"><i class="fas fa-check"></i>

                                        <span>Item is added successfully!</span></div>
                                    <div class="success__img-wrap">

                                        <img class="u-img-fluid" src="images/product/electronic/product1.jpg" alt="">
                                    </div>
                                    <div class="success__info-wrap">

                                        <span class="success__name">Beats Bomb Wireless Headphone</span>

                                        <span class="success__quantity">Quantity: 1</span>

                                        <span class="success__price">$170.00</span></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="s-option">

                                    <span class="s-option__text">1 item (s) in your cart</span>
                                    <div class="s-option__link-box">

                                        <a class="s-option__link btn--e-white-brand-shadow" data-dismiss="modal">CONTINUE
                                            SHOPPING</a>

                                        <a class="s-option__link btn--e-white-brand-shadow" href="cart.html">VIEW
                                            CART</a>

                                        <a class="s-option__link btn--e-brand-shadow" href="checkout.html">PROCEED TO
                                            CHECKOUT</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Add to Cart Modal ======-->
    </div>
    <!--====== End - Main App ======-->


@component("modules.scripts")@endcomponent

</body>
</html>