<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Type'), ['action' => 'edit', $type->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Type'), ['action' => 'delete', $type->id], ['confirm' => __('Are you sure you want to delete # {0}?', $type->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Type'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facility'), ['controller' => 'Facility', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facility'), ['controller' => 'Facility', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="type view large-9 medium-8 columns content">
    <h3><?= h($type->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($type->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class') ?></th>
            <td><?= $this->Number->format($type->class) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Name') ?></h4>
        <?= $this->Text->autoParagraph(h($type->name)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Facility') ?></h4>
        <?php if (!empty($type->facility)): ?>
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
            <?php foreach ($type->facility as $facility): ?>
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
</div>
