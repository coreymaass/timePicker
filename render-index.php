<!DOCTYPE html>
<html>
<head>
	<title>timePicker jQuery plugin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" media="all" href="css/jquery.timepicker.css" />


<style>
.BSDatePicker {margin-bottom: 1em;}
.BSDatePickerPrev,
.BSDatePickerNext {cursor: pointer; display: inline-block; font-size: 3em; text-align: center; vertical-align: middle;
-webkit-user-select: none; /* webkit (safari, chrome) browsers */
-moz-user-select: none; /* mozilla browsers */
-khtml-user-select: none; /* webkit (konqueror) browsers */
-ms-user-select: none; /* IE10+ */
}

.BSDatePickerDate {cursor: pointer; display: inline-block; margin-right: .236em; padding: 1em; text-align: center; width: 5em;}
.BSDatePickerDate small {display: block;}
.BSDatePickerDate b {display: block; font-size: 2em;}

.BSTimePickerTime {display: inline-block; margin-right: .236em; padding: .236em 1em; text-align: center;}
.BSTimePickerTime small {display: block;}
.BSTimePickerTime b {display: block; font-size: 2em;}
.BSTimePickerTime select { margin-top: .618em; width: 100%;}

#dl-settings {margin-bottom: 5em;}
#dl-settings dl {line-height: 1em; margin: 0;}
#dl-settings dt {font-size: 1.382em;}
#dl-settings dd {margin-left: 4em;}
#dl-settings i {color: #999; font-size: .82em; font-weight: normal;}
</style>
</head>
<body>



	<div class="container">
		<h1>TimePicker plugin for jQuery</h1>
		
		<p class="lead">Built by <a href="http://gelform.com" target="_blank">Gelform</a></p>

		<p>
			This plugin is for letting a user choose dates and then corresponding times. I built it to allow users to let me know when they're available for phone calls.
		</p>

		<p>
			The time pickers return an array of dates containing a date (in yyyy-mm-dd format) and 24-hour time (hh:mm), by default. Here's what it would look like in PHP:
			<pre><code>
$schedule = array (
	"1381107061051" => array (
		"date" => "2013-10-06",
		"time" => "07:00"
	),
	"1381193461051" => array (
		"date" => "2013-10-07",
		"time" => "15:00"
	),
	"1381279861051" => array (
		"date" => "2013-10-08",
		"time" => "16:00"
	)
);
			</code></pre>
		</p>

		<p>
			<a href="https://github.com/coreymaass/timePicker" target="_blank" class="btn btn-primary">Download it from Github</a>
		</p>



		<hr />



		<h2>Examples:</h2>

		<h3>Basic</h3>

		<p>Here's a basic example:</p>

		<div class="well" id="basic"></div>

		<p>All this requires is:</p>

		<pre><code>
<?php 
$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" media="all" href="css/jquery.timepicker.css" />
</head>
<body>
	<div id="basic"></div>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/jquery.timepicker.min.js"></script>
	<script>
	$(document).ready(function(){
		$('#basic').timePicker();
	});
	</script>
</body>
</html>
HTML;

echo htmlspecialchars($html, ENT_QUOTES);
 ?>
 	</code></pre>



		<hr />

		<h3>Bootstrap</h3>

		<p>Here's a bootstrap integration example:</p>



		<div class="well" id="bootstrap"></div>


		<p>
			We'll change a few things to make this work. First, we'll make the dates wrapper a button group, and each date a button. Similarly, we'll make each time picker a Bootstrap well. We could've also just changed the class.
		</p>

		<p>
			The gotcha is changing the "selectedClassName" (the class added to each date when it's selected) to "active" to match Bootstrap. FInally we want to set "addSelectedClassOnClick" to false. Bootstrap will automatically add the class "active" to a clicked button, so we don't want our plugin to toggle it, which will turn it off.
		</p>

		<pre><code>
<?php 
$html = <<<HTML
// get today
var today = new Date();

// set a start date a week from now
var todayPlus7 = new Date(today.getTime() + (24 * 60 * 60 * 1000)*7);

$('#bootstrap').timePicker({
	datePicker: {
		startDate: todayPlus7,
		dates: {
			html: '<span class=" btn-group" data-toggle="buttons-checkbox" />',
		},
		date: {
			html: '<button type="button" class="btn" />',
			selectedClassName: 'active',
			addSelectedClassOnClick: false
		}
	},
	timePicker: {
		showPlaceholders: false,
		time: {
			html: '<span class="well" />',
		}
	}
});
HTML;

echo htmlspecialchars($html, ENT_QUOTES);
 ?>
 	</code></pre>


 	<p>These settings are available like this, too:</p>


		<pre><code>
<?php 
$html = <<<HTML
$.fn.timePicker.defaults.datePicker.startDate = todayPlus7;
$.fn.timePicker.defaults.datePicker.date.html = '<button type="button" class="btn" />';
$.fn.timePicker.defaults.datePicker.date.selectedClassName = 'active';
$.fn.timePicker.defaults.datePicker.date.addSelectedClassOnClick = false;
$.fn.timePicker.defaults.timePicker.time.html = '<span class="well" />';
$.fn.timePicker.defaults.timePicker.showPlaceholders = false;

$('#bootstrap').timePicker();
HTML;

echo htmlspecialchars($html, ENT_QUOTES);
 ?>
 	</code></pre>



 	<hr />

 		<h3>Callback</h3>

		<p>Here's a callback example:</p>

		<div class="well">
			<p id="callback"></p>

			<p>
				<button id="btn-callback" type="button" disabled="disabled" class="btn btn-large">Disabled until 3 are selected</button>
			</p>
		</div>

		<p>For this we need a timepicker (in this case #callback) and a disabled button:</p>

		<pre><code>
<?php 
$html = <<<HTML
<!-- our html, including a disabled button -->
<p id="callback"></p>

<p>
	<button id="btn-callback" type="button" disabled="disabled">Disabled until 3 are selected</button>
</p>
HTML;

echo htmlspecialchars($html, ENT_QUOTES);
 ?>
 	</code></pre>


 	<p>Then we define our callback when we instantiate our time picker:</p>

<pre><code>
<?php 
$js = <<<JS
// instantiate the timepicker
$('#callback').timePicker({
	datePicker: {
		date: {
			// trigger this whenever a date item is clicked
			finished: function(){
				// get our whole date picker element
				var \$wrapper = $('#callback');

				// get the timepickers element
				var \$timePickers = $('[data-tp-role=timePickerTime]', \$wrapper);

				// if there are 3 of them, we're good!
				if ( \$timePickers.length >= 3 )
				{
					// enable our button, and change the text
					$('#btn-callback')
					.prop('disabled', '')
					.text('3 selected!');
				}
				else
				{
					// not enough dates selected, change the button back
					$('#btn-callback')
					.prop('disabled', 'disabled')
					.text('Disabled until 3 are selected');
				}
			}
		}
	}
});
JS;

echo htmlspecialchars($js, ENT_QUOTES);
 ?>
 	</code></pre>



	<hr />



	<h2>Settings:</h2>

	<p>Here's an explaination of the available settings:</p>

	<dl id="dl-settings">
		<dt>numberOfTimes <i>Int</i></dt>
		<dd>The number of times you want to allow people to select. default: 3</dd>
		<dt>fieldName <i>Str</i></dt>
		<dd>The name of the array passed when the form gets submitted. default: schedule</dd>
		<dt>datePicker:</dt>
		<dd>
			The element that contains the prev, next buttons, and the calendar boxes
			<dl>
				<dt>startDate <i>Date Obj</i></dt>
				<dd>A date object of the date you want to start from. default: new Date()</dd>
				<dt>numOfDates <i>Int</i></dt>
				<dd>How many calendar boxes to show between the prev and next buttons. default: 5</dd>
				<dt>allowPastDates <i>Bool</i></dt>
				<dd>Set to true if you want to allow users to choose dates before today. default: false</dd>
				<dt>wrapper:</dt>
				<dd>
					<dl>
						<dt>htmlBefore <i>Html</i></dt>
						<dd>A message that appears above the date picker. Use this like a label. NOTE: MUST BE HTML, NOT JUST TEXT. default: &lt;p&gt;First, choose three dates:&lt;/p&gt;</dd>
						<dt>html <i>Html</i></dt>
						<dd>What kind of html element should wrap the date picker elements. default: &lt;div /&gt;</dd>
						<dt>className <i>Str</i></dt>
						<dd>The class name that will be added to the date picker element, for styling. default: TPDatePicker</dd>
					</dl>
				<dt>prev:</dt>
				<dd>
					This is the button that moves the dates back a day.
					<dl>
						<dt>className <i>Str</i></dt>
						<dd>The class name that will be added to the prev element, for styling. default: TPDatePickerPrev</dd>
						<dt>html <i>Html</i></dt>
						<dd>What kind of html element should the button be. default: &lt;span /&gt;</dd>
						<dt>text <i>Html</i></dt>
						<dd>What html or text should be in the prev element. default: &amp;#9664;</dd>
						<dt>clicked <i>Func</i></dt>
						<dd>A callback triggerd when the prev element has been clicked, but BEFORE the dates are rendered. this = the $datePickerPrev element</dd>
						<dt>finished <i>Func</i></dt>
						<dd>A callback triggered after the new dates have been rendered. this = the $datePickerPrev just clicked</dd>
					</dl>
				</dd>
				<dt>dates:</dt>
				<dd>
					<dl>
						<dt>className <i>Str</i></dt>
						<dd>The class name that will be added to the element, for styling. default: TPDatePickerDates</dd>
						<dt>html <i>Html</i></dt>
						<dd>What kind of html element should the dates wrapper be. default: &lt;span /&gt;</dd>
						<dt>added <i>Func</i></dt>
						<dd>A callback function triggered after the dates element have been added (only happens once). this = a jQuery array of the date elements just added</dd>
					</dl>
				</dd>
				<dt>date:</dt>
				<dd>
					<dl>
						<dt>className <i>Str</i></dt>
						<dd>The class name that will be added to the element, for styling. default: TPDatePickerDate</dd>
						<dt>selectedClassName <i>Str</i></dt>
						<dd>What class should be applied to each calendar box when it's selected. default: selected</dd>
						<dt>addSelectedClassOnClick <i>Bool</i></dt>
						<dd>For bootstrap and other frameworks. The selected class will only be applied when the prev or next buttons are clicked, but not when the element itself is clicked. Bootstrap already adds this class when it's clicked, so we don't want to toggle it again. default: true</dd>
						<dt>html <i>Html</i></dt>
						<dd>What kind of html element should each calendar box be. default: &lt;span /&gt;</dd>
						<dt>text <i>Html</i></dt>
						<dd>What html or text should be in each calendar box element. This uses the built in "template" function, which will populate the following variables: monthName, shortMonthName, dayName, shortDayName and date. default: &lt;small&gt;shortMonthName&lt;/small&gt; &lt;b&gt;date&lt;/b&gt; &lt;small&gt;shortDayName&lt;/small&gt;</dd>
						<dt>Clicked <i>Func</i></dt>
						<dd>A callback function triggered after the calendar box has been clicked, before anything else has happened. this = the $datePickerDate just clicked</dd>
						<dt>Finished <i>Func</i></dt>
						<dd>A callback function triggered after the corresponding time chooser box has been added. this = the $datePickerDate just clicked</dd>
					</dl>
				</dd>
				<dt>next:</dt>
				<dd>
					<dl>
						<dt>className <i>Str</i></dt>
						<dd>The class name that will be added to the element, for styling. default: TPDatePickerNext</dd>
						<dt>html <i>Html</i></dt>
						<dd>What kind of html element should the button be. default: &lt;span /&gt;</dd>
						<dt>text <i>Html</i></dt>
						<dd>What html or text should be in the next element. default: &amp;#9654;</dd>
						<dt>clicked <i>Func</i></dt>
						<dd>A callback triggerd when the next element has been clicked, but BEFORE the dates are rendered. this = the $datePickerNext element</dd>
						<dt>finished <i>Func</i></dt>
						<dd>A callback triggered after the new dates have been rendered. this = the $datePickerNext just clicked</dd>
					</dl>
				</dd>
			</dl>
		</dd>
		<dt>timePicker:</dt>
		<dd>
			<dl>
				<dt>wrapper:</dt>
				<dd>
					<dl>
						<dt>htmlBefore <i>Html</i></dt>
						<dd>A message that appears above the times picker. Use this like a label. NOTE: MUST BE HTML, NOT JUST TEXT. default: &lt;p&gt;Now, please select your available times:&lt;/p&gt;</dd>
						<dt>html <i>Html</i></dt>
						<dd>What kind of html element should the times wrapper be. default: &lt;div /&gt;</dd>
						<dt>className <i>Str</i></dt>
						<dd>The class name that will be added to the element, for styling. default: TPTimePicker</dd>
					</dl>
				</dd>
				<dt>time:</dt>
				<dd>
					<dl>
						<dt>className <i>Str</i></dt>
						<dd>The class name that will be added to the element, for styling. default: TPTimePickerTime</dd>
						<dt>preSelected <i>Str</i></dt>
						<dd>What default time should be selected when a time chooser is added. default: 7:00am</dd>
						<dt>startTime <i>Str</i></dt>
						<dd>In 24h. The earliest time a user can choose. default: 6:00</dd>
						<dt>endTime <i>Str</i></dt>
						<dd>in 24h. The latest time a user can choose. default: 19:00</dd>
						<dt>interval <i>Int</i></dt>
						<dd>The interval between times, in minutes. (i.e. 15 = 7:15, 7:30, 7:45...) default: 15</dd>
						<dt>selectFieldName <i>Str</i></dt>
						<dd>The actually name attribute of the time select element &lt;select name="time".... This is what gets submitted when the form gets submitted. default: time</dd>
						<dt>html <i>Html</i></dt>
						<dd>What kind of html element should each time box be. default: &lt;span /&gt;</dd>
						<dt>text <i>Html</i></dt>
						<dd>What html or text should be in each time box element. This uses the built in "template" function, which will populate the following variables: monthName, shortMonthName, dayName, shortDayName and date. default: &lt;small&gt;shortMonthName&lt;/small&gt; &lt;b&gt;date&lt;/b&gt; &lt;small&gt;shortDayName&lt;/small&gt;</dd>
						<dt>added <i>Func</i></dt>
						<dd>A callback when a time chooser box has been added. this = the $timePickerTime just added.</dd>
						<dt>removed <i>Func</i></dt>
						<dd>A callback when a time chooser box has been removed. this = the $timePicker wrapper</dd>
					</dl>
				</dd>
			</dl>
		</dd>
	</dl>



	</div><!-- container -->














	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery.timepicker.min.js"></script>
	<script>
	$(document).ready(function(){
		$('#basic').timePicker();



		var today = new Date();

		// set a start date a week from now
		var todayPlus7 = new Date(today.getTime() + (24 * 60 * 60 * 1000)*7);

		$('#bootstrap').timePicker({
				datePicker: {
					startDate: todayPlus7,
				wrapper: {
					className: 'BSDatePicker'
				},
				prev: {
					className: 'BSDatePickerPrev'
				},
				dates: {
					html: '<span class=" btn-group" data-toggle="buttons-checkbox" />',
					className: 'BSDatePickerDates'
				},
				date: {
					html: '<button type="button" class="btn" />',
					className: 'BSDatePickerDate',
					selectedClassName: 'active',
					addSelectedClassOnClick: false
				},
				next: {
					className: 'BSDatePickerNext'
				}
			},
			timePicker: {
				showPlaceholders: false,
				time: {
					html: '<span class="well" />',
					className: 'BSTimePickerTime'
				},
				placeholder: {
					html: '<span class="well" />',
					className: 'BSTimePickerPlaceholder'
				}
			}
		});



		$('#callback').timePicker({
			datePicker: {
				date: {
					finished: function(){
						var $wrapper = $('#callback');
						var $timePickers = $('[data-tp-role=timePickerTime]', $wrapper);

						if ( $timePickers.length >= 3 )
						{
							$('#btn-callback')
							.prop('disabled', '')
							.text('3 selected!');
						}
						else
						{
							$('#btn-callback')
							.prop('disabled', 'disabled')
							.text('Disabled until 3 are selected');
						}
					}
				}
			}
		});
	});
	</script>
</body>
</html>