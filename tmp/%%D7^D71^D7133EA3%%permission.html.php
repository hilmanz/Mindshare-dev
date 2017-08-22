<?php /* Smarty version 2.6.13, created on 2012-06-20 13:13:32
         compiled from common/admin/permission.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'common/admin/permission.html', 13, false),)), $this); ?>
<p><strong>ADMINISTRATIVE ACCOUNTS</strong><br>
  <br>
  <strong>Permission settings for &quot;<?php echo $this->_tpl_vars['rs']['username']; ?>
&quot;</strong></p>
<p style="color:#FF0000;"><?php echo $this->_tpl_vars['msg']; ?>
</p>
<form action="" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
  <tr class="head">
    <td width="64%"><strong>Section</strong></td>
    <td width="36%"><strong>Permission</strong></td>
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
    <td>
    <input name="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['requestID']; ?>
" type="radio" value="yes" <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['isAllowed']): ?>checked<?php endif; ?>>
    <label>Yes </label>
    <input name="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['requestID']; ?>
" type="radio" value="no" <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['isAllowed']):  else: ?>checked<?php endif; ?>>
	<label>No</label> </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<div align="center">
  <input name="s" type="hidden" id="s" value="admin">
  <input name="r" type="hidden" id="r" value="permission">
  <input name="do" type="hidden" id="do" value="update">
  <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['rs']['userID']; ?>
">
<input type="submit" name="SAVE" id="SAVE" value="SAVE">
  <br>
</div>
</form>