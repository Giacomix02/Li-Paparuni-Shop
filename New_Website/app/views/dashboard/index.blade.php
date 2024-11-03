<!DOCTYPE html>
<html lang="en">
@component("dashboard.modules.head")@endcomponent
<body>
<div class="container-scroller">
    @component("dashboard.modules.navbar")@endcomponent
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @component("dashboard.modules.sidebar")@endcomponent
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?=ASSETS_DASHBOARD?>images/dashboard/circle.svg" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Totale Acquisti<i
                                            class="mdi mdi-chart-line mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5">€{!! $soldiTotali !!}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?=ASSETS_DASHBOARD?>images/dashboard/circle.svg" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Totale Ordini <i
                                            class="mdi mdi-truck mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5">{!! $totalOrders["NumeroOrdini"] !!}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?=ASSETS_DASHBOARD?>images/dashboard/circle.svg" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Utenti Registrati<i
                                            class="mdi mdi-pen mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5">{!! $numeroUtenti !!}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ordini Recenti</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> Numero Ordine</th>
                                            <th> Stato</th>
                                            <th> Email</th>
                                            <th> Data ordine</th>
                                            <th> Totale</th>
                                            <th> Visualizza</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recentOrders as $order)
                                            <tr>
                                                <td>{!! $order["IdOrdine"] !!}</td>


                                                @if($order["StatoOrdine"] == "In Attesa")
                                                    <td>
                                                        <label class="badge badge-danger">{!! $order["StatoOrdine"]  !!}</label>
                                                    </td>
                                                @elseif($order["StatoOrdine"] == "In Preparazione")
                                                    <td>
                                                        <label class="badge badge-warning">{!! $order["StatoOrdine"]  !!}</label>
                                                    </td>
                                                @elseif($order["StatoOrdine"] == "In Consegna")
                                                    <td>
                                                        <label class="badge badge-info">{!! $order["StatoOrdine"] !!}</label>
                                                    </td>
                                                @elseif($order["StatoOrdine"] == "Consegnato")
                                                    <td>
                                                        <label class="badge badge-success">{!! $order["StatoOrdine"] !!}</label>
                                                    </td>
                                                @endif


                                                <td>{!! $order["Email"] !!}</td>
                                                <td>{!! $order["DataOrdine"] !!}</td>
                                                <td>{!! $order["Totale"] !!}</td>
                                                <td>
                                                    <a class="btn btn btn-inverse-info btn-fw"
                                                       href="<?=ROOT?>DashboardOrdineVisualizza/{!! $order["IdOrdine"] !!}">
                                                        <i class="fa fa-sharp-duotone fa-solid fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@component("dashboard.modules.scripts")@endcomponent
</body>
</html>