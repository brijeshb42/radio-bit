<?php
if(isset($msg)){
    echo json_encode($msg);
}
else{ ?>
<div id="request-div" class="row zero-radius row-mod">
    <div class="ui-header ui-bar-a">
        <h1 class="ui-title">Dedicate Song</h1>
    </div>
    <div class="row" style="margin:0px">
    <div class="span2 zero"></div>
    <div id="form-div" class="span6" style="margin:0px">
    <?php
        echo $this->Form->create('Song',array('url'=>array('controller'=>'songs','action'=>'request'),'inputDefaults'=>array('div'=>false,'label'=>false),'type'=>'post','class'=>'form-horizontal reg-form','id'=>'request-form'));
        echo $this->Form->input('song',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;',
                'text'=>'Song*'
                ),
            'placeholder'=>'Song'
            ));
        echo $this->Form->input('album',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;'
                ),
            'placeholder'=>'Album'
            ));
        echo $this->Form->input('dedicate_to',array(
            'div' => array(
                'class'=>'control-group',
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;',
                'text'=>'Dedicate To'
                ),
            'placeholder'=>'Dedicate To'
            ));
        echo $this->Form->input('message',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => array(
                'class'=>'control-label',
                'style'=>'padding-right:20px;'
                ),
            'type' => 'textarea',
            'placeholder'=>'Message(if any)',
            'rows'=>2
            ));
        echo $this->Form->input('Request',array(
            'div' => array(
                'class'=>'control-group'
                ),
            'label' => false,
            'type' => 'submit',
            'class' => 'btn btn-primary'
            ));
        echo $this->Form->end();
    ?>
    </div>
    <div class="span2 zero">
    </div>
</div>
</div>
<?php echo $this->Html->script('request',false);?>
<?php } ?>