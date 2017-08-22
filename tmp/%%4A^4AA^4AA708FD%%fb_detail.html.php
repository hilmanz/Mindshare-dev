<?php /* Smarty version 2.6.13, created on 2012-07-27 13:10:47
         compiled from dashboard/fb_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'dashboard/fb_detail.html', 116, false),)), $this); ?>
<script type="text/javascript">
	var page = "project";
	var page_detail = "social";
	var volumeChartData = <?php echo $this->_tpl_vars['volume']; ?>
;
	var visitChartData = <?php echo $this->_tpl_vars['visit']; ?>
;
	var reachChartData = <?php echo $this->_tpl_vars['reach']; ?>
;
	var demogChartData = <?php echo $this->_tpl_vars['demog']; ?>
;
	var locChartData = <?php echo $this->_tpl_vars['location']; ?>
;
	
	<?php echo '
	$(document).ready(function() {
		//Volume Chart
		var category = volumeChartData.category;
		var data = [{
						name: \'Like\',
						data: volumeChartData.like,
						visible: true
					}, {
						name: \'Talking about This\',
						data: volumeChartData.story,
						visible: false
					}, {
						name: \'Post\',
						data: volumeChartData.post,
						visible: false
					}];
		lineChart(\'volume\', category, data);
		
		//Visit Chart
		var category = visitChartData.category;
		var data = [{
						name: \'All\',
						data: visitChartData.all
					}, {
						name: \'Unique\',
						data: visitChartData.unique
					}];
		lineChart(\'visit\', category, data);
		
		//Reach Chart
		var category = reachChartData.category;
		var data = [{
						name: \'Organic\',
						data: reachChartData.organic
					},{
						name: \'Paid\',
						data: reachChartData.paid
					},{
						name: \'Viral\',
						data: reachChartData.viral
					}];
		stackAreaChart(\'reach\', category, data);
		
		//Demography Chart
		var category = demogChartData.category;
		var data = [{
						name: \'Male\',
						data: demogChartData.male
					}, {
						name: \'Female\',
						data: demogChartData.female
					}];
		stackColumnChart(\'demog\', category, data);
		
		//Location Chart
		var temp = [];
		for (var x in locChartData.location){
			var data = {
						name: locChartData.location[x],
						y: locChartData.value[x]
					};
			temp.push(data);
			
		}
		pieChart(\'location\', category, temp);
	});
	'; ?>

</script>
<div id="body-tab">
	<?php if ($this->_tpl_vars['tabSEO'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SEO</a><?php endif; ?>
	<?php if ($this->_tpl_vars['tabSEM'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SEM</a><?php endif; ?>
	<?php if ($this->_tpl_vars['tabSOCIAL'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SOCIAL</a><?php endif; ?>
</div>
<div class="body-content">
	<div class="body-content-head">
		<span class="flLeft" style="font-size:14px;">Facebook Page Performance - <?php echo $this->_tpl_vars['fbPageName']; ?>
</span>
		
		<div class="dropdown flRight fgrey2 arial relative" no="1">
			<span><?php echo $this->_tpl_vars['fbPageName']; ?>
</span>
			<div class="droplist1 dropdown-bg absolute transparent hide" style="top:6px;left:5px;">
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
&act=fb"><?php echo $this->_tpl_vars['fbPageName']; ?>
</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
">Social Buzz</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
&act=twit">Twitter Account</a>
			</div>
		</div>
			</div>
	<div style="border: 1px solid #999999;height: 65px;margin: 15px 0;padding: 18px;width: 920px;" class="radius-white bg-white">
		<div class="radius-white flLeft" style="margin-right: 13px;margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">Likes</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['likes'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div class="radius-white flLeft" style="margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">People Talking About This</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['story'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div class="radius-white flRight" style="margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">Reach</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['reachSum'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div class="radius-white flRight" style="margin-right: 13px;margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">Posts</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['postSum'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
	</div>
	<span class="relative" style="font-size:14px;margin-top:10px;margin-left:2px;width: 300px;display: block;">
		Like, Conversations & Posts
	</span>
	<div id="volume" style="height: 292px;margin: 15px 0;"></div>
	<div style="height: 400px;">
		<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;margin-bottom:15px;">
			Page Visits
		</span>
		<div id="visit" class="flLeft" style="width: 470px; height: 370px;margin: 0 0 20px 0;">
		</div>
		<span class="relative flRight" style="font-size:14px;margin-left:2px;margin-top: -33px;width: 468px;display: block;margin-bottom:15px;">
			Page Reach
		</span>
		<div id="reach" class="flRight" style="width: 470px; height: 370px;margin: 0 0 20px 0;">
		</div>
	</div>
	<div style="height: 430px;">
		<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;margin-bottom:15px;">
			Demography		
		</span>
		<div id="demog" class="flLeft" style="width: 470px; height: 370px;margin: 0 0 20px 0;">
		</div>
		<span class="relative flRight" style="font-size:14px;margin-left:2px;margin-top: -33px;width: 468px;display: block;margin-bottom:15px;">
			Location
		</span>
		<div id="location" class="flRight" style="width: 470px; height: 370px;margin: 0 0 20px 0;">
		</div>
	</div>
	<div style="height: 315px;">
		<table class="body-tbl flLeft contentLeft  fgrey2" style="padding: 0;font-size: 11px; width:468px;">
			<tbody>
			<tr>
				<th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">
					Top 10 Posts
				</th>
			</tr>
			<tr>
				<th>Post</th>
				<th>Reach</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['post']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['message']; ?>
</td><td><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['value']; ?>
</td></tr>
			<?php endfor; endif; ?>
			</tbody>
		</table>
		<table class="body-tbl flRight contentLeft  fgrey2" style="padding: 0;font-size: 11px; width:468px;">
			<tbody>
			<tr>
				<th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">
					Top 10 Cities
				</th>
			</tr>
			<tr>
				<th>City</th>
				<th>Post</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['cities'][$this->_sections['i']['index']]['city']; ?>
</td><td><?php echo $this->_tpl_vars['cities'][$this->_sections['i']['index']]['nilai']; ?>
</td></tr>
			<?php endfor; endif; ?>
			</tbody>
		</table>
	</div>
</div>