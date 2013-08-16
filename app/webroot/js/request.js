$(document).ready(function(){
$("#request-form").submit(function(){
    $.post($("#request-form").attr('action'),$('#request-form :input').serialize(),function(j){
    	if(j.type=='error'){
    		$.each(j.message,function(i,v){
    			//console.log(i);
                //console.log(v);
    			switch(i){
    				case "song":$("#SongSong").parent().append("<label class='error-message'>"+v[0]+"</label>");
    							$("#SongSong").parent().addClass('error');
    							break;
    				default: break;
    			}
    		});
    		delete_error('.control-group .error-message',5000);
    	}
    	else{
    		$("#alertModalHeader").html("Success");
            $("#alertModalBody").html(j.message);
            $('#alertModal').modal('show');
            $('#modalClose').focus();
            $('#request-form :text').val("");
    	}
    });
    return false;
});
});