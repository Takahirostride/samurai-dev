
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="assets/plugins/bar-rating/dist/jquery.barrating.min.js"></script>
	<script src="assets/js/common.js"></script>
	<script src="assets/js/luu.js"></script>
	<script>
		$.fn.datepicker.dates['ja'] = {
		    days: ["日", "月", "火", "水", "木", "金", "土"],
		    daysShort: ["日", "月", "火", "水", "木", "金", "土"],
		    daysMin: ["日", "月", "火", "水", "木", "金", "土"],
		    months: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
		    monthsShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
		    today: "Today",
		    clear: "Clear",
		    format: "mm/dd/yyyy",
		    titleFormat: "MM yyyy",
		    weekStart: 0
		};
		$('.datepickertoday').datepicker({
	    	language : 'ja',
	        inline: true,
	        sideBySide: true,
	        todayHighlight: true
	    });
	</script>
  </body>
</html>