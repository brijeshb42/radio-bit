$(document).ready(function(){
	$("#editFormSubmit").live("click",function(){
		var aj = $.ajax({
			url: $("#SongEditForm").attr("action"),
			cache: false,
			data: $("#SongEditForm :input").serialize(),
			type: "post",
			dataType: "json",
			success: function(json){
				$("#editSongDiv").modal("hide");
				if(json.type=='success'){
					refreshList('songs/playlist');
					$("#alertModalHeader").html("Success");
            		$("#alertModalBody").html(json.message);
            		$('#alertModal').modal('show');
				}
				else{
					alert(json.message);
				}
			},
			error: function(){
				alert("There was some error while fetching songs from server.");
			}
		});
		return false;
	});
	$("#playnextFormSubmit").live("click",function(){
		var aj = $.ajax({
			url: $("#SongPlaynextForm").attr("action"),
			cache: false,
			data: $("#SongPlaynextForm :input").serialize(),
			type: "post",
			dataType: "json",
			success: function(json){
				$("#editSongDiv").modal("hide");
				if(json.type=='success'){
					//refreshList('songs/playlist');
					$("#alertModalHeader").html("Success");
            		$("#alertModalBody").html(json.message);
            		$('#alertModal').modal('show');
				}
				else{
					alert(json.message);
				}
			},
			error: function(){
				alert("There was some error while fetching songs from server.");
			}
		});
		return false;
	});
});