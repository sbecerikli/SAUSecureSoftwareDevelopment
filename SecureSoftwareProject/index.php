<?php
session_start();
session_unset();
include_once 'scripts/token.php';
include 'header.php';
include 'navbar.php';
?>
<div class="container-fluid">
    <title>Login</title>
    <!-- Page Content  -->
    <div class="row justify-content-center">
        <div class="col-11 col-md-6">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11 col-md-6">
            <form method="POST" action="scripts/login.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="Username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <p>If you don't have an account. <a href="register.php">Click Here.</a> </p>
                    
                </div> 
                <button type="submit" name="login" class="btn btn-primary">login</button>
                <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
                  
            </form>
            <form method="POST" action="register.php">
                
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>