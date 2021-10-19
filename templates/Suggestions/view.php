<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Suggestion $suggestion
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Suggestion'), ['action' => 'edit', $suggestion->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Suggestion'), ['action' => 'delete', $suggestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suggestion->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Suggestions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Suggestion'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="suggestions view content">
            <h3><?= h($suggestion->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre Sugerencia') ?></th>
                    <td><?= h($suggestion->nombre_sugerencia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Importancia') ?></th>
                    <td><?= h($suggestion->importancia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($suggestion->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($suggestion->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($suggestion->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion Sugerencia') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($suggestion->descripcion_sugerencia)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
