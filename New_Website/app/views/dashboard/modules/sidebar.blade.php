<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">

        <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>dashboardHome">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-case-editrici" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Case Editrici</span>
                <i class="menu-arrow"></i>
                <i class="fa fa-book menu-icon"></i>
            </a>
            <div class="collapse" id="ui-case-editrici">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=ROOT?>dashboardCaseEditrici">Visualizza tutto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=ROOT?>dashboardCasaEditriceAggiunta">Aggiungi</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-case-generi" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Generi</span>
                <i class="menu-arrow"></i>
                <i class="fa fa-tag menu-icon"></i>
            </a>
            <div class="collapse" id="ui-case-generi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=ROOT?>dashboardGeneri">Visualizza tutto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=ROOT?>dashboardGenereAggiunta">Aggiungi</a>
                    </li>
                </ul>
            </div>
        </li>




        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-case-prodotti" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Prodotti</span>
                <i class="menu-arrow"></i>
                <i class="fa fa-inbox menu-icon"></i>
            </a>
            <div class="collapse" id="ui-case-prodotti">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=ROOT?>dashboardProdotti">Visualizza tutto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=ROOT?>dashboardProdottoAggiunta">Aggiungi</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>dashboardUtenti"  aria-controls="ui-basic">
                <span class="menu-title">Utenti</span>
                <i class="fa fa-user-circle  menu-icon"></i>
            </a>
            <div class="collapse" id="ui-case-utenti">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" >Visualizza tutto</a>
                    </li>
                   
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>dashboardOrdini">
                <span class="menu-title">Ordini</span>
                <i class="fa fa-truck menu-icon"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>dashboardCarousel">
                <span class="menu-title">Gestione Carousel</span>
                <i class="fa fa-file-image-o menu-icon"></i>
            </a>
        </li>




    </ul>
</nav>