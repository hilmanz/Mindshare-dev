<?php /* Smarty version 2.6.13, created on 2012-05-16 20:11:40
         compiled from dashboard/seo_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'dashboard/seo_detail.html', 49, false),)), $this); ?>
<script type="text/javascript">
	var page = "project";
</script>
<div id="body-tab">
	<?php if ($this->_tpl_vars['tabSEO'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SEO</a><?php endif; ?>
	<?php if ($this->_tpl_vars['tabSEM'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SEM</a><?php endif; ?>
	<?php if ($this->_tpl_vars['tabSOCIAL'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SOCIAL</a><?php endif; ?>
</div>
<div class="body-content" style="height: 1550px;">
	<div class="body-content-head">
		<span class="flLeft" style="font-size:14px;">DETAIL REPORT</span>
		<div id="seoDropdown" class="dropdown flRight fgrey2 arial relative">
			<span>DETAIL REPORT</span>
			<div id="seoList" class="dropdown-bg absolute transparent hide" style="top:6px;left:5px;">
				<a class="dropdown-item" href="index.php?s=seo&id=<?php echo $this->_tpl_vars['projectID']; ?>
&act=detail">DETAIL REPORT</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=seo&id=<?php echo $this->_tpl_vars['projectID']; ?>
">SUMMARY REPORT</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	<?php echo '
		$("#seoDropdown").click(function(){
			effect();
		});
		function effect(){
			$("#seoList").toggle("blind",300);
		}
	'; ?>

	</script>
	<table class="body-tbl fgrey2" style=" margin-top: 15px;padding: 0;font-size: 10px;">
		<tr><th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">LOCATIONS & AGE BY VIEWS</th></tr>
		<tr class="fgrey">
			<th>COUNTRY</th>
			<th>VIEWS</th>
			<th>13-17 YEARS</th>
			<th>18-24 YEARS</th>
			<th>25-34 YEARS</th>
			<th>35-44 YEARS</th>
			<th>45-54 YEARS</th>
			<th>55-64 YEARS</th>
			<th>65+ YEARS</th>
			<th>GENDER MALE</th>
			<th>GENDER FEMALE</th>
		</tr>
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['demograp']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td><?php echo $this->_tpl_vars['demograp'][$this->_sections['i']['index']]['country']; ?>
</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['demograp'][$this->_sections['i']['index']]['country_views'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['demograp'][$this->_sections['i']['index']]['PercentPerAge']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['demograp'][$this->_sections['i']['index']]['PercentPerAge'][$this->_sections['j']['index']])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%</td>
			<?php endfor; endif; ?>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['demograp'][$this->_sections['i']['index']]['MalePercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['demograp'][$this->_sections['i']['index']]['FemalePercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%</td>
		</tr>
		<?php endfor; endif; ?>
		
	</table>
	<table class="body-tbl flLeft contentLeft fgrey2" style=" margin-top: 15px;padding: 0;font-size: 10px; width:468px;">
		<tr><th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">DAILY VIEWS</th></tr>
		<tr class="fgrey">
			<th>DATE</th>
			<th>VIEWS</th>
			<th>TARGET</th>
		</tr>
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['daily']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr><td><?php echo $this->_tpl_vars['daily'][$this->_sections['i']['index']]['date']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['daily'][$this->_sections['i']['index']]['views'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['daily'][$this->_sections['i']['index']]['target']; ?>
</td></tr>
		<?php endfor; endif; ?>
		<tr class="fgrey">
			<th>TOTAL</th>
			<th style="text-align: right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['totViews'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</th>
			<th style="text-align: right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['totKPI'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</th>
		</tr>
	</table>
	<div class="flRight" style="width;468px;">
		<table class="body-tbl contentLeft fgrey2" style="margin-top: 15px;padding: 0;font-size: 10px; width:468px;">
			<tr><th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">TRAFFIC SOURCES</th></tr>
			<tr class="fgrey">
				<th>CHANNEL</th>
				<th>VIEWS</th>
				<th>PCT.</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['top_traffic']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['top_traffic'][$this->_sections['i']['index']]['source']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['top_traffic'][$this->_sections['i']['index']]['views'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['top_traffic'][$this->_sections['i']['index']]['percent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%</td></tr>
			<?php endfor; endif; ?>
		</table>
		<table class="body-tbl contentLeft fgrey2" style="margin-top: 15px;padding: 0;font-size: 10px; width:468px;">
			<tr><th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">TOTAL VIEW</th></tr>
			<tr class="fgrey">
				<th>WEEKLY VIEWS</th>
				<th>VIEWS</th>
				<th>TARGET</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['weekly']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['weekly'][$this->_sections['i']['index']]['weeks']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['weekly'][$this->_sections['i']['index']]['views'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['weekly'][$this->_sections['i']['index']]['target'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td></tr>
			<?php endfor; endif; ?>
			<tr class="fgrey">
				<th>MONTHLY VIEWS</th>
				<th>VIEWS</th>
				<th>TARGET</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['monthly']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['monthly'][$this->_sections['i']['index']]['month']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['monthly'][$this->_sections['i']['index']]['views'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['monthly'][$this->_sections['i']['index']]['target'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td></tr>
			<?php endfor; endif; ?>
		</table>
	</div>
</div>