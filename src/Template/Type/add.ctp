<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Type'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Facility'), ['controller' => 'Facility', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Facility'), ['controller' => 'Facility', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="type form large-9 medium-8 columns content">
    <?= $this->Form->create($type) ?>
    <fieldset>
        <legend><?= __('Add Type') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('class');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
