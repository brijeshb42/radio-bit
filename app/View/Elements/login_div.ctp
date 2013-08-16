<?php
if(isset($msg)){
    echo json_encode($msg);
}
else{
?>

<div id="login-div" class="row zero-radius row-mod">
    <div class="ui-header ui-bar-a">
        <h1 class="ui-title">Login to Radio BIT</h1>
    </div>
    <div style="max-width:300px;margin:0 auto;margin-top:20px">
        <?php
            echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'login'),'inputDefaults'=>array('div'=>false,'label'=>false),'type'=>'post','class'=>'form-horizontal reg-form','id'=>'login-form'));
            echo $this->Form->input('login_username',array('placeholder'=>'Username'));
            echo $this->Form->input('login_password',array('type'=>'password','placeholder'=>'Password'));
        ?>
        <label class="checkbox" for="UserAutoLogin"><?php echo $this->Form->input('auto_login',array('type'=>'checkbox'));?>Remember Me<a id="forgotPass" style="float:right" class="btn btn-inverse btn-mini" href="user/forgot">Forgot Password</a></label>
        <?php
            echo $this->Form->input('Login',array('type'=>'submit','class'=>'btn btn-primary'));
            echo $this->Form->end();
        ?>
    </div>
</div>
<?php echo $this->Html->script('login',false);?>
<?php } ?>
