<!DOCTYPE html>
<html lang="en">
@component('dashboard.modules.head')@endcomponent
<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @component('dashboard.modules.navbar')@endcomponent
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @component('dashboard.modules.sidebar')@endcomponent
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- INIZIO TABELLA -->
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ordini</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Numero ordine</th>
                                    <th>Stato</th>
                                    <th>Email</th>
                                    <th>Data ordine</th>
                                    <th>Totale</th>
                                    <th>Visualizza</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($ordini as $ordine)
                                    <tr>
                                        <td>{!! $ordine["IdOrdine"] !!}</td>

                                        @if($ordine["StatoOrdine"] == "In Attesa")
                                            <td><label class="badge badge-danger">{!! $ordine["StatoOrdine"]  !!}</label></td>
                                        @elseif($ordine["StatoOrdine"] == "In Preparazione")
                                            <td><label class="badge badge-warning">{!! $ordine["StatoOrdine"]  !!}</label></td>
                                        @elseif($ordine["StatoOrdine"] == "In Consegna")
                                            <td><label class="badge badge-info">{!! $ordine["StatoOrdine"] !!}</label></td>
                                        @elseif($ordine["StatoOrdine"] == "Consegnato")
                                            <td><label class="badge badge-success">{!! $ordine["StatoOrdine"]!!}</label></td>
                                        @endif


                                        <td>{!! $ordine["Email"] !!}</td>
                                        <td>{!! $ordine["DataOrdine"] !!}</td>
                                        <td>{!! $ordine["Totale"] !!}€</td>
                                        <td>
                                            <a class="btn btn btn-inverse-info btn-fw" href="<?=ROOT?>DashboardOrdineVisualizza/{!! $ordine["IdOrdine"] !!}">
                                                <i  class="fa fa-sharp-duotone fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- FINE TABELLA -->
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<span id="alert" hidden>{!! $alert !!}</span>
@component('dashboard.modules.scripts')@endcomponent
</body>
</html>