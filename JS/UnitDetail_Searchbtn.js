//This is Unit_Detail.php search button js file

//Search Button
$("#search_button").on("click",function(){  
    var term = $("#search_term").val();

    //Check whether input is blank
    if($("#search_term").val() == ""){
        alert("Nothing input in the search field!");
    }
    else{
        //use Ajax 
        $.ajax({
            url:"../PHP/UnitDetailSearch_engine.php",
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
         
            
