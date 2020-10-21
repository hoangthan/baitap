$(document).ready(function() {
var myInput = $("#password");
var letter = $("#letter");
var capital = $("#capital");
var number = $("#number");
var length = $("#length");
var upperCaseLetters = /[A-Z]/g;
var numbers = /[0-9]/g;
var lowerCaseLetters = /[a-z]/g;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
$("#password").on("focus",function(){
    $("#message").css("display","block");
});
$("#password").on("blur",function(){ 
      $("#message").css("display","none");
});
function validatepassword () {

    if(myInput.val().match(lowerCaseLetters)) {  
      letter.removeClass("invalid");
      letter.addClass("valid");
    } else {
      letter.removeClass("valid");
      letter.addClass("invalid");
    }
    
    // Validate capital letters
    if(myInput.val().match(upperCaseLetters)) {  
      capital.removeClass("invalid");
      capital.addClass("valid");
    } else {
      capital.removeClass("valid");
      capital.addClass("invalid");
    }
  
    // Validate numbers
    if(myInput.val().match(numbers)) {  
      number.removeClass("invalid");
      number.addClass("valid");
    } else {
      number.removeClass("valid");
      number.addClass("invalid");
    }
    
    // Validate length
    if(myInput.val().length >= 8) {
      length.removeClass("invalid");
      length.addClass("valid");
    } else {
      length.removeClass("valid");
      length.addClass("invalid");
    }
};
$("#password").on("keyup",function(){
    validatepassword();
});
//gui du lieu len server 
$(".signupbtn").on("click",function(){
    var phone = $("#phone").val();
    var emailsubmit = $("#email").val();
    var addressubmit = $("#address").val();
    var usernamesubmit = $("#username").val();
    var password = $("#password").val();
    var passwordconfirms = $("#passwordconfirms").val();
    var Chucvu = $("#exampleFormControlSelect").val();
    if(!(myInput.val().length  > 8) || !(myInput.val().match(numbers)) || !(myInput.val().match(upperCaseLetters)) || !(myInput.val().match(lowerCaseLetters))) {
        alert(" Mat khau ban nhap chua du manh vui long nhap lai");
    }  else if (password != passwordconfirms)
     {
      alert(" Mat khau phai giong nhau");
    }else {
      var datasigup= {
        'Chucvu':Chucvu,
        'phone': phone,
        'email': emailsubmit,
        'address': addressubmit,
        'username': usernamesubmit,
        'password': password,
        'passwordconfirm': passwordconfirms
        }
      $.ajax({
        url:'sinhvien/getInforStudent',
        type:'POST',
        data: {'json':JSON.stringify(datasigup)},
          success: function (response) {
            if(response.status ==200) { 
              alert("ban da dang ky thanh cong");
              window.location.href =baseUrl+"/login";
             }else {
               alert(" Ten hoac email da duoc su dung ");
             }
        } ,
        error: function (response) {
          alert(response.status);
        }
      })

    }
});

$("#btnlogin").on("click",function(){
  // alert("clicked");
  var uname = $("#studentlogins #uname").val();
  var password = $("#studentlogins #password").val();
  var data = {
    'uname': uname,
    'psw': password
  }
  $.ajax({
    url:'login/loginstudent',
    type:'POST',
    data: {'json':JSON.stringify(data)},
      success: function (response) {
       if(response.status ==200) {
        window.location.href =baseUrl+"/backend/backendmanager";
        
       } else {
         alert(" username or Password not correct ")
       }

    }
  })
})

$("#changepasswords").on("click",function(){
  var myinput1= $("#NewPassword");
  var oldpass= $("#Chanegedpass #oldpassword").val();
  var newpass= $("#Chanegedpass #NewPassword").val();
  var confimnewpass= $("#Chanegedpass #cfNewPassword").val();
  var id    = $("#Chanegedpass #id").val();
  if(!(myinput1.val().length  > 8) || !(myinput1.val().match(numbers)) || !(myinput1.val().match(upperCaseLetters)) || !(myinput1.val().match(lowerCaseLetters))) {
    alert(" Mat khau ban nhap chua du manh vui long nhap lai");
  }
  else if(oldpass==newpass){
    alert("mat khau cu va moi phai khac nhau");
  } else if(newpass != confimnewpass) {
    alert("mat khau moi phai giong nhau ");
  }else {
    var data2 = {
      'id'  : id,
      'oldpass': oldpass,
      'newpass': newpass,
      'confimnewpass':confimnewpass
    }
  }
  $.ajax({
    url:'editpass/editpassword',
    type:'POST',
    data: {'json':JSON.stringify(data2)},
      success: function (response) {
        if(response.status ==200) { 
          alert(" Thay đổi mật khẩu thành công bấm ok để đăng nhập ");
          window.location.href =baseUrl+"/login";
         }else {
           alert("Mật khẩu cũ không chính xác ");
         }

    }
  })


})
});
 