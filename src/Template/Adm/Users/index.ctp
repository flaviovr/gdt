<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
        <a href='/adm/users/add' class="btn btn-success float-right btn-sm">Novo Item</a>
    </p>
    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0" class='table'>
        <thead class="thead-light">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $tag): ?>
            <tr>
                <td><?= $this->Number->format($tag->id) ?></td>
                <td><?= h($tag->nome) ?></td>
                <td><?= h($tag->username) ?></td>
                <td class="actions text-right">
                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $tag->id],['escape' => false]) ?>&nbsp;&nbsp;
                    <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $tag->id], ['confirm' => __('Deseja realmente deletar {0}?', $tag->nome), 'escape' => false]) ?>
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
