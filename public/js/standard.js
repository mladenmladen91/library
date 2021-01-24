//function for getting token
function getToken() {
  fetch('/admin/token', {
    method: "GET"
  }).then(function (response) {
    response.json().then(function (json) {
      localStorage.setItem('token', json.accessToken);
      localStorage.setItem('user', JSON.stringify(json.user));
      console.log(json.accessToken);
    });
  }).catch(function (r) {
    return reject(r)
  });
}
