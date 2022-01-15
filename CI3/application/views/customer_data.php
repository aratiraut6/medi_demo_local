<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<title>Welcome to CodeIgniter</title>
	<style>
	.form-control{
		width:20%;
	}
	</style>
	
</head>
<body>

<div id="container">
	<h1>Upload Customer Data</h1>
	
	<div id="body">
	
		<?php echo form_open_multipart('customer/do_upload');?>
			<div class="form-group">
				<label>File Name</label>
				<input type="text" name="file_name" value="<?php echo set_value('file_name'); ?>" class="form-control"/>
				<?php echo form_error('file_name'); ?>
			</div>
			<div class="form-group">
				<label>Quote Number</label>
				<input type="text" name="quote_no" value="<?php echo set_value('quote_no'); ?>" class="form-control"/>
				<?php echo form_error('quote_no'); ?>
			</div>
			<div class="form-group">
				<input type="file" name="userfile" class="form-control" />
				<?php echo form_error('userfile'); ?>
			</div>
			<input type="submit" value="Submit" class="btn btn-info"/>
		</form>
	</div>


</div>

</body>
</html>