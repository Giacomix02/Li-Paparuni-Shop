<div class="u-s-m-b-30">
    <div class="shop-w shop-w--style">
        <div class="shop-w__intro-wrap">
            <h1 class="shop-w__h">CASA EDITRICE</h1>

            <span class="fas fa-minus shop-w__toggle" data-target="#s-manufacturer"
                  data-toggle="collapse"></span>
        </div>
        <div class="shop-w__wrap collapse show" id="s-manufacturer">
            <ul class="shop-w__list-2">

                @foreach($caseEditrici as $casaEditrice)
                    @include('modules.products-filter-casaeditrice-listitem',array_merge($casaEditrice, $filter))
                @endforeach
            </ul>
        </div>
    </div>
</div>