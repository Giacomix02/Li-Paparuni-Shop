<tr>
    <td>
        <div class="table-p__box">
            <div class="table-p__img-wrap">

                <img class="u-img-fluid" src="<?=IMAGE?>{{ $Immagine }}" alt=""></div>
            <div class="table-p__info">

                <span class="table-p__name">

                    <a href="<?= ROOT?>product-detail/{{ $IdProdotto }}"> {{ $Nome }} </a></span>

                <span class="table-p__category">

                    <a href="<?= ROOT?>category/{{ $Categoria }}"> {{ $Categoria }} </a></span>
                <ul class="table-p__variant-list">
                    <li>

                        <span> {{ $NomeSerie }} </span></li>
                    <li>

                        <span> {{ $CasaEditrice }} </span></li>
                </ul>
            </div>
        </div>
    </td>
    <td>

        <span class="table-p__price"> €{{ $PrezzoAttuale }} </span></td>
    <td>
        <div class="table-p__input-counter-wrap">

            <!--====== Input Counter ======-->
            <div class="input-counter">

                <span class="input-counter__minus fas fa-minus"></span>

                <input class="input-counter__text input-counter--text-primary-style" name='quantity-in-cart-{{ $IdProdotto }}' type="text" value="{{ $quantita }}" data-min="1" data-max="{{$Quantita - $quantita}}">

                <span class="input-counter__plus fas fa-plus"></span></div>
            <!--====== End - Input Counter ======-->
        </div>
    </td>
    <td>
        <div class="table-p__del-wrap">

                <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl"> </input>
                <input type="hidden" value="{{$IdProdotto}}" name="id"> </input>
                <button name="action" value="remove" type="submit" class="unset-all-sium"> 
                    <a class="mini-product__delete-link far fa-trash-alt"></a>
                </button>
        </div>
    </td>
</tr>