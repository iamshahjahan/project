<?php
Class User extends CI_Model
{
 function login($email, $password)
 {
   $this -> db -> select('user_id, email, passwd');
   $this -> db -> from('users');
   $this -> db -> where('email', $email);
   $this -> db -> where('passwd', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>
