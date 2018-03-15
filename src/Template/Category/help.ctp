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
    <h3>HELP</h3>
    <div class="row">
        <h4>注意事項</h4>
        いろいろ気を付けてね
    </div>
    <div class="row">
        <h4>ああああ</h4>
        いいいい
    </div>
    <div class="related">
        <h4>アイコン説明</h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col">アイコン</th>
                <th scope="col">名前</th>
                <th scope="col" class="actions">説明</th>
            </tr>
            <?php foreach ($category as $category): ?>
            <tr>
                <td><?= h($category->id) ?></td>
                <td><?= h($category->name) ?></td>
                <td><?= h($category->name) ?>はあれです。</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
