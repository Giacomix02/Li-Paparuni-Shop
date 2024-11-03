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
            <!-- se devi copiare copia da qui -->


                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Visualizza Ordine</h4>
                            <div class="form-sample">
                                <p class="card-description"></p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nome</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{!! $Nome !!}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Cognome</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{!! $Cognome !!}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Numero di telefono</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{!! $NumeroTelefono !!}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <p class="card-description"> Stato Ordine </p>

                                <form class="row" method="POST">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Modifica Stato ordine</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="statoOrdine">
                                                    <option disabled selected>{!! $StatoOrdine !!}</option>
                                                    <option @if($StatoOrdine =="In Attesa") hidden="" @endif >In Attesa</option>
                                                    <option @if($StatoOrdine =="In Preparazione") hidden="" @endif>In Preparazione</option>
                                                    <option @if($StatoOrdine =="In Consegna") hidden="" @endif>In Consegna</option>
                                                    <option @if($StatoOrdine =="Consegnato") hidden="" @endif>Consegnato</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn btn-inverse-info btn-fw" style="width: auto">Modifica</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Data Ordine</label>
                                            <div class="col-sm-9">
                                                <input readonly type="text" class="form-control" value="{!! $DataOrdine !!}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Totale</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-gradient-primary text-white">€</span>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="Amount" value="{!! $Totale !!}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <p class="card-description"> Indirizzo </p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Città</label>
                                            <div class="col-sm-9">
                                                <input readonly type="text" class="form-control" value="{!! $Citta !!}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">CAP</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{!! $CAP !!}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Provincia</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{!! $Provincia !!}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Via</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{!! $Via !!}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Numero civico</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{!! $NumeroCivico !!}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="<?=ROOT?>DashboardOrdini" class="btn btn-inverse-danger btn-fw">
                                    Pagina precedente
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- se devi copiare copia fino a qui -->

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@component('dashboard.modules.scripts')@endcomponent
</body>
</html>