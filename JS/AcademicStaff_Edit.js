//This file is about academic staff master page (Academic_Staff.php) edit, detele, or add a staff function. And also include search staff function 

$(document).ready(function(){
    //Academic Staff information edit or delete function, use Tabledit plugin
    $('#AcademicStaff_table').Tabledit({
        url:'../PHP/AcademicStaffEdit_engine.php',
        restoreButton:false,
        eventType:'dblclick',
        deleteButton:true,
        editButton:true,
        columns:{
            identifier:[0,'user_id'],
            editable:[
                [1,'user_name'],
                [2,'Email'],
                [3,'Qualification'],
                [4,'Expertise'],
                [5,'Consultation'],
                [6,'Teach_Unit'],
                [7,'Role_Level']
            ]
        },
        buttons: {
            edit: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fas fa-edit"></span>',
                action: 'edit'
            },
            delete: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fas fa-eraser"></span>',
                action: 'delete'
            },
                
        },               

    });


});

// Add a new staff button function, the input validate
function formvalidate(){ 
    //Read the values from form and store in variables
    var username = document.getElementById("user_name").value;
    var userid = document.getElementById("user_id").value;
    var Email = document.getElementById("Email").value;
    var Qualification = document.getElementById("Qualification").value;
    var Expertise = document.getElementById("Expertise").value;
    var Role = document.getElementById("Role").value;
   
    //Validate staff name input
    if(username.length < 1){
        alert("Please enter name.")
        return false;
    }

    //Validate staff ID input
    if(userid.length < 1 ){
        alert("Please enter staff ID.");
        return false;
    }

    //Validate staff Email input and check email format
    if(Email.length < 1 ){
        alert("Please enter Email address.");
        return false;
    }else {
        var regemail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var validemail = regemail.test(Email);
        if(!validemail){
            alert("Please enter a vaild email address");
            return false;
        }
    }

    //Validate staff qualification input
    if(Qualification.length < 1 ){
        alert("Please enter staff's qualification.");
        return false;
    }
  
    //Validate staff expertise input
    if(Expertise.length < 1 ){
        alert("Please input staff's expertise information.");
        return false;
    }


    //Validate staff role input
    if(Role == "notSelect"){
        alert("Please select staff role.");
        return false;
    }
  
}     


//Search form 
$("#search_button").on("click",function(){  
    var term = $("#search_term").val();

    //check whether input is blank
    if($("#search_term").val() == ""){
        alert("Nothing input in the search field!");
    }
    else{
        //use Ajax 
        $.ajax({
            url:"../PHP/AcademicStaffSearch_engine.php",
            type:"GET",
            data:{search_term: term},
            dataType:"html",
            cache:false,

            success:function(output){
                if (output == 'No'){
                    alert ("Nothing found!");
                }else{
                    $("#search_output").html(output);
                    
                                
                }
            }

        })
    }
})
         
//Search result will become invisible after click close button
$("#close_button").on("click",function(){
    $("#search_output").css("display","none");      
})

