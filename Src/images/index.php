<html>

<script type="text/javascript" src="../Assets/Javascript/jquery.min.js"></script>
<script type="text/javascript" src="../Assets/Javascript/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').live('change', function()			{ 
			           $("#preview").html('');
			    $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
			});
        }); 
</script>
<body>



<div style="width:600px">

<form id="imageform" method="post" enctype="multipart/form-data" action='../images/ajaximage.php'>
Upload your image <input type="file" name="photoimg" id="photoimg" />
</form>
<div id='preview'>
</div>


</div>
</body>
</html>