<?php /* Smarty version 2.6.13, created on 2012-05-08 11:29:23
         compiled from dashboard/admin/SEM/upload_csv_ads.html */ ?>
<form method="post" enctype="multipart/form-data">
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
  	<td width="12%" class="head"><strong>Excel</strong></td>
    <td>
    <input type="file" name="csv" id="csv" />
    </td>
 </tr>
 <tr>
 	<td colspan="2">
    <input type="submit" name="submit" />
    <input type="hidden" name="save" value="1"/>
    </td>
 </tr>
<br>
<span><?php echo $this->_tpl_vars['err']; ?>
</span>
</form>