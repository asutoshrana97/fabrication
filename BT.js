var serialPort = require("serialport");

//Configure Database
var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'fabrication'
});

// Create new serialport pointer
var serial = new serialPort("COM4" , { baudrate : 9600 });

// Add data read event listener
serial.on( "data", function( chunk ) {
    
    console.log(chunk);
    var res = chunk.split(" ");
    var post = {
    	cell_id: res[0],
    	val: res[1],
    };
    
    connection.connect();
	connection.query("INSERT INTO status ('cell_id','val') VALUES ?",res, function(err, rows, fields) 
	{
	  if(err)
	  	console.log('Failed to insert');
	  else
	  	console.log('success');
	});

	connection.end();

});

serial.on( "error", function( msg ) {
    console.log("error: " + msg );
});