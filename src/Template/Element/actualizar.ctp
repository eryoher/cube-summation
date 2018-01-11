<?php
  $myTemplates = [
    'inputContainer' => '<div class="col-md-2 input {{type}}{{required}}">{{content}}</div>',
    'inputContainerError' => '<div class="col-md-2 input {{type}}{{required}} error">{{content}}{{error}}</div>',
    'submitContainer' => '<div class="col-md-4 d-flex align-items-center">{{content}}</div>'
  ];
  $this->Form->templates($myTemplates);

  echo $this->Form->create('Cubes', ['url' => ['action' => 'query']]);
?>
<div class="row col-12">
<?php

  echo $this->Form->input('x1');
  echo $this->Form->input('x2');
  echo $this->Form->input('y1');
  echo $this->Form->input('y2');
  echo $this->Form->input('z1');
  echo $this->Form->input('z2');
  echo $this->Form->Submit('Query', ['class' => 'btn btn-success']);
  echo $this->Form->end();
?>
</div>
