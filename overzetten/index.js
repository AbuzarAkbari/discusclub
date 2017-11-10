const mysql = require("mysql")

const conn = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'forum'
});
conn.connect();

let data = require("./dhc")
// map the data to make it easier
data = data.map(x => ({name: x.name, data: x.data}))

data.map(x => console.log(x.name))

data.forEach((x, i) => {
  // {"id":"-1","group_id":"100","username":"Anonymous","password":"","passwordcode":null,"email":"---------","email_authenticated":"1","activationcode":null,"last_login":"2010-08-16 00:26:58","created":"2003-12-09 18:39:56","modified":"2010-08-16 01:04:15","approved":"1","new":"0"}
  if(x.name === "users") {
    x.data.forEach(x => {
      conn.query("INSERT INTO user(email, first_name, last_name, username, created_at) VALUES(?, ?, ?, ?, ?)",
                [x.email, x.username.split(" ").slice(0, 1).join("").trim(), x.username.split(" ").slice(1).join(" ").trim(), x.username, x.created], (err, res) => {
                  if(err) {
                    console.log(err)
                  } else {
                    console.log("successful insert")
                  }

                })
    })
  }
})