<?php /* Smarty version 2.6.13, created on 2012-06-20 13:13:04
         compiled from common/admin/user_manage.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'common/admin/user_manage.html', 11, false),)), $this); ?>
<p><strong>ADMINISTRATIVE ACCOUNTS</strong> </p>
<table class="list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="head">
    <td width="4%"><strong>No</strong></td>
    <td width="74%"><strong>Username</strong></td>
    <td width="22%"><strong>Action</strong></td>
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
    <td>1</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['username'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
    <td>
    <a class="publish" href="?s=admin&r=permission&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['userID']; ?>
">Set Permissions</a> 
    <a class="addSubPage" href="?s=admin&amp;r=users&amp;do=edit&amp;id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['userID']; ?>
">Edit</a> 
    <a class="deletePage" href="#" onClick="doConfirm('<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['userID']; ?>
');return false;">Delete</a>
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<a class="newUserAccount" href="?s=admin&amp;r=users&amp;do=new">&nbsp; </a>

<script>
<?php echo '
function doConfirm(id){
	if(confirm("Are you sure to delete this account permanently ?")){
	'; ?>

		var s = "?s=admin&r=users&do=delete&id="+id;
<?php echo '
		document.location=s;
	}else{
		return false;
	}
}
'; ?>

</script>