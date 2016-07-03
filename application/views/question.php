<!-- 
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
-->
<div class="row">
	<div class="col-sm-offset-3 col-sm-6">

		<div class="panel panel-success">
			<div class="panel panel-heading">
				Add A Question
			</div>

			<div class="panel panel-body">
				<form class="form-horizontal" method="POST" id="question_form" action="verifyquestion">
					<!-- name goes here. -->
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="title" name="title" placeholder="Title" required autofocus>
						</div>
					</div> 

					<div class="row">
						<div  class="col-sm-offset-2" id="title_error"></div>
					</div>
					<!-- email goes here. -->
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="description" name="description" placeholder="Description" required autofocus>
						</div>
					</div>
					<div class="row">
						<div  class="col-sm-offset-2" id="description_error"></div>
					</div>

					<!-- tags goes here. -->
					<div class="form-group">
						<label for="tags" class="col-sm-2 control-label">Tags</label>
						<div class="col-sm-8" id="tags">
							<input type="text" class="form-control" id="tag1" name="tag1" placeholder="tag" required autofocus>
						</div>
					</div> 
					<div class="row">
						<div  class="col-sm-offset-2" id="tag_error" ></div>
					</div>


					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<button class="btn btn-info" id="addTag">Add Tags</button>
						</div>
					</div>

					<!-- <p>Some thing is here.</p> -->
					<div class="row">
						<div  class="col-sm-offset-2" id="form_error" ></div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<button type="submit" name="submit" class="btn btn-success">Post Answer</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>