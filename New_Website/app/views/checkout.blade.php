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

                                        <a href="<?=ROOT?>checkout">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="checkout-msg-group">
                                    @if(!$isLoggedIn)
                                        <div class="msg u-s-m-b-30">

                                            <span class="msg__text">Returning customer?

                                                <a class="gl-link" href="#return-customer" data-toggle="collapse">Click here to login</a></span>
                                            <div class="collapse" id="return-customer" data-parent="#checkout-msg-group">
                                                <div class="l-f u-s-m-b-16">

                                                    <span class="gl-text u-s-m-b-16">If you have an account with us, please log in.</span>
                                                    <form class="l-f__form" method="POST" action="<?=ROOT?>signin">
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-15">

                                                                <label class="gl-label"  for="email" >E-MAIL *</label>

                                                                <input class="input-text input-text--primary-style" type="email" id="email" name="email" placeholder="nome@dominio"></div>
                                                            <div class="u-s-m-b-15">

                                                                <label class="gl-label" for="login-password">PASSWORD *</label>

                                                                <input class="input-text input-text--primary-style" type="password" id="password" name="password" placeholder="*?^&!@#$%"></div>
                                                        </div>
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-15">
                                                                <input type="hidden" value="{{$this->getCurrentUrl()}}" name="originUrl"></input>
                                                                <button class="btn btn--e-transparent-brand-b-2" type="submit">LOGIN</button></div>
                                                            <div class="u-s-m-b-15">

                                                                <a class="gl-link" href="<?=ROOT?>lost-password">Lost Your Password?</a></div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="msg">

                                        <span class="msg__text">Have a coupon?

                                            <a class="gl-link" href="#have-coupon" data-toggle="collapse">Click Here to enter your code</a></span>
                                        <div class="collapse" id="have-coupon" data-parent="#checkout-msg-group">
                                            <div class="c-f u-s-m-b-16">

                                                <span class="gl-text u-s-m-b-16">Enter your coupon code if you have one.</span>
                                                <form class="c-f__form">
                                                    <div class="u-s-m-b-16">
                                                        <div class="u-s-m-b-15">

                                                            <label for="coupon"></label>

                                                            <input class="input-text input-text--primary-style" type="text" id="coupon" placeholder="Coupon Code"></div>
                                                        <div class="u-s-m-b-15">

                                                            <button class="btn btn--e-transparent-brand-b-2" type="submit">APPLY</button></div>
                                                    </div>
                                                </form>
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
            
            <!--====== End - Section 2 ======-->


            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="checkout-f">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label style="color: crimson"> {{$error}} </label>
                                    <h1 class="checkout-f__h1">DELIVERY INFORMATION</h1>
                                    <form class="checkout-f__delivery" method="POST" action="<?=ROOT?>checkout">
                                        <div class="u-s-m-b-30">
                                            <div class="u-s-m-b-15">
                                                @if(false)
                                                <!--====== Check Box ======-->
                                                <div hidden class="check-box">

                                                    <input name="checkbox-default-shipping" type="checkbox" id="get-address">
                                                    <div class="check-box__state check-box__state--primary">

                                                        <label class="check-box__label" for="get-address">Use default shipping and billing address from account</label></div>
                                                </div>
                                                <!--====== End - Check Box ======-->
                                                @endif
                                            </div>

                                            <!--====== First Name, Last Name ======-->
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-15">

                                                    <label class="gl-label" for="Nome">FIRST NAME *</label>

                                                    <input class="input-text input-text--primary-style" type="text" name="Nome" id="Nome" data-bill=""></div>
                                                <div class="u-s-m-b-15">

                                                    <label class="gl-label" for="Cognome">LAST NAME *</label>

                                                    <input class="input-text input-text--primary-style" type="text" name="Cognome" id="Cognome" data-bill=""></div>
                                            </div>
                                            <!--====== End - First Name, Last Name ======-->


                                            <!--====== E-MAIL ======-->
                                            <div class="u-s-m-b-15">

                                                <input hidden class="input-text input-text--primary-style" type="text" name="mail" id="mail" value="{{$email}}" data-bill=""></div>
                                            <!--====== End - E-MAIL ======-->


                                            <!--====== PHONE ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="Telefono">PHONE</label>

                                                <input class="input-text input-text--primary-style" type="text" name="Telefono" id="Telefono" data-bill=""></div>
                                            <!--====== End - PHONE ======-->


                                            <!--====== Street Address ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="street-address">STREET ADDRESS *</label>

                                                <input class="input-text input-text--primary-style" type="text" name="Via" id="Via" placeholder="House name and street name" data-bill=""></div>
                                            <div class="u-s-m-b-15">

                                                <label for="NumeroCivico"></label>

                                                <input class="input-text input-text--primary-style" type="text" name="NumeroCivico" id="NumeroCivico" placeholder="Apartment, suite unit etc. (optional)" data-bill=""></div>
                                            <!--====== End - Street Address ======-->


                                            


                                            <!--====== Town / City ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="Citta">TOWN/CITY *</label>

                                                <input class="input-text input-text--primary-style" type="text" name="Citta" id="Citta" data-bill=""></div>
                                            <!--====== End - Town / City ======-->


                                            <!--====== STATE/PROVINCE ======-->
                                            <div class="u-s-m-b-15">

                                                <!--====== Select Box ======-->

                                                <label class="gl-label" for="Provincia">STATE/PROVINCE *</label>
                                                <input class="select-box select-box--primary-style" name="Provincia" id="Provincia" data-bill="">
                                                </input>
                                                <!--====== End - Select Box ======-->
                                            </div>
                                            <!--====== End - STATE/PROVINCE ======-->


                                            <!--====== ZIP/POSTAL ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="CAP">ZIP/POSTAL CODE *</label>

                                                <input class="input-text input-text--primary-style" type="text" name="CAP" id="CAP" placeholder="Zip/Postal Code" data-bill=""></div>
                                            <!--====== End - ZIP/POSTAL ======-->
                                            <div class="u-s-m-b-10">
                                                @if(false)
                                                <!--====== Check Box ======-->
                                                <div class="check-box">

                                                    <input type="checkbox" name="checkbox-default-address" id="checkbox-default-address" data-bill="">
                                                    <div class="check-box__state check-box__state--primary">

                                                        <label class="check-box__label" for="checkbox-default-address">Make default shipping and billing address</label></div>
                                                </div>
                                                <!--====== End - Check Box ======-->
                                                @endif
                                            </div>
                                            <div class="u-s-m-b-10">

                                                <a class="gl-link"  data-toggle="collapse"></a></div>
                                            
                                            <div>

                                                @if($isLoggedIn)
                                                        <button class="btn btn--e-brand-b-2" name="order-is-submitted" value="1" type="submit">PLACE ORDER</button></div>
                                                @else
                                                        <button class="btn btn--e-brand-b-2 non-disponibile" disabled style="background-color:rgb(68, 68, 68)" >LOG IN TO PLACE ORDER</button></div>
                                                @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <h1 class="checkout-f__h1">ORDER SUMMARY</h1>

                                    <!--====== Order Summary ======-->
                                    <div class="o-summary">
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__item-wrap gl-scroll">
                                                @foreach($cartProducts as $product)
                                                    @component("modules.card-checkout", $product)@endcomponent  
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        @set( $subtotal = 0)
                                        @foreach($cartProducts as $product)
                                            @set($subtotal = $subtotal + $product['PrezzoAttuale'] * $product['quantita'])
                                        @endforeach
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <table class="o-summary__table">
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
                                                            <td>€{{ $subtotal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>GRAND TOTAL</td>
                                                            <td>€{{$shipping + $taxes + $subtotal}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--====== End - Order Summary ======-->
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

        <!--====== Modal Section ======-->


        <!--====== Shipping Address Add Modal ======-->
        <div class="modal fade" id="edit-ship-address">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="checkout-modal2">
                            <div class="u-s-m-b-30">
                                <div class="dash-l-r">
                                    <h1 class="gl-modal-h1">Shipping Address</h1>
                                    <div class="dash__link dash__link--brand">

                                        <a data-modal="modal" data-modal-id="#add-ship-address" data-dismiss="modal">Add new Address</a></div>
                                </div>
                            </div>
                            <form class="checkout-modal2__form">
                                <div class="dash__table-2-wrap u-s-m-b-30 gl-scroll">
                                    <table class="dash__table-2">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Full Name</th>
                                                <th>Address</th>
                                                <th>Region</th>
                                                <th>Phone Number</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>

                                                    <!--====== Radio Box ======-->
                                                    <div class="radio-box">

                                                        <input type="radio" id="address-1" name="default-address" checked="">
                                                        <div class="radio-box__state radio-box__state--primary">

                                                            <label class="radio-box__label" for="address-1"></label></div>
                                                    </div>
                                                    <!--====== End - Radio Box ======-->
                                                </td>
                                                <td>John Doe</td>
                                                <td>4247 Ashford Drive Virginia VA-20006 USA</td>
                                                <td>Virginia VA-20006 USA</td>
                                                <td>(+0) 900901904</td>
                                                <td>
                                                    <div class="gl-text">Default Shipping Address</div>
                                                    <div class="gl-text">Default Billing Address</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    <!--====== Radio Box ======-->
                                                    <div class="radio-box">

                                                        <input type="radio" id="address-2" name="default-address">
                                                        <div class="radio-box__state radio-box__state--primary">

                                                            <label class="radio-box__label" for="address-2"></label></div>
                                                    </div>
                                                    <!--====== End - Radio Box ======-->
                                                </td>
                                                <td>Doe John</td>
                                                <td>1484 Abner Road</td>
                                                <td>Eau Claire WI - Wisconsin</td>
                                                <td>(+0) 7154419563</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="gl-modal-btn-group">

                                    <button class="btn btn--e-brand-b-2" type="submit">SAVE</button>

                                    <button class="btn btn--e-grey-b-2" type="button" data-dismiss="modal">CANCEL</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Shipping Address Add Modal ======-->


        <!--====== Shipping Address Add Modal ======-->
        <div class="modal fade" id="add-ship-address">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="checkout-modal1">
                            <form class="checkout-modal1__form">
                                <div class="u-s-m-b-30">
                                    <h1 class="gl-modal-h1">Add new Shipping Address</h1>
                                </div>
                                <div class="gl-inline">
                                    <div class="u-s-m-b-30">

                                        <label class="gl-label" for="address-fname">FIRST NAME *</label>

                                        <input class="input-text input-text--primary-style" type="text" id="address-fname" placeholder="First Name"></div>
                                    <div class="u-s-m-b-30">

                                        <label class="gl-label" for="address-lname">LAST NAME *</label>

                                        <input class="input-text input-text--primary-style" type="text" id="address-lname" placeholder="Last Name"></div>
                                </div>
                                <div class="gl-inline">
                                    <div class="u-s-m-b-30">

                                        <label class="gl-label" for="address-phone">PHONE *</label>

                                        <input class="input-text input-text--primary-style" type="text" id="address-phone"></div>
                                    <div class="u-s-m-b-30">

                                        <label class="gl-label" for="address-street">STREET ADDRESS *</label>

                                        <input class="input-text input-text--primary-style" type="text" id="address-street" placeholder="House Name and Street"></div>
                                </div>
                                <div class="gl-inline">
                                    <div class="u-s-m-b-30">

                                        <!--====== Select Box ======-->

                                        <label class="gl-label" for="address-country">COUNTRY *</label><select class="select-box select-box--primary-style" id="address-country">
                                            <option selected value="">Choose Country</option>
                                            <option value="uae">United Arab Emirate (UAE)</option>
                                            <option value="uk">United Kingdom (UK)</option>
                                            <option value="us">United States (US)</option>
                                        </select>
                                        <!--====== End - Select Box ======-->
                                    </div>
                                    <div class="u-s-m-b-30">

                                        <!--====== Select Box ======-->

                                        <label class="gl-label" for="address-state">STATE/PROVINCE *</label><select class="select-box select-box--primary-style" id="address-state">
                                            <option selected value="">Choose State/Province</option>
                                            <option value="al">Alabama</option>
                                            <option value="al">Alaska</option>
                                            <option value="ny">New York</option>
                                        </select>
                                        <!--====== End - Select Box ======-->
                                    </div>
                                </div>
                                <div class="gl-inline">
                                    <div class="u-s-m-b-30">

                                        <label class="gl-label" for="address-city">TOWN/CITY *</label>

                                        <input class="input-text input-text--primary-style" type="text" id="address-city"></div>
                                    <div class="u-s-m-b-30">

                                        <label class="gl-label" for="address-street">ZIP/POSTAL CODE *</label>

                                        <input class="input-text input-text--primary-style" type="text" id="address-postal" placeholder="Zip/Postal Code"></div>
                                </div>
                                <div class="gl-modal-btn-group">

                                    <button class="btn btn--e-brand-b-2" type="submit">SAVE</button>

                                    <button class="btn btn--e-grey-b-2" type="button" data-dismiss="modal">CANCEL</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Shipping Address Add Modal ======-->
        <!--====== End - Modal Section ======-->
    </div>
    <!--====== End - Main App ======-->


    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->

    @component("modules.scripts")@endcomponent

</body>
</html>