<?php /* Smarty version 2.6.13, created on 2012-04-23 09:55:11
         compiled from dashboard/addCSV.html */ ?>
<form action="index.php?s=sem" method="post" enctype="multipart/form-data">
<input type="file" name="csv" id="csv" />
<input type="submit" name="submit" />
<input type="hidden" name="upload_csv" value="1"/>
<br>
<span><?php echo $this->_tpl_vars['err']; ?>
</span>
</form>