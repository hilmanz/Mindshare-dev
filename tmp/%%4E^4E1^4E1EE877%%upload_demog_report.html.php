<?php /* Smarty version 2.6.13, created on 2012-04-24 04:14:09
         compiled from dashboard/admin/SEO/upload_demog_report.html */ ?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="csv" id="csv" />
<input type="submit" name="submit" />
<input type="hidden" name="save" value="1"/>
<br>
<span><?php echo $this->_tpl_vars['err']; ?>
</span>
</form>