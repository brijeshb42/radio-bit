<?php
if(isset($loggedIn) && $loggedIn[2]=='admin'){
	echo $this->element('my_account_admin');
}
else if(isset($loggedIn) && $loggedIn[2]=='user'){
	echo $this->element('my_account_user');
}
?>