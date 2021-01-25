//function for getting token
function getToken() {
  fetch('/admin/token', {
    method: "GET"
  }).then(function (response) {
    response.json().then(function (json) {
      localStorage.setItem('token', json.accessToken);
      localStorage.setItem('user', JSON.stringify(json.user));
      if (!localStorage.getItem('token') || localStorage.getItem('token') == null || localStorage.getItem('token') == undefined) {
        getToken();
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}
