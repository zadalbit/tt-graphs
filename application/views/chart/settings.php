<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
	
	h2 {
		color: #444;
		background-color: transparent;
		font-size: 18px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
		text-align:center;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	.ui-datepicker .selected-start:not(.selected-end) a,
	.ui-datepicker .selected-end:not(.selected-start) a {
	  background: #F3FDD5;
	}

	.ui-datepicker .selected.first-of-month:not(.selected-start) a {
	  border-left: 2px dotted #D4E7F6;
	  padding-left: 1px;
	}

	.ui-datepicker .selected.last-of-month:not(.selected-end) a {
	  border-right: 2px dotted #D4E7F6;
	  padding-right: 1px;
	}
	</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jquery-ui-bootstrap.github.io/jquery-ui-bootstrap/css/custom-theme/jquery-ui-1.10.3.custom.css">
	<script type="text/javascript" src="https://rawgit.com/Artemeey/5ebc39370e568c34f03dce1639cabee8/raw/8de40b26479c406ee9cd6f9b4b3f4ad05370a024/jquery.datepicker.extension.range.min.js"></script>    
    <script type="text/javascript">
	  
	  $(function() {
  $('#date_range').datepicker({
    range: 'period', // режим - выбор периода
    numberOfMonths: 2,
    onSelect: function(dateText, inst, extensionRange) {
    	// extensionRange - объект расширения
      $('[name=startDate]').val(extensionRange.startDateText);
      $('[name=endDate]').val(extensionRange.endDateText);
    }
  });

  $('#date_range').datepicker('setDate', ['+4d', '+8d']);

  // объект расширения (хранит состояние календаря)
  var extensionRange = $('#date_range').datepicker('widget').data('datepickerExtensionRange');
  if(extensionRange.startDateText) $('[name=startDate]').val(extensionRange.startDateText);
  if(extensionRange.endDateText) $('[name=endDate]').val(extensionRange.endDateText);
});

    </script>
</head>
<body>

<div id="container">
	<h1>Test task realisation</h1>

	<div id="body">
	
		<h2>Select the date range:</h2>
		<div id="date_range" style="width:460px;margin:0 auto;"></div>
		<br>
		<?php echo form_open('chart/show') ?>
		<input name="startDate">
		<input name="endDate">
		<br><br>STEP: <input name="shag" value="1" style="width:60px;"><br><br>
		<input type="submit" value="Generate">
		</form>
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>