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

                <a type="button" class="btn btn-inverse-success btn-icon-text" style="margin-bottom: 3rem" href="<?=ROOT?>DashboardCarouselAggiunta">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Add
                </a>

                <!-- INIZIO TABELLA -->
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Carousel</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Testo bottone</th>
                                    <th>Presenza bottone</th>
                                    <th>Visibile</th>
                                    <th>Modifica</th>
                                    <th>Elimina</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td>{{$banner['NomeBanner']}}</td>
                                        <td>{{$banner['Testo_Bottone']}}</td>
                                        <td>{{$banner['Bottone'] ? 'Sì' : 'No'}}</td>
                                        <td>{{$banner['Visibile'] ? 'Sì' : 'No'}}</td>
                                        <td>
                                            <a href="<?=ROOT?>dashboardcarouselmodifica/{{$banner['IdBanner']}}" class="btn btn btn-inverse-info btn-fw" style="min-width: 0rem">
                                                <i class="fa fa-sharp-duotone fa-solid fa-pencil"></i>
                                            </a>

                                            </td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="{{$banner['IdBanner']}}" name="IdBanner"></input>
                                                <button style="min-width: 0rem" type="submit" name="delete" value="1" class="btn btn-inverse-danger btn-fw"> <i class="fa fa-trash-o"> </i></button>
                                                
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