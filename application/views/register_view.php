
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
                    </div> 

                    <div class="row">
                        <div  class="col-sm-offset-2" id="name_error"></div>
                    </div>
                    <!-- email goes here. -->
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="col-sm-offset-2" id="email_error"></div>
                    </div>

                    <!-- mobile number goes here. -->
                    <div class="form-group">
                        <label for="mobileno" class="col-sm-2 control-label">Mobile No.</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="mobileno" name="mobileno" placeholder="Mobile No (10 digits)" required autofocus>
                        </div>
                    </div> 
                    <div class="row">
                        <div  class="col-sm-offset-2" id="mobileno_error"></div>
                    </div>                    
                    <!-- enter your password -->
                    <div class="form-group">
                        <label for="passwrod" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password (Minimum 6 characters)">
                        </div>
                    </div>
                    <div class="row">
                        <div  class="col-sm-offset-2" id="password_error"></div>
                    </div>
                    <!-- confirm password goes here. -->
                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required autofocus>
                        </div>
                    </div> 
                    <div class="row">
                        <div  class="col-sm-offset-2" id="confirm_password_error"></div>
                    </div>
                    <!-- sign in button is here. -->
                        <!-- <p>Some thing is here.</p> -->
                            <div class="row">
                        <div  class="col-sm-offset-2" id="form_error" ></div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" name="submit" class="btn btn-success">Sign in</button>
                        </div>
                    </div>
                </form>
                    <div class="pull-right">
                        Already have account <a href="login"><button class="btn btn-defualt" id="login">Login</button></a>
                    </div>
            </div>
        </div>
    </div>
</div>