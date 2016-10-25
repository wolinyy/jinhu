$(function(){
    myTable.init();
    EditInit();
});

//编辑自定义
function EditInit(){
    $("#username").attr('readonly', true);
    $("#password").removeAttr("required");
    $("#repassword").removeAttr("required");
    $("#password").closest(".form-group").removeClass("require");
    $("#repassword").closest(".form-group").removeClass("require");
    
    $("#password").val("");
    $("#repassword").val("");
}