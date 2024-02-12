<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="container row">
    <nav class="col-3" id="">
        <div>
            <div>
                <div class="fs-2 fw-bold"><?= __('Actions') ?></div>
            </div>
            <div class="d-flex flex-column">
                <div>
                    <button class="btn btn-success p-3 mt-5">
                        <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'text-decoration-none text-light'])?>
                    </button>
                </div>
                <div>
                    <button class="btn btn-danger p-3 mt-3 text-decoration-none">
                        <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $user->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                                'class' => 'text-decoration-none text-light p-2'])
                    ?></button>
                </div>
            </div>
        </div>
    </nav>

    <div class="col-9">
    </div>

    <div class="col-4">
    </div>

    <div class="col-6 align-self-center">
        <legend class="fw-bold mb-3 fs-2"><?= __('Edit User') ?></legend>
        <div class="row align-items-center px-4 py-5 shadow p-3 mb-5 bg-body-tertiary rounded">
            <?= $this->Form->create($user) ?>

            <?= $this->Form->control('username', ['class' => 'form-control', 'placeholder' => 'TestUser']) ?>
            <?= $this->Form->control('email', ['class' => 'form-control', 'placeholder' => 'TestUser@sample.com']) ?>
            <?= $this->Form->control('position', ['class' => 'form-control', 'placeholder' => 'TestAdmin']) ?>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-warning p-2 px-3']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>

</div>






