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
                                <p class="card-description"> Modifica Genere </p>
                                <form class="forms-sample" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nome Genere</label>
                                        <input type="text" class="form-control" id="nuovoGenere" name="nuovoGenere" value="{!! $genere["NomeGenere"] !!}" placeholder="{!! $genere["NomeGenere"] !!}">
                                    </div>

                                    <div class="form-group">
                                        <label>Carica Immagine</label>
                                        <input type="file" name="img" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text"  class="form-control file-upload-info" disabled placeholder="Upload Image">
                                            <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-inverse-primary py-3" type="button">Upload</button>
                                        </span>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn btn-inverse-info btn-fw">Modifica</button>
                                    <a href="<?=ROOT?>dashboardgeneri/" class="btn btn-inverse-danger btn-fw">
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