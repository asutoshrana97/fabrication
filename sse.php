<!--Duplicate server that randomly transmits data as the arduino will be transmitting-->
<?php
	header('Content-Type: text/event-stream'); // specific sse mimetype
	header('Cache-Control: no-cache'); // no cache
	/*while(true) {
		if(/*something changes/){
			echo "id: ".time().PHP_EOL;
		  	echo "data: ".$data.PHP_EOL;
		  	
		}
		ob_flush(); // clear memory
		flush(); // clear memory
		sleep(10);// seconds 
	}*/
	for($i=0;$i<10;$i++){
		if($i%2==0){
			for($j=0;$j<10;$j++){
				$color = rand(0,1);
				if($color==0)
					sendMessage($i,$j,0);
				else{
					sendMessage($i,$j,2);
					sleep(2.5);
					sendMessage($i,$j,1);
				}
				sleep(1);// seconds		
				
			}
		}
		else{
			for($j=9;$j>=0;$j--){
				$color = rand(0,1);
				if($color==0)
					sendMessage($i,$j,0);
				else{
					sendMessage($i,$j,2);
					sleep(1);
					sendMessage($i,$j,1);
				}
				sleep(1);// seconds		
			}	
		}
	}

	// Function to send data in format "ticket:price".
	function sendMessage($i, $j, $val) {
		echo "id: $i:$j\n";
		$k['val'] = $val;
		$k['cell_id'] = "cell".$i.$j;
		echo "data: ".json_encode($k)."\n\n";
		ob_flush();
		flush();
	}
?>