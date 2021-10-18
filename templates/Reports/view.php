<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Report'), ['action' => 'edit', $report->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Report'), ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Report'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="reports view content">
            <h3><?= h($report->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Fecha') ?></th>
                    <td><?= h($report->fecha) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora') ?></th>
                    <td><?= h($report->hora) ?></td>
                </tr>
                <tr>
                    <th><?= __('Motivo') ?></th>
                    <td><?= h($report->motivo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($report->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Midified') ?></th>
                    <td><?= h($report->midified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($report->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($report->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
