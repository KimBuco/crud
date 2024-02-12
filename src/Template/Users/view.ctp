<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>



<div class="d-flex column-gap-5 container mt-5">
  
        <div class="d-flex flex-column" id="">
            <div class="fs-2 fw-bold mt-5"><?= __('Actions') ?></div>
            <div>
                <button class="btn btn-success p-2 px-3 mt-3">
                    <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'text-decoration-none text-light']) ?>
                </button>

    

            </div>

            <div>
                <button class="btn btn-primary p-2 px-3 mt-3">
                    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'text-decoration-none text-light']) ?>
                </button>
            </div>

            <div>
                <button class="btn btn-warning p-2 px-3 mt-3">
                    <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'text-decoration-none text-light']) ?>
                </button> 
            </div>

            <div>
                <button class="btn btn-danger p-2 mt-3">
                    <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                    'class' => 'text-decoration-none text-light']) ?> 
                </button> 
            </div>
        </div>

        <!-- <div class="col-9">
        </div> -->

        <!-- <div class="col-2">
        </div> -->

        <div class="d-flex flex-column justify-content-end ps-5 ms-5">
                <div class="text-start">
                    <h3 class="fs-1 fw-bold text-danger"><?= h($user->id) ?></h3>
                </div>
   
                <table class="vertical-table">
                    <tr>
                        <th scope="row"><?= __('Username') ?></th>
                        <td><?= h($user->username) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Email') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Position') ?></th>
                        <td><?= h($user->position) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                </table>
        </div>


</div>
