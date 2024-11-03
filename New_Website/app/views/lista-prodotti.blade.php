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
    @component('modules.navbar-all')@endcomponent
    <!--====== End - Main Header ======-->


    <!--====== App Content ======-->
    <div class="app-content">

        <!--====== Section 1 ======-->
        <div class="u-s-p-y-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="shop-w-master">
                            <h1 class="shop-w-master__heading u-s-m-b-30"><i class="fas fa-filter u-s-m-r-8"></i>

                                <span>FILTRI</span></h1>
                            <div class="shop-w-master__sidebar">
                                @component('modules.products-filter-categoria',["categorie"=>$listaGeneri, "filter"=>$filter])@endcomponent

                                @component('modules.products-filter-casaeditrice',["caseEditrici"=>$caseEditrici, "filter"=>$filter])@endcomponent

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="shop-p">
                            <div class="shop-p__toolbar u-s-m-b-30">
                                <div class="shop-p__meta-wrap u-s-m-b-60 filter-custom" >
                                    <span class="shop-p__meta-text-1">FOUND {{$count}} RESULTS</span>
                                    <a class="btn btn--e-brand-b-2-animated filter-button" href="<?=ROOT?>products">Rimuovi i filtri</a>
                                </div>
                                <div class="shop-p__tool-style">
                                    <div class="tool-style__group u-s-m-b-8">

                                        <span class="js-shop-grid-target is-active">Grid</span>

                                        <span class="js-shop-list-target">List</span></div>
                                    <div class="tool-style__form-wrap">
                                        <div class="u-s-m-b-8">
                                            <select class="select-box select-box--transparent-b-2" id="orderBySelect">
                                                @if($filter["orderBy"]=="Nome")
                                                    <option selected value="location.href='<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=Nome">Ordina per: Nome</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=CasaEditrice">Ordina per: Casa Editrice</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoCrescente">Ordina per: Prezzo crescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoDecrescente">Ordina per: Prezzo decrescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=DataPubblicazione">Ordina per: Data di Pubblicazione</option>
                                                @elseif($filter["orderBy"]=="PrezzoCrescente")
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=Nome">Ordina per: Nome</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=CasaEditrice">Ordina per: Casa Editrice</option>
                                                    <option selected value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoCrescente">Ordina per: Prezzo crescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoDecrescente">Ordina per: Prezzo decrescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=DataPubblicazione">Ordina per: Data di Pubblicazione</option>
                                                @elseif($filter["orderBy"]=="PrezzoDecrescente")
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=Nome">Ordina per: Nome</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=CasaEditrice">Ordina per: Casa Editrice</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoCrescente">Ordina per: Prezzo crescente</option>
                                                    <option selected value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoDecrescente">Ordina per: Prezzo decrescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=DataPubblicazione">Ordina per: Data di Pubblicazione</option>
                                                @elseif($filter["orderBy"]=="CasaEditrice")
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=Nome">Ordina per: Nome</option>
                                                    <option selected value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=CasaEditrice">Ordina per: Casa Editrice</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoCrescente">Ordina per: Prezzo crescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoDecrescente">Ordina per: Prezzo decrescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=DataPubblicazione">Ordina per: Data di Pubblicazione</option>
                                                @elseif($filter["orderBy"]=="DataPubblicazione")
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=Nome">Ordina per: Nome</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=CasaEditrice">Ordina per: Casa Editrice</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoCrescente">Ordina per: Prezzo crescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoDecrescente">Ordina per: Prezzo decrescente</option>
                                                    <option selected value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=DataPubblicazione">Ordina per: Data di Pubblicazione</option>
                                                @else
                                                    <option selected>Ordina per: --seleziona--</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=Nome">Ordina per: Nome</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=CasaEditrice">Ordina per: Casa Editrice</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoCrescente">Ordina per: Prezzo crescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=PrezzoDecrescente">Ordina per: Prezzo decrescente</option>
                                                    <option value="<?=ROOT?>products?category={!! $filter["category"] !!}&search={!! $filter["search"] !!}&casaEditrice={!! $filter["casaEditrice"] !!}&orderBy=DataPubblicazione">Ordina per: Data di Pubblicazione</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-p__collection">
                                <div class="row is-grid-active">
                                    @foreach($products as $product)
                                        @component('modules.card-prodotto', $product)@endcomponent
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section 1 ======-->
    </div>
    <!--====== End - App Content ======-->


    <!--====== Main Footer ======-->
    @component('modules.footer')@endcomponent
    <!--====== Modal Section ======-->


    <!--====== Quick Look Modal ======-->
    @component('modules.quick-look')@endcomponent
    <!--====== End - Quick Look Modal ======-->


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

                                    <img class="u-img-fluid" src="images/product/electronic/product1.jpg" alt=""></div>
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

                                    <a class="s-option__link btn--e-white-brand-shadow" href="cart.html">VIEW CART</a>

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
    <!--====== End - Modal Section ======-->
</div>
<!--====== End - Main App ======-->


@component("modules.scripts")@endcomponent


</body>
</html>