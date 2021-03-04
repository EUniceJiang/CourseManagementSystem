//This is Student_Management.php page's js

$("#Unitbtn").on("click",function(){
    $("#UnitList").css("display","block");
    $("#TutorialList").css("display","none");              
})

$("#Tutorialbtn").on("click",function(){
    $("#TutorialList").css("display","block");
    $("#UnitList").css("display","none");                                            
})