<div class="card-mini-product">
    <div class="mini-product">
        <div class="mini-product__image-wrapper">

            <a class="mini-product__link"
               href="<?= ROOT . 'product-detail/' ?>{{ $IdProdotto }}">

                <img class="u-img-fluid"
                     src="<?=IMAGE?>{{ $Immagine }}"
                     alt=""></a>
        </div>
        <div class="mini-product__info-wrapper">

            <span class="mini-product__category">
                

                <a href="<?= ROOT . "category/" ?>{{ $Categoria }}">{{$Categoria }}</a>

            </span>
            <span class="mini-product__name">

            <a href="<?= ROOT . 'productdetail/' ?>{{ $IdProdotto }}"> {{ $Nome }}</a>

            </span>

            <span class="mini-product__quantity">{{ $quantita }} x</span>

            <span class="mini-product__price">€ {{ $PrezzoAttuale }}</span>
        </div>
    </div>
    <form method="POST" action="<?=ROOT?>cart">
        <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
        <input type="hidden" value="{{$IdProdotto}}" name="id" />
        <button type="submit" name="action" value="remove" class="unset-all-sium"> 
            <a class="mini-product__delete-link far fa-trash-alt"></a>
        </button>
    </form>
</div>