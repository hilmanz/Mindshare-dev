<?php /* Smarty version 2.6.13, created on 2012-04-13 16:05:27
         compiled from common/admin/user_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'common/admin/user_edit.html', 13, false),)), $this); ?>
<p><strong>ADMINISTRATIVE ACCOUNTS</strong><br />
  <br />
<a class="backAccount" href="?s=admin&amp;r=users">&nbsp;</a> <br />
<br />
</p>
<form id="form1" name="form1" method="post" action="">
  <table width="43%" border="0" cellpadding="0" cellspacing="0" class="list">
    <tr>
      <td class="head"><strong>Edit Account</strong></td>
    </tr>
    <tr>
      <td><strong>Username :</strong><span class="pink"> <?php echo $this->_tpl_vars['rs']['username']; ?>
</span>
          <input name="username" type="hidden" id="username" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['username'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" />      </td>
    </tr>
  
  <tr>
    <td><strong>Change Password</strong></td>
  </tr>
  <tr>
    <td><input type="password" name="password" id="password" /> 
      Max : 10 alphanumeric character(s) <br /></td>
  </tr>
    <tr>
    <td><strong>Confirm Password</strong></td>
  </tr>
  <tr>
    <td><input type="password" name="confirm" id="confirm" /> 
    Max : 10 alphanumeric character(s) <br />
   <span style="color:#FF0000;"><?php echo $this->_tpl_vars['rs']['e2']; ?>
</span></td>
  </tr>
  <tr>
    <td><input class="update" type="submit" name="button" id="button" value="UPDATE" />
      <input name="s" type="hidden" id="s" value="admin" />
      <input name="r" type="hidden" id="r" value="users" />
      <input name="do" type="hidden" id="do" value="update" />
      <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['rs']['userID']; ?>
" /></td>
  </tr>
  </table>
</form>
<p><a class="newUserAccount" href="?s=admin&r=users&do=new">&nbsp;</a></p>