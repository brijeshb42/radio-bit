<div class="span5" style="padding:0;margin:0" id="song-playing">
    <div>
        		<ul class="ui-listview">
                    <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-b">
                        <div class="ui-btn-inner ui-li">
                            <div class="ui-btn-text"><a href="#" onclick="return false;" id="songTitle" class="ui-link-inherit">Now Playing: Loading...</a></div>
                            <span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
                        </div>
                    </li>
                    <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-b">
                        <div class="ui-btn-inner ui-li">
                            <div class="ui-btn-text"><a href="#" class="ui-link-inherit" id="songArtist">Artist: Loading...</a></div>
                            <span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
                        </div>
                    </li>
                    <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-b" style="display:none">
                        <div class="ui-btn-inner ui-li">
                            <div class="ui-btn-text"><a href="#" class="ui-link-inherit" id="dedicateTo">Dedicated To:</a></div>
                            <span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
                        </div>
                    </li>
                    <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-b" style="display:none">
                        <div class="ui-btn-inner ui-li">
                            <div class="ui-btn-text"><a href="#" class="ui-link-inherit" id="requestedBy">Requested By: </a></div>
                            <span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
                        </div>
                    </li>
                    <?php if(isset($loggedIn) && $loggedIn[0]==false){ ?>
                        <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-down-e">
                        <div class="ui-btn-inner ui-li">
                            <div class="ui-btn-text"><a href="#" class="ui-link-inherit">Login now to request a song.</a></div>
                            <span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
                        </div>
                        </li>
                    <?php } ?>
                </ul>
    </div>
</div>
<?php echo $this->Html->script('now_playing',false);?>
