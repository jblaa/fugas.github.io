<?php
    //php specific for this page
    $thispage = 'Create Account';
    require('inc/header.php')
?>

<!--signup form-->
<div class="jumbotron" style="width:60%;margin:auto; padding:2rem">
        <form action="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <legend style="text-align:center;">Sign up for F U Gas</legend><hr>
                <div class="email_entry">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                </div><br>
                <div class="username_entry">
                    <label for="username">Your Screen Name</label>
                    <input type="text" class="form-control" id="username" aria-describedby="" placeholder="Enter Screen Name" name="username">
                </div><br>
                <div class="firstname_entry">
                    <label for="f_name">First Name</label>
                    <input type="text" class="form-control" id="f_name" aria-describedby="" placeholder="Enter First Name" name="f_name">
                </div><br>
                <div class="lastname_entry">
                    <label for="l_name">Last Name</label>
                    <input type="text" class="form-control" id="l_name" aria-describedby="" placeholder="Enter Last Name" name="l_name">
                </div><br><br>
                <div class="pass_1_entry">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass_1">
                </div><br>
                <div class="pass_2_entry">
                    <label for="exampleInputPassword1">RE-ENTER Your Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass_2">
                </div><br>
            </fieldset>
            <div class="container" style="text-align:center;">
                <input type="submit" name="signup" value="Sign Up" class="btn btn-primary btn-lg">
                <hr>
                <a href="login.php">Already registered? Log in.</a>
            </div>
        </form>
    </div>

<?php require('inc/footer.php') ?>