<?php /* Smarty version 2.6.13, created on 2012-06-20 13:11:23
         compiled from dashboard/admin/project/insert_budget.html */ ?>
<h3>Insert Budget</h3>
<?php if ($this->_tpl_vars['msg']): ?><p><font color="#FF0000"><?php echo $this->_tpl_vars['msg']; ?>
</font></p><?php endif;  if ($this->_tpl_vars['ok']): ?><p><font color="#00CC00"><?php echo $this->_tpl_vars['ok']; ?>
</font></p><?php endif; ?>
<form method="post" name="fbudget">
<input name="save" type="hidden" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
  <tr>
    <td width="12%" class="head"><strong>Project</strong></td>
    <td width="88%"><label for="project"></label>
      <select name="project" id="project">
        <option value="0">Select Project</option>
        <?php if ($this->_tpl_vars['plist']): ?>
        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['plist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
         <option value="<?php echo $this->_tpl_vars['plist'][$this->_sections['i']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['project'] == '$plist[i].id'): ?>selected<?php endif; ?>}><?php echo $this->_tpl_vars['plist'][$this->_sections['i']['index']]['username']; ?>
 - <?php echo $this->_tpl_vars['plist'][$this->_sections['i']['index']]['name']; ?>
</option>
        <?php endfor; endif; ?>
        <?php endif; ?>
      </select></td>
  </tr>
  <tr>
    <td class="head"><strong>Budget</strong></td>
    <td><label for="budget"></label>
      <input type="text" name="budget" id="budget" value="<?php echo $this->_tpl_vars['budget']; ?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Save"></td>
  </tr>
</table>
</form>