<!DOCTYPE html>
<html>
<head>
	<title>POST A QUESTION</title>
</head>
<body>
<?php
	$this->load->library('form_validation');
	echo validation_errors();
	echo form_open('question'); 
?>
		<label>Title</label>
		<input type="text" name="title">
		<br>
		<label>Description</label>
		<input type="text" name="description">
		<br>
		<div id="tags">	
			<label>Tags</label>
			<input type="text" name="tag1">
			<br>
		</div>
		<button id="addTag">add</button>
		<button type="submit" name="submit">POST</button>
	</form>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/addtags.js"></script>
</body>
</html>