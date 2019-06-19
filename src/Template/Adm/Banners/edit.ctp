    <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner $banner
 */
?>

<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($data,['enctype'=>'multipart/form-data']) ?>
 
        <div class='row'>
            
            <?php if($page['action']=='edit') { ?>
            <div class="col-md-12">
                <div class="form-group">
                    <?= $this->Html->image('banners/'.$data->imagem,['width'=>'100%', 'height'=>'auto']) ?>
                </div>
            </div>
            <?php } ?>
            <div class='col-md-8'>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control <?=@$error['nome'] ? 'is-invalid':'';?>" id="nome" name="nome" value='<?=$data['nome']?>' placeholder="Nome descritivo do banner...">
                </div>
            </div>

            <div class='col-md-2'>
                <div class="form-group">
                    <label for="tempo">Duração :</label>
                    <input type="number" min='1' max='20' class="form-control" id="tempo" name="tempo" value='<?=$data['tempo']?>'placeholder="1...">
                    <small>em segundos</small>
                </div>
            </div>

            <div class='col-md-2'>
                <div class="form-group">
                    <p>Ítem Ativo ?</p>
                    <input type="checkbox" name="ativo" id="ativo"  <?=$data['ativo'] ? 'checked="checked"' :'' ?>  value='1'>
                    <label for="ativo">Sim</label>
                </div>
            </div>

            <div class='col-md-8'>
                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control <?=@$error['link'] ? 'is-invalid':'';?>" name='link' id="link" value='<?=$data['link']?>' placeholder="Link para o banner">
                    <small>links externos devem iniciar em http:// ou https:// </small>
                </div>
            </div>
            <div class='col-md-2'>
                <div class="form-group">
                    <label for="ordem">Ordem :</label>
                    <input type="number" min='1' max='20' class="form-control" id="ordem" name="ordem" value='<?=$data['ordem']?>'placeholder="1...">
                </div>
            </div>
            <div class='col-md-2'>
                <div class="form-group">
                    <p>Link Externo ?</p>
                    <input type="checkbox" name="externo" id="externo" <?=$data['externo'] ? 'checked="checked"' :'' ?>  value='1'>
                    <label for="externo">Sim</label>
                </div>
            </div>

            <div class='col-md-12'>
                <div class="form-group">
                    
                    <label for="imagem">Alterar a Imagem:</label>
                    <div class="custom-file ">
                        <input type="file" class="custom-file-input <?=@$error['imagem'] ? 'is-invalid':'';?>" name='imagem'  id="imagem" >
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
