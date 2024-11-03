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

                <div class="content-wrapper">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-description"> Modifica Casa Editrice </p>
                                <form class="forms-sample" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Sede</label>
                                        <input type="text" class="form-control" name="nuovaSede" value="{{$Sede}}" id="exampleInputName1" placeholder="Nome">

                                        <label for="exampleInputName1">Telefono</label>
                                        <input type="text" class="form-control" name="nuovoTelefono" value="{{$NumeroTelefono}}" id="exampleInputName1" placeholder="Nome">
                                    </div>

                                    <button type="submit" class="btn btn btn-inverse-info btn-fw">Modifica</button>
                                    <a href="<?=ROOT?>dashboardCaseEditrici/" class="btn btn-inverse-danger btn-fw">
                                        Annulla
                                    </a>
                                </form>
                                {{$error}}
                            </div>
                        </div>
                    </div>

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