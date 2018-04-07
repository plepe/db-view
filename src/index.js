const DBApi = require('db-api')
const DBView = require('./DBView.js')

window.onload = () => {
  let api = new DBApi('api.php')
  let view = new DBView(api)
  view.set_query({ table: 'posts' })
  view.show((err, result) => {
    document.body.innerHTML = result
  })
}
