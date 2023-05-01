const { connect } = require('http2');
const mysql = require('mysql');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '12345',
    database: 'SEDIH',
    
});

connection.connect((error)=>{
    if(error){
        console.log('El error de conexion es : '+error);
        return;
    }
    console.log('!Conectado a la DB');
});

module.exports = connection;