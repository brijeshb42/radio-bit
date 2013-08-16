$(document).ready(function(){
$("#login-form").submit(function(){
	//validate('#reg-form');
    $.post($("#login-form").attr('action'),$('#login-form :input').serialize(),function(j){
    	if(j.type=='error'){
            $("#alertModalHeader").html("Error");
            $("#alertModalBody").html("Invalid username/password combination.");
            $('#alertModal').modal('show');
    	}
        else{
            window.location.reload();
        }
    });
    return false;
});

$("#forgotPass").click(function(){
    $("#alertModalHeader").html("Enter your registered email:");
    var form = '<form action="users/forgot" method="post" id="UserForgotForm" class="form-search"><input type="text" class="input-xlarge" name="data[User][email]" /><button type="submit" class="btn btn-info">Submit</button></form>';
    $("#alertModalBody").html(form);
    $("#alertModal").modal('show');
    return false;
});

$("#UserForgotForm").live("submit",function(){
    $.ajax({
        url: $(this).attr("action"),
        cache: false,
        dataType: "json",
        type: "post",
        success: function(json){
            if(json.type=='success'){
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
    return false;
});

});