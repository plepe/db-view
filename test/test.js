const fs = require('fs')
const conf = JSON.parse(fs.readFileSync('test-conf.json', 'utf8'));

const assert = require('assert')

const DBApi = require('db-api')
const DBView = require('../src/DBView')

const dbApi = new DBApi(conf.url, conf.options)

describe('DBView', () => {
  it('init', () => {
    new DBView(dbApi)
  })

  it('show', (done) => {
    let view = new DBView(dbApi)
    view.set_query({ table: 'test1' })
    view.show((err, result) => {
      assert.equal(err, null, 'Error should be null')
      assert.equal(result, '[{"a":2,"b":"bar","d":"b"},{"a":3,"b":"bla","d":"b"}]')
      done()
    })
  })
})
