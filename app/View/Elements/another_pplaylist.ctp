<div class="content-primary">
	<ul class="ui-listview nav nav-tabs nav-stacked">
		<?php //foreach ($songs as $song) { ?>
		<li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-d">
		<div class="ui-btn-inner ui-li">
		<div class="ui-btn-text">
		<a href="#" class="ui-link-inherit"><p class="ui-li-aside ui-li-desc"><strong>4:48</strong>PM</p>
				<h3 class="ui-li-heading"><?php //echo $song['Song']['song'];?></h3>
				<p class="ui-li-desc"><strong>Album: <?php //echo $song['Song']['album'];?></strong></p>
				<p class="ui-li-desc">Message: <?php //echo $song['Song']['message'];?></p>	
		</a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div>
		</li>
		<?php //} ?>
	</ul>
	<?php //print_r($songs);?>
	</div>-->
	<ul class="nav nav-tabs nav-stacked" style="width:50%;margin:0 auto;">
		<?php foreach ($songs as $song){ ?>
		<li><a href="#" rel="popover" data-content="Message: <?php echo $song['Song']['message'];?>" data-original-title="For :<?php echo $song['Song']['dedicate_to'];?>"><?php echo $song['Song']['song'];?></a></li>
		<?php } ?>
	</ul>
		<li  class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-hover-d ui-btn-up-d">
		<div class="ui-btn-inner ui-li"><div class="ui-btn-text">
			<a href="index.html" class="ui-link-inherit">
				<p class="ui-li-aside ui-li-desc"><strong>6:24</strong>PM</p>
				<h3 class="ui-li-heading">Stephen Weber</h3>
				<p class="ui-li-desc"><strong>You've been invited to a meeting at Filament Group in Boston, MA</strong></p>
				<p class="ui-li-desc">Hey Stephen, if you're available at 10am tomorrow, we've got a meeting with the jQuery team.</p>
			</a>
		</div>
		<span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
		</div>
		</li>
	