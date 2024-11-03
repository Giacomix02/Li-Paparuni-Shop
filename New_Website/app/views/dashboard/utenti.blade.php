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

                <a type="button" class="btn btn-inverse-success btn-icon-text" style="margin-bottom: 3rem" href="<?=ROOT?>DashboardUtenteAggiunta">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Add
                </a>
                <!-- INIZIO TABELLA -->
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Utenti</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nome utente</th>
                                    <th>Mail</th>
                                    <th> Ordini </th>
                                    <th>Modifica</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($utenti as $utente)
                                    <tr>
                                        <td> {{$utente['NomeUtente']}} </td>
                                        <td>{{$utente['Email']}}</td>
                                        <td> 
                                            <form method="POST" action="<?=ROOT?>dashboardOrdini">
                                                <button type="submit" name="email" value="{{ $utente['Email'] }}" class="btn btn-inverse-success btn-fw"> 
                                                    <i class="fa fa-sharp-duotone fa-solid fa-truck"> </i>
                                                </button>
                                                <input hidden name="username" value="{{$utente['NomeUtente']}}"> </input>
                                            </form>
                                            
                                        </td>
                                        <td>
                                            <form method="POST" action="<?=ROOT?>dashboardUtenteModifica">
                                                <button type="submit" name="email" value="{{ $utente['Email'] }}" class="btn btn-inverse-info btn-fw"> 
                                                    <i class="fa fa-pencil"> </i>
                                                </button>
                                                <input hidden name="username" value="{{$utente['NomeUtente']}}"> </input>
                                                
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