$(document).ready(function(){
    //check admin password is correct or not
    $("#current_pwd").keyup(function(){
        var current_pwd=$("#current_pwd").val();
       //alert(current_pwd);
        $.ajax({
            type:'post',    
            url:'/admin/check-current-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                alert(resp);
                if(resp=="false"){
                 $("#chkCurrentpwd"),html("<font color=red>current passowrd is incorrect</font>");
                }else if(resp=="true"){
                 $("#chkCurrentpwd"),html("<font color=green>current passowrd is correct</font>");
                }
                  
            },
            error:function(){
                alert("error");
            }
        });
    });
});