<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Station $station
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Station'), ['action' => 'edit', $station->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Station'), ['action' => 'delete', $station->id], ['confirm' => __('Are you sure you want to delete # {0}?', $station->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Station'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Station'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facility'), ['controller' => 'Facility', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facility'), ['controller' => 'Facility', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="station view large-9 medium-8 columns content">
    <h3><?= h($station->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($station->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lat') ?></th>
            <td><?= $this->Number->format($station->lat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lng') ?></th>
            <td><?= $this->Number->format($station->lng) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Name') ?></h4>
        <?= $this->Text->autoParagraph(h($station->name)); ?>
    </div>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($station->comment)); ?>
    </div>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($station->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Facility') ?></h4>
        <?php if (!empty($station->facility)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Station Id') ?></th>
                <th scope="col"><?= __('Type Id') ?></th>
                <th scope="col"><?= __('Time') ?></th>
                <th scope="col"><?= __('Holiday') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($station->facility as $facility): ?>
            <tr>
                <td><?= h($facility->id) ?></td>
                <td><?= h($facility->name) ?></td>
                <td><?= h($facility->station_id) ?></td>
                <td><?= h($facility->type_id) ?></td>
                <td><?= h($facility->time) ?></td>
                <td><?= h($facility->holiday) ?></td>
                <td><?= h($facility->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Facility', 'action' => 'view', $facility->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Facility', 'action' => 'edit', $facility->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Facility', 'action' => 'delete', $facility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facility->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Category') ?></h4>
        <?php if (!empty($station->category)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($station->category as $category): ?>
            <tr>
                <td><?= h($category->id) ?></td>
                <td><?= h($category->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Category', 'action' => 'view', $category->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Category', 'action' => 'edit', $category->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Category', 'action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
