/*const form = document.querySelector(".form"),
//const form= document.getElementById('group_create_section');
  continueBtn = form.querySelector(".button input"),
     errorText = form.querySelector(".error-txt");
    // continueBtn=document.getElementById('submit');
    // errorText=document.getElementById('error-txt');

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    //let's start Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/group_create.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";

                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}*/



$(document).ready(function(){
    $(document).on('submit', '#group_form', function(event){
        event.preventDefault();
        var group_name =$('#group_name').val();
        var image=$('#image').val();
        //alert (proj_img_2);
        if (group_name==""){
            alert ("Kindly input Group Name");
        }else if(image==""){
            alert ("Kindly select Group Image");
        }else{
            $.ajax({
            url: "php/group_create.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            dataType:"json",
            cache: false,
            processData:false,
            success: function(data){
               alert(data.message);
               if(data.group_id!=''){
                    window.location="group_user_manage.php?group_id="+data.group_id;  
               }
               
            }   
          });
        }
           


    });
});