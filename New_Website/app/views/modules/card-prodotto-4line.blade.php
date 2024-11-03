<div class="col-lg-4-custom col-md-6 col-sm-6">
    <div class="product-m">
        <div class="product-m__thumb form-padre">

            <a class="aspect aspect--bg-grey aspect--square u-d-block"
                   href="<?=ROOT?>productDetail/{!! $IdProdotto !!}">

                <img class="aspect__img" src="<?=IMAGE?>{!! $Immagine !!}" alt=""></a>
            <div class="product-m__quick-look">
                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                   data-placement="top" title="" data-original-title="Quick Look"
                   data-prezzo="{!! $PrezzoAttuale!!}" data-prezzo-originale="{!! $PrezzoOriginale !!}"
                   data-nome="{!! $Nome !!}" data-descrizione="{!! $Descrizione !!}"
                   data-casa-editrice="{!! $CasaEditrice !!}"
                   data-id="{!! $IdProdotto !!}" data-prodotti-disponibili="{!! $Quantita !!}" data-root="<?=ROOT?>" data-img-src="<?=IMAGE?>{!! $Immagine !!}">
                </a>
            </div>
            @if ($Quantita > 0)
            <form class="product-m__add-cart form-submit-cart" method="POST" action="<?=ROOT?>cart">


                    <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                    <input type="hidden" value=1 name="quantity" />
                    <input type="hidden" value="{{$IdProdotto}}" name="id" />

                    <button class="submit-button-cart button-add-to-cart " type="Submit" name="action" value="add" >
                        Aggiungi al carrello
                    </button>
            </form>
            @else
            <div class="product-m__add-cart form-submit-cart">
                <button class="submit-button-cart button-add-to-cart black-color">
                    Non disponibile
                </button>
            </div>
        @endif
    </div>
    <div class="product-m__content">
        <div class="product-m__category">

            <a>{!! $CasaEditrice !!}</a></div>
        <div class="product-m__name">

            <a href="<?= ROOT?>'product-detail/'{{ $IdProdotto }}">{!! $Nome !!}</a></div>

        @if($PrezzoAttuale!= 0)
            <div class="product-m__price">{!! $PrezzoAttuale !!}€
                <span class="product-m__discount">{!! $PrezzoOriginale !!}€</span>
            </div>
        @else
            <div class="product-m__price">{!! $PrezzoOriginale !!} €</div>
        @endif

        <div class="product-m__hover">
            <div class="product-m__preview-description">

                <span>{!! $Descrizione !!}</span>
            </div>
            <div class="product-m__wishlist">



                <form method="POST" action="<?=ROOT?>wishlist" class="all-unset">

                    <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                    <input hidden="" name="IdProdotto" value="{!! $IdProdotto !!}">

                    <button type="submit" class="unset-all-sium button-pointer">
                        <a class="far fa-heart" data-tooltip="tooltip" data-placement="top" title=""
                           data-original-title="Add to Wishlist">
                        </a>
                    </button>
                </form>


            </div>
        </div>
    </div>
</div>
</div>