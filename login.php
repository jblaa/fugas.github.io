<?php
    //php specific for this page
    $thispage = 'Login';
    require('inc/header.php')
?>

<!--login form-->
    <div class="jumbotron" style="width:60%;margin:auto; padding:2rem">
        <form action="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <legend style="text-align:center;">Enter your login details</legend><hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                </div><br>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div><br>
            </fieldset>
            <div class="container" style="text-align:center;">
                <input type="submit" name="login" value="Login" class="btn btn-primary btn-lg">
                <hr>
                <a href="signup.php">Don't have a login? Sign up.</a>
            </div>
        </form>
    </div>


<?php require('inc/footer.php') ?>