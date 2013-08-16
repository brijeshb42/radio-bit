<div id="account-div">
<?php
if(isset($loggedIn) && $loggedIn[2]=='admin'){
	echo $this->element('my_account_admin');
}
else{
	echo $this->element('my_account_user');
}
?>
</div>