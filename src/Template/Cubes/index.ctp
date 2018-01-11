<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div>
  <?= $this->Form->create("Cubes",['url' => ['action' => 'check']]); ?>
  <?=  $this->Form->input("matrix",['type'=>'textarea', 'value' => $matrix, 'style'=>['style'=>'width:900px; height:400px;']]); ?>

  <?= $this->Form->submit("Submit", ['class'=>'btn btn-success mt-2 mb-2']);?>
  <?= $this->Form->end();?>
</div>
<div class="result">
  <?php
      if(isset($result)){
        foreach ($result as $rest) {
          echo $rest . "<br />";
        }
      }
   ?>
</div>
