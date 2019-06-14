<?php
$menus = $data['menus'];
$data = $data['data'];
?>
<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($data) ?>
    
    <div class='row'>
        
        <div class='col-md-12'>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value='<?=$data['nome']?>'placeholder="Nome descritivo..">
            </div>
        </div>

        <div class='col-md-6'>
            <div class="form-group">
                <label for="slug">Slug :</label>
                <input type="string"  class="form-control" name='slug' id="slug" value='<?=$data['slug']?>' placeholder="titulo-do-item...">
                <small>Texto Utilizado para criação da URL</small>
            </div>
        </div>
       

        <div class='col-md-5'>
            <div class="form-group">
                <?= $this->Form->control('menu_id',['options' => $menus, 'empty' => true, 'class'=>'form-control'.(@$error['menu_id'] ? 'in-invalid':'') , 'label'=>['text'=>'Menu:']]);?>                
            </div>
        </div>

        <div class='col-md-1'>
            <div class="form-group">
                <label for="ordem">Ordem :</label>
                <input type="string"  class="form-control" name='ordem' id="ordem" value='<?=$data['ordem']?>'placeholder="9999...">
            </div>
        </div>

        <div class='col-md-2'>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            
        </div>
             
        
    </div>
    
  
    <?= $this->Form->end() ?>


  

</section>
