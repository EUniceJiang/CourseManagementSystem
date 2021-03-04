//This is 5 buttons' js file (include myaccount, Register, Sign in, logout, staffmyaccount buttons)

//Login Button
$("#loginbtn").on('click',function(){
    document.location = "./Login.php";

})

//Register Button
$("#registerbtn").on('click',function(){
    document.location = "./Registration.php";

})

//Myaccount button for student
$("#myaccountbtn").on('click',function(){
    document.location = "./UserAccount.php";
})

//Logout Button
$("#logoutbtn").on('click',function(){
    document.location = "./Logout.php";
})

//Myaccount button for staff
$("#staffmyaccountbtn").on('click',function(){
    document.location = "./StaffUserAccount.php";
})


          

      




