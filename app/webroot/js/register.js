function validate(f){
	//alert($(f+' :text').val());
}
function toCamel(s){
	s[0] = s[0].toUpperCase();
	return s;
}
$(document).ready(function(){
$("#reg-form").submit(function(){
	//validate('#reg-form');
    $.post($("#reg-form").attr('action'),$('#reg-form :input').serialize(),function(j){
    	if(j.type=='error'){
            //$("#alertModalHeader").html("Error");
            //$("#alertModal .modal-body").html("<table class='table'></table>");
    		$.each(j.message,function(i,v){
    			//console.log(i);console.log(v);
    			switch(i){
    				case "username":$("#UserUsername").parent().append("<label class='error-message'>"+v[0]+"</label>");
                                    //$("#alertModal .modal-body table").append("<tr><td>"+i+"</td><td>"+v[0]+"</td></tr>");
                                    $("#UserUsername").parent().addClass('error');
    								break;
    				case "email":$("#UserEmail").parent().append("<label class='error-message'>"+v[0]+"</label>");
    							//$("#alertModal .modal-body ul").append("<tr><td>"+i+"</td><td>"+v[0]+"</td></tr>");
                                $("#UserEmail").parent().addClass('error');
    							break;
                    case "name":$("#UserName").parent().append("<label class='error-message'>"+v[0]+"</label>");
                                //$("#alertModal .modal-body ul").append("<tr><td>"+i+"</td><td>"+v[0]+"</td></tr>");
                                $("#UserName").parent().addClass('error');
                                break;
    				case "password":$("#UserPassword").parent().append("<label class='error-message'>"+v[0]+"</label>");
    							//$("#alertModal .modal-body ul").append("<tr><td>"+i+"</td><td>"+v[0]+"</td></tr>");
                                $("#UserPassword").parent().addClass('error');
                                $("#UserConfirmPassword").parent().append("<label class='error-message'>"+v[0]+"</label>");
                                $("#UserConfirmPassword").parent().addClass('error');
    							break;
    				default: break;
    			}
    		});
            //$("#alertModal").removeClass('hide');
    		delete_error('.control-group .error-message',5000);
    	}
    	else{
    		$('#form-div').addClass("hero-unit");
    		$('#form-div').html("<div class='alert alert-success'>"+j.message+"</div>");
            $("#alertModalHeader").html("Success");
            $("#alertModalBody").html(j.message);
            $('#alertModal').modal('show');
    	}
    });
    return false;
});
});