<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="/Demo_Gallery/includes/uploadify/uploadify.css">
	<?php include_once("/includes/header.php"); ?>

</head>

<body>
	<?php require_once("/includes/config/db.php");
          require_once("/login/classes/Login.php"); 
          $login = new Login();
          include_once("/includes/nav.php"); ?>

	<center><h1 id="encab-up" class="foo-head">Choose your images</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form></center>

	<?php include_once("/includes/footer.php"); ?>
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : '/Demo_Gallery/includes/uploadify/uploadify.swf',
				'uploader' : '/Demo_Gallery/includes/uploadify/uploadify.php'
			});
		});
	</script>

	<script src="/Demo_Gallery/js/jquery.1.7.1.min.js" type="text/javascript"></script>
	<script src="/Demo_Gallery/includes/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

</body>
</html>