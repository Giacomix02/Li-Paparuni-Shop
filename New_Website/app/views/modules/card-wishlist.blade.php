<div class="w-r u-s-m-b-30">
    <div class="w-r__container">
        <div class="w-r__wrap-1">
            <div class="w-r__img-wrap">
                <img class="u-img-fluid" src="<?=IMAGE?>{!! $Immagine !!}" alt="">
            </div>
            <div class="w-r__info">
                <span class="w-r__name">
                    <a href="<?=ROOT?>products/{!! $IdProdotto !!}">{!! $Nome !!}</a>
                </span>
                <span class="w-r__category">
                    <a href="">{!! $CasaEditrice !!}</a>
                </span>
                @if($PrezzoAttuale!= 0)
                <span class="w-r__price">{!! $PrezzoAttuale !!} €
                    <span class="w-r__discount">{!! $PrezzoOriginale!!} € </span>
                </span>
                @else
                <span class="product-m__price">{!! $PrezzoOriginale !!} €</span>
                @endif
            </div>
        </div>
        <div class="w-r__wrap-2">
            <form class="unset-all-sium" method="POST" action="<?=ROOT?>cart">
                <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                <input type="hidden" value="{{$IdProdotto}}" name="id" />
                <button class="unset-all-sium" type="submit" name="action" value="add"> 
                    <a class="w-r__link btn--e-brand-b-2">ADD TO CART</a>
                </button>
            </form>

            <a class="w-r__link btn--e-transparent-platinum-b-2" href="<?=ROOT?>ProductDetail/{!! $IdProdotto !!}">VIEW</a>
            <a class="w-r__link btn--e-transparent-platinum-b-2" href="<?=ROOT?>wishlist/{!! $IdProdotto !!}">REMOVE</a>
        </div>
    </div>
</div>


