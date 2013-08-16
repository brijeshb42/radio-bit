<?php
	echo $this->element('home_div');
	if(isset($loggedIn) && $loggedIn[0]==false){
		echo $this->element('login_div');
		echo $this->element('reg_div');
	}
	else{
		echo $this->element('request_div');
		echo $this->element('playlist_div');
	}
?>