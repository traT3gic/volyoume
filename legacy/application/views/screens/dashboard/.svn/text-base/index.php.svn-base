<h3><?php echo sprintf('Welcome, <strong>%s</strong>!', user_info('full_name'));?></h3>
<p>This tool will facilitate communication between you, other users, and administrators at <?php echo config_item('org');?>. Use it to stay up-to-date on what&rsquo;s happening and to keep others up-to-date with changes in your life. The dashboard screen you are currently viewing provides a snapshot of activity on your account.</p> 
<table class="index">
<tr><th colspan="4">Messages</th></tr>
<tr>
	<td><img src="<?php echo site_url('assets/img/icons/coquette/16/mail.png');?>" alt="" /></td>
	<td colspan="2">You have <strong><?php echo page_info('num_new_messages'); ?></strong> new message(s).</td>
	<td class="actions"><ul><li><?php echo anchor('/messages', 'Read messages', array('class'=>'button manage'));?></li></ul></td>
</tr>

<?php if (is_super_admin()): ?>
<tr><th colspan="4">Volunteer Overview</th></tr>
<tr>
	<td colspan="2" id="ministry-breakdown-chart"></td>
	<td colspan="2" id="status-breakdown-chart"></td>
</tr>
<tr><th colspan="4">Fulfillment Requests</th></tr>
<?php endif; ?>
</table>
<?php if (is_super_admin()): ?>
<script src="https://www.google.com/jsapi"></script>
<script>
	var dashboard = function(){
		var _width = 400, _height = 300;		
		return {
			draw: function(){
				var _ministryBreakdownData = new google.visualization.DataTable();
				_ministryBreakdownData.addColumn("string", "Ministry");
				_ministryBreakdownData.addColumn("number", "Volunteers");
				_ministryBreakdownData.addRows([
					["Support Operations", 30],
					["Vols", 6],
					["NGM", 56],
					["SOS", 26],
					["Other Stuff", 80],												
				]);
				var _ministryBreakdownChartContainer = document.getElementById("ministry-breakdown-chart");
				var _ministryBreakdownChart = new google.visualization.PieChart(_ministryBreakdownChartContainer);
				_ministryBreakdownChart.draw(_ministryBreakdownData, {
					title: "Distribution Across Ministries",
					width: _width,
					height: _height
				});
				
				var _statusBreakdownData = new google.visualization.DataTable();
				_statusBreakdownData.addColumn("string", "Status");
				_statusBreakdownData.addColumn("number", "Volunteers");
				_statusBreakdownData.addRows([
					["Unassigned", <?php echo page_info('num_unassigned_users'); ?>],
					["Assigned", <?php echo page_info('num_assigned_users'); ?>]
				]);
				var _statusBreakdownChartContainer = document.getElementById("status-breakdown-chart");
				var _statusBreakdownChart = new google.visualization.PieChart(_statusBreakdownChartContainer);
				_statusBreakdownChart.draw(_statusBreakdownData, {
					title: "Volunteer Status",
					width: _width,
					height: _height
				});			
			}
		};
	}();
	google.load('visualization', '1.0', {'packages':['corechart']});
	google.setOnLoadCallback(dashboard.draw);			
</script>
<?php endif; ?>