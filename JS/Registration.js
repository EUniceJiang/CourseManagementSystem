//This is Registration page's js file

// Students' registration form input validate
$("#StudentSignupForm").submit(function(){
    //Read the values from form and store in variables
    var studentid = $("#studentID").val();
    var username = $("#StudentName").val();
    var pword = $("#StudentPassword").val();
    var confirmpw = $("#StudentRePassword").val();
    var email = $("#StudentEmail").val();

    //Validate Student Id
    if(studentid.length < 1){
        alert("Please enter your student ID.")
        return false;
    }

    //Validate Username
    if(username.length < 1 ){
        alert("Please enter your name.");
        return false;
    }

    //Validate email
    if(email.length < 1 ){
        alert("Please enter email.");
        return false;
    }
    else{
        var regemail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var validemail = regemail.test(email);
        if(!validemail){
            alert("Please enter your vaild email address");
            return false;
        }
    }

    //Validate Password
    if(pword.length < 1 ){
        alert("Please enter password.");
        return false;
    }
    else{
        var regpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^]).{6,12}$/;
        var vaildpassword = regpassword.test(pword);
        if(!vaildpassword){
            alert("Password needs to be at least 6 characters and less than 12 characters long and contains minimum 1 Uppercase, 1 Lowercase, 1 number and one of following special characters!@#$%^.");
            return false;
        }
    }

    //Validate Confirm Password
    if(confirmpw.length < 1){
        alert("Please re-type the password.");
        return false;
    }
    else{
        if(confirmpw != pword){
            alert("Passwords do not match.");
            return false;
        }
    }
})     
       
// Staff's registration form input validate
$("#StaffSignupForm").submit(function(){
    //Read the values from form and store in variables
    var StaffId = $("#StaffID").val();
    var StaffName = $("#StaffName").val();
    var StaffPassword = $("#StaffPassword").val();
    var StaffConfirmpw = $("#StaffCmpassword").val();
    var StaffEmail = $("#StaffEmail").val();
    var Qualification = $("#Qualification").val();
    var Expertise = $("#Expertise").val();
    var Phone = $("#StaffPhone").val();
    var Role =$("#Role").val();
    

    //Validate Staff ID
    if(StaffId.length < 1){
        alert("Please enter your staff ID.");
        return false;
    }

    //Validate Name
    if(StaffName.length < 1 ){
        alert("Please enter your name.");
        return false;
    }

    //Validate email
    if(StaffEmail.length < 1 ){
        alert("Please enter email.");
        return false;
    }
    else{
        var regemail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var validemail = regemail.test(StaffEmail);
        if(!validemail){
            alert("Please enter your vaild email address");
            return false;
        }
    }

    //Validate Phone Number Input
    if(Phone.length < 1){
        alert("Please enter your phone number.");
        return false;
    }
    
    // Validate Qualification Input
    if(Qualification.length < 1){
        alert("Please enter qualification.");
        return false;
    }

    // Validate Expertise Input
    if(Expertise.length < 1){
        alert("Please enter your expertise.");
        return false;
    }

    // Validate Role Input
    if(Role == "notSelect"){
        alert("Please select your role.");
        return false;
    }
           
                 
    //Validate Password
    if(StaffPassword.length < 1 ){
        alert("Please enter password.");
        return false;
    }
    else{
        var regpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^]).{6,12}$/;
        var vaildpassword = regpassword.test(StaffPassword);
        if(!vaildpassword){
            alert("Password needs to be between 6 and 12 characters long and contains minimum 1 Uppercase, 1 Lowercase, 1 number and one of following special characters!@#$%^.");
            return false;
        }
    }

    //Validate Confirm Password
    if(StaffConfirmpw.length < 1){
        alert("Please re-type the password.");
        return false;
    }
    else{
        if(StaffConfirmpw != StaffPassword){
            alert("Passwords do not match.");
            return false;
        }
    }
})     