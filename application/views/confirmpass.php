<html>
 <head>
   <title>AnA</title>
 </head>
 <body>
   <h2>Confirm Password</h2>
   <?php echo validation_errors(); ?> 
   <?php echo form_open('resetpass/commit'); ?>
     <label for="password">Password:</label>
     <input type="password" size="20" id="password" name="password"/>
     <br/>
     <label for="password2">Re-type Password:</label>
     <input type="password" size="20" id="password2" name="password2"/>
     <br/>

     <input type="hidden" name="email" value="<?php echo $email;?>">
     <input type="submit" value="Reset"/>
   </form>
 </body>
</html
