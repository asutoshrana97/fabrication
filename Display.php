
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>WareHouse empty space detector</title>
</head>
<body>
<script type="text/javascript">
	
	window.onload = function setDataSource() {
		if (!!window.EventSource) {
			var source = new EventSource("sse.php");

			source.addEventListener("message", function(e) {
				//alert(e.data);
				$res = JSON.parse(e.data);
				var cell_id = document.getElementById($res['cell_id']);
				//alert($res['val']);	
				if($res['val']==0)
					cell_id.style.backgroundColor="red";
				else if($res['val']==1)
					cell_id.style.backgroundColor="green";
				else
					cell_id.style.backgroundColor="yellow";
			}, false);
			
			
		} else {
			document.getElementById("notSupported").style.display = "block";
		}
	}
</script>
<center>
	<h1>Warehouse Empty Space Detector and Cleaner</h1>
	<?php $row = 10; $col = 10; ?>
	
	<table border=2 cellpadding=30>
		<?php for($i=0 ; $i<$row ; $i++){ ?>
			<tr>
				<?php for( $j=0 ; $j<$col ; $j++){ ?>
					<td id="cell<?php echo $i.$j; ?>"><?php echo $i.$j; ?></td>
				<?php } ?>
			</tr>
		<?php } ?>
	</table>

	<br><br><br>
	<table border=0 cellpadding=5>
		<tr>
			<td width= 20 bgcolor="red"></td>
			<td>Occupied</td>
		</tr>		
		<tr>
			<td width= 5 bgcolor="yellow"></td>
			<td>Free/Empty</td>
		</tr>
		<tr>
			<td width= 5 bgcolor="green"></td>
			<td>Cleaned</td>		
		</tr>
	</table>
</center>

</body>
</html> 