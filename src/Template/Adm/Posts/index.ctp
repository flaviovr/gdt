<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
        <a href='/adm/posts/add' class="btn btn-success float-right btn-sm">Novo Item</a>
    </p>
    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0" class='table'>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('imagem') ?></th>
                <th scope="col"><?= $this->Paginator->sort('region_id',"Região") ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_id','Local') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id','Categoria') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
                <th class='text-center'  scope="col"><?= $this->Paginator->sort('ativo') ?></th>
                <th  class='text-center' scope="col"><?= $this->Paginator->sort('destaque') ?></th>
                
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $post): ?>
            <tr>
                <td><?= $this->Number->format($post->id) ?></td>
                <td><?= $this->Html->image('posts/'.$post->imagem,['height'=>60]) ?></td>
                <td><?= $post->has('region') ? $this->Html->link($post->region->nome, ['controller' => 'Regions', 'action' => 'view', $post->region->id]) : '' ?></td>
                <td><?= $post->has('location') ? $this->Html->link($post->location->nome, ['controller' => 'Locations', 'action' => 'view', $post->location->id]) : '' ?></td>
                <td><?= $post->has('category') ? $this->Html->link($post->category->nome, ['controller' => 'Categories', 'action' => 'view', $post->category->id]) : '' ?></td>
                <td><?= h($post->titulo) ?></td>
                
                
                <td class='text-center'><?= $post->ativo  ? '<i class="fas  fa-check-circle "></i>' : '' ?></td>
                <td class='text-center'><?= $post->destaque  ? '<i class="fas  fa-check-circle "></i>' : '' ?></td>
                
                <td class="actions text-right">
                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $post->id],['escape' => false]) ?>&nbsp;&nbsp;
                    <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->titulo), 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator clearfix">
        <ul class="pagination ">
            <?= $this->Paginator->first('<i class="far fa-arrow-alt-circle-left"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->numbers() ?>    
            <?= $this->Paginator->last('<i class="far fa-arrow-alt-circle-right"></i>',['escape'=>false]) ?>
        </ul>
        <p class=''><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}}')]) ?></p>
    </div>
</section>
