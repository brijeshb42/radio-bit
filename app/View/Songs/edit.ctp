<?php
if(isset($auth) && $auth==false){
	echo json_encode($song);
}
else{ ?>
<?php
echo $this -> Form -> create('Song', array('controller'=>'songs','action' => 'edit'),array('class'=>'form-horizontal'));
echo $this -> Form -> input('song');
echo $this -> Form -> input('album');
echo $this -> Form -> input('dedicate_to');
echo $this -> Form -> input('message',array('type'=>'textarea'));
echo $this -> Form -> input('id', array('type' => 'hidden'));
echo $this -> Form -> input('Update',array('type'=>'submit','class'=>'btn btn-info','id'=>'editFormSubmit','label'=>false));
echo $this -> Form -> end();
?>
<?php
}
?>