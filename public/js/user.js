// function for getting users
function getUsers(page) {
  let offset = page * 15;
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  if (!localStorage.getItem("token")) {
    location.reload();
  }
  return fetch('/api/user/all', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: JSON.stringify({ offset: offset, limit: 15 })
  }).then((response) => response.json())
    .then((responseData) => {
      return responseData;
    }).catch(function (r) {
      //console.log(r);
    });
}
// function for storing user
function addUser(form) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  let formData = new FormData(form);
  return fetch('/api/user/store', {
    method: "POST",
    headers: {
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: formData
  }).then(function (response) {
    response.json().then(function (json) {
      if (json.success == true) {
        window.location = '/admin/user/index';
      } else {
        alert(json.message.email[0]);
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}
// function for getting users
function getUser(id) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/user/get', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: JSON.stringify({ id: id })
  }).then((response) => response.json())
    .then((responseData) => {
      return responseData;
    }).catch(function (r) {
      //console.log(r);
    });
}
// function for updating user
function updateUser(form) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  let formData = new FormData(form);
  return fetch('/api/user/update', {
    method: "POST",
    headers: {
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: formData
  }).then(function (response) {
    response.json().then(function (json) {
      if (json.success == true) {
        alert("Korisnik uspješno updejtovan!");
      } else {
        alert(json.message.email[0]);
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}
// function for deleting users
function deleteUser(id) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/user/delete', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: JSON.stringify({ id: id })
  }).then((response) => response.json())
    .then((responseData) => {
      location.reload();
    }).catch(function (r) {
      //console.log(r);
    });
}
//function for activation user
function activateUser(id) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/user/activate', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: JSON.stringify({ id: id })
  }).then((response) => response.json())
    .then((responseData) => {
      if (responseData.success === true) {
        location.reload();
      } else {
        alert(responseData.message);
        location.reload();
      }
    }).catch(function (r) {
      //console.log(r);
    });
}