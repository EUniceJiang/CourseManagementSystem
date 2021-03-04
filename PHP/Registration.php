<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Required meta tages-->
        <meta charset="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=0">
        
        <!--CSS stylesheet-->
        <link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">

        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Bootstrap ICON-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        
        <title>Register</title>

    </head>

    <body>            
        <!--Navigation Bar-->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <!--Brand Icon-->
            <a class="navbar-brand" href="#">DoWell</a>

            <!--Collapse Button-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./Home.php">Home</a>
                    </li>
                </ul>

                <!--Login and Register button-->
                <ul class="nav navbar-nav ml-auto">
                    <li>
                        <button class="btn btn-dark" type="button" id="loginbtn"><i class="fas fa-sign-in-alt"></i> Log in</button>
                    </li>

                    <li>
                        <button class="btn btn-dark" type="button" id="registerbtn"><i class="fa fa-user-plus"></i> Register</button>
                    </li> 
                </ul>
            </div>  
        </nav>
        
        <!--Main Content(Sign Up)-->
        <div class="container-fluid bg">
            <br>          
            <div class="card w-50 mx-auto">
                <!--Sign Up Header-->
                <div class="card-header">
                    <h3 class="Message">Creat Account</h3>
                    <h4 class="Message">Please fill in this form to crate an account.</h4>
                </div>
      
                <div class="card-body">
                    <!--Set Two Tabs(Student&Staff)-->
                    <ul class="nav nav-tabs" id="registerTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true">Register as Student</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="staff-tab" data-toggle="tab" href="#staff" role="tab" aria-controls="staff" aria-selected="false">Register as Staff</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="registerTabContent">
                        <!--Student Signup Panel-->
                        <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
                            <!--Student Signup Form-->
                            <form id="StudentSignupForm" method="post" action="StudentRegister_engine.php">
                                <div class="form-group">
                                    <div class="row">
                                        <!--Stundet ID Input-->
                                        <div class="col">
                                            <label>Student ID:</label><span style="color: red;">*</span><br>
                                            <input class="form-control" name="studentID" type="text" id="studentID">
                                        </div>
                                        
                                        <!--Stundet Name Input-->
                                        <div class="col">
                                            <label>Name:</label><span style="color: red;">*</span><br>
                                            <input class="form-control" name="StudentName" type="text" id="StudentName">
                                        </div> 
                                    </div>
                                </div>
                                
                                <!--Stundet Email Input-->
                                <div class="form-group">
                                    <label>Email: </label><span style="color: red;">*</span><br>
                                    <input class="form-control" name="StudentEmail" type="text" id="StudentEmail">
                                </div>
                                
                                <!--Stundet Address Input-->
                                <div class="form-group">
                                    <label>Address: </label><br>
                                    <input class="form-control" name="Address" type="text" id="Address">
                                </div>

                                <!--City Input-->
                                <div class="form-group">
                                    <label>City: </label><br>
                                    <input class="form-control" name="City" type="text" id="City">
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <!--State Input-->
                                        <div class="col">
                                            <label>State: </label><br>
                                            <input class="form-control" name="State" type="text" id="State">
                                        </div>

                                        <!--Zip Input-->
                                        <div class="col">
                                            <label>ZIP/Postal Code: </label><br>
                                            <input class="form-control" name="Zip" type="text" id="Zip">
                                        </div> 
                                    </div>
                                </div>           
                                
                                <!--Student Phone Number Input-->
                                <div class="form-group">
                                    <label>Phone Number: </label><br>
                                    <input class="form-control" name="Phone" type="text" id="Phone">   
                                </div>

                                <!--Student Date of Birth Input-->
                                <div class="form-group">
                                    <label>Date of Birth </label><br>
                                    <input class="form-control" name="DOB" type="text" id="DOB">
                                </div>

                                <!--Student Login Password Input-->
                                <div class="form-group">
                                    <label>Password:</label><span style="color: red;">*</span><br>
                                    <input class="form-control" name="StudentPassword" type="Password" id="StudentPassword">
                                </div>

                                <!--Student Password Confirm Input-->
                                <div class="form-group">
                                    <label>Confirm password:</label><span style="color: red;">*</span><br>
                                    <input class="form-control" name="StudentRePassword" type="Password" id="StudentRePassword">
                                </div>
                                
                                <!--Sign In Button-->
                                <div class="form-group"> 
                                    <input class="btn btn-primary" type="submit" value="Sign in">
                                </div>                    
                            </form>
                        </div>

                        <!--Staff Signup Panel-->
                        <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
                            <!--Staff Signup Form-->
                            <form id="StaffSignupForm" method="post" action="StaffRegister_engine.php">                          
                                <div class="form-group">
                                    <div class="row">
                                        <!--Staff ID Input-->
                                        <div class="col">
                                            <label>Staff ID:</label><br>
                                            <input class="form-control" name="StaffID" type="text" id="StaffID">
                                        </div>

                                        <!--Staff Name Input-->
                                        <div class="col">
                                            <label>Name:</label><br>
                                            <input class="form-control" name="StaffName" type="text" id="StaffName">
                                        </div> 
                                    </div>
                                </div>  

                                <!--Staff Email Input-->
                                <div class="form-group">
                                    <label>Email: </label><br>
                                    <input class="form-control" name="StaffEmail" type="text" id="StaffEmail">                     
                                </div>
                                
                                <!--Staff Address Input-->
                                <div class="form-group">
                                    Address:<br>
                                    <input class="form-control" name="StaffAddress" type="text" id="StaffAddress">                 
                                </div>

                                <!--City Input-->
                                <div class="form-group">
                                    City: <br>
                                    <input class="form-control" name="City" type="text" id="City">
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <!--State Input-->
                                        <div class="col">
                                            State: <br>
                                            <input class="form-control" name="State" type="text" id="State">
                                        </div>

                                        <!--Zip Input-->
                                        <div class="col">
                                            ZIP/Postal Code:<br>
                                            <input class="form-control" name="Zip" type="text" id="Zip">
                                        </div> 
                                    </div>
                                </div>      

                                <!--Staff Phone Number Input-->
                                <div class="form-group">
                                    <label>Phone Number: </label><br>  
                                    <input class="form-control" name="StaffPhone" type="text" id="StaffPhone">                 
                                </div>

                                <!--Staff Date of Birth Input-->
                                <div class="form-group">
                                    Date of Birth: <br>
                                    <input class="form-control" name="StaffDOB" type="text" id="StaffDOB">               
                                </div>

                                <!--Staff Qualification Input-->
                                <div class="form-group">
                                    <label>Qualification: </label><br>
                                    <input class="form-control" name="Qualification" type="text" id="Qualification" placeholder="e.g:PhD">
                                            
                                </div>

                                <!--Staff Expertise Input-->
                                <div class="form-group">
                                    <label>Expertise: </label><br>
                                    <input class="form-control" name="Expertise" type="text" id="Expertise" placeholder="eg:Information Systems">
                                </div>

                                <!--Staff Role Selection Box-->
                                <div class="form-group">
                                    <label>Role: </label>
                                    <select class="form-control" name="Role" type="text" id="Role">
                                        <option value ="notSelect">No Select</option>
                                        <option value="DC">DC</option>
                                        <option value="UC">UC</option>
                                        <option value="Lecturer">Lecturer</option>
                                        <option value="Tutor">Tutor</option>
                                    </select>
                                </div>

                                <!--Staff Login Password Input-->
                                <div class="form-group">
                                    <label>Password:</label><br>
                                    <input class="form-control" name="StaffPassword" type="password" id="StaffPassword">
                                </div>

                                <!--Staff Password Confirm Input-->
                                <div class="form-group">
                                    <label>Confirm password:</label><br>
                                    <input class="form-control" name="StaffCmpassword" type="password" id="StaffCmpassword">
                                </div>

                                <!--Staff Sign in Submit Button-->
                                <div class="form-group"> 
                                    <input class="btn btn-primary" type="submit" value="Sign in">
                                </div>                
                            </form>
                        </div>  
                    </div>
                </div>
            </div>     
        </div>

        <!-- Footer -->
        <?php include('Footer.php'); ?>
        


        <!--Optional JavaScript-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--Use external js files for sign up form validate and other button function-->
        <script type="text/javascript" src="../JS/Registration.js"></script>
        <script type="text/javascript" src="../JS/buttons.js"></script>
    </body>
    
</html>