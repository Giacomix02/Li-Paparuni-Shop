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
                                <p class="card-description"> Aggiunta Casa Editrice </p>
                                <form class="forms-sample" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nome Casa Editrice *</label>
                                        <input type="text" class="form-control" name="nome" id="exampleInputName1" placeholder="Name">
                                        <label style="color: red; margin-top: 0.5rem"> {{$nomeGiaPresente}} </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nome Sede</label>
                                        <input type="text" class="form-control" name="sede" id="exampleInputName1" placeholder="Name">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Telefono</label>
                                        <input type="text" class="form-control" name="telefono" id="exampleInputName1" placeholder="Name">
                                    </div>

                                    <button type="submit" class="btn btn btn-inverse-info btn-fw">Aggiungi</button>
                                    <a href="<?=ROOT?>/dashboardCaseEditrici" class="btn btn-inverse-danger btn-fw">
                                        Annulla
                                    </a>
                                </form>
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