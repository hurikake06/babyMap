<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Station $station
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $station->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $station->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Station'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Facility'), ['controller' => 'Facility', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Facility'), ['controller' => 'Facility', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="station form large-9 medium-8 columns content">
    <?= $this->Form->create($station) ?>
    <fieldset>
        <legend><?= __('Edit Station') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('comment');
            echo $this->Form->control('address');
            echo $this->Form->control('lat');
            echo $this->Form->control('lng');
            echo $this->Form->control('category._ids', ['options' => $category]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
