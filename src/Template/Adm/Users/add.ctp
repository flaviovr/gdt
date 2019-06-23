<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ;?>
    <?= $this->Form->create($data); ?>

    <div class='row'>
        
        <div class='col-md-6'>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" id="nome" name="nome" placeholder="Nome descritivo...">
            </div>
        </div>

        <div class='col-md-6'>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email"  class="form-control" name='email' id="email" placeholder="titulo-do-item...">
            </div>
        </div>
        <div class='col-md-6'>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" id="username" name="username" placeholder="Nome descritivo...">
            </div>
        </div>
        <div class='col-md-6'>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" id="password" name="password" placeholder="Nome descritivo...">
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
