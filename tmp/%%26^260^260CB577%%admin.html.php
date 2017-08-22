<?php /* Smarty version 2.6.13, created on 2012-07-27 15:49:14
         compiled from dashboard/admin.html */ ?>
<script type="text/javascript">
var project1 = "<?php echo $this->_tpl_vars['pro1']; ?>
";
var project2 = "<?php echo $this->_tpl_vars['pro2']; ?>
";
<?php echo '
	$(document).ready(function() {
		
		if (page == "project"){
			$("#main-control").show();
		}else if(page == "main"){
			$("#main-control").hide();
			$("#header").css("height","64px");
			$("#header").css("marginBottom","25px");
		}
		
		if (page_detail == "seo"){
			$("#projectName").html(project2);
		}else if(page_detail == \'sem\'){
			$("#projectName").html(project1);
		}else if(page_detail == \'social\'){
			$("#projectName").html(project1);
		}
	});
'; ?>

</script>
<div id="header">
		<div id="head-warp">
			<div id="head-top">
				<div id="head-left">
					<a href="index.php">
						<img src="images/logo.png" width="152" style="border:none;" />
					</a>
				</div>
				<div id="head-right">
					<span class="user-name">Welcome, <?php echo $this->_tpl_vars['user']['username']; ?>
</span>
					<a href="logout.php" class="logout">Log Out</a>
				</div>
			</div>
			<div id="main-control">
				<div class="ctrl-left fgrey">
					<span><?php echo $this->_tpl_vars['pro1']; ?>
</span><span style="margin:0 15px;">-</span><span>Status: Execution Phase</span>
				</div>
				<div class="ctrl-right">
					<a href="index.php" class="project fgrey"><< Switch to a different project</a>
				</div>
			</div>
		</div>
	</div>
<div id="body">
	<div id="body-warp">
		<?php echo $this->_tpl_vars['content']; ?>

	</div>
</div>
<div id="footer" class="arial fgrey2">Copyright - Campaign Dashboard, Kana Cipta Media 2012</div>