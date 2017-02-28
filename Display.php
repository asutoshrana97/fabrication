
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>WareHouse empty space detector</title>
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type='text/javascript' src='js/jquery.min.js'></script>
</head>
<body>
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
<script type="text/javascript">

	function worker() {

		$.ajax({
			type: 'POST',
			url: 'get_status.php', 
			dataType: 'json', 
			success: function(res) {
				
				
				var cell_id;
				<?php
					for($i=0 ; $i<$row ; $i++){ 
						for( $j=0 ; $j<$col ; $j++){ ?>
							
							cell_id = document.getElementById("cell<?php echo $i.$j; ?>");
							if(res["cell<?php echo $i.$j; ?>"]==0)
								cell_id.style.backgroundColor="red";
							else if(res["cell<?php echo $i.$j; ?>"]==1)
								cell_id.style.backgroundColor="green";
							else if(res["cell<?php echo $i.$j; ?>"]==2)
								cell_id.style.backgroundColor="yellow";
							else
								cell_id.style.backgroundColor="white";

				<?php   } 
					} ?>
			
			},
			complete: function() {
			  // Schedule the next request when the current one's complete
			  setTimeout(worker, 5000);
			}
		});

		
	}
	worker();

	

</script>
</body>
</html> 