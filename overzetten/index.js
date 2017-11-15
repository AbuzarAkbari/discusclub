const mysql = require('promise-mysql')

const conn = mysql.createPool({
  host: 'localhost',
  user: 'test',
  password: 'test',
  database: 'forum',
  connectionLimit: 10,
})

const dhc = mysql.createPool({
  host: 'localhost',
  user: 'test',
  password: 'test',
  database: 'dhc',
  connectionLimit: 10,
})

const topicIds = {}

dhc
  .query('SELECT * FROM users')
  .then(res => {
    const queries = []
    res.forEach((x, i) => {
      let role_id = 2
      if (x.group_id == 500 || x.group_id == 502 || x.group_id == 400) {
        role_id = 5
      } else if (x.group_id == 300) {
        role_id = 4
      }
      queries.push(
        conn
          .query(
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
            ]
          )
          .catch(e => console.log(e))
      )
    })
    return Promise.all(queries)
  })
  .then(res => conn.query(
      "INSERT INTO user (first_name, last_name, email, username, password, role_id, created_at) VALUES ('john', 'doe', 'john_doe@example.com', 'test', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, NOW()), ('jane', 'doe', 'jane_doe@example.com', 'bla', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, NOW());",
    ).catch(e => console.log(e))
  )
  .then(res => dhc.query("SELECT * FROM forums"))
  .then(res => {
    const queries = []
    res.forEach((x, i) => {
      if (x.is_category == 1) {
        queries.push(conn.query(
          'INSERT INTO category(id, name, created_at) VALUES(?, ?, NOW())',
          [x.id, x.title]
        ).catch(e => console.log(e)))
      } else {
        queries.push(conn.query(
          'INSERT INTO sub_category(id, name, created_at, category_id) VALUES(?, ?, NOW(), ?)',
          [x.id, x.title, x.parent_id]
        ).catch(e => console.log(e)))
      }
    })
    return Promise.all(queries)
  })
  .then(res => dhc.query("SELECT * FROM forum_topics"))
  .then(res => {
    const queries = []
    res.forEach((x, i) => {
      let state = 1
      if (x.is_sticky) {
        state = 3
      }
      if (x.is_locked) {
        state = 2
      }
      // const bla = forum_posts.filter(y => y.created == x.created)
      // const content = bla.length > 0 ? bla[0].content_cache : ''
      // const content = ""
      // console.log(content)
      let forum_topic_id = null;
      queries.push(
        dhc.query("SELECT * FROM forum_posts WHERE profile_id = ? AND forum_id = ? AND created < (? + INTERVAL 1 MINUTE) AND created > (? - INTERVAL 1 MINUTE) ORDER BY created DESC LIMIT 1", [x.profile_id, x.forum_id, x.created, x.created]).then(res => {
          if(res.length > 0) {
            forum_topic_id = res[0].forum_topic_id
            return conn.query(
              'INSERT INTO topic(user_id, title, sub_category_id, created_at, last_changed, state_id, content) VALUES (?, ?, ?, ?, ?, ?, ?)',
              [x.profile_id, x.title, x.forum_id, x.created, x.modified, state, res[0].content_cache]
            ).catch(e => console.log(e))
          } else {
            return Promise.reject("no content found")
          }
        }).then(res => conn.query("SELECT id FROM topic WHERE user_id = ? AND created_at = ?", [x.profile_id, x.created])).catch(e => console.log(e))
         .then(res => {
            let id = false;
            if(res.length > 0) {
              id = {dhc: forum_topic_id, conn: res[0].id}
            }
            return new Promise((res, rej) => {
              if(id) {
                res(id)
              } else {
                rej()
              }
            })
         }).catch(e => console.log(e))
      )
    })
    return Promise.all(queries)
  })
  .then(res => {
    res.forEach((x, i) => {
      if(x) {
        topicIds[x.dhc] = x.conn;
      }
    })
    return dhc.query("SELECT * FROM forum_posts")
  })
  .then(res => {
    const queries = []
    res.forEach((x, i) => {
      console.log(topicIds[x.forum_topic_id], x.forum_topic_id)
      queries.push(
        conn.query("INSERT INTO reply(user_id, content, topic_id, created_at, last_changed) VALUES(?, ?, ?, ?, ?)",
                   [x.profile_id, x.content_cache, topicIds[x.forum_topic_id], x.created, x.modified]).catch(e => console.log(e))
      )
    })
    return Promise.all(queries);
  })
  .then(res => dhc.query("SELECT * FROM news"))
  .then(res => {

  })
  .catch(e => console.log(e))