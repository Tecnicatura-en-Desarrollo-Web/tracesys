<?php

/**
 * @var \App\View\AppView $this
 */
$cakeDescription = 'CakeVue Application';
?>
<!DOCTYPE html>
<html>

<head>
    <!-- <script>
        $("[data-toggle=tooltip").tooltip();
    </script> -->
    <!-- <style src="../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style> -->

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        TraceSys
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->AssetMix->css('main') ?>

    <?= $this->AssetMix->script('app') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>

<body>
    <span id="app">
        <!-- <top-header></top-header> -->

        <app></app>

        <footer></footer>
    </span>
</body>
<style>

body {
    background-color: #F6F6F6;
    overflow-x: hidden;
}
</style>
</html>
