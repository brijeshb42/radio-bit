function getStatus(s,id){
	if(s==1){
		return '<div class="btn-group playlist-btn-bar"><button class="btn btn-info">Completed</button></div>';
	}else{
		return '<div class="btn-group playlist-btn-bar"><button class="btn btn-warning">Pending</button><a class="btn editSong" href="songs/edit/'+id+'">Edit</a><a class="btn deleteSong" href="songs/delete/'+id+'">Delete</a>';
	}
}

function modifyPlaylist(songs){
	var ul = $("#play-list");
	ul.html("");
	if(songs.length==0){
		$("#play-list").html('<li style="color:#000" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-e"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" class="ui-link-inherit"><h3 class="ui-li-heading">Your playlist is empty.</h3></a></div></div></li>');
	}
	else{
	for(var i=0;i<songs.length;i++){
		var a='<li id="userSong'+songs[i].Song.id+'" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li">';
		a=a+'<div class="ui-btn-inner ui-li"><div class="ui-btn-text">';
		a=a+getStatus(songs[i].Song.status,songs[i].Song.id);
		if(songs[i].User){
			a=a+'<a class="btn playnextSong" href="songs/playnext/'+songs[i].Song.id+'">Play Next</a></div>';
		}else{
			a=a+'</div>';
		}
		a=a+'<a href="#" onclick="return false" class="ui-link-inherit"><!--<p class="ui-li-aside ui-li-desc"><strong>6:24</strong>PM</p>--><h3 class="ui-li-heading">'+songs[i].Song.song;
		if(songs[i].Song.dedicate_to!=""){
			a=a+' <em>(for '+songs[i].Song.dedicate_to+')</em>';
		}
		if(songs[i].User){
			a=a+' <em> by '+songs[i].User.username+'</em>';
		}
		a=a+'</h3>';
		if(songs[i].Song.album!=""){
			a=a+'<p class="ui-li-desc"><strong>'+songs[i].Song.album+'</strong></p>';
		}
		if(songs[i].Song.message!=""){
			a=a+'<p class="ui-li-desc">'+songs[i].Song.message+'</p>';
		}
		a=a+'</a></div></div></li>';
		ul.append(a);
	}
	}
}

function refreshList(link){
	$("#play-list").html('<li style="color:#000" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-e"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" class="ui-link-inherit"><h3 class="ui-li-heading">Refreshing Playlist...</h3></a></div></div></li>');
		$.ajax({
			url: link,
			cache: false,
			dataType: "json",
			success: function(json){
				if(json.type=='success'){
					modifyPlaylist(json.message);
					$('.pager').html("");
					if(json.next)
						$('.pager').append(json.next);
					if (json.previous){
						$('.pager').append(json.previous);
					}
				}
				else{
					alert('There was an error.');
				}
			},
			error: function(){
				alert("There was some error while fetching songs from server.");
			}
		});
}

function getEditForm(link){
	$.ajax({
		url: link,
		cache: false,
		dataType: "html",
		success: function(html){
			$("#editSongDiv .modal-body").html(html);
			$("#editSongDiv").modal("show");
		},
		error: function(){
			alert("There was some error while fetching songs from server.");
		}
	});
}

function deleteSong(link,e){
	$.ajax({
		url: link,
		cache: false,
		dataType: "json",
		type: "post",
		success: function(json){
			if(json.type=='success'){
				e.parent().parent().parent().parent().remove();
				$("#alertModalHeader").html("Success");
           		$("#alertModalBody").html(json.message);
           		$('#alertModal').modal('show');
           	}else{
           		alert(json.message);
           	}
		},
		error: function(){
			alert("There was some error while fetching songs from server.");
		}
	});
}

$(document).ready(function(){

	$("#editDivClose").live("click",function(){
		$("#editSongDiv").modal("hide");
		return false;
	});

	$("#refreshPlaylist").live("click",function(){
		refreshList($(this).attr("href"));
		return false;
	});

	$("#customSong").live("click",function(){
		getEditForm($(this).attr("href"));
		return false;
	});

	$("#customSong").live("mouseover",function(){
		$(this).addClass("ui-btn-down-b");
	});

	$("#customSong").live("mouseout",function(){
		$(this).removeClass("ui-btn-down-b");
	});

	$("#refreshPlaylist").live("mouseover",function(){
		$(this).addClass("ui-btn-down-b");
	});

	$("#refreshPlaylist").live("mouseout",function(){
		$(this).removeClass("ui-btn-down-b");
	});

	$(".pager .next a").live("click",function(){
		refreshList($(this).attr("href"));
		return false;
	});
	$(".pager .previous a").live("click",function(){
		refreshList($(this).attr("href"));
		return false;
	});

	$('a.editSong').live("click",function(){
		var url = $(this).attr("href");
		getEditForm(url);
		return false;
	});

	$('a.playnextSong').live("click",function(){
		var url = $(this).attr("href");
		getEditForm(url);
		return false;
	});

	$('a.deleteSong').live("click",function(){
		var url = $(this).attr("href");
		if(confirm("Are you sure you want to delete this request??")){
			deleteSong(url,$(this));
		}
		return false;
	});

	$("#editSongDiv").modal({
		"show":false,
    	"backdrop":false,
    	"keyboard":true
	});

	/*$('#play-list li').live("mouseover",function(){
		$(this).find('.playlist-btn-bar').show();
	});

	$('#play-list li').live("mouseout",function(){
		$(this).find('.playlist-btn-bar').hide();
	});*/

});