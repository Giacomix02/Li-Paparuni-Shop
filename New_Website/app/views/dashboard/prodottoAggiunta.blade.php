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
                            <p class="card-description"> Aggiunta Prodotto </p>
                            <form class="forms-sample" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="exampleInputName1">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="exampleInputName1" 
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Descrizione</label>
                                    <textarea class="form-control" name="descrizione" id="exampleTextarea1" rows="4"> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Quantità</label>
                                    <input type="number" class="form-control" name="quantita" id="exampleInputName1"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">ISBN</label>
                                    <input type="text" class="form-control" name="ISBN" id="exampleInputName1" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Prezzo</label>
                                    <input type="number" class="form-control" name="prezzoOriginale" id="exampleInputName1" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Prezzo Scontato</label>
                                    <input type="number" class="form-control" name="prezzoAttuale" id="exampleInputName1" required>
                                </div>

                                <div class="form-group">
                                    <label>Casa Editrice</label>
                                    <select required class="js-example-basic-single" name="CasaEditrice" style="width:100%">
                                        @foreach (getCaseEditrici() as $CasaEditriceLoop)
                                        <option value="{{$CasaEditriceLoop['Nome']}}"> {{$CasaEditriceLoop['Nome']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tipologia</label>
                                    <select class="js-example-basic-single" name="TipoProdotto" style="width:100%">
                                        <option value="Manga">Manga</option>
                                        <option value="Magazine">Magazine</option>
                                        <option value="Light Novel">Light Novel</option>
                                        <option selected value="Altro">Altro</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Genere</label>
                                    <select required class="js-example-basic-single" name="genere" style="width:100%">
                                        @foreach(getGeneri() as $genere)
                                            <option value="{{$genere['IdGenere']}}">{{$genere["Categoria"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputName1">Data Pubblicazione</label>
                                    <input type="date" class="form-control" name="dataPubblicazione" id="exampleInputName1" required>
                                </div>
                            

                                <div class="form-group">
                                    <label>Image upload</label>
                                    <input type="file" name="img" class="file-upload-default"> 
                                    <div class="input-group col-xs-12">
                                        <input type="text"  class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-inverse-primary py-3" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>




                                <button type="submit" name="requested" value="yes" class="btn btn btn-inverse-info btn-fw">Aggiungi</button>
                                <a href="<?=ROOT?>dashboardProdotti" class="btn btn-inverse-danger btn-fw">
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