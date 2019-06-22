<?php

?>
<nav class="navbar navbar-expand-lg navbar-light"  style='background-color:#fff;' id='main-navbar'>
    
    <a class="navbar-brand" href="/home">

        <img src="/img/site/logo.png" class='' height="50px">
        
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto" >

            <li class="nav-item <?=$page['pagina']=='home' ? 'active': '';?> "> 
                <a class="nav-link " href="/home"><i class="fas fa-home"></i></a> 
            </li>
            <?php
                foreach ($menus as $menu) {
                    $active = $page['menu']== $menu['slug'] ? 'active': '';
                    $dropdown= !empty($menu['regions']) ? 'dropdown'  : false ;
                    $dropdownClass= $dropdown ? 'dropdown-toggle'  : false ;
                    
                    echo "<li class='nav-item $active $dropdown' >";
                    echo "<a class='nav-link $dropdownClass ' role='button'  aria-haspopup='true' aria-expanded='false' data-toggle='$dropdown' href='/$menu[slug]'>$menu[nome]</a>";
                    
                    if($dropdown){
                        
                        echo "<ul class='dropdown-menu'  >
                            <li><a class='dropdown-item' href='/$menu[slug]'>Todos</a></li>";

                        foreach($menu['regions'] as $regiao) {
                           
                            $active = $page['regiao']==$regiao['slug'] ? 'active':'';
                            
                            $dropdown= !empty($regiao['locations']) ? 'dropdown'  : false ;
                            $dropdownClass= $dropdown ? 'dropdown-toggle'  : false ;
                            echo "<li class='nav-item $active $dropdown'>";
                            echo "<a class='dropdown-item $dropdownClass'  role='button' id='navbarDropdown2'  aria-haspopup='true' aria-expanded='false' data-toggle='$dropdown'  href='/$menu[slug]/$regiao[slug]'>$regiao[nome]</a>";
                            
                            if($dropdown) {
                                echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>
                                <li><a class='dropdown-item' href='/$menu[slug]/$regiao[slug]'>Todos</a></li>";
                                foreach($regiao['locations'] as $local) {
                                    $active = $page['local']==$local['slug'] ? 'active' :'';
                                    echo "<li class=' nav-item $active'>";
                                    echo "<a class='$active dropdown-item' href='/$menu[slug]/$regiao[slug]/$local[slug]'>$local[nome]</a></li>";                                    
                                }
                                echo '</ul>';
                            }
                            
                            echo '</li>';
                        }
                        echo '</ul>';
                    } 
                    
                    echo "</li>";
                    
                }
            ?>
          
            <li class="nav-item <?php echo $page['controller']=='Videos' ? 'active': '';?>"> <a class="nav-link" href="/videos">Vídeos</a> </li>
            <li class="nav-item <?php echo $page['controller']=='Discounts' ? 'active': '';?>"> <a class="nav-link" href="/descontos">Descontos</a> </li>
            <li class="nav-item <?php echo $page['pagina']=='sobre' ? 'active': '';?>"> <a class="nav-link" href="/sobre">Sobre</a> </li>
            <li class="nav-item <?php echo $page['pagina']=='contato' ? 'active': '';?>"> <a class="nav-link" href="/contato">Contato</a> </li>
        </ul>

        <form class="form-inline" method='GET' action='/buscar' >

            <div class="input-group input-group-xs">
                <input type="text" class="form-control form-control-sm" name='termo' id='termo' placeholder="Buscar" aria-label="Buscar" aria-describedby="Buscar">
                <div class="input-group-append">
                    <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-search-location"></i></button>
                </div>
            </div>
            
        </form>

    </div>
</nav>
