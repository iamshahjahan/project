<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            
            <div class="row">
                <div id="resend_div">

                </div>
            </div>

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

                        </div>

                        <div class="row">
                            <div  class="col-sm-offset-2" id="email_error"></div>
                        </div>
                        <!-- enter your password -->
                        <div class="form-group">
                            <label for="passwrod" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>

                        </div>

                        <div class="row">
                            <div  class="col-sm-offset-2" id="password_error"></div>
                        </div>
                        <!-- sign in button is here. -->
                        <div class="row">
                            <div  class="col-sm-offset-2" id="form_error"></div>
                        </div>
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

                        <button class="btn btn-defualt" data-toggle="modal" data-target="#forgotpasswordModal" id="forgotpassword">Forgot Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="forgotpasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotpasswordLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="forgotpasswordLabel">Forgot your password?</h4>
                </div>
                <!-- modal body  -->
                <div class="modal-body" id="forgotpassword_modal_body">
                    <form class="form-horizontal" method="POST" id="forgotpassword_form" action="forgotpassword">
                        <!-- name goes here. -->
                        <div class="form-group">
                            <label for="forgotpassword_email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="forgotpassword_email" name="forgotpassword_email" placeholder="Enter your email id here." required autofocus>
                            </div>
                        </div> 

                        <div class="row">
                            <div  class="col-sm-offset-2" id="forgotpassword_error"></div>
                        </div>
                    </div>
                    <!-- footer -->
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-success">Send Link</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>