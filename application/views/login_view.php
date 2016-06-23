<html>
 <head>
   <title>AnA</title>
 </head>
 <body>
   <h1>Ask and Answer</h1>
   <h2>Login</h2>
   <?php echo validation_errors(); //display errors if redirect from verifylogin?> 
   <?php echo form_open('verifylogin'); ?>
     <label for="email">Email:</label>
     <input type="email" size="20" id="email" name="email"/> <!--email validation not working at application level-->
     <br/>
     <label for="password">Password:</label>
     <input type="password" size="20" id="password" name="password"/>
     <br/>
     <input type="submit" value="Login"/>
   </form>
 </body>
</html
