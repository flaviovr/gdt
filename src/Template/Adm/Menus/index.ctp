<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
        <a href='/adm/menus/add' class="btn btn-success float-right btn-sm">Novo Item</a>
    </p>
    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0" class='table'>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col">Imagem</th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordem') ?></th>
                
                <th scope="col" class="actions"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $menu): ?>
            <tr>
                <td><?= $this->Number->format($menu->id) ?></td>
                <td><?= $this->Html->image('headers/'.$menu->imagem,['height'=>60]) ?></td>
                <td><?= h($menu->nome) ?></td>
                <td><?= h($menu->slug) ?></td>
                <td><?= h($menu->ordem) ?></td>
                <td class="actions text-right">
                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $menu->id],['escape' => false]) ?>&nbsp;&nbsp;
                    <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->nome), 'escape' => false]) ?>
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
