// get password fields
const passwordField = document.querySelector('input[name=password]')
const repeatPasswordField = document.querySelector(
  'input[name=repeat_password]',
)

const change = e => {
  // set custom validity
  passwordField.value === repeatPasswordField.value
    ? repeatPasswordField.setCustomValidity('')
    : repeatPasswordField.setCustomValidity('Wachtwoorden komen niet overeen')
}

// add event listeners
passwordField.addEventListener('change', change)
repeatPasswordField.addEventListener('change', change)
