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

            <!-- se devi copiare copia da qui -->

            <div class="content-wrapper">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-description"> Modifica Utente </p>
                            <form class="forms-sample" method="POST">
                                <div class="form-group">
                                    <label for="exampleInputName1">Nuovo Username</label>
                                    <div class="input-group">
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
            
                                        <input type="text" name="newUsername" value="{{$username}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"> </input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Nuova Password</label>
                                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Nuova Password">
                                    <a href="<?=ROOT?>ehVolevi" class="btn btn-inverse-danger btn-fw">
                                        <i class="fa fa-exchange"></i> Cambia Password 
                                    </a>
                                </div>

                                <button type="submit" name="email" value="{{$email}}" class="btn btn btn-inverse-info btn-fw">Modifica</button>
                                    <a href="<?=ROOT?>dashboardUtenti" class="btn btn-inverse-danger btn-fw">
                                        Annulla
                                    </a>
                            </form>
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