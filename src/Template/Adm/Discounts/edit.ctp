<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($data,['enctype'=>'multipart/form-data']) ?>
 
        <div class='row'>
            <?php if($page['action']=='edit') { ?>
            
            <div class="form-group col-md-6">
                <?= $this->Html->image('descontos/'.$data->imagem,['width'=>'100%', 'height'=>'auto']) ?>
            </div>
        
            <?php } ?>
         
            <div class='<?= $page['action']=='edit' ? "col-md-6" : "col-md-12";?>'>
                <div class="row">


                    <div class="form-group col-md-8">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control <?=@$error['nome'] ? 'is-invalid':'';?>" id="nome" name="nome" value='<?=$data['nome']?>' placeholder="Nome descritivo do banner...">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="slug">Slug :</label>
                        <input type="text" min='1' max='20' class="form-control" id="slug" name="slug" value='<?=$data['slug']?>'placeholder="1...">
                        <small>em segundos</small>
                    </div>
            
                    <div class="form-group col-md-5">
                        <label for="link">Link:</label>
                        <input type="text" class="form-control <?=@$error['link'] ? 'is-invalid':'';?>" name='link' id="link" value='<?=$data['link']?>' placeholder="Link para o banner">
                        <small>links externos devem iniciar em http:// ou https:// </small>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="slug">Validade :</label>
                        <input type="date" min='<?=$this->Time->format('now', 'yyyy-MM-dd')?>' class="form-control <?=@$error['validade'] ? 'is-invalid':'';?>" id="validade" name="validade" value='<?php if($data->validade!='') echo $data->validade->i18nFormat('yyyy-MM-dd');?>'placeholder="">
                    </div>
                    <div class="form-group col-md-2">
                        <p>Ativo?</p>
                        <input type="checkbox" name="ativo" id="ativo"  <?=$data['ativo'] ? 'checked="checked"' :'' ?>  value='1'>
                        <label for="ativo">Sim</label>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="imagem">Alterar a Imagem:</label>
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input <?=@$error['imagem'] ? 'is-invalid':'';?>" name='imagem'  id="imagem" >
                            <label class="custom-file-label" for="imagem">Escolha a Imagem</label>
                        </div>
                        <small>1230x410px | png-jpg-jpeg </small>
                    </div>    

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
