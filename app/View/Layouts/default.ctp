<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Radio BIT');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('normalize');
		echo $this->Html->css('cyborg.bootstrap.min');
        echo $this->Html->css('bootstrap.responsive');
		echo $this->Html->css('jquery-ui.custom.min');
		echo $this->Html->css('jquery.mobile.theme.min');
		echo $this->Html->css('jquery.mobile.min');
		echo $this->Html->css('main');

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <div class="content container" style="max-width:1000px">
            <!--header-->
        	<?php echo $this->element('header');?>
        	<!--header end-->
            <!--nav menu-->
            <?php echo $this->element('head_menu');?>
            <!--nav menu end-->
        	<div class="tab-container ui-body-a">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('Auth'); ?>   
                <?php echo $this->fetch('content'); ?>
        	</div>      
            <?php //echo $this->element('song_list_div');?>
            <?php //echo $this->element('sql_dump'); ?>
        </div>
        <div id="footer">
        <div class="container" style="position:fixed;bottom:0px;margin:0 auto;background:whiteSmoke;max-width:400px">
        <p class="muted credit" style="margin:20px">This site works best with chrome.<br />
        created by <a href="http://www.facebook.com/brijeshb42" target="_blank">anDroiD</a>(DC Nick)
        </p>
        </div>
        </div>
        <?php echo $this->element('modal');?>
        <?php echo $this->Html->script('jquery-1.8.0.min');?>
        <?php echo $this->Html->script('jquery-ui-1.9.1.custom.min');?>
        <?php echo $this->Html->script('jquery.idTabs.min');?>
        <?php echo $this->Html->script('bootstrap.min');?>
        <?php echo $this->Html->script('main');?>
        <?php echo $this->fetch('script');?>
        <?php echo $this -> Js -> writeBuffer();?>
    </body>
</html>
		<!--<div id="content">

			<?php //echo $this->Session->flash(); ?>

			<?php //echo $this->fetch('content'); ?>
		</div>
	</div>-->
