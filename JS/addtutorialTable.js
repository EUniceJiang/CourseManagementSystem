//This is AllocateTeachingStaff.php page js file, is for "Add New Tutorial Class" form input validate

$("#addtutorialTable").submit(function(){
    //Read the values from form and store in variables
    var unitcode = $("#unitcode").val();
    var unitname = $("#unitname").val();
    var Activity = $("#Activity").val();
    var Tutor = $("#Tutor").val();
    var Capacity = $("#Capacity").val();
    var Start_time = $("#Start_time").val();
    var End_time = $("#End_time").val();
    var Day = $("#Day").val();
    var Campus =$("#Campus").val();
    var Location = $("#Location").val();
    var Description =$("#Description").val();
    

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

    //Validate activity input
    if(Activity.length < 1 ){
        alert("Please enter Activity.");
        return false;
    }
  
    //Validate tutor selection box
    if(Tutor == "notselect"){
        alert("Please select a tutor!");
        return false;
    }

    //Validate capacity input
    if(Capacity.length < 1 ){
        alert("Please enter the max number of students can allocate.");
        return false;
    }else{
        //Limit to only number input
        var regCapacity = /^[0-9]+$/;
        var vaildCapacity = regCapacity.test(Capacity);
        if(!vaildCapacity){
            alert("Only enter number");
            return false;
        }
    }

    //Validate Start time selection box select
    if(Start_time == "notselect" ){
        alert("Please select the start time.");
        return false;
    }

    //Validate End time selection box select
    if(End_time == "notselect"){
        alert("Please select the end time.");
        return false;
    }

    //Validate day selection box select
    if(Day == "notselect" ){
        alert("Please select a Day.");
        return false;
    }

    //Validate Campus selection box select
    if(Campus == "notselect"){
        alert("Please select a Campus.");
        return false;
    }

    //Validate location input
    if(Location.length < 1 ){
        alert("Please enter location.");
        return false;
    }

    //Validate description input
    if(Description.length < 1 ){
        alert("Please enter Description.");
        return false;
    }
  
})     