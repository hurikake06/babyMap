<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facility[]|\Cake\Collection\CollectionInterface $facility
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Facility'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Station'), ['controller' => 'Station', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Station'), ['controller' => 'Station', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type'), ['controller' => 'Type', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Type', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facility index large-9 medium-8 columns content">
    <h3><?= __('Facility') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('station_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facility as $facility): ?>
            <tr>
                <td><?= $this->Number->format($facility->id) ?></td>
                <td><?= $facility->has('station') ? $this->Html->link($facility->station->name, ['controller' => 'Station', 'action' => 'view', $facility->station->id]) : '' ?></td>
                <td><?= $facility->has('type') ? $this->Html->link($facility->type->name, ['controller' => 'Type', 'action' => 'view', $facility->type->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $facility->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $facility->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $facility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facility->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
