<?php
if(isset($msg)){
    echo json_encode($msg);
}
else{ ?>
<div id="reg-div" class="row zero-radius row-mod">
    <div class="ui-header ui-bar-a">
        <h1 class="ui-title">Register</h1>
    </div>
    <div class="row" style="margin:0px">
    <div class="span3 zero"></div>
    <div id="form-div" class="span6" style="margin:0px">
    <?php
        echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'register'),'inputDefaults'=>array('div'=>false,'label'=>false),'type'=>'post','class'=>'form-horizontal reg-form','id'=>'reg-form','autocomplete'=>'off'));
        echo $this->Form->input('username',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;',
                'text'=>'Username'
                ),
            'placeholder'=>'Username'
            ));
        echo $this->Form->input('name',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;',
                'text'=>'Your Name'
                ),
            'placeholder'=>'Your Name'
            ));
        echo $this->Form->input('email',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;'
                ),
            'placeholder'=>'Email'
            ));
        echo $this->Form->input('password',array(
            'div' => array(
                'class'=>'control-group',
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;',
                'text'=>'Password'
                ),
            'placeholder'=>'Password'
            ));
        echo $this->Form->input('confirm_password',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;'
                ),
            'type' => 'password',
            'placeholder'=>'Confirm Password'
            ));
        echo $this->Form->input('Register',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => false,
            'type' => 'submit',
            'class' => 'btn'
            ));
        echo $this->Form->end();
    ?>
    </div>
    <div class="span3 zero">
    </div>
</div>
</div>
<?php echo $this->Html->script('register',false);?>
<?php } ?>