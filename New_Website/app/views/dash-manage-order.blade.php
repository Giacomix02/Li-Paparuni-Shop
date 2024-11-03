<!DOCTYPE html>
<html class="no-js" lang="en">
@component('modules.head')@endcomponent
<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="images/preloader.png" alt=""></div>
    </div>

    <!--====== Main App ======-->
    <div id="app">

        <!--====== Main Header ======-->
        @component('modules.navbar-all')@endcomponent
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
                                        <a href="<?=ROOT?>account">Home</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="<?=ROOT?>accountOrders">My Orders</a>
                                    </li>
                                    <li class="is-marked">
                                        <a href="">Order</a>
                                    </li>
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
                    <div class="dash">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    @component('modules.account-dashboard-features',array_merge($data["infos"],$data["orders"],$data["wishlist"]))@endcomponent
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <h1 class="dash__h1 u-s-m-b-30">Order Details</h1>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <div class="dash-l-r">
                                                <div>
                                                    <div class="manage-o__text-2 u-c-secondary">Ordine #{!! $data["IdOrdine"] !!}</div>
                                                    <div class="manage-o__text u-c-silver">Effettuato il {!! $data["orderDetails"]["DataOrdine"] !!}</div>
                                                </div>
                                                <div>
                                                    <div class="manage-o__text-2 u-c-silver">Totale:

                                                        <span class="manage-o__text-2 u-c-secondary">{!! $data["orderDetails"]["Totale"] !!}€</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <div class="manage-o">
                                                <div class="manage-o__header u-s-m-b-30">
                                                    <div class="manage-o__icon"><i class="fas fa-box u-s-m-r-5"></i>

                                                        <span class="manage-o__text">Ordine:</span></div>
                                                </div>
                                                <div class="dash-l-r">
                                                    <div class="manage-o__text u-c-secondary"></div>
                                                    <div class="manage-o__icon"><i class="fas fa-truck u-s-m-r-5"></i>

                                                        <span class="manage-o__text">Standard</span></div>
                                                </div>
                                                <div class="manage-o__timeline">
                                                    @set($count = -1)
                                                    @switch($data["orderDetails"]["StatoOrdine"])
                                                        @case('In Attesa')
                                                            @set($count = -1)
                                                            @break
                                                        @case('In Preparazione')
                                                            @set($count = 1)
                                                            @break
                                                        @case('In Consegna')
                                                            @set($count = 2)
                                                            @break
                                                        @case('Consegnato')
                                                            @set($count = 3)
                                                            @break
                                                        @default
                                                            @set($error = 'stato dell\'ordine sconosciuto')
                                                    @endswitch

                                                    <div class="timeline-row">
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                                @if($count > 0)
                                                                <div class="timeline-l-i  timeline-l-i--finish">
                                                                @else
                                                                <div class="timeline-l-i">
                                                                @endif                                                                    
                                                                <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">In Preparazione</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                                @if($count > 1)
                                                                <div class="timeline-l-i  timeline-l-i--finish">
                                                                @else
                                                                <div class="timeline-l-i">
                                                                @endif 

                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">In Consegna</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                                @if($count > 2)
                                                                <div class="timeline-l-i  timeline-l-i--finish">
                                                                @else
                                                                <div class="timeline-l-i">
                                                                @endif 

                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">Consegnato</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{$error}}
                                                </div>
                                                @foreach($data["products"] as $product)
                                                    @component("modules.account-orderDetail-product",$product)@endcomponent
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8" style="margin-bottom: 1rem">Indirizzo di consegna:</h2>
                                                    <h2 class="dash__h2 u-s-m-b-8">{!! $data["orderDetails"]["Nome"] !!} {!! $data["orderDetails"]["Cognome"] !!}</h2>

                                                    <span class="dash__text-2">{!! $data["orderDetails"]["CAP"] !!} {!! $data["orderDetails"]["Citta"] !!} {!! $data["orderDetails"]["Via"] !!} {!! $data["orderDetails"]["NumeroCivico"] !!} - {!! $data["orderDetails"]["Provincia"] !!}</span>

                                                    <span class="dash__text-2">{!! $data["orderDetails"]["NumeroTelefono"] !!}</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Riepilogo ordine:</h2>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Subtotale</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{!! $data["orderDetails"]["Totale"] !!}€</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Costi di spedizione</div>
                                                        <div class="manage-o__text-2 u-c-secondary">0€</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Totale</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{!! $data["orderDetails"]["Totale"] !!}€</div>
                                                    </div>

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
            <!--====== End - Section 2 ======-->
        </div>
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
        @component('modules.footer')@endcomponent
    </div>
    <!--====== End - Main App ======-->


    @component('modules.scripts')@endcomponent
</body>
</html>