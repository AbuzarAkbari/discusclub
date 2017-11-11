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

const forums = data.filter(x => x.name === "forums")[0].data;
const users = data.filter(x => x.name === "users")[0].data;
const forum_topics = data.filter(x => x.name === "forum_topics")[0].data;
const forum_posts = data.filter(x => x.name === "forum_posts")[0].data;


data = null

console.log(forums.length, users.length, forum_topics.length, forum_posts.length)

console.log("data loaded!");

const errorHandler = i => total => (err, res) => {
  if (err) {
    console.log(err)
  } else {
    process.stdout.clearLine()
    process.stdout.cursorTo(0)
    process.stdout.write(`${i}/${total}`)
  }
}

console.log("inserting users");

users.forEach((x, i) => {
  let role_id = 2
  if (x.group_id == 500 || x.group_id == 502 || x.group_id == 400) {
    role_id = 5
  } else if (x.group_id == 300) {
    role_id = 4
  }
  conn.query(
    'INSERT INTO user(id, email, first_name, last_name, username, created_at, last_changed, role_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)',
    [
      x.id,
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
    errorHandler(i)(users.length),
  )
})
conn.query(
  "INSERT INTO user (first_name, last_name, email, username, password, role_id, created_at) VALUES ('john', 'doe', 'john_doe@example.com', 'test', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, NOW()), ('jane', 'doe', 'jane_doe@example.com', 'bla', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, NOW());",
)

console.log("inserting categories")

forums.forEach((x, i) => {
  if (x.is_category == 1) {
    conn.query(
      'INSERT INTO category(id, name, created_at) VALUES(?, ?, NOW())',
      [x.id, x.title],
      errorHandler(i)(forums.length),
    )
  } else {
    conn.query(
      'INSERT INTO sub_category(id, name, created_at, category_id) VALUES(?, ?, NOW(), ?)',
      [x.id, x.title, x.parent_id],
      errorHandler(i)(forums.length),
    )
  }
})

console.log("inserting forum posts")

forum_topics.forEach((x, i) => {
  let state = 0;
  if(x.is_sticky) {
    state = 2;
  }
  if(x.is_locked) {
    state = 1;
  }
  const bla = forum_posts.filter(y => y.created == x.created);
  const content = bla.length > 0 ? bla[0].content_cache : "";
  // const content = ""
  // console.log(content)
  conn.query("INSERT INTO topic(user_id, title, sub_category_id, created_at, last_changed, state_id, content) VALUES (?, ?, ?, ?, ?, ?, ?)",
            [x.profile_id, x.title, x.forum_id, x.created, x.modified, state, content], errorHandler(i)(forum_topics.length))
})
