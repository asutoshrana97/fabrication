var serialPort = require("serialport");

//Configure Database
var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'fabrication'
});
connection.connect();
// Create new serialport pointer
var serial = new serialPort("COM4" , { baudrate : 9600 });

// Add data read event listener
var str = '';
serial.on( "data", function( chunk ) {
    
    str += chunk;
    
    try {

        res = JSON.parse(str);

	    console.log("cell_id: "+res['cell_id']+" && val:"+res['val'])
		str = '';

		var post = {
			cell_id: res['cell_id'],
			val: 	 res['val'], 
		};

		
	    connection.query("DELETE FROM status WHERE cell_id = ? ",res['cell_id'], function(err, rows, fields) 
		{
		  if(err)
		  	console.log('Failed to delete');
		  else
		  	console.log('success');
		});
		connection.query("INSERT INTO status SET ?",post, function(err, rows, fields) 
		{
		  if(err)
		  	console.log('Failed to insert');
		  else
		  	console.log('success');
		});

		
    } catch (e) {
        //console.log(str);
        return;
    }

});

serial.on( "error", function( msg ) {
    console.log("error: " + msg );
});