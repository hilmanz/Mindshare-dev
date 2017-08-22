<?php /* Smarty version 2.6.13, created on 2012-07-27 13:10:29
         compiled from dashboard/social.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'dashboard/social.html', 109, false),)), $this); ?>
<script type="text/javascript">
	var page = "project";
	var page_detail = "social";
	var volumeChartData = <?php echo $this->_tpl_vars['sentiment']; ?>
;
	var sentimentChartData = <?php echo $this->_tpl_vars['sentimentoverall']; ?>
;
	var channels = <?php echo $this->_tpl_vars['getChannels']; ?>
;
	var countries = <?php echo $this->_tpl_vars['getCountries']; ?>
;
	<?php echo '
	$(document).ready(function() {
		//Volume Chart
		var category = volumeChartData.category;
		var data = [{
						name: \'Positive\',
						data: volumeChartData.positive,
						color: \'#008000\'
					}, {
						name: \'Negatif\',
						data: volumeChartData.negatif,
						color: \'#FF0000\'
					}, {
						name: \'Neutral\',
						data: volumeChartData.neutral,
						color: \'#808080\'
					}];
		stackAreaChart(\'volume\', category, data);
		
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
		
		//Channel Pie Chart
		var chan = [];
		var i=0;
		for (var x in channels){
			var data = {
						name: x,
						y: parseInt(channels[x])
					};
			chan.push(data);
			i++;
		}
		pieChart(\'channel\', category, chan);
		
		//Countries Pie Chart
		var country = [];
		var i=0;
		for (var x in countries){
			var data = {
						name: x,
						y: parseInt(countries[x])
					};
			country.push(data);
			i++;
		}
		pieChart(\'countries\', category, country);
		
		
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
		<span class="flLeft" style="font-size:14px;">Buzz</span>
		
		<div class="dropdown flRight fgrey2 arial relative" no="1">
			<span>Social Buzz</span>
			<div class="droplist1 dropdown-bg absolute transparent hide" style="top:6px;left:5px;">
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
">Social Buzz</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
&act=fb"><?php echo $this->_tpl_vars['fbPageName']; ?>
</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=social&id=<?php echo $this->_tpl_vars['userID']; ?>
&act=twit">Twitter Account</a>
			</div>
		</div>
			</div>
	<div class="radius-white bg-white" style="border: 1px solid #999999;height: 65px;margin: 15px 0;padding: 18px;width: 920px;">
		<div style="margin-top:0;width:430px; background:#ccc;height: 45px;padding: 10px;" class="radius-white flLeft">
			<span style="font-size:12px" class="arial">Buzz Volume</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['buzzVolume'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div style="margin-top:0;width:430px; background:#ccc;height: 45px;padding: 10px;" class="radius-white flRight">
			<span style="font-size:12px" class="arial">Unique People</span><br>
			<span style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['uniquePeople'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
	</div>
	<span class="relative" style="font-size:14px;margin-top:10px;margin-left:2px;width: 300px;display: block;">
		Volume (Sentiment Overtime)
	</span>
	<div id="volume" style="height: 292px;margin: 15px 0;"></div>
	<div id="kol" style="height: 475px;">
		<span class="relative flLeft" style="font-size:14px;margin-left:2px;width: 500px;display: block;">
			Key Opinion Leaders
		</span>
		<div class="box-large-white radius-white bg-white flLeft" style="margin: 15px 0 0 0">
			<div class="kol-row">
				<h3 class="fgreen kol-head">Positif</h3>
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['kolPlus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<div class="box-profile" style="width: 10%;">
					<a href="#" onclick="popupProfile(<?php echo $this->_tpl_vars['kolPlus'][$this->_sections['i']['index']]['campaign_id']; ?>
, '<?php echo $this->_tpl_vars['kolPlus'][$this->_sections['i']['index']]['author_id']; ?>
')">
						<img src="<?php echo $this->_tpl_vars['kolPlus'][$this->_sections['i']['index']]['author_avatar']; ?>
">
					</a>
					<div class="box-name"><?php echo $this->_tpl_vars['kolPlus'][$this->_sections['i']['index']]['author_id']; ?>
<br>
					<?php if ($this->_tpl_vars['kolPlus'][$this->_sections['i']['index']]['sentiment_type'] == '-1'): ?>
						-
					<?php elseif ($this->_tpl_vars['kolPlus'][$this->_sections['i']['index']]['sentiment_type'] == '1'): ?>
						+
					<?php endif; ?>
					<?php echo $this->_tpl_vars['kolPlus'][$this->_sections['i']['index']]['total']; ?>
</div>
				</div>
				<?php endfor; endif; ?>
			</div>
			
		</div>
		<div class="box-large-white radius-white bg-white flLeft" style="margin: 15px 0 0 0">
			<div class="kol-row">
			<h3 class="fred kol-head">Negative</h3>
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['kolMinus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<div class="box-profile" style="width: 10%;">
					<a href="#" onclick="popupProfile(<?php echo $this->_tpl_vars['kolMinus'][$this->_sections['i']['index']]['campaign_id']; ?>
, '<?php echo $this->_tpl_vars['kolMinus'][$this->_sections['i']['index']]['author_id']; ?>
')">					
						<img src="<?php echo $this->_tpl_vars['kolMinus'][$this->_sections['i']['index']]['author_avatar']; ?>
">
					</a>
					<div class="box-name"><?php echo $this->_tpl_vars['kolMinus'][$this->_sections['i']['index']]['author_id']; ?>
<br>
					<?php if ($this->_tpl_vars['kolMinus'][$this->_sections['i']['index']]['sentiment_type'] == '-1'): ?>
						-
					<?php elseif ($this->_tpl_vars['kolMinus'][$this->_sections['i']['index']]['sentiment_type'] == '1'): ?>
						+
					<?php endif; ?>
					<?php echo $this->_tpl_vars['kolMinus'][$this->_sections['i']['index']]['total']; ?>
</div>
				</div>
				<?php endfor; endif; ?>
			</div>
			
		</div>
		<div class="box-large-white radius-white bg-white flLeft" style="margin: 15px 0 0 0">
			<div class="kol-row">
			<h3 class="fgrey2 kol-head">Neutral</h3>
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['kolNetral']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<div class="box-profile" style="width: 10%;">
					<a href="#" onclick="popupProfile(<?php echo $this->_tpl_vars['kolNetral'][$this->_sections['i']['index']]['campaign_id']; ?>
, '<?php echo $this->_tpl_vars['kolNetral'][$this->_sections['i']['index']]['author_id']; ?>
')">										
						<img src="<?php echo $this->_tpl_vars['kolNetral'][$this->_sections['i']['index']]['author_avatar']; ?>
">
					</a>
					<div class="box-name"><?php echo $this->_tpl_vars['kolNetral'][$this->_sections['i']['index']]['author_id']; ?>
<br>
					<?php if ($this->_tpl_vars['kolNetral'][$this->_sections['i']['index']]['sentiment_type'] == '-1'): ?>
						-
					<?php elseif ($this->_tpl_vars['kolNetral'][$this->_sections['i']['index']]['sentiment_type'] == '1'): ?>
						+
					<?php endif; ?>
					<?php echo $this->_tpl_vars['kolNetral'][$this->_sections['i']['index']]['total']; ?>
</div>
				</div>
				<?php endfor; endif; ?>
			</div>
			
		</div>
	</div>
	<div style="height: 400px;">
		<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;margin-bottom:15px;">
			Sentiments
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
	<div style="height: 425px;">
		<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;margin-bottom:15px;">
			Channels
		</span>
		<div id="channel" class="flLeft" style="width: 470px; height: 370px;margin: 0 0 20px 0;">
		</div>
		<span class="relative flRight" style="font-size:14px;margin-left:2px;margin-top: -33px;width: 468px;display: block;margin-bottom:15px;">
			Countries
		</span>
		<div id="countries" class="flRight" style="width: 470px; height: 370px;margin: 0 0 20px 0;">
		</div>
	</div>
	<div style="height: 456px;">
		<table class="body-tbl flLeft contentLeft  fgrey2" style="padding: 0;font-size: 11px; width:468px;">
			<tbody>
			<tr>
				<th class="fgrey" colspan="11" style="border-top: 0;font-size: 14px;text-align: left;">
					Top 10 Conversation
				</th>
			</tr>
			<tr>
				<th>Conversation</th>
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
					Top 10 Keywords
				</th>
			</tr>
			<tr>
				<th>Keyword</th>
				<th>Reach</th>
			</tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['keyword']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr><td><?php echo $this->_tpl_vars['keyword'][$this->_sections['i']['index']]['keyword']; ?>
</td><td><?php echo $this->_tpl_vars['keyword'][$this->_sections['i']['index']]['total']; ?>
</td></tr>
			<?php endfor; endif; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="popup_block popupWidth ui-draggable" id="profile" style="display: none; width: 650px; margin-left: -365px;">
	<a class="close" onclick="closePopup()">
		<img alt="Close" title="Close Window" class="btn_close" src="images/close.png">
	</a>
	<div class="headpopup">
    	<h1 id="twitID" class="flLeft"></h1>
        <a href="#" class="logo-twitter flRight">&nbsp;</a>
    </div>
	<div id="popupload" style="display: none;"><div style="text-align:center; height: 135px;margin-top: 50px;"><img src="images/loader-med.gif"></div></div>
    <div id="popupbody" style="display: none;">
    <div class="content-popup" unselectable="on" style="-moz-user-select: none;">
   	 	<div class="smallthumb">
        	<img src="http://a1.twimg.com/profile_images/1540473809/326475609_normal.jpg">
        </div>
        <div class="statistik-profile">
        	<a no="1" title="Followers" href="#" class="icon1 arial"></a>
        	<a no="2" title="Mentions" href="#" class="icon2 arial"></a>
        	<a no="3" title="Total Impressions" href="#" class="icon3 arial"></a>
        	<a no="4" title="Retweet Frequency" href="#" class="icon4 arial"></a>
        	<a no="5" title="Retweeted Impressions" href="#" class="icon5 arial"></a>
        	<a no="5" title="Share" href="#" class="icon6 arial"></a>
        </div>
        <div class="impact-score">
        	<span>RANK</span>
        	<h1></h1>
        </div>
	</div>
    <div id="profile-detail" class="arial fgrey">
    	<div id="about-profile">
        	<span>About :</span>
            <span class="entry" id="authorabout"></span>
        </div>
        <div id="location-profile">
        	<span>Location :</span>
            <span class="entry" id="authorlocation"></span>
       	</div>
    </div>
    <div class="legend arial">
        	<a no="1" title="Followers" href="#" class="icon1">Followers</a>
        	<a no="2" title="Mentions" href="#" class="icon2">Mentions</a>
        	<a no="3" title="Total Impressions" href="#" class="icon3">Total Impressions</a>
        	<a no="4" title="Retweet Frequency" href="#" class="icon4">Retweet Frequency</a>
        	<a no="5" title="Retweeted Impressions" href="#" class="icon5">Retweeted Impressions</a>
        	<a no="5" title="Share" href="#" class="icon6">Share</a>
    </div>
    </div>
</div>
<div id="fade" style="display: none;"></div>