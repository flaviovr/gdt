<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($data,['enctype'=>'multipart/form-data']) ?>
 
        <div class='row'>
            
            <div class='col-md-8'>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" value='<?=$data['nome']?>' id="nome" name="nome" placeholder="Nome descritivo...">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label for="video">Id do Vídeo :</label>
                    <input type="string"  class="form-control" name='video' id="video" value='<?=$data['video']?>'  placeholder="titulo-do-item...">
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
