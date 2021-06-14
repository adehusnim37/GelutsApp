const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".input-field"),
    // sendBtn = form.querySelector("button"),
    sendBtn =document.getElementById('send');
    chatBox = document.querySelector(".chat-box");
    attachment= document.getElementById('attachment');
form.onsubmit=(e)=>{
    e.preventDefault();
}



sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";// setelah input di db, akan reset kosong field chat
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}


chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}


setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ //jika tidak aktif maka langsung scroll ke bawah
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
},500); //refresh otomatis 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}


const dropArea = document.querySelector(".drag-area"),
dragText = document.getElementById("file_message"),
input_label= document.getElementById('browse_file'),
input = document.getElementById("filename");
fileselected = document.getElementById("file_selected");


let file; //this is a global variable and we'll use it inside multiple functions
input_label.onclick = ()=>{
  input.click(); //if user click on the button then the input also clicked
}

input.onchange = function(){

fileselected.hidden = false;
input_label.innerHTML= "Want to Select different File";
fileselected.innerHTML ="File Selected: " + input.files[0].name;
};


input.addEventListener("change", function(){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = this.files[0];
  dropArea.classList.add("active");
//   showFile(); //calling function
});
//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
});
//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
});
//If user drop File on DropArea
dropArea.addEventListener("drop", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
//   file = event.dataTransfer.files[0];
//   showFile(); //calling function
});



$(document).ready(function(){
    $(document).on('submit', '#file_form', function(event){
        var fileinput=$('#filename').val();
        
        //alert (proj_img_2);
        if (fileinput=="" ){
          if(confirm("No File selected to update. Do you still want to close this Window?")){
              $('#file_form')[0].reset();
              $('#attachmentModal').modal('hide');
              location.reload();

          }
        }else{
           
          $.ajax({
            url: "php/share.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                alert(data);

              //    $('#file_form')[0].reset();
             // $('#attachmentModal').modal('hide');
          //    location.reload();
            }
          });
        }
           


    });

   /* $('#add_user').click(function(){
      var form_data = $(this).serialize();
      $.ajax({
      url: "php/fetch_group_users.php",  
      method:"POST",
      data:form_data,
      dataType:"json",
        success:function(data){
        $('#projectModal').modal('show');
        $('#project_name').val(data.project_name);
        $('#project_address').val(data.project_address);
        $('#project_type').val(data.project_type);
        $('#project_status').val(data.project_status);
        $('#project_comment').val(data.project_comment);
        $('.modal-title').text("Edit Project Details");
        $('#projectid').val(id);
        $('#action').val('Edit');
        $('#operation').val('Edit');

      }
    });
    
  });*/

  //   $(document).on('submit', '#add_user_form', function(event){
      
  //     var fld = document.getElementById('user_select[]');
  //     var values = [];
  //     for (var i = 0; i < fld.options.length; i++) {
  //       if (fld.options[i].selected) {
  //         values.push(fld.options[i].value);
  //       }
  //     }
  //     if (values=="" ){
  //       alert("No User Selected");
  //     }else{
  //       $.ajax({
  //         url: "php/group_add_users.php",
  //         method: "POST",
  //         data: {
  //           user_id: $('user_id').val(),
  //           // group_id: $('user_id').val(),
  //           // user_select: values
  //         },
  //         // dataType:"json",
  //         contentType: false,
  //         cache: false,
  //         processData:false,
  //         success: function(data){
  //             alert(data);

  //           //    $('#file_form')[0].reset();
  //          // $('#attachmentModal').modal('hide');
  //       //    location.reload();
  //         }
  //       });
  //     }
         


  // });
});