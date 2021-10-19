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
            <?= $this->Html->link(__('List Suggestions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="suggestions form content">
            <?= $this->Form->create($suggestion) ?>
            <fieldset>
                <legend><?= __('Add Suggestion') ?></legend>
                <?php
                    echo $this->Form->control('nombre_sugerencia');
                    echo $this->Form->control('descripcion_sugerencia');
                    echo $this->Form->control('importancia');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
