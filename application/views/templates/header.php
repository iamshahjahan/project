<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/font-awesome/css/font-awesome.css">
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url();?>/home">Project</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="<?php if($this->uri->segment(1)=="home"){echo "active";}?>"><a  href="<?php echo site_url();?>/home">Home <span class="sr-only">(current)</span></a></li>

          <?php 
          if ( is_logged_in() )
          {
            ?>

            <li class="<?php if($this->uri->segment(1)=="question"){echo "active";}?>">
              <a  href="<?php echo site_url();?>/question">Add a question</a>

            </li>
            <li class="<?php if($this->uri->segment(1)=="profile"){echo "active";}?>"><a href="<?php echo site_url();?>/profile">Profile</a></li>
            <li class="<?php if($this->uri->segment(1)=="logout"){echo "active";}?>"><a href="<?php echo site_url();?>/logout">Log Out</a></li>

            <?php
          }
          else
          {
            ?>
            <li class="<?php if($this->uri->segment(1)=="login"){echo "active";}?>" ><a href="<?php echo site_url();?>/login">Sign In</a></li>
            <li class="<?php if($this->uri->segment(1)=="register"){echo "active";}?>"><a href="<?php echo site_url();?>/register">Sign Up</a></li>

            <?php
          }
          
          ?>

        </ul>
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
