<?php /* Smarty version 2.6.13, created on 2012-07-27 15:49:09
         compiled from dashboard/mainDashboard.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'dashboard/mainDashboard.html', 11, false),)), $this); ?>
<script type="text/javascript">
	var page = "main";
	var page_detail = "";
</script>
<div class="body-content">
	<span class="fgrey" style="font-size:12px;margin:10px 0 0 2px;">You have <?php echo $this->_tpl_vars['projectActive']; ?>
 active project. Click on each campaign type to view it's progress</span>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['projectList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<div class="body-project relative">		
		<div class="box-project flLeft relative">
			<span>
				<span class="absolute" style="top:5px;left:10px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['projectList'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</span>
				<span class="fgrey arial absolute" style="font-size:11px;top:25px;left:10px;">
				<?php if ($this->_tpl_vars['projectList'][$this->_sections['i']['index']]['seo'] == 1): ?>
				SEO optimization on <?php echo ((is_array($_tmp=$this->_tpl_vars['projectList'][$this->_sections['i']['index']]['cname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 Youtube Channel
				<?php elseif ($this->_tpl_vars['projectList'][$this->_sections['i']['index']]['sem'] == 1): ?>
				<?php echo $this->_tpl_vars['projectList'][$this->_sections['i']['index']]['description']; ?>

				<?php endif; ?>
				</span>
			</span>
			<span class="absolute arial" style="top:15px;right:10px; font-size: 11px;">
				<?php echo $this->_tpl_vars['projectStatus'][$this->_sections['i']['index']]; ?>

			</span>
		</div>
		<div class="project-status flRight">
			<div class="statusNon flRight <?php if ($this->_tpl_vars['tabSocial'][$this->_sections['i']['index']] == 'Active'): ?>statusActive<?php elseif ($this->_tpl_vars['tabSocial'][$this->_sections['i']['index']] == 'Completed'): ?>statusCompleted<?php endif; ?>" style="margin-left:10px"><?php if ($this->_tpl_vars['tabSocial'][$this->_sections['i']['index']] != 'None'): ?><a href="index.php?s=social&id=<?php echo $this->_tpl_vars['projectList'][$this->_sections['i']['index']]['id']; ?>
" class="link-project">SOCIAL</a><?php else: ?>SOCIAL<?php endif; ?></div>
			<div class="statusNon flRight <?php if ($this->_tpl_vars['tabSEM'][$this->_sections['i']['index']] == 'Active'): ?>statusActive<?php elseif ($this->_tpl_vars['tabSEM'][$this->_sections['i']['index']] == 'Completed'): ?>statusCompleted<?php endif; ?>" style="margin-left:10px"><?php if ($this->_tpl_vars['tabSEM'][$this->_sections['i']['index']] != 'None'): ?><a href="index.php?s=sem&id=<?php echo $this->_tpl_vars['projectList'][$this->_sections['i']['index']]['id']; ?>
" class="link-project">SEM</a><?php else: ?>SEM<?php endif; ?></div>
			<div class="statusNon flRight <?php if ($this->_tpl_vars['tabSEO'][$this->_sections['i']['index']] == 'Active'): ?>statusActive<?php elseif ($this->_tpl_vars['tabSEO'][$this->_sections['i']['index']] == 'Completed'): ?>statusCompleted<?php endif; ?>"><?php if ($this->_tpl_vars['tabSEO'][$this->_sections['i']['index']] != 'None'): ?><a href="index.php?s=seo&id=<?php echo $this->_tpl_vars['projectList'][$this->_sections['i']['index']]['id']; ?>
" class="link-project">SEO</a><?php else: ?>SEO<?php endif; ?></div>
		</div>
		<div class="project-start arial flLeft fgrey2">Started on: <?php echo $this->_tpl_vars['projectList'][$this->_sections['i']['index']]['mulai']; ?>
</div>
		<div class="project-start arial absolute fgrey2" style="bottom:16px;right:-10px;"> Last update: <?php echo $this->_tpl_vars['lastUpdate'][$this->_sections['i']['index']]['lastUpdate']; ?>
</div>
		<div class="project-label arial flRight">
			<div class="labelNon flRight <?php if ($this->_tpl_vars['tabSocial'][$this->_sections['i']['index']] == 'Active'): ?>labelActive<?php elseif ($this->_tpl_vars['tabSocial'][$this->_sections['i']['index']] == 'Completed'): ?>labelGreen<?php endif; ?>" style="margin-left:10px"><?php echo $this->_tpl_vars['tabSocial'][$this->_sections['i']['index']]; ?>
</div>
			<div class="labelNon flRight <?php if ($this->_tpl_vars['tabSEM'][$this->_sections['i']['index']] == 'Active'): ?>labelActive<?php elseif ($this->_tpl_vars['tabSEM'][$this->_sections['i']['index']] == 'Completed'): ?>labelGreen<?php endif; ?>" style="margin-left:10px"><?php echo $this->_tpl_vars['tabSEM'][$this->_sections['i']['index']]; ?>
</div>
			<div class="labelNon flRight <?php if ($this->_tpl_vars['tabSEO'][$this->_sections['i']['index']] == 'Active'): ?>labelActive<?php elseif ($this->_tpl_vars['tabSEO'][$this->_sections['i']['index']] == 'Completed'): ?>labelGreen<?php endif; ?>" style="margin-left:10px"><?php echo $this->_tpl_vars['tabSEO'][$this->_sections['i']['index']]; ?>
</div>
		</div>
	</div>
	<?php endfor; endif; ?>
</div>