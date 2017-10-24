const passwordField = document.querySelector('input[name="password"]')
const repeatPasswordField = document.querySelector(
  'input[name="repeat_password"]',
)

let password = ''
let repeatPassword = ''

passwordField.addEventListener('onchange', e => {
  password = e.target.value
  console.log(isPasswordEqual())
})

repeatPasswordField.addEventListener('onchange', e => {
  repeatPassword = e.target.value
  console.log(isPasswordEqual())
})

function isPasswordEqual() {
  return password === repeatPassword
}
