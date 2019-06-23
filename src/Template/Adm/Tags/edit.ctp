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
                    <label for="slug">Slug :</label>
                    <input type="string"  class="form-control <?php if(@$error['slug']) echo 'is-invalid'; ?>" name='slug' id="slug" value='<?=$data['slug']?>'  placeholder="titulo-do-item...">
                    <small>Texto Utilizado para criação da URL</small>
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
