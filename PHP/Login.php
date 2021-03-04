<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--CSS stylesheet-->
        <link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        
        <!--Bootstrap ICON-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        
        <!--Page Title-->
        <title>Login</title>

    </head>

    <body>
        <div class="container-fluid bg">
            <br><br><br><br><br><br>
            <!--Login Section-->
            <div class="card mx-auto" style="width: 20rem;">
                <!--Login Header-->
                <div class="card-header">
                    <h4>Please Login</h4>        
                </div>

                <!--Login Form-->
                <div class="card-body">
                    <form action="./Login_engine.php" method="post" onsubmit="return validate();">
                    
                        <!--Username-->
                        <div class="form-group">
                            <label>Email Address</label><br>
                            <input class="form-control" name="email" type="text" id="email">
                        </div>
                        
                        <!--Password-->
                        <div class="form-group">
                            <label>Password</label><br>
                            <input class="form-control" name="password" type="password" id="password">
                        </div>
                        
                        <!--Submit Button-->
                        <div class="form-group"> 
                            <input class="btn btn-primary btn-block" type="submit" value="Sign in">
                        </div>         
                        
                        <!--Cancel Button-->
                        <div class="form-group"> 
                            <input class="btn btn-danger btn-block" type="button" value="Cancel" id="cancelbtn">
                        </div>  
                    
                    </form>
                    
                </div>
            </div>
        </div>

        <!-- Latest compiled JavaScript -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script type="text/javascript" src="../JS/LoginForm.js"></script>
    </body>

</html>  
