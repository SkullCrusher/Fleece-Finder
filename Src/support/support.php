<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>


<div class="container_12 backgroundwhite">

	<p style="text-align:center;font-size: 300%;margin-top:0px;margin-left:0px;"><b>Support contact</b></p>

	<h2 style="text-align:center">General communication</h2>
	<div class="profile_container">
		<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
			<p>Email support at <a href="">support@fleecefinder.com</a> or use the internal messaging system <a href="../message/compose.php?to=support"> Message Support <a></p>
		</div>
	</div>
	
	<h2 style="text-align:center">Reporting bugs or technical problems</h2>
	<div class="profile_container">
		<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
			<p>When reporting a problem please provide a good explanation and as much information as possible. Example "I was unable to view my product named 'blue fleece' that I posted on 1/1/2000 and my account name is berryfarms. When I attempt to access the page it only displays a white blank page. I asked my friend to attempt to view the product but they were unable to as well."</p>
			<p>Email the development team at <a href="">administrator@fleecefinder.com</a> or use the internal messaging system <a href="../message/compose.php?to=administrator"> Message Development Team <a></p>
		</div>
	</div>
	
	<div class="spacer" style="margin-bottom:20px"></div>	
</div>


<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
