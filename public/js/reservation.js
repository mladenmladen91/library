// function for getting reservations
function getReservations(page) {
  let offset = page * 15;
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/reservation/all', {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    /*withCredentials: true,
    credentials: 'include', */
    body: JSON.stringify({ offset: offset, limit: 15 })
  }).then((response) => response.json())
    .then((responseData) => {
      return responseData;
      //console.log(responseData);
    }).catch(function (r) {
      //console.log(r);
    });
}
//getting available users and books
function getUsersAndBooks() {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/reservation/users-and-books', {
    method: "GET",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
  }).then((response) => response.json())
    .then((responseData) => {
      return responseData;
    }).catch(function (r) {
      //console.log(r);
    });
}
// function for storing reservation
function addReservation(form) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  let formData = new FormData(form);
  return fetch('/api/reservation/store', {
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
        window.location = '/admin/reservation/index';
      } else {
        alert("Popunite sve podatke");
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}

// function for deleting reservation
function deleteReservation(id) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/reservation/delete', {
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

//function for activation reservation
function activateReservation(id, bookId) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/reservation/activate', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: JSON.stringify({ id: id, book_id: bookId })
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

