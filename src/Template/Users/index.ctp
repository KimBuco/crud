<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 * 
 */
?>



<div class="container">


    <div class="container mt-5">


        <div class="d-flex justify-content-between">
            <div>   
                <button class="btn btn-success mb-5 p-3">
                    <?= $this->Html->link(__('Add New User'), ['action' => 'add'], ['class' => 'text-decoration-none text-light']) ?>
                </button>
            </div>
            <div class="d-flex">
                <div>
                    <button class="btn btn-info mb-5 p-3">
                        <?= $this->Html->link(__('Download CSV'), ['controller' => 'Files', 'action' => 'export'],
                        ['confirm' => __('Are you sure you want to download the csv file?'),
                        'class' => 'text-decoration-none text-light']) ?>
                    </button>
                </div>
                <div class="btn btn-primary p-3 ms-2 mb-5">
                    <?= $this->Html->link(
                    'Download CSV Template',
                    '\files\CSV_Template.csv',
                    ['class' => 'text-white text-decoration-none', 'target' => '_blank'] );
                    ?>
                </div>
            </div>

        </div>

        <h3 id="Testusers"><?= __('Users') ?></h3>

        <table  id= "users" class="table table-striped nowrap" style="width:100%">
            <thead>
                <tr class="">
                    <th scope="col" class=""><?= __( 'Id')?></th>
                    <th scope="col" ><?= __( 'Username') ?></th>
                    <th scope="col"><?= __( 'Email' ) ?></th>
                    <th scope="col"><?= __( 'Position' )?></th>
                    <th scope="col"><?= __( 'Profile' ) ?></th>
                    <th scope="col"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                

            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <div class="mt-5">
                <?= $this->Form->create(null, ['type' => 'file', 'url' => ['controller' => 'Files',  'action' => 'import']]) ?>
                <?= $this->Form->control('csv_file', ['type' => 'file']) ?>
                <?= $this->Form->button(__('Upload Test'),  ['class'=>'btn btn-danger mb-5 p-3']) ?>
                <?= $this->Form->end() ?>
            </div>
            <!-- <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile">
            </div> -->
        </div>
    </div>
</div>


<script>

    var dataTableAjaxUrl = '<?= $this->Url->build(['controller' => 'DataTables', 'action' => 'data']); ?>';
    var deleteBaseUrl = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'delete']); ?>';
  
</script>
