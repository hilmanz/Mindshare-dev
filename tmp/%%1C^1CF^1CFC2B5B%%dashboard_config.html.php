<?php /* Smarty version 2.6.13, created on 2012-04-23 03:44:20
         compiled from common/admin/dashboard_config.html */ ?>
<h3>DASHBOARD CONFIGURATION</h3>
<p><?php echo $this->_tpl_vars['msg']; ?>
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list zebra">
  <tr class="head">
    <td><strong>Dashboard Name</strong></td>
    <td><strong>ClassPath</strong></td>
    <td><strong>Slot</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Action</strong></td>
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
    <td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['class']; ?>
</td>
    <td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['slot']; ?>
</td>
    <td><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['status'] == '1'): ?> ACTIVE <?php else: ?> DISABLED<?php endif; ?></td>
    <td><a href="?s=admin&r=dashboard&do=edit&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?s=admin&r=dashboard&do=delete&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
">Delete</a></td>
  </tr>
  <?php endfor; endif; ?>
</table>
<br>
<br>
<strong>Add Module</strong><br>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="addlist zebra">
    <tr>
      <td width="9%">Name</td>
      <td width="91%"><input type="text" name="name" id="name"></td>
    </tr>
    <tr>
      <td>ClassPath</td>
      <td><input name="class" type="text" id="class" size="50" maxlength="255"> 
        example : com.ModuleName.ModuleClass</td>
    </tr>
    <tr>
      <td>Invoker</td>
      <td><input name="invoker" type="text" id="invoker" value="Dashboard" size="50" maxlength="255"> </td>
    </tr>
    <tr>
      <td valign="top">Slot</td>
      <td><select name="slot" id="slot">
        <option value="1">1</option>
        <option value="2">2</option>
      </select> 
        <br>
        1 = main panel<br>
        2= sidebar</td>
    </tr>
    <tr>
      <td>Status</td>
      <td><select name="status" id="status">
        <option value="1" selected>Active</option>
        <option value="0">Disabled</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save">
      <input name="s" type="hidden" id="s" value="admin">
      <input name="r" type="hidden" id="r" value="dashboard">
      <input name="do" type="hidden" id="r" value="save"></td>
    </tr>
  </table>
</form>