// function for getting users
function getPages(page, phrase, status) {
  let offset = page * 15;
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/book/all', {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      'Content-Type': 'application/json'
    },
    /*withCredentials: true,
    credentials: 'include', */
    body: JSON.stringify({ offset: offset, limit: 15, phrase: phrase, status: status })
  }).then((response) => response.json())
    .then((responseData) => {
      return responseData;
      //console.log(responseData);
    }).catch(function (r) {
      //console.log(r);
    });
}
// function for storing book
function addBook(form) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  let formData = new FormData(form);
  return fetch('/api/book/store', {
    method: "POST",
    headers: {
      // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: formData
  }).then(function (response) {
    response.json().then(function (json) {
      if (json.success == true) {
        window.location = '/admin/book/index';
      } else {
        alert(json.message.title[0]);
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}
// function for getting users
function getBook(id) {
  return fetch('/book/get', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    body: JSON.stringify({ id: id })
  }).then((response) => response.json())
    .then((responseData) => {
      return responseData;
    }).catch(function (r) {
      //console.log(r);
    });
}
// function for updating user
function updateBook(form) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  let formData = new FormData(form);
  return fetch('/api/book/update', {
    method: "POST",
    headers: {
      // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: formData
  }).then(function (response) {
    response.json().then(function (json) {
      if (json.success == true) {
        alert(json.message);
      } else {
        alert(json.message.title[0]);
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}
// function for deleting users
function deleteBook(id) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/book/delete', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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

// function for sreserving book
function reserveBook(form) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  let formData = new FormData(form);
  return fetch('/api/reservation/book', {
    method: "POST",
    headers: {
      'Authorization': 'Bearer ' + altToken
    },
    /*withCredentials: true,
    credentials: 'include',*/
    body: formData
  }).then(function (response) {
    response.json().then(function (json) {
      alert(json.message);
      location.reload();
    });
  }).catch(function (r) {
    return reject(r)
  });
}
