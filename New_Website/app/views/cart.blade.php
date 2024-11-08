<!DOCTYPE html>
<html class="no-js" lang="en">

@component("modules.head")@endcomponent

<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="images/preloader.png" alt=""></div>
    </div>

    <!--====== Main App ======-->
    <div id="app">

        <!--====== Main Header ======-->
        @component("modules.navbar-all")@endcomponent
        <!--====== End - Main Header ======-->


        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="<?=ROOT?>">Home</a></li>
                                    <li class="is-marked">

                                        <a href="<?=ROOT?>cart">Cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">SHOPPING CART</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <form class="row" method="POST">
                                <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                    <div class="table-responsive">
                                        <table class="table-p">
                                            <tbody>
                                            
                                                @foreach($cartProducts as $product)
                                                    <!--====== Row ======-->
                                                    @component("modules.card-cart", $product)@endcomponent
                                                    <!--====== End - Row ======-->
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                                <div class="col-lg-12">
                                    <div class="route-box">
                                        <div class="route-box__g1">

                                            <a class="route-box__link" href="<?=ROOT?>products"><i class="fas fa-long-arrow-alt-left"></i>

                                                <span>CONTINUE SHOPPING</span></a></div>
                                        <div class="route-box__g2">
                                            

                                                @foreach($cartProducts as $product)
                                                @set($productIds[] = $product['IdProdotto'])
                                                @endforeach

                                                    <input type="hidden" name="productIds" value="{{ serialize($productIds) }}"></input>
                                                    <button name="action" value="update" class="unset-all-sium" type="submit">
                                                        <a class="route-box__link"><i class="fas fa-sync"></i> 
                                                                <span>UPDATE CART</span>
                                                        </a>
                                                    </button>
                                            
                                        </div>
                                                    <button name="action" value="clear" class="unset-all-sium" type="submit">
                                                        <a class="route-box__link"><i class="fas fa-trash"></i> 
                                                                <span>CLEAR CART</span>
                                                        </a>
                                                    </button>
                                                

                            
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->


            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="f-cart">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                            <div class="f-cart__pad-box">
                                                <h1 class="gl-h1">ESTIMATE SHIPPING AND TAXES</h1>

                                                <span class="gl-text u-s-m-b-30">Enter your destination to get a shipping estimate.</span>
                                                <div class="u-s-m-b-30">

                                                    <!--====== Select Box ======-->

                                                    <label class="gl-label" for="shipping-country">COUNTRY *</label><select class="select-box select-box--primary-style" id="shipping-country">
                                                        <option selected value="">Choose Country</option>
                                                        <option value="uae">United Arab Emirate (UAE)</option>
                                                        <option value="uk">United Kingdom (UK)</option>
                                                        <option value="us">United States (US)</option>
                                                    </select>
                                                    <!--====== End - Select Box ======-->
                                                </div>
                                                <div class="u-s-m-b-30">

                                                    <!--====== Select Box ======-->

                                                    <label class="gl-label" for="shipping-state">STATE/PROVINCE *</label><select class="select-box select-box--primary-style" id="shipping-state">
                                                        <option selected value="">Choose State/Province</option>
                                                        <option value="al">Alabama</option>
                                                        <option value="al">Alaska</option>
                                                        <option value="ny">New York</option>
                                                    </select>
                                                    <!--====== End - Select Box ======-->
                                                </div>
                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="shipping-zip">ZIP/POSTAL CODE *</label>

                                                    <input class="input-text input-text--primary-style" type="text" id="shipping-zip" placeholder="Zip/Postal Code"></div>
                                                <div class="u-s-m-b-30">

                                                    <a class="f-cart__ship-link btn--e-transparent-brand-b-2" href="cart.html">CALCULATE SHIPPING</a></div>

                                                <span class="gl-text">Note: There are some countries where free shipping is available otherwise our flat rate charges or country delivery charges will be apply.</span>
                                            </div>
                                        </div>
                                        @set( $subTotal = 0)
                                        @foreach($cartProducts as $product)
                                            @set($subTotal = $subTotal + $product['PrezzoAttuale'] * $product['quantita'])
                                        @endforeach
                                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                            <div class="f-cart__pad-box">
                                                <div class="u-s-m-b-30">
                                                    <table class="f-cart__table">
                                                        <tbody>
                                                            <tr>
                                                                <td>SHIPPING</td>
                                                                <td>€{{$shipping}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>TAX</td>
                                                                <td>€{{$taxes}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>SUBTOTAL</td>
                                                                <td>€{{ $subTotal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>GRAND TOTAL</td>
                                                                <td>€{{$shipping + $taxes + $subTotal}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>

                                                    <a class="btn btn--e-brand-b-2" style="text-align:center" href="<?=ROOT?>checkout" type="submit"> PROCEED TO CHECKOUT</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 3 ======-->
        </div>
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
        @component("modules.footer")@endcomponent
    </div>
    <!--====== End - Main App ======-->


    @component("modules.scripts")@endcomponent


</body>
</html>