
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">

        <div class="panel panel-success">
            <div class="panel panel-heading">
                Sign Up
            </div>

            <div class="panel panel-body">
                <form class="form-horizontal" method="POST" id="register_form" action="verifyregister">
                    <!-- name goes here. -->
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required autofocus>
                        </div>
                        <span id="name_error"></span>
                    </div> 

                    <!-- email goes here. -->
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                        </div>
                        <span id="email_error"></span>
                    </div>


                     <!-- mobile number goes here. -->
                    <div class="form-group">
                        <label for="mobileno" class="col-sm-2 control-label">Mobile No.</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="mobileno" name="mobileno" placeholder="Mobile No (10 digits)" required autofocus>
                        </div>
                        <span id="mobileno_error"></span>
                    </div> 
                    
                    <!-- enter your password -->
                    <div class="form-group">
                        <label for="passwrod" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password (Minimum 6 characters)">
                        </div>
                        <span id="password_error"></span>
                    </div>

                     <!-- confirm password goes here. -->
                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required autofocus>
                        </div>
                        <span id="confirm_password_error"></span>
                    </div> 

                    <!-- sign in button is here. -->
                    <span id="form_error" class="col-sm-offset-2">
                        <!-- <p>Some thing is here.</p> -->
                    </span>
                    <br>
                    <br>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" name="submit" class="btn btn-success">Sign in</button>
                            <div class="pull-right">
                                Already have account <button class="btn btn-defualt" id="login"><a href="login">Login</a></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>