<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item {!! CasaEditrice !!}">
                                            <div class="product-bs">
                                                <div class="product-bs__container">
                                                    <div class="product-bs__wrap">

                                                        <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                                            <img class="aspect__img" src="{!! FotoProdotto !!}" alt=""></a>
                                                        <div class="product-bs__action-wrap">
                                                            <ul class="product-bs__action-list">
                                                                <li>

                                                                    <a data-modal="modal" data-modal-id="#quick-look"><i class="fas fa-search-plus"></i></a></li>
                                                                <li>

                                                                    <a data-modal="modal" data-modal-id="#add-to-cart"><i class="fas fa-shopping-cart"></i></a></li>
                                                                <li>

                                                                    <a href="signin.html"><i class="fas fa-heart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <span class="product-bs__category">

                                                        <a href="shop-side-version-2.html">{!! CasaEditrice !!}</a></span>

                                                    <span class="product-bs__name">

                                                        <a href="product-detail.html">{!! Nome !!}</a></span>
                                                    <div class="product-bs__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                                    @if ($Prezzo!= 0)
                                                        <span class="product-bs__price">{!! PrezzoAttuale!!}

                                                        <span class="product-m__discount">{!! PrezzoOriginale !!}</span></span>
                                                    @else
                                                        <span class="product-bs__price">{!! PrezzoOriginale !!}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>