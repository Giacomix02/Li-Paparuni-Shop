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

                <a type="button" class="btn btn-inverse-success btn-icon-text" style="margin-bottom: 3rem" href="<?=ROOT?>DashboardProdottoAggiunta">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Add
                </a>

                <!-- INIZIO TABELLA -->
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ordini</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Prezzo</th>
                                    <th>Prezzo Scontato</th>
                                    <th>Quantità</th>
                                    <th>ISBN</th>
                                    <th>Modifica</th>
                                    <th>Elimina</th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($Prodotti as $prodotto)
                                <tr>
                                    <td>{{$prodotto['Nome']}}</td>
                                    <td>{{$prodotto['PrezzoOriginale']}}</td>
                                    <td>{{$prodotto['PrezzoAttuale']}}</td>
                                    <td>{{$prodotto['Quantita']}}</td>
                                    <td>{{$prodotto['ISBN']}}</td>
                                    <td>
                                        <a href="<?=ROOT?>dashboardProdottoModifica/{{ $prodotto['IdProdotto'] }}" style="min-width: 0rem" class="btn btn btn-inverse-info btn-fw">

                                            <i   class="fa fa-sharp-duotone fa-solid fa-pencil"></i> 
                                        </a>

                                    </td>
                                    <td>
                                        <form method="POST">
                                                <input type="hidden" value="{{$prodotto["IdProdotto"]}}" name="idProdotto"></input>
                                                <button type="submit" style="min-width: 0rem" name="delete" value="1" class="btn btn-inverse-danger btn-fw"> <i class="fa fa-trash-o"> </i></button>
                                        </form>
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