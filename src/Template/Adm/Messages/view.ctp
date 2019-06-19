
<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($data) ?>
   
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Enviado por</label>
            <div class="col-sm-4">
                <input type="text" readonly class="form-control-plaintext"  value="<?=$data['nome'].' ('.$data['email'].') '.$data['telefone']?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Assunto</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext"  value="<?=$data['assunto']?>">
            </div>
        </div>


        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Mensagem</label>
            <div class="col-sm-10">
                <p class='texto'>
                    <?=nl2br($data['message']);?>
                </p>
            </div>
        </div>

    
  
    <?= $this->Form->end() ?>


  

</section>
