<!DOCTYPE html>
<html class="no-js" lang="en">

@component("modules.head")@endcomponent

<body class="config">
<div class="preloader is-active">
    <div class="preloader__wrap">

        <img class="preloader__img" src="images/preloader.png" alt=""></div>
</div>

<!--====== Main App ======-->
<div id="app">

    <!--====== Main Header ======-->
    @component("modules.navbar-all")@endcomponent
    <!--====== End - Main Header ======-->


    <!--====== App Content ======-->
    <div class="app-content">

        <!--====== Section 1 ======-->
        <div class="u-s-p-t-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">

                        <!--====== Product Detail Zoom ======-->
                        <div class="pd u-s-m-b-30">
                            <div class="slider-fouc pd-wrap">
                                <div id="pd-o-initiate">
                                    <div class="pd-o-img-wrap" data-src="<?=IMAGE?>{!! $product["Immagine"] !!}">

                                            <img class="u-img-fluid" src="<?=IMAGE?>{!! $product["Immagine"] !!}" data-zoom-image="images/product/product-d-1.jpg" alt=""></div>
                                    </div>
                                </div>
                                <div class="u-s-m-t-15">
                                    <div class="slider-fouc">
                                        <div id="pd-o-thumbnail">
                                            <div>

                                            <img class="u-img-fluid" src="images/product/product-d-1.jpg" alt=""></div>
                                        <div>

                                            <img class="u-img-fluid" src="images/product/product-d-2.jpg" alt=""></div>
                                        <div>

                                            <img class="u-img-fluid" src="images/product/product-d-3.jpg" alt=""></div>
                                        <div>

                                            <img class="u-img-fluid" src="images/product/product-d-4.jpg" alt=""></div>
                                        <div>

                                            <img class="u-img-fluid" src="images/product/product-d-5.jpg" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--====== End - Product Detail Zoom ======-->
                    </div>
                    <div class="col-lg-7">

                        <!--====== Product Right Side Details ======-->
                        <div class="pd-detail">
                            <div>

                                <span class="pd-detail__name">{!! $product["Nome"] !!}</span></div>
                            <div>
                                <div class="pd-detail__inline">
                                    @if($product["PrezzoAttuale"]!=0)
                                        <span class="pd-detail__price">{!! $product["PrezzoAttuale"] !!} €</span>

                                        @php($product["Sconto"]=round(($product["PrezzoOriginale"]-$product["PrezzoAttuale"])/$product["PrezzoOriginale"]*100,0))

                                        <span class="pd-detail__discount">({!! $product["Sconto"] !!}%)</span>
                                        <del class="pd-detail__del">
                                            {!! $product["PrezzoOriginale"] !!} €
                                        </del></div>
                                @else
                                    <span class="pd-detail__price">{!! $product["PrezzoOriginale"] !!} €</span></div>
                            @endif
                        </div>

                        <div class="u-s-m-b-15">
                            <div class="pd-detail__inline">
                                @if($product["Quantita"]>0 && $product["Quantita"]<10)
                                    <span class="pd-detail__left">Only {!! $product["Quantita"] !!} left</span></div>
                            @elseif($product["Quantita"]>=10)
                                <span class="pd-detail__stock">In Stock</span></div>
                        @endif
                    </div>
                    <div class="u-s-m-b-15">

                        <span class="pd-detail__preview-desc">{!! $product["Descrizione"] !!}</span></div>
                    <div class="u-s-m-b-15">
                        <div class="pd-detail__inline">

                            <span class="pd-detail__click-wrap">

                                <form method="POST" action="<?=ROOT?>wishlist" class="all-unset">
                                    <i class="far fa-heart u-s-m-r-6"></i>
                                    <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                                    <input hidden="" name="IdProdotto" value="{!! $product["IdProdotto"] !!}">
                                    <button type="submit" class="unset-all-sium button-pointer">Add to Wishlist</button>
                                </form>
                            </span>
                        </div>
                    </div>


                    <div class="u-s-m-b-15">
                        <form class="pd-detail__form" method="POST" action="<?=ROOT?>cart">
                            <div class="pd-detail-inline-2">
                                <div class="u-s-m-b-15">
                                    @if($product["Quantita"]>0)
                                        <!--====== Input Counter ======-->
                                        <div class="input-counter">

                                            <span class="input-counter__minus fas fa-minus"></span>

                                            <input class="input-counter__text input-counter--text-primary-style"
                                                   type="text" name="quantity" value="1" data-min="1" data-max="{!! $product["Quantita"] !!}">

                                            <span class="input-counter__plus fas fa-plus"></span></div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                                    <input type="hidden" value="{{$product["IdProdotto"]}}" name="id" />
                                    <button class="btn btn--e-brand-b-2-animated" type="submit" name="action" value="add" >Add To Cart</button>
                                    
                                </div>
                                <!--====== End - Input Counter ======-->

                                @else
                                    <div class="u-s-m-b-15">

                                        <button class="btn btn--e-brand-b-2 non-disponibile">Out of Stock</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                </div>
                <div class="u-s-m-b-15">

                    <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                    <ul class="pd-detail__policy-list">
                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                            <span>Buyer Protection.</span></li>
                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                            <span>Full Refund if you don't receive your order.</span></li>
                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                            <span>Returns accepted if product not as described.</span></li>
                    </ul>
                </div>
            </div>
            <!--====== End - Product Right Side Details ======-->
        </div>
    </div>
</div>
</div>


<div class="u-s-p-b-90">

    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-46">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">CUSTOMER ALSO VIEWED</h1>

                        <span class="section__span u-c-grey">PRODUCTS THAT CUSTOMER VIEWED</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->


    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="slider-fouc">
                <div class="owl-carousel product-slider" data-item="4">
                    @foreach($consigliati as $consigliato)
                        @component("modules.card-dettagli-prodotto-consigliato",$consigliato)@endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 1 ======-->
</div>
<!--====== End - App Content ======-->


<!--====== Main Footer ======-->
@component("modules.footer") @endcomponent

<!--====== Modal Section ======-->


<!--====== Quick Look Modal ======-->
<div class="modal fade" id="quick-look">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal--shadow">

            <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">

                        <!--====== Product Breadcrumb ======-->
                        <div class="pd-breadcrumb u-s-m-b-30">
                            <ul class="pd-breadcrumb__list">
                                <li class="has-separator">

                                    <a href="index.hml">Home</a></li>
                                <li class="has-separator">

                                    <a href="shop-side-version-2.html">Electronics</a></li>
                                <li class="has-separator">

                                    <a href="shop-side-version-2.html">DSLR Cameras</a></li>
                                <li class="is-marked">

                                    <a href="shop-side-version-2.html">Nikon Cameras</a></li>
                            </ul>
                        </div>
                        <!--====== End - Product Breadcrumb ======-->


                        <!--====== Product Detail ======-->
                        <div class="pd u-s-m-b-30">
                            <div class="pd-wrap">
                                <div id="js-product-detail-modal">
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-1.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-2.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-3.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-4.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-5.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="u-s-m-t-15">
                                <div id="js-product-detail-modal-thumbnail">
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-1.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-2.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-3.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-4.jpg" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-5.jpg" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <!--====== End - Product Detail ======-->
                    </div>
                    <div class="col-lg-7">

                        <!--====== Product Right Side Details ======-->
                        <div class="pd-detail">
                            <div>

                                <span class="pd-detail__name">Nikon Camera 4k Lens Zoom Pro</span></div>
                            <div>
                                <div class="pd-detail__inline">

                                    <span class="pd-detail__price">$6.99</span>

                                    <span class="pd-detail__discount">(76% OFF)</span>
                                    <del class="pd-detail__del">$28.97</del>
                                </div>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__rating gl-rating-style"><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                    <span class="pd-detail__review u-s-m-l-4">

                                                <a href="product-detail.html">23 Reviews</a></span></div>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                    <span class="pd-detail__stock">200 in stock</span>

                                    <span class="pd-detail__left">Only 2 left</span></div>
                            </div>
                            <div class="u-s-m-b-15">

                                <span class="pd-detail__preview-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                            <span class="pd-detail__click-wrap"><i class="far fa-heart u-s-m-r-6"></i>

                                                <a href="signin.html">Add to Wishlist</a>

                                                <span class="pd-detail__click-count">(222)</span></span></div>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                            <span class="pd-detail__click-wrap"><i
                                                        class="far fa-envelope u-s-m-r-6"></i>

                                                <a href="signin.html">Email me When the price drops</a>

                                                <span class="pd-detail__click-count">(20)</span></span></div>
                            </div>
                            <div class="u-s-m-b-15">
                                <ul class="pd-social-list">
                                    <li>

                                        <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li>

                                        <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li>

                                        <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>

                                        <a class="s-wa--color-hover" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                    <li>

                                        <a class="s-gplus--color-hover" href="#"><i
                                                    class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                            <div class="u-s-m-b-15">
                                <form class="pd-detail__form">
                                    <div class="pd-detail-inline-2">
                                        <div class="u-s-m-b-15">

                                            <!--====== Input Counter ======-->
                                            <div class="input-counter">

                                                <span class="input-counter__minus fas fa-minus"></span>

                                                <input class="input-counter__text input-counter--text-primary-style"
                                                       type="text" value="1" data-min="1" data-max="1000">

                                                <span class="input-counter__plus fas fa-plus"></span></div>
                                            <!--====== End - Input Counter ======-->
                                        </div>
                                        <div class="u-s-m-b-15">

                                            <button class="btn btn--e-brand-b-2" type="submit">Add to Cart</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="u-s-m-b-15">

                                <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                                <ul class="pd-detail__policy-list">
                                    <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                        <span>Buyer Protection.</span></li>
                                    <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                        <span>Full Refund if you don't receive your order.</span></li>
                                    <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                        <span>Returns accepted if product not as described.</span></li>
                                </ul>
                            </div>
                        </div>
                        <!--====== End - Product Right Side Details ======-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== End - Quick Look Modal ======-->



<!--====== End - Add to Cart Modal ======-->
<!--====== End - Modal Section ======-->

<!--====== End - Main App ======-->

@component("modules.scripts")@endcomponent

</body>
</html>