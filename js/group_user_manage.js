$(document).ready(function(){
     $(document).on('submit', '#add_user_form', function(event){
         event.preventDefault();
          var assign_user=$('#user_select').val();
          
           var form_data = $(this).serialize();

          
          if(assign_user!=""){
            $.ajax({
              url: "php/group_user_manage.php?action='add'",
              method: "POST",
              data:form_data,
              success: function(data){
                alert(data);
                $('#add_user_form')[0].reset();
                $('#userModal').modal('hide');
                location.reload();
              }
            });
          }else{
            alert("Select a User");
          }
      });
      /*
      $('#userModal').on('show.bs.modal', function() {
        
        $('#assign_form')[0].reset();
          $('#assign_user').val('');
           $('#project_comment').val('');
           $('.modal-title').text("Assign Project");
                   
      });
      
*/  
  
    });
    function delete_user(id){
      if(confirm("Are you sure you want to delete this?")){
              
              $.ajax({
                url:"php/group_user_manage.php?action='delete'",
                method:"POST",
                data:{id:id, action:"delete"},
                success: function(data){
                  alert(data);
                  location.reload();
                }
              });
            }else{
              return false;
            }
      }
  
      
  
      
  