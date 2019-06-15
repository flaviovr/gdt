<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="#">Gerenciar</a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            
            <li class="nav-item <?= $page['controller']=='Pages' ? 'active' : '';?>">
                <a class="nav-link" href="/adm">Início <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item <?= $page['controller']=='Banners' ? 'active' : '';?>">
                <a class="nav-link" href="/adm/banners">Banners</a>
            </li>

            <li class="nav-item <?= $page['controller']=='Discounts' ? 'active' : '';?>">
                <a class="nav-link" href="/adm/discounts">Descontos</a>
            </li>

            <li class="nav-item dropdown <?= ($page['controller']=='Tags' || $page['controller']=='Categories' || $page['controller']=='Locations' || $page['controller']=='Posts' || $page['controller']=='Menus' || $page['controller']=='Regions') ? 'active' : '';?>">
                <a class="nav-link dropdown-toggle" href="" data-toggle='dropdown'>Posts</a>
                <ul class='dropdown-menu'>
                    <li class="nav-item <?= $page['controller']=='Menus' ? 'active' : '';?>">
                        <a class="nav-link" href="/adm/menus">Menus</a>
                    </li>
                    <li class="nav-item <?= $page['controller']=='Regions' ? 'active' : '';?>">
                        <a class="nav-link" href="/adm/regions">Regiões</a>
                    </li>

                    <li class="nav-item <?= $page['controller']=='Locations' ? 'active' : '';?>">
                        <a class="nav-link" href="/adm/locations">Locais</a>
                    </li>

                    <li class="nav-item <?= $page['controller']=='Categories' ? 'active' : '';?>">
                        <a class="nav-link" href="/adm/categories">Categorias</a>
                    </li>

                    <li class="nav-item <?= $page['controller']=='Tags' ? 'active' : '';?>">
                        <a class="nav-link" href="/adm/tags">Tags</a>
                    </li>
                    <li class="nav-item <?= $page['controller']=='Posts' ? 'active' : '';?>">
                        <a class="nav-link" href="/adm/posts">Posts</a>
                    </li>
                </ul>
            </li>
           
            
           
            <li class="nav-item <?= $page['controller']=='Videos' ? 'active' : '';?>">
                <a class="nav-link" href="/adm/videos">Vídeos</a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
            <li class="nav-item">
                <a class="nav-link " href="/adm/logout" >Sair</a>
            </li>
        </ul>
        <?php if($page['action']=='xindex'){?>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name='busca' placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas  fa-search"></i></button>
        </form>
        <?php } ?>
    </div>
</nav>