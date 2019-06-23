<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render();?>
    <?= $this->Form->create($data,['enctype'=>'multipart/form-data']) ?>
 
        <div class='row'>
            
            <?php if($page['action']=='edit') { ?>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo $this->Html->image('headers/'.$data['imagem'],['width'=>'100%', 'height'=>'auto']) ?>
                </div>
            </div>
            <?php } ?>

            <div class='col-md-6'>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" value='<?=$data['nome']?>' id="nome" name="nome" placeholder="Nome descritivo...">
                </div>
            </div>  

            <div class='col-md-4'>
                <div class="form-group">
                    <label for="slug">Slug :</label>
                    <input type="string"  class="form-control <?=@$error['slug'] ? 'is-invalid':'';?>" name='slug' id="slug" value='<?=$data['slug']?>'  placeholder="titulo-do-item...">
                    <small>Texto Utilizado para criação da URL</small>
                </div>
            </div>

        
            <div class='col-md-2'>
                <div class="form-group">
                    <label for="ordem">Ordem:</label>
                    <input type="number" class="form-control <?php if(@$error['ordem']) echo 'is-invalid'; ?>" value='<?=$data['ordem']?>' id="ordem" name="ordem" placeholder="Nome descritivo...">
                </div>
            </div>
        

            <div class='col-md-12'>
                <div class="form-group">
                    
                    <label for="imagem">Alterar a Imagem:</label>
                    <div class="custom-file ">
                        <input type="file" class="custom-file-input <?=@$error['imagem'] ? 'is-invalid':'';?>" name='imagem' id="imagem" >
                        <label class="custom-file-label" for="imagem">Escolha a Imagem</label>
                    </div>
                    <small>1230x410px | png-jpg-jpeg </small>
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
