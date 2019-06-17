<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
        <a href='/adm/regions/add' class="btn btn-success float-right btn-sm">Novo Item</a>
    </p>
    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0" class='table'>
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Imagem</th>
                <th scope="col">Menu</th>
                <th scope="col">Nome</th>
                <th scope="col">Slug</th>
                <th scope="col">Ordem</th>
                <th scope="col" class="actions"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $region): ?>
            <tr>
                <td><?= $this->Number->format($region->id) ?></td>
                <td><?= $this->Html->image('headers/'.$region->imagem,['height'=>60]) ?></td>
                <td><?= $region->has('menu') ? h($region->menu->nome) : '' ;?></td>
                <td><?= h($region->nome) ?></td>
                <td><?= h($region->slug) ?></td>
                
                <td><?= h($region->ordem) ?></td>
                <td class="actions text-right">
                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $region->id],['escape' => false]) ?>&nbsp;&nbsp;
                    <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $region->id], ['confirm' => __('Deseja realmente deletar {0}?', $region->nome), 'escape' => false]) ?>
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
