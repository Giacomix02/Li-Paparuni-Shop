<div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
    <div class="dash__pad-1">

        @if(isset($username))
            <span class="dash__text u-s-m-b-16">Hello, {!! $username !!}</span>
        @else
            <span class="dash__text u-s-m-b-16">Hello, {!! $email !!}</span>
        @endif

        <ul class="dash__f-list">
            <li>

                <a class="dash-active" href="<?=ROOT?>account">Manage My Account</a></li>
            <li>

                <a href="<?=ROOT?>accountProfile">My Profile</a>
            </li>

            <li>

                <a href="<?=ROOT?>accountOrders">My Orders</a>
            </li>

        </ul>
    </div>
</div>
<div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w">
    <div class="dash__pad-1">
        <ul class="dash__w-list">
            <li>
                <div class="dash__w-wrap">

                    <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-cart-arrow-down account-icon-laterale"></i></span>

                    <span class="dash__w-text">{!! $NumeroOrdini !!}</span>

                    <span class="dash__w-name">Orders Placed</span></div>
            </li>

            <li>
                <div class="dash__w-wrap">

                    <span class="dash__w-icon dash__w-icon-style-3"><i class="far fa-heart account-icon-laterale"></i></span>

                    <span class="dash__w-text">{!! $NumeroProdotti !!}</span>

                    <span class="dash__w-name">Wishlist</span></div>
            </li>
        </ul>
    </div>
</div>