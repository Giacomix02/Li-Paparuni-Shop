<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item {!! $CasaEditrice !!}">
    <div class="product-bs">
        <div class="product-bs__container">
            <div class="product-bs__wrap">
                <a class="aspect aspect--bg-grey aspect--square u-d-block" href="<?=ROOT?>productDetail/{!! $IdProdotto !!}">
                    <img class="aspect__img" src="<?=IMAGE?>{{ $Immagine }}" alt="">
                </a>
                <div class="product-bs__action-wrap">
                    <ul class="product-bs__action-list">
                        <li>
                            <a  data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                               data-placement="top" title="" data-original-title="Quick Look"
                               data-prezzo="{!! $PrezzoAttuale!!}" data-prezzo-originale="{!! $PrezzoOriginale !!}"
                               data-nome="{!! $Nome !!}" data-descrizione="{!! $Descrizione !!}"
                               data-casa-editrice="{!! $CasaEditrice !!}"
                               data-id="{!! $IdProdotto !!}" data-prodotti-disponibili="{!! $Quantita !!}" data-root="<?=ROOT?>" data-img-src="<?=IMAGE?>{!! $Immagine !!}">
                                <i class="fas fa-search-plus"></i></a>
                        </li>
                       
                        <li>
                            @if ($Quantita > 0)
                            <a>
                                <form  method="POST" action="<?=ROOT?>cart">
                                    <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                                    <input type="hidden" value=1 name="quantity" />
                                    <input type="hidden" value="{{$IdProdotto}}" name="id" />
                                    <button class="unset-all-sium" type="submit" name="action" value="add">
                                       <i class="fas fa-shopping-cart"></i>
                                    </button>

                                </form>
                                </a>
                            @else
                            <a>
                            <form   class="non-disponibile-cart">
                                <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                                
                                <button disabled class="non-disponibile-cart" >
                                   <i class="fas fa-shopping-cart "></i>
                                </button>
                                
                            </form>
                            </a>
                            @endif
                        </li>
                        
                        <li>
                            <a>
                                <form  method="POST" action="<?=ROOT?>wishlist">
                                    <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl" />
                                    <input type="hidden" value="{{$IdProdotto}}" name="IdProdotto" />
                                    <button class="unset-all-sium" type="submit"> 
                                       <i class="fas fa-heart"></i>
                                    </button>
                                    
                                </form>
                                </a> 
                        </li>
                    </ul>
                </div>
            </div>

            <span class="product-bs__category">
            @if ($Categoria==null)
                <a> ㅤ </a>
            @else
                <a >{!! $Categoria !!}</a>
            </span>
            @endif
            <span class="product-bs__name">
                <a >{!! $Nome !!}</a>
            </span>
            @if($PrezzoOriginale != 0)
                <span class="product-bs__price">€{!! $PrezzoAttuale!!}
                    <span class="product-m__discount">€{!! $PrezzoOriginale !!}</span>
                </span>
            @else
                <span class="product-bs__price">€{!! $PrezzoAttuale!!}</span>
            @endif
        </div>
    </div>
</div>