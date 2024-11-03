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
                            <p class="card-description"> Aggiunta Carousel </p>
                            <form class="forms-sample" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="titolo">Nome Banner</label>
                                    <input type="text" class="form-control" name="nomeBanner" id="titolo"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="titolo">Titolo</label>
                                    <input type="text" class="form-control" name="riga1" id="titolo"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="quantita">Sottotitolo</label>
                                    <input type="text" class="form-control" name="riga2" id="quantita"  required>
                                </div>
                                <div class="form-group">
                                    <label for="testoBottone">Testo Bottone</label>
                                    <input type="text" class="form-control" name="testoBottone" id="testoBottone" required>
                                </div>

                                <div class="form-group">
                                    <label for="testoBottone">Link Bottone</label>
                                    <input type="text" class="form-control" name="link" id="testoBottone" required>
                                </div>

                                <div class="form-group">
                                    <label>Presenza Bottone</label>
                                    <select required class="js-example-basic-single" name="bottone" style="width:100%">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Visibile</label>
                                    <select class="js-example-basic-single" name="visibile" style="width:100%">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
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



                                <button type="submit" name="requested" value="yes" class="btn btn btn-inverse-info btn-fw">Aggiungi</button>
                                <a href="<?=ROOT?>dashboardCarousel" class="btn btn-inverse-danger btn-fw">
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