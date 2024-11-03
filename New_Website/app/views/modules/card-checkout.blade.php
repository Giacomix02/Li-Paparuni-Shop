<div class="o-card">
    <div class="o-card__flex">
        <div class="o-card__img-wrap">

            <img class="u-img-fluid" src="<?=IMAGE?>{{$Immagine}}" alt=""></div>
        <div class="o-card__info-wrap">

            <span class="o-card__name">

                <a href="<?= ROOT?>'product-detail/'{{ $IdProdotto }}">{{$Nome}}</a></span>

            <span class="o-card__quantity">Quantity x {{$quantita}}</span>

            <span class="o-card__price">€{{$PrezzoAttuale}}</span></div>
    </div>
    <form method="POST" action="<?=ROOT?>cart">
        <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl"></input>
        <input type="hidden" value="{{$IdProdotto}}" name="id" />
        <button type="submit" class="unset-all-sium" name="action" value="remove"> 
            <a class="o-card__del far fa-trash-alt"></a>
        </button>
    </form>
</div>