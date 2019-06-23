<?php
echo $this->Html->css('home');
$assuntos = [
    'Propostas de Trabalho'=>'Propostas de Trabalho',
    'Propostas de Trabalho'=>'Teste de E-mail'
];
?>
<section class="padrao">
    <p class='title'><i class="fas fa-envelope"></i> Contato</p>
    <?= $this->Flash->render();?>
    <?= $this->Form->create(null) ?>
 
        <div class='row'>
            
            <div class='col-md-8'>
                <h3>Fale com o Guia de trips</h3>
                <p class=''>Mande sua mensagem pelo formulario abaixo:</p>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" value='<?=$data['nome']?>' id="nome" name="nome">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email"  class="form-control <?=@$error['email'] ? 'is-invalid':'';?>" name='email' id="email" value='<?=$data['email']?>'>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control <?php if(@$error['telefone']) echo 'is-invalid'; ?>" value='<?=$data['telefone']?>' id="telefone" name="telefone" >
                </div>
                <div class="form-group">
                    <?= $this->Form->control('assunto',['options' => $assuntos, 'empty' => true, 'class'=>'form-control'.(@$error['assunto'] ? ' is-invalid':'') , 'label'=>['text'=>'Assunto']]);?>
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <?= $this->Form->textarea('message',['class'=>'form-control'.(@$error['message'] ? ' is-invalid':'') , 'label'=>['text'=>'Mensagem']]);?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>  

            <div class='col-md-4'>
                <p class='text-right'>Apoie o Guia</p>
                <div class="form-group">
                    <a href="<?=$config['topbar']['descontos'][0]['link']?>" target='_blank'>
                    <?php echo $this->Html->image('descontos/'.$config['topbar']['descontos'][0]['imagem'],['width'=>'90%', 'height'=>'auto','class'=>'float-right ','style'=>'margin-bottom:20px;']) ?><br><br>
                    <?php echo $this->Html->image('descontos/'.$config['topbar']['descontos'][2]['imagem'],['width'=>'90%', 'height'=>'auto','class'=>'float-right ']) ?>
                    </a>
                </div>
            </div>

        
          
            
        </div>
      
    <?= $this->Form->end() ?><br><br>
</section>