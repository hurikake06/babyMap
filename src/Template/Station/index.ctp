<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Station[]|\Cake\Collection\CollectionInterface $station
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Station'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Facility'), ['controller' => 'Facility', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Facility'), ['controller' => 'Facility', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="station index large-9 medium-8 columns content">
    <h3><?= __('Station') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lng') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($station as $station): ?>
            <tr>
                <td><?= $this->Number->format($station->id) ?></td>
                <td><?= $this->Number->format($station->lat) ?></td>
                <td><?= $this->Number->format($station->lng) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $station->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $station->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $station->id], ['confirm' => __('Are you sure you want to delete # {0}?', $station->id)]) ?>
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
