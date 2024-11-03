<div class="u-s-m-b-30">
    <div class="shop-w shop-w--style">
        <div class="shop-w__intro-wrap">
            <h1 class="shop-w__h">GENERI</h1>

            <span class="fas fa-minus shop-w__toggle" data-target="#s-casaeditrice"
                  data-toggle="collapse"></span>
        </div>
        <div class="shop-w__wrap collapse show" id="s-casaeditrice">
            <ul class="shop-w__list-2">

                @foreach($categorie as $categoria)
                    @include('modules.products-filter-categoria-listitem',array_merge($categoria, $filter))
                @endforeach
            </ul>
        </div>
    </div>
</div>