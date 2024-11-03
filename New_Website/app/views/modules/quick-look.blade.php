<div class="modal fade" id="quick-look">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal--shadow">

            <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">

                        <!--====== Product Detail ======-->
                        <div class="pd u-s-m-b-30">
                            <div class="pd-wrap">
                                <div id="js-product-detail-modal">
                                    <div>
                                        <img class="u-img-fluid" src="#" id="modal-img-src" alt="">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!--====== End - Product Detail ======-->
                    </div>
                    <div class="col-lg-7">

                        <!--====== Product Right Side Details ======-->
                        <div class="pd-detail">
                            <div>
                                <span class="pd-detail__name modal-nome"></span>
                            </div>
                            <div>
                                <div class="pd-detail__inline" id="sconto-vedi">
                                        <span class="pd-detail__price modal-prezzo"></span>
                                        <span class="pd-detail__discount modal-sconto"></span>
                                        <span class="pd-detail__discount"></span>
                                        <del class="pd-detail__del modal-prezzo-originale"></del>
                                </div>

                                <span class="pd-detail__price modal-prezzo-originale" id="non-sconto-vedi"></span>
                            </div>

                            <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                        <span class="pd-detail__stock modal-prodotti-disponibili-grandi" id="quantita-grandi"></span>
                                        <span class="pd-detail__left modal-prodotti-disponibili-piccole" id="quantita-piccole"></span>
                                        <span class="pd-detail__stock" id="quantita-grandissime">In stock</span>
                                        <span class="pd-detail__left" id="quantita-no">Out of Stock</span>

                                </div>
                            </div>
                            <div class="u-s-m-b-15">
                                <span class="pd-detail__preview-desc modal-descrizione"></span>
                            </div>

                            <div class="u-s-m-b-15">
                                <form class="pd-detail__form" id="add-to-cart" method="POST" action="">
                                    <div class="pd-detail-inline-2">
                                        <div class="u-s-m-b-15">
                                            <!--====== Input Counter ======-->
                                            <div class="input-counter" id="modal-add-to-cart-count">
                                                <span class="input-counter__minus fas fa-minus"></span>
                                                <input class="input-counter__text input-counter--text-primary-style" id="Modal-data-max" type="text" name="quantity" value="1" data-min="1" data-max="{!! $Quantita !!}">
                                                <span class="input-counter__plus fas fa-plus"></span>
                                            </div>
                                            <!--====== End - Input Counter ======-->
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <button class="btn btn--e-brand-b-2-animated" type="submit" id="modal-add-to-cart-button-si" name="action" value="add">Aggiungi al carrello</button>
                                            <input type="hidden" id="id-prodotto" name="id" />
                                            <span class="btn btn--e-brand-b-2-animated non-disponibile" id="modal-add-to-cart-button-no">Prodotto non disponibile</span>
                                            <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="u-s-m-b-15">
                                <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                                <ul class="pd-detail__policy-list">
                                    <li>
                                        <i class="fas fa-check-circle u-s-m-r-8"></i>
                                        <span>Buyer Protection.</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle u-s-m-r-8"></i>
                                        <span>Full Refund if you don't receive your order.</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle u-s-m-r-8"></i>
                                        <span>Returns accepted if product not as described.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        <!--====== End - Product Right Side Details ======-->
                    </div>
                </div>
            </div>
        </div>
    </div>

            <span class="modal-prezzo"></span>
            <span class="modal-prezzo-originale"></span>
            <span class="modal-casa-editrice"></span>
            <span class="modal-nome"></span>
            <span class="modal-descrizione"></span>
            <span class="modal-prodotti-disponibili"></span>
            <span class="modal-id"></span>

</div>
