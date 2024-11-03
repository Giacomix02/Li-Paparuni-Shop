<li class="has-dropdown">
    @set($cartProducts=getCart())
    @set($cartProducts = is_array($cartProducts) ? $cartProducts : [])
    @set($count = count($cartProducts))
    <a class="mini-cart-shop-link" href="<?=ROOT?>cart"><i class="fas fa-shopping-cart"></i>
        @if($count > 0)
            <span class="total-item-round">{{$count}}</span></a>
       @endif
    <!--====== Dropdown ======-->

    <span class="js-menu-toggle"></span>
    <div class="mini-cart">

        <!--====== Mini Product Container ======-->
        <div class="mini-product-container gl-scroll u-s-m-b-15">
            <!--====== Card for mini cart ======-->
            @set( $subTotal = 0)
            @foreach($cartProducts as $product)
                @set($subTotal = $subTotal + $product['PrezzoAttuale'] * $product['quantita'])
                @component("modules.card-mini-product", $product)@endcomponent
            @endforeach

            <!--====== End - Card for mini cart ======-->
        </div>
        <!--====== End - Mini Product Container ======-->


        <!--====== Mini Product Statistics ======-->
        <div class="mini-product-stat">
            @if($count > 0)
                <div class="mini-total">
        
                    <span class="subtotal-text">SUBTOTAL</span>

                    <span class="subtotal-value">€ {{ $subTotal }} </span>

                </div>
                <div class="mini-action">

                    <a class="mini-link btn--e-brand-b-2"
                       href="<?=ROOT?>checkout">FAI IL CHECKOUT</a>

                    <a class="mini-link btn--e-transparent-secondary-b-2"
                       href="<?=ROOT?>cart">VAI AL CARRELLO</a>
                </div>
            @else
                <div class="carrello-vuoto">
                    <label class="carrello-vuoto-text"> IL TUO CARRELLO È VUOTO </label>
                </div>
                <div class="mini-total">
                    <div class="carrello-vuoto">

                    </div>
                    <span class="subtotal-text"></span>

                    <span class="subtotal-value"></span>

                </div>
                <div class="mini-action">

                    <a style='display:none' class="mini-link btn--e-brand-b-2"></a>

                    <a class="mini-link btn--e-transparent-secondary-b-2"
                       href="<?=ROOT?>cart">VAI AL CARRELLO</a>
                </div>

            @endif
        </div>


        <!--====== End - Mini Product Statistics ======-->
    </div>
    <!--====== End - Dropdown ======-->
</li>