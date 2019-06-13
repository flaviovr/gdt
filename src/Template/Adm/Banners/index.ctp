
<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
        <a href='/adm/banners/add' class="btn btn-success float-right btn-sm">Novo Item</a>
    </p>
    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0" class='table'>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col">Imagem</th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('link') ?></th>
                <th class='text-center' scope="col"><?= $this->Paginator->sort('tempo') ?></th>
                <th class='text-center'scope="col"><?= $this->Paginator->sort('externo') ?></th>
                <th class='text-center' scope="col"><?= $this->Paginator->sort('ativo') ?></th>
                <th scope="col" class="actions"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $banner): ?>
            <tr>
                <td><?= $this->Number->format($banner->id) ?></td>
                <td><?= $this->Html->image('banners/'.$banner->imagem,['height'=>60]) ?></td>
                <td><?= h($banner->nome) ?></td>
                <td><?= h($banner->link) ?></td>
                
                <td class='text-center'><?= $this->Number->format($banner->tempo) ?>s</td>
                <td class='text-center'><?= $banner->externo  ? '<i class="fas  fa-check-circle "></i>' : '' ?></td>
                <td class='text-center'><?= $banner->ativo  ? '<i class="fas  fa-check-circle "></i>' : '' ?></td>
                <td class="actions text-right">
                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $banner->id],['escape' => false]) ?>&nbsp;&nbsp;
                    <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $banner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $banner->nome), 'escape' => false]) ?>
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
