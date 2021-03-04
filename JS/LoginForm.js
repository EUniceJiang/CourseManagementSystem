//This is Login.php js file

//Login input validate
function validate(){ 
    //Read the values from form and store in variables
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
   
    //Validate email input
    if(email.length < 1){
        alert("Please enter your Email address!")
        return false;
    }

    //Validate Password input
    if(password.length < 1 ){
        alert("Please enter password.");
        return false;
    }
  
}     

//If click "Cancel" button, page will change to Logout.php
$("#cancelbtn").on('click',function(){
    document.location = "./Logout.php";

})