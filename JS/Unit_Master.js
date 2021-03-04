//This file is about the Unit_Management some buttons' functions and form validate

// Add a new unit button form input validate
function formvalidate(){ 
    //Read the values from form and store in variables
    var unitcode = document.getElementById("unitcode").value;
    var unitname = document.getElementById("unitname").value;
    var unitcoordinator = document.getElementById("unitcoordinator").value;
    var semester = document.getElementById("semester").value;
    var campus = document.getElementById("campus").value;
   
    //Validate Unit code input
    if(unitcode.length < 1){
        alert("Please enter unit code.")
        return false;
    }

    //Validate unit name input
    if(unitname.length < 1 ){
        alert("Please enter unit name.");
        return false;
    }

    //Validate unit coordinator input
    if(unitcoordinator.length < 1 ){
        alert("Please enter unit coordinator.");
        return false;
    }
  
    //Validate semester input
    if(semester.length < 1 ){
        alert("Please enter semester.");
        return false;
    }

    //Validate campus input
    if(campus.length < 1 ){
        alert("Please enter campus.");
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
            url:"../PHP/UnitManagementSearch_engine.php",
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

