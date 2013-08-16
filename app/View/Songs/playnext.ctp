<?php
if(isset($song) && !empty($song)){
echo json_encode($song);
//echo json_encode($a);
}
else{ ?>
<?php
echo $this -> Form -> create('Song', array('controller'=>'songs','action' => 'playnext'),array('class'=>'form-horizontal'));
echo $this -> Form -> input('song');
echo $this -> Form -> input('album');
echo $this -> Form -> input('dedicate_to');
echo $this -> Form -> input('artist',array('type'=>'text'));
echo $this -> Form -> input('message',array('type'=>'textarea'));
echo $this -> Form -> input('id', array('type' => 'hidden'));
echo $this -> Form -> input('Update',array('type'=>'submit','class'=>'btn btn-info','id'=>'playnextFormSubmit','label'=>false));
echo $this -> Form -> end();
?>
<?php
}
?>