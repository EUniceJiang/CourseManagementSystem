//This file is about Student Myaccount page 

//Using Tabledit plugin to update personal information
$(document).ready(function(){
    $('#useraccount_table').Tabledit({
        url:'../PHP/UserAccount_engine.php',
        restoreButton:false,
        eventType:'dblclick',
        deleteButton:false,
        editButton:true,
        columns:{
            identifier:[0,'user_id'],
            editable:[
                [1,'user_name'],
                [2,'Email'],
                [3,'Phone'],
                [4,'dob'],
                
            ]
        },
        buttons: {
            edit: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fas fa-edit"></span>',
                action: 'edit'
            },
        },
            
    
    });
 
      
});

//Change Password form validate
function validate(){ 
    //Read the values from form and store in variables
    var NewPassword = document.getElementById("NewPassword").value;
   
    //Validate Password
    if(NewPassword.length < 1 ){
        alert("Please enter the new password.");
        return false;
    }
    else{
        var regpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^]).{6,12}$/;
        var vaildpassword = regpassword.test(NewPassword);
        if(!vaildpassword){
            alert("Password needs to be at least 6 characters and less than 12 characters long and contains minimum 1 Uppercase, 1 Lowercase, 1 number and one of following special characters!@#$%^.");
            return false;
        }
    }
  
}  
    
