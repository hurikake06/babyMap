<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $category
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Search'), ['controller' => 'Category','action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Information'), ['controller' => 'Category','action' => 'info']) ?></li>
        <li><?= $this->Html->link(__('Help'), ['controller' => 'Category','action' => 'help']) ?></li>
        <li><?= $this->Html->link(__('Configuration'), ['controller' => 'Category','action' => 'conf']) ?></li>
    </ul>
</nav>
<div class="category index large-9 medium-8 columns content">
  <h1>Information</h1>
  <h2>Information</h2>
  <h3>Information</h3>
  <h4>Information</h4>
  <h5>Information</h5>
  <h6>Information</h6>
  <table>
    <tr>
      <td>a1</td>
      <td>a2</td>
      <td>a3</td>
      <td>a4</td>
    </tr>
    <tr>
      <td>a1</td>
      <td>a2</td>
      <td>a3</td>
      <td>a4</td>
    </tr>
    <tr>
      <td>a1</td>
      <td>a2</td>
      <td>a3</td>
      <td>a4</td>
    </tr>
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
