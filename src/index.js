const DBApi = require('db-api')
const DBViewTwig = require('./DBViewTwig')
const twig = require('twig')

window.onload = () => {
  let api = new DBApi('api.php')
  let view = new DBViewTwig(api, 'Entry {{ entry.id }}: {{ entry.commentsCount }} Comments\n<ul>{% for c in entry.comments %}<li>{{ c.text }}</li>{% endfor %}</ul>', { twig })
  view.set_query({ table: 'test2' })
  view.show((err, result) => {
    document.body.innerHTML = result
  })
}
