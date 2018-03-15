<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facility $facility
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $facility->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $facility->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Facility'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Station'), ['controller' => 'Station', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Station'), ['controller' => 'Station', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type'), ['controller' => 'Type', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Type', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facility form large-9 medium-8 columns content">
    <?= $this->Form->create($facility) ?>
    <fieldset>
        <legend><?= __('Edit Facility') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('station_id', ['options' => $station]);
            echo $this->Form->control('type_id', ['options' => $type]);
            echo $this->Form->control('time');
            echo $this->Form->control('holiday');
            echo $this->Form->control('comment');
            echo $this->Form->control('category._ids', ['options' => $category]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
