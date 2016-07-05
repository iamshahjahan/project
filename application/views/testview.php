<html>
 <head>
   <title>Search</title>
 </head>
 <body>
   <h2>Search</h2>
   <?php echo validation_errors(); ?> 
   <?php echo form_open('search_controller/tagsearch'); ?>
     <label for="tag">tag:</label>
     <input type="text" size="20" id="tag1" name="tag1"/>
     <br/>  

     <button type="submit" name="search">find</button>
   </form>
   </br>
   <?php echo validation_errors(); ?> 
   <?php echo form_open('search_controller/quessearch'); ?>
     <label for="tag">search:</label>
     <input type="text" size="20" id="ques1" name="ques1"/>
     <br/>  

     <button type="submit" name="search">find</button>
   </form>
 </body>
</html
