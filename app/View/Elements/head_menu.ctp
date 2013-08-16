<div id="head-menu">
    <div class="navbar navbar-inverse" style="margin-bottom:0px;">
        <div id="myTabs" class="navbar-inner zero-radius">
            <a href="<?php echo $this->Html->url(array('controller'=>'songs'));?>" class="brand">Radio BIT</a>
            <ul id="main-menu" class="idTabs nav">
            <li class="active"><a href="#home-div"><span class="icon icon-white icon-home"></span>&nbsp;Home</a></li>
        <?php if(isset($loggedIn) && $loggedIn[0]==false){ ?>
            <li><a href="#login-div"><span class="icon icon-white icon-user"></span>&nbsp;Login</a></li>
            <li><a href="#reg-div"><span class="icon icon-white icon-pencil"></span>&nbsp;Register</a></li>
            <?php }
            else{ ?>
            <li><a href="#request-div"><span class="icon icon-white icon-edit"></span>&nbsp;Request</a></li>
            <li><a href="#playlist-div"><span class="icon icon-white icon-list"></span>&nbsp;My Playlist</a></li>
        <?php    }
        ?>
            </ul>
            <?php if($loggedIn[0]==true){ ?>
            <ul class="nav pull-right">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'logout')); ?>">Logout (<?php echo $loggedIn[1]; ?>)</a></li>
            </ul>
            <?php } ?>
        </div>
    </div>
</div>