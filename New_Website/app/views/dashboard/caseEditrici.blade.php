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

                <a type="button" class="btn btn-inverse-success btn-icon-text" style="margin-bottom: 3rem" href="<?=ROOT?>DashboardCasaEditriceAggiunta">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Add
                </a>
                <!-- INIZIO TABELLA -->
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Case Editrici</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Casa Editrice</th>
                                    <th>Sede</th>
                                    <th>Telefono</th>
                                    <th>Modifica</th>
                                    <th>Elimina</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($CaseEditrici as $CasaEditrice)
                                    <tr>
                                        
                                        <td>{{$CasaEditrice['Nome']}}</td>
                                        <td>{{$CasaEditrice['Sede']}}</td>
                                        <td>{{$CasaEditrice['NumeroTelefono']}}</td>
                                        <td>
                                            @set($NomeSanitized = sanitizeSpaces($CasaEditrice['Nome']))
                                            <a href="<?=ROOT?>dashboardCasaEditriceModifica/{{$NomeSanitized}}" type="submit" class="btn btn btn-inverse-info btn-fw">

                                                <i class="fa fa-sharp-duotone fa-solid fa-pencil"></i> </a>

                                        </td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="{{$CasaEditrice["Nome"]}}" name="CasaEditrice"></input>
                                                <button type="submit" name="delete" value="1" class="btn btn-inverse-danger btn-fw"> <i class="fa fa-trash-o"> </i></button>
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