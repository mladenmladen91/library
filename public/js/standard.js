function getToken() {
  fetch('/admin/token', {
    method: "GET"
    /*headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+window.Flex.User.accessToken
    },
    credentials: 'include',
    body: data */
  }).then(function (response) {
    response.json().then(function (json) {
      localStorage.setItem('token', json.accessToken)
    });
  }).catch(function (r) {
    return reject(r)
  });
}
