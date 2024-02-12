<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="">
  <button class="btn btn-success p-3 mt-5 text-decoration-none">
  <?= $this->Html->link(__('List Users'), ['action' => 'index',], ['class' => 'text-decoration-none text-light']) ?></button>
</div>

<div class="container col col-6 ">

<legend class="fw-bold mb-3 fs-2"><?= __('Add User') ?></legend>


<div class="row align-items-center px-4 py-5 shadow p-3 mb-5 rounded">
<?= $this->Form->create($user , ['type' => 'file']) ?>

      <?= $this->Form->control('username', ['class' => 'form-control bg-transparent', 'placeholder' => 'TestUser' ]) ?>
      <?= $this->Form->control('email', ['class' => 'form-control bg-transparent', 'placeholder' => 'TestUser@sample.com']) ?>
      <?= $this->Form->control('position', ['class' => 'form-control bg-transparent', 'placeholder' => 'TestAdmin']) ?>
      <?= $this->Form->control('image_file', ['type' => 'file']) ?>
      <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-warning text-white p-2 px-3']) ?>

      <?= $this->Form->end() ?>
</div>


      
</div>
