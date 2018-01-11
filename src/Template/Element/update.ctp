<?php
  echo $this->Form->create('Cubes', ['url' => ['action' => 'update']]);
  $myTemplates = [
    'inputContainer' => '<div class="col-md-2 input {{type}}{{required}}">{{content}}</div>',
    'inputContainerError' => '<div class="col-md-2 input {{type}}{{required}} error">{{content}}{{error}}</div>',
    'submitContainer' => '<div class="col-md-4 d-flex align-items-center">{{content}}</div>'
  ];
$this->Form->templates($myTemplates);
  ?>
  <div class="row col-12">
    <?php
      echo $this->Form->input('x',['class'=>'']);
      echo $this->Form->input('y', ['class'=>'']);
      echo $this->Form->input('z', ['class'=>'']);
      echo $this->Form->input('value', ['class'=>'']);
      echo $this->Form->Submit('Update', ['class' => 'btn btn-success']);
    ?>
  </div>
<?php
  echo $this->Form->end();
?>
