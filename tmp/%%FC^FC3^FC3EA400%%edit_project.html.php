<?php /* Smarty version 2.6.13, created on 2012-06-20 13:14:08
         compiled from dashboard/admin/project/edit_project.html */ ?>
<script type="text/javascript">
var start = "<?php echo $this->_tpl_vars['pData']['start_date']; ?>
";
var end = "<?php echo $this->_tpl_vars['pData']['end_date']; ?>
";
<?php echo '
	$(document).ready(function() {
		$("#startDate, #endDate").datepicker();
		$("#startDate, #endDate").datepicker("option", "dateFormat", "yy-mm-dd");
		
		$("#startDate").val(start);
		$("#endDate").val(end);
	});
'; ?>

</script>

<h3>Edit Project</h3>
<?php if ($this->_tpl_vars['msg']): ?><p><font color="#FF0000"><?php echo $this->_tpl_vars['msg']; ?>
</font></p><?php endif;  if ($this->_tpl_vars['ok']): ?><p><font color="#00CC00"><?php echo $this->_tpl_vars['ok']; ?>
</font></p><?php endif; ?>
<form method="post" name="fproject" action="index.php?s=project&act=update-project&id=<?php echo $this->_tpl_vars['projID']; ?>
">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
  <tr>
    <td width="12%" class="head">
		<strong>Project Name</strong>
	</td>
    <td width="88%">
		<label for="projectName"></label>
		<input type="text" name="projectName" id="projectName" value="<?php echo $this->_tpl_vars['pData']['name']; ?>
">
	</td>
  </tr>
  <tr>
    <td width="12%" class="head">
		<strong>Duration</strong>
	</td>
    <td width="88%">
		<label for="startDate"></label>
		<input type="text" name="startDate" id="startDate" value="">
		-
		<label for="endDate"></label>
		<input type="text" name="endDate" id="endDate" value="">
	</td>
  </tr>
  <tr>
    <td width="12%" class="head">
		<strong>Reporting Type</strong>
	</td>
    <td width="88%">
		<label for="seo"></label>
		<input type="checkbox" name="seo" id="seo" value="1" <?php if ($this->_tpl_vars['pData']['seo'] == '1'): ?>checked="true"<?php endif; ?>/> SEO 
		<input type="checkbox" name="sem" id="sem" value="1" <?php if ($this->_tpl_vars['pData']['sem'] == '1'): ?>checked="true"<?php endif; ?>/> SEM
		<input type="checkbox" name="social" id="social" value="1" <?php if ($this->_tpl_vars['pData']['social'] == '1'): ?>checked="true"<?php endif; ?>/> SOCIAL
	</td>
  </tr>
  <tr>
    <td width="12%" class="head">
		<strong>Status</strong>
	</td>
    <td width="88%">
		<label for="projectStatus"></label>
		<select name="projectStatus" id="projectStatus">
			<option value="0" <?php if ($this->_tpl_vars['pData']['project_status'] == '0'): ?>selected<?php endif; ?>>Select Status</option>
			<option value="1" <?php if ($this->_tpl_vars['pData']['project_status'] == '1'): ?>selected<?php endif; ?>>Execution Phase</option>
			<option value="2" <?php if ($this->_tpl_vars['pData']['project_status'] == '2'): ?>selected<?php endif; ?>>Completed</option>
		</select>
	</td>
  </tr>
   <tr>
    <td width="12%" class="head">
		<strong>Youtube Channel<br>(if any)</strong>
	</td>
    <td width="88%">
		<label for="projectChannel"></label>
		<input type="text" name="projectChannel" id="projectChannel" value="<?php echo $this->_tpl_vars['pData']['channel_id']; ?>
">
	</td>
  </tr>
   <tr>
    <td width="12%" class="head">
		<strong>Description</strong>
	</td>
    <td width="88%">
		<label for="projectDesc"></label>
		<input type="text" name="projectDesc" id="projectDesc" value="<?php echo $this->_tpl_vars['pData']['description']; ?>
">
	</td>
  </tr>
</table>

<h3>KPI</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
   <tr>
    <td width="12%">
	</td>
    <td width="10%"  class="head">
		<strong>Total KPI</strong>
	</td>
	<td width="10%"  class="head">
		<strong>Monthly KPI</strong>
	</td>
	<td width="63%"  class="head">
		<strong>Daily KPI</strong>
	</td>
  </tr>
  <tr>
    <td width="12%" class="head">
		<strong>Click</strong>
	</td>
    <td width="10%">
		<label for="clickTot"></label>
		<input type="text" name="clickTot" id="clickTot" value="<?php echo $this->_tpl_vars['pKPI']['click'][0]; ?>
">
	</td>
	<td width="10%">
		<label for="clickMonth"></label>
		<input type="text" name="clickMonth" id="clickMonth" value="<?php echo $this->_tpl_vars['pKPI']['click'][1]; ?>
">
	</td>
	<td width="63%">
		<label for="clickDaily"></label>
		<input type="text" name="clickDaily" id="clickDaily" value="<?php echo $this->_tpl_vars['pKPI']['click'][2]; ?>
">
	</td>
  </tr>
  <tr>
    <td width="12%" class="head">
		<strong>Budget</strong>
	</td>
    <td width="10%">
		<label for="budgetTot"></label>
		<input type="text" name="budgetTot" id="budgetTot" value="<?php echo $this->_tpl_vars['pKPI']['budget'][0]; ?>
">
	</td>
	<td width="10%">
		<label for="budgetMonth"></label>
		<input type="text" name="budgetMonth" id="budgetMonth" value="<?php echo $this->_tpl_vars['pKPI']['budget'][1]; ?>
">
	</td>
	<td width="63%">
		<label for="budgetDaily"></label>
		<input type="text" name="budgetDaily" id="budgetDaily" value="<?php echo $this->_tpl_vars['pKPI']['budget'][2]; ?>
">
	</td>
  </tr>
  <tr>
    <td width="12%" class="head">
		<strong>CTR</strong>
	</td>
    <td width="10%">
		<label for="ctrTot"></label>
		<input type="text" name="ctrTot" id="ctrTot" value="<?php echo $this->_tpl_vars['pKPI']['ctr'][0]; ?>
">
	</td>
	<td width="10%">
		<label for="ctrMonth"></label>
		<input type="text" name="ctrMonth" id="ctrMonth" value="<?php echo $this->_tpl_vars['pKPI']['ctr'][1]; ?>
">
	</td>
	<td width="63%">
		<label for="ctrDaily"></label>
		<input type="text" name="ctrDaily" id="ctrDaily" value="<?php echo $this->_tpl_vars['pKPI']['ctr'][2]; ?>
">
	</td>
  </tr>
</table>

<h3>USER ACCESS</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list" style="margin-bottom:12px;">
	<tr>
		<td width="12%" class="head">
			<strong>Username</strong>
		</td>
		<td width="88%" class="head">
			<strong>Permission</strong>
		</td>
	</tr>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['userList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
		<tr>
			<td width="12%">
				<span><?php echo $this->_tpl_vars['userList'][$this->_sections['i']['index']]['username']; ?>
</span>
			</td>
			<td width="88%">
				<input type="checkbox" name="projectAccess[]" id="projectAccess[]" value="<?php echo $this->_tpl_vars['userList'][$this->_sections['i']['index']]['userID']; ?>
" 
				<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['pUsr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
					<?php if ($this->_tpl_vars['userList'][$this->_sections['i']['index']]['userID'] == $this->_tpl_vars['pUsr'][$this->_sections['j']['index']]['user_id']): ?>
					checked
					<?php endif; ?>
				<?php endfor; endif; ?>	
				>
			</td>
		</tr>	
	<?php endfor; endif; ?>
</table>
<input name="update" type="hidden" value="1">
<input type="submit" name="submit" id="submit" value="Update">
<input type="reset" name="reset" id="reset" value="Reset">

</form>