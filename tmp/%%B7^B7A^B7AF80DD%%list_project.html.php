<?php /* Smarty version 2.6.13, created on 2012-06-20 13:14:06
         compiled from dashboard/admin/project/list_project.html */ ?>
<h3>Project List</h3>
<?php if ($this->_tpl_vars['msg']): ?><p><font color="#FF0000"><?php echo $this->_tpl_vars['msg']; ?>
</font></p><?php endif;  if ($this->_tpl_vars['ok']): ?><p><font color="#00CC00"><?php echo $this->_tpl_vars['ok']; ?>
</font></p><?php endif; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
  <tr>
    <td class="head">
		<strong>Project Name</strong>
	</td>
	<td class="head">
		<strong>Start Date</strong>
	</td>
	<td class="head">
		<strong>End Date</strong>
	</td>
	<td class="head">
		<strong>SEO</strong>
	</td>
	<td class="head">
		<strong>SEM</strong>
	</td>
	<td class="head">
		<strong>Social</strong>
	</td>
	<td class="head">
		<strong>Project Status</strong>
	</td>
	<td class="head">
		<strong>Channel ID</strong>
	</td>
	<td class="head">
		<strong>Description</strong>
	</td>
	<td class="head">
		<strong>Action</strong>
	</td>
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['start_date']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['end_date']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['seo']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['sem']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['social']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['project_status']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['channel_id']; ?>
</td>
	<td><?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['description']; ?>
</td>
	<td>
		<a href="index.php?s=project&act=edit-project&id=<?php echo $this->_tpl_vars['pList'][$this->_sections['i']['index']]['id']; ?>
">Edit</a> 
			</td>
  </tr>
  <?php endfor; endif; ?>
</table>