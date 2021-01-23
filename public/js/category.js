// function for getting categories
function getCategories() {
  return fetch('/admin/book-category/all', {
    method: "GET",
    headers: {
      'Content-Type': 'application/json'
    },
  }).then((response) => response.json())
    .then((responseData) => {
      return responseData;
    }).catch(function (r) {
      //console.log(r);
    });
}
// function for storing category
function addCategory(name) {
  console.log(name);
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/book-category/store', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: JSON.stringify({ name: name })
  }).then(function (response) {
    response.json().then(function (json) {
      if (json.success == true) {
        window.location = '/admin/book-category/index';
      } else {
        alert(json.message.name[0]);
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}

// function for updating category
function updateCategory(name, id) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/book-category/update', {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + altToken
    },
    withCredentials: true,
    credentials: 'include',
    body: JSON.stringify({ name: name, id: id })
  }).then(function (response) {
    response.json().then(function (json) {
      if (json.success == true) {
        window.location = '/admin/book-category/index';
      } else {
        alert(json.message.name[0]);
      }
    });
  }).catch(function (r) {
    return reject(r)
  });
}
// function for deleting category
function deleteCategory(id) {
  let altToken = "";
  getToken();
  altToken = localStorage.getItem('token');
  return fetch('/api/book-category/delete', {
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

