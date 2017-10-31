const userTable = document.getElementById("userTable")
document.querySelector("input[name='userSearch']").addEventListener("keyup", e => {
  fetch(`/api/user_messenger_search.php?id=${id}&user_id=${user_id}&q=${e.target.value}`)
    .then(res => res.text())
    .then(res => {
      userTable.innerHTML = res;
    })
})