//This function checks email-availability-status
function checkPsw() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_password.php",
data:'old_psw='+$("#old_psw").val(),
type: "POST",
success:function(data){
$("#old_psw-status").html(data);
$("#loaderIcon").hide();

},
error:function (){}
});

}

function check_pass(){
    if(document.getElementById('new_psw').value == document.getElementById('cfm_psw').value){
        document.getElementById('submit').disabled = false;
        document.getElementById('msg').innerHTML = '';
    }else{ 
        document.getElementById('msg').style.color = 'red';
        document.getElementById('msg').innerHTML = 'password does no match';
        document.getElementById('submit').disabled = true;
    }
}
