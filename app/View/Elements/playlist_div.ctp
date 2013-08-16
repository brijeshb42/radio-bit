<?php $songs = $this->requestAction('songs/playlist');?>
<div id="playlist-div" class="row zero-radius row-mod">
    <div class="ui-header ui-bar-a">
		<h1 class="ui-title">Playlist</h1>
		<?php if($loggedIn[2]=='admin'){ ?>
		<a id="customSong" href="<?php echo $this->Html->url(array('controller'=>'songs','action'=>'playnext')); ?>" class="ui-btn-left ui-btn ui-shadow ui-btn-corner-all ui-btn-icon-left ui-btn-up-b">
		<span class="ui-btn-inner ui-btn-corner-all">
			<span class="ui-btn-text">Custom Song</span>
			<span class="ui-icon ui-icon-plus ui-icon-shadow">&nbsp;</span>
		</span>
		</a>
		<?php } ?>
		<a href="<?php echo $this->Html->url(array('controller'=>'songs','action'=>'playlist')); ?>" id="refreshPlaylist" class="ui-btn-right ui-btn ui-shadow ui-btn-corner-all ui-btn-icon-notext ui-btn-up-b" title="Refresh Playlist">
		<span class="ui-btn-inner ui-btn-corner-all">
			<span class="ui-btn-text">Refresh</span>
			<span class="ui-icon ui-icon-refresh ui-icon-shadow">&nbsp;</span>
		</span>
		</a>
	</div>
	<ul class="ui-listview" id="play-list">
	<?php if(isset($songs) && empty($songs)){ ?>
	
	<li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-e">
		<div class="ui-btn-inner ui-li">
			<div class="ui-btn-text">
			<a href="#" class="ui-link-inherit">
			<h3 class="ui-li-heading">Your playlist is empty</h3>	
			</a>
			</div>
		</div>
	</li>
	
	<?php }else{ ?>
	<?php foreach ($songs as $song) { ?>
		<li id="userSong<?php echo $song['Song']['id'];?>" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li">
		<div class="ui-btn-inner ui-li">
			<div class="ui-btn-text">
			<div class="btn-group playlist-btn-bar">
			<?php if($song['Song']['status']==1){
				echo '<button class="btn btn-info">Completed</button>';
			}else{
				echo '<button class="btn btn-warning">Pending</button>';
				echo '<a class="btn editSong" href="'.$this->Html->url(array('controller'=>'songs','action'=>'edit',$song['Song']['id'])).'">Edit</a>';
				echo '<a class="btn deleteSong" href="'.$this->Html->url(array('controller'=>'songs','action'=>'delete',$song['Song']['id'])).'">Delete</a>';
				if($loggedIn[2]=='admin')
					echo '<a class="btn playnextSong" href="'.$this->Html->url(array('controller'=>'songs','action'=>'playnext',$song['Song']['id'])).'">Play Next</a>';
			}
			?>
			</div>
			<a href="#" onclick="return false" class="ui-link-inherit">
				<!--<p class="ui-li-aside ui-li-desc"><strong>6:24</strong>PM</p>-->
				<h3 class="ui-li-heading"><?php echo $song['Song']['song'];?>
				<?php if($song['Song']['dedicate_to']!=""){
					echo ' <em>(for '.$song['Song']['dedicate_to'].')</em>';
				}
				if(isset($song['User']) && !empty($song['User'])){
					echo ' <em> by '.$song['User']['username'].'</em>';	
				}
				?>
				</h3>
				<?php if($song['Song']['album']!=""){ ?>
				<p class="ui-li-desc"><strong><?php echo $song['Song']['album']; ?></strong></p>
				<?php } ?>
				<?php if($song['Song']['message']!=""){ ?>
				<p class="ui-li-desc"><?php echo $song['Song']['message']; ?></p>
				<?php } ?>
			</a>
			</div>
		</div>
		</li>
		<?php } } ?>
	</ul>
	<ul class="pager">
  		<?php
            if($this->Paginator->hasPrev()){
              echo $this->Paginator->prev('Back',array('tag'=>'li','class'=>'previous'));  
            }
            if($this->Paginator->hasNext()){
              echo $this->Paginator->Next('Next',array('tag'=>'li','class'=>'next'));  
            }
        ?>
	</ul>
	<?php //print_r($songs); ?>
</div>
<?php echo $this->element('edit_song_div');?>
<?php echo $this->Html->script('playlist_div',false);?>
<?php echo $this->Html->script('edit_song_form',false);?>
