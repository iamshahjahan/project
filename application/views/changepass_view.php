<html>
 <head>
   <title>Change Password</title>
 </head>
 <body>
   <h2>Change Password</h2>
   <?php echo validation_errors(); ?> 
   <?php echo form_open('profile/changepass'); ?>
     <label for="password">Old Password:</label>
     <input type="password" size="20" id="password" name="password"/>
     <br/>

     <input type="hidden" name="email" value="<?php echo $email;?>">
     <button type="submit" name="submit">Next</button>
   </form>
 </body>
</html
