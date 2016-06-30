<div class="row">
    <div class="col-sm-offset-3 col-sm-6">

        <div class="panel panel-success">
            <div class="panel panel-heading">
                Log In
            </div>

            <div class="panel panel-body">
                <form class="form-horizontal" id="login_form" method="POST" action="verifylogin">
                    <!-- email goes here. -->
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                        </div>
                        <span id="email_error"></span>
                    </div>
                    <!-- enter your password -->
                    <div class="form-group">
                        <label for="passwrod" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <span id="password_error"></span>
                    </div>
                    <!-- sign in button is here. -->
                    <span id="form_error" class="col-sm-offset-2">
                        <!-- <p>Some thing is here.</p> -->
                    </span>
                    <br>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" name="submit" class="btn btn-success">Sign in</button>
                        </div>
                    </div>
                </form>
                <!-- register and forgot password button. -->
                <div class="pull-right">
                    <a href="register"><button class="btn btn-defualt" id="register">Register</button></a>

                    <a href="forgot"><button class="btn btn-defualt" id="forgotpassword">Forgot Password</button></a>
                </div>
            </div>
        </div>
    </div>
</div>