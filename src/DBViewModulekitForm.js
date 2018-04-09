const DBView = require('./DBView')

class DBViewModulekitForm extends DBView {
  show (div, callback) {
    this.get((err, result) => {
      if (err) {
        return callback(err)
      }

      let domForm = document.createElement('form')
      div.appendChild(domForm)

      let options = {
        type: 'array',
        default: 1
      }
      let formDef = { def: this.def, type: 'form' }

      this.form = new form(null, formDef, options)
      this.form.show(domForm)
      this.form.set_data(result)

      let input = document.createElement('input')
      input.type = 'submit'
      input.value = lang('save')
      domForm.appendChild(input)

      domForm.onsubmit = () => {
        let data = this.form.get_data()
        let changeset = []

        changeset.push({
          action: 'insert-update',
          table: this.query.table,
          data: data
        })

        this.api.do(changeset, (err, result) => {
          console.log(err, result)
        })

        return false
      }

      callback(null)
    })
  }
}

module.exports = DBViewModulekitForm
