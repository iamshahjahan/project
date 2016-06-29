<!-- 
<h1>Ask and Answer</h1>
<h2>Login</h2>
<?php echo validation_errors(); //display errors if redirect from verifylogin?> 
<?php echo form_open('verifylogin'); ?>
<label for="email">Email:</label>
<input type="email" size="20" id="email" name="email"/> email validation not working at application level
<br/>
<label for="password">Password:</label>
<input type="password" size="20" id="password" name="password"/>
<br/>
<input type="submit" value="Login"/>
<a href="forgot">Forgot Password</a>
<br><br>
<a href="register">Register</a>
</form>
-->
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">

        <div class="panel panel-success">
            <div class="panel panel-heading">
                Log In
            </div>

            <div class="panel panel-body">
                <form class="form-horizontal">
                    <!-- email goes here. -->
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <!-- enter your password -->
                    <div class="form-group">
                        <label for="passwrod" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <!-- sign in button is here. -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" class="btn btn-success">Sign in</button>
                            <div class="pull-right">
                                <button class="btn btn-defualt" id="register"><a href="register">Register</a></button>

                                <button class="btn btn-defualt" id="forgotpassword"><a href="forgot">Forgot Password</a></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>