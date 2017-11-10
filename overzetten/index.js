const mysql = require('mysql')

const conn = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'forum',
})
conn.connect()

let data = require('./dhc')
// map the data to make it easier
data = data.map(x => ({ name: x.name, data: x.data }))

data.map(x => console.log(x.name))

data.forEach((x, i) => {
  const total = x.data.length
  const errorHandler = i => (err, res) => {
    if (err) {
      console.log(err)
    } else {
      process.stdout.clearLine()
      process.stdout.cursorTo(0)
      process.stdout.write(`${i}/${total}`)
    }
  }

  if (x.name === 'forums') {
    x.data.forEach((x, i) => {
      if (x.is_category == 1) {
        conn.query(
          'INSERT INTO category(name, created_at) VALUES(?, NOW())',
          [x.title],
          errorHandler,
        )
      } else {
        conn.query(
          'INSERT INTO sub_category(name, created_at, category_id) VALUES(?, NOW(), ?)',
          [x.title, x.parent_id],
          errorHandler(i),
        )
      }
    })
  }
  // {"id":"-1","group_id":"100","username":"Anonymous","password":"","passwordcode":null,"email":"---------","email_authenticated":"1","activationcode":null,"last_login":"2010-08-16 00:26:58","created":"2003-12-09 18:39:56","modified":"2010-08-16 01:04:15","approved":"1","new":"0"}
  if (x.name === 'users') {
    x.data.forEach((x, i) => {
      let role_id = 2
      if (x.group_id == 500 || x.group_id == 502 || x.group_id == 400) {
        role_id = 5
      } else if (x.group_id == 300) {
        role_id = 4
      }

      conn.query(
        'INSERT INTO user(email, first_name, last_name, username, created_at, last_changed, role_id) VALUES(?, ?, ?, ?, ?, ?, ?)',
        [
          x.email,
          x.username
            .split(' ')
            .slice(0, 1)
            .join('')
            .trim(),
          x.username
            .split(' ')
            .slice(1)
            .join(' ')
            .trim(),
          x.username,
          x.created,
          x.modified,
          role_id,
        ],
        errorHandler(i),
      )
    })
    conn.query(
      "INSERT INTO user (first_name, last_name, email, username, password, role_id, created_at) VALUES ('john', 'doe', 'john_doe@example.com', 'test', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, NOW()), ('jane', 'doe', 'jane_doe@example.com', 'bla', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, NOW());",
    )
  }
})
