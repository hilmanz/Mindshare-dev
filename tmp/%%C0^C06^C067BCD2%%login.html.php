<?php /* Smarty version 2.6.13, created on 2012-07-27 15:46:42
         compiled from dashboard/login.html */ ?>
<div id="login-wrap">
	<div id="login-head" class="relative">
			</div>
	<div id="login-box" class="relative">
		<form id="login" name="form1" method="post" action="login.php">
			<input type="hidden" name="PHPSESSID" value="85a1fe34897ffd340ee39272d8a03b8c" />
			<label class="absolute" style="left: 25px;top: 93px; font-size: 14px;">USERNAME</label>
			<input type="text" name="username" type="text" id="username" maxlength="20" value="" class="absolute" />
			<div class="login-border absolute" style="left: 27px;top: 135px;"></div>
			<label class="absolute" style="left: 25px;top: 162px; font-size: 14px;">PASSWORD</label>
			<input type="password" name="password" id="password" maxlength="20" value="" class="absolute" style="top:155px;left:140px;" />
			<div class="login-border absolute" style="left: 27px;top: 205px;"></div>
			<input name="f" type="hidden" id="f" value="1">
			<input id="button" type="submit" name="Submit" value="" class="absolute" />
						<?php if ($this->_tpl_vars['msg'] <> ""): ?>
			  <span class="messageLogin absolute"> <?php echo $this->_tpl_vars['msg']; ?>
 </span>
			<?php endif; ?>
		</form>
	</div>
</div>
<div id="footer" class="arial fgrey2">Copyright - Campaign Dashboard, Kana Cipta Media 2012</div>
<?php echo '
<script>
	$("input#username").focus(function(){
		if ($(this).val() == "EMAIL/USERNAME"){
			$(this).val("");
		}
	});
	$("input#username").blur(function(){
		if ($(this).val() == ""){
			$(this).val("EMAIL/USERNAME");
		}
	});
	$("input#password").focus(function(){
		if ($(this).val() == "PASSWORD"){
			$(this).val("");
		}
	});
	$("input#password").blur(function(){
		if ($(this).val() == ""){
			$(this).val("PASSWORD");
		}
	});
</script>
'; ?>