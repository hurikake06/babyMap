<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facility $facility
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Facility'), ['action' => 'edit', $facility->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Facility'), ['action' => 'delete', $facility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facility->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Facility'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facility'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Station'), ['controller' => 'Station', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Station'), ['controller' => 'Station', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Type'), ['controller' => 'Type', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Type', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facility view large-9 medium-8 columns content">
    <h3><?= h($facility->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Station') ?></th>
            <td><?= $facility->has('station') ? $this->Html->link($facility->station->name, ['controller' => 'Station', 'action' => 'view', $facility->station->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $facility->has('type') ? $this->Html->link($facility->type->name, ['controller' => 'Type', 'action' => 'view', $facility->type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($facility->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Name') ?></h4>
        <?= $this->Text->autoParagraph(h($facility->name)); ?>
    </div>
    <div class="row">
        <h4><?= __('Time') ?></h4>
        <?= $this->Text->autoParagraph(h($facility->time)); ?>
    </div>
    <div class="row">
        <h4><?= __('Holiday') ?></h4>
        <?= $this->Text->autoParagraph(h($facility->holiday)); ?>
    </div>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($facility->comment)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Category') ?></h4>
        <?php if (!empty($facility->category)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($facility->category as $category): ?>
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
