<!DOCTYPE html>
<html>
<head>
	<title>Test d3</title>
	<script type="text/javascript" src="d3/d3.js"></script>
</head>
<body>

	<svg width="50" height="50">
		<circle cx="40" cy="40" r = "5" style="fill:green" />
	</svg>	



</body>


	<script type="text/javascript">
		
		// d3.select('body').
		//    append('h1').
		//    text('asdf').
		//    // append('').
		//    style('font-size','30px');

		d3.select('body').
		   append('svg').
		   attr('width','50').
		   attr('height','50').
		   append('circle').
		   attr('cx','40').
		   attr('cy','40').
		   attr('r','10').
		   style('fill','blue');
   


		
	</script>




</html>