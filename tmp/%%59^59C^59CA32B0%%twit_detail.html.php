<?php /* Smarty version 2.6.13, created on 2012-07-26 17:01:59
         compiled from dashboard/twit_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'dashboard/twit_detail.html', 71, false),)), $this); ?>
<script type="text/javascript">
	var page = "project";
	var page_detail = "social";
	var volumeChartData = <?php echo $this->_tpl_vars['volume']; ?>
;
	var followerChartData = <?php echo $this->_tpl_vars['follower']; ?>
;
	var sentimentChartData = <?php echo $this->_tpl_vars['sentiment']; ?>
;
	
	<?php echo '
	$(document).ready(function() {
		//Volume Chart
		var category = volumeChartData.category;
		var data = [{
						name: \'Mentions\',
						data: volumeChartData.mentions
					}, {
						name: \'People\',
						data: volumeChartData.people
					}, {
						name: \'RTs\',
						data: volumeChartData.rts
					}];
		lineChart(\'twitter\', category, data);
		//Follower Chart
		var category = followerChartData.category;
		for (var x in followerChartData.follower)
			var data = [{
							name: x,
							data: followerChartData.follower[x]
						}];
		lineChart(\'follower\', category, data);
		//Sentiment Pie Chart
		var temp = [];
		var _color = [\'#008000\',\'#FF0000\',\'#808080\'];
		var i=0;
		for (var x in sentimentChartData){
			var data = {
						name: x,
						y: parseInt(sentimentChartData[x]),
						color : _color[i]
					};
			temp.push(data);
			i++;
		}
		pieChart(\'sentiment\', category, temp);
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
		<span class="flLeft" style="font-size:14px;">Twitter</span>
		
		<div class="dropdown flRight fgrey2 arial relative" no="1">
			<span>Twitter Account</span>
			<div class="droplist1 dropdown-bg absolute transparent hide" style="top:6px;left:5px;">
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
&act=twit">Twitter Account</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
&act=fb"><?php echo $this->_tpl_vars['fbPageName']; ?>
</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
">Social Buzz</a>
			</div>
		</div>
	</div>
	<div style="border: 1px solid #999999;height: 65px;margin: 15px 0;padding: 18px;width: 920px;" class="radius-white bg-white">
		<div class="radius-white flLeft" style="margin-right: 13px;margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">Mentions</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['mentions'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div class="radius-white flLeft" style="margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">Potential Impressions</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['potentialImpression'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div class="radius-white flRight" style="margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">Retweets</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['retweet'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div class="radius-white flRight" style="margin-right: 13px;margin-top:0;width:200px; background:#ccc;height: 45px;padding: 10px;">
			<span class="arial" style="font-size:12px">Unique People Engaged</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['uniquePeople'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
	</div>
	<span class="relative" style="font-size:14px;margin-top:10px;margin-left:2px;width: 300px;display: block;">
		Volume
	</span>
	<div id="twitter" style="height: 292px;margin: 15px 0;"></div>
	<span class="relative" style="font-size:14px;margin-top:10px;margin-left:2px;width: 300px;display: block;">
		Followers
	</span>
	<div id="follower" style="height: 292px;margin: 15px 0;"></div>
	<div style="height: 400px;">
		<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;margin-bottom:15px;">
			Sentiment
		</span>
		<div id="sentiment" class="flLeft" style="width: 470px; height: 370px;margin: 0 0 20px 0;">
		</div>
		<span class="relative flRight" style="font-size:14px;margin-left:2px;margin-top: -33px;width: 468px;display: block;margin-bottom:15px;">
			Wordcloud
		</span>
		<div id="wordcloud" class="wordcloud radius-white bg-white flRight" style="width:470px; height: 367px;margin-bottom: 21px;overflow:hidden;position:relative;">
			<?php echo $this->_tpl_vars['wordcloud']; ?>
			
		</div>
	</div>
	<div style="height: 460px;">
		<table class="body-tbl flLeft contentLeft  fgrey2" style="padding: 0;font-size: 11px; width:468px;">
			<tbody>
			<tr>
				<th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">
					Top 10 Conversation
				</th>
			</tr>
			<tr>
				<th>Post</th>
				<th>Reach</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['conversation']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['conversation'][$this->_sections['i']['index']]['content']; ?>
</td><td><?php echo $this->_tpl_vars['conversation'][$this->_sections['i']['index']]['followers']; ?>
</td></tr>
			<?php endfor; endif; ?>
			</tbody>
		</table>
		<table class="body-tbl flRight contentLeft  fgrey2" style="padding: 0;font-size: 11px; width:468px;">
			<tbody>
			<tr>
				<th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">
					Top 10 Countries
				</th>
			</tr>
			<tr>
				<th>Countries</th>
				<th>Reach</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['location']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['location'][$this->_sections['i']['index']]['country_name']; ?>
</td><td><?php echo $this->_tpl_vars['location'][$this->_sections['i']['index']]['mentions']; ?>
</td></tr>
			<?php endfor; endif; ?>
			</tbody>
		</table>
	</div>
</div>