/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/discounts/module.js":
/*!******************************************!*\
  !*** ./resources/js/discounts/module.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.Discounts = {};
window.Flex.Component.Discounts.Store = {};
window.Flex.Component.Discounts.Store.Query = {};
window.Flex.Component.Discounts.Store.Command = {};

/***/ }),

/***/ "./resources/js/discounts/store-cmd.js":
/*!*********************************************!*\
  !*** ./resources/js/discounts/store-cmd.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Discounts.Store.Command = {
  add: function add(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/discounts/addDiscount', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  update: function update(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/discounts/editDiscount', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  remove: function remove(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/discounts/deleteDiscount', JSON.stringify({
        id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/discounts/store-query.js":
/*!***********************************************!*\
  !*** ./resources/js/discounts/store-query.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Discounts.Store.Query = {
  list: function list() {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/discounts/getAllDiscounts', JSON.stringify({}), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/flex.js":
/*!******************************!*\
  !*** ./resources/js/flex.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Util: {},
    Component: {},
    User: {
      accessToken: null
    }
  };
}

window.Flex.Util.uuid = function () {
  return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, function (c) {
    return (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16);
  });
};

window.Flex.Util.DateTime = {
  formatDate: function formatDate(date) {
    if (typeof date === "string") {
      date = new Date(date);
    }

    return date.getDate() + "." + (date.getMonth() + 1) + "." + (date.getFullYear() + "").substr(2);
  },
  formatTime: function formatTime(date) {
    if (typeof date === "string") {
      date = new Date(date);
    }

    return date.getHours() + ":" + date.getMinutes();
  }
};

window.Flex.Util.Query = function (uri, data) {
  var method = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "GET";

  while (null === window.Flex.User.accessToken && uri != '/admin/token') {
    return new Promise(function (resolve, reject) {
      setTimeout(function () {
        if (null === window.Flex.User.accessToken) {
          reject("Cant resolve access Token");
        } else {
          window.Flex.Util.Query(uri, data, method).then(function (r) {
            resolve(r);
          })["catch"](function (r) {
            reject(r);
          });
        }
      }, 1000);
    });
  }

  return new Promise(function (resolve, reject) {
    fetch(uri, {
      method: method,
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + window.Flex.User.accessToken
      },
      credentials: 'include',
      body: data
    }).then(function (response) {
      response.json().then(function (json) {
        if (json.success === false) {
          reject(json.errors);
          return;
        }

        return resolve({
          data: json,
          response: response
        });
      });
    })["catch"](function (r) {
      return reject(r);
    });
  });
};

window.Flex.Util.Query('/admin/token').then(function (r) {
  window.Flex.User.accessToken = r.data.accessToken;
});

window.Flex.Util.Dispatcher = function () {
  var listOfRegisteredCallbacks = {};
  return {
    dispatch: function dispatch(event, resource) {
      if (!listOfRegisteredCallbacks[event]) {
        return;
      }

      listOfRegisteredCallbacks[event].forEach(function (callback) {
        callback(resource);
      });
    },
    register: function register(event, callback) {
      if (!listOfRegisteredCallbacks[event]) {
        listOfRegisteredCallbacks[event] = [];
      }

      listOfRegisteredCallbacks[event].push(callback);
    },
    unregister: function unregister(event) {
      listOfRegisteredCallbacks[event] = [];
    }
  };
}();

window.Flex.Util.clearElement = function (elem) {
  while (elem.firstChild) {
    elem.removeChild(elem.firstChild);
  }
};

window.Flex.Util.clearElements = function (elems) {
  elems.forEach(function (elem) {
    window.Flex.Util.clearElement(elem);
  });
};

window.Flex.Util.toArray = function (elem) {
  var type = _typeof(elem);

  switch (type) {
    case 'object':
      var arr = [];
      Object.keys(elem).forEach(function (key) {
        arr.push(elem[key]);
      });
      return arr;

    default:
      return [elem];
  }
};

window.Flex.Util.listApiCalls = function () {
  var display = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
  var displayApis = [];
  var apis = {
    component: [],
    command: [],
    query: []
  };
  Object.keys(window.Flex.Component).forEach(function (key) {
    var component = window.Flex.Component[key];

    if (component.hasOwnProperty('Store')) {
      if (component.Store.hasOwnProperty('Command')) {
        Object.keys(component.Store.Command).forEach(function (commandCall) {
          displayApis.push({
            component: key,
            command: commandCall,
            query: null
          });
          apis.component.push(key);
          apis.command.push(commandCall);
        });
      }

      if (component.Store.hasOwnProperty('Query')) {
        Object.keys(component.Store.Query).forEach(function (commandCall) {
          displayApis.push({
            component: key,
            command: null,
            query: commandCall
          });
          apis.component.push(key);
          apis.query.push(commandCall);
        });
      }
    }
  });

  if (display) {
    console.table(displayApis);
  }

  return apis;
};

window.Flex.Util.confirmModal = function (options) {
  var parsedOptions = {
    title: 'Potvrdi akciju',
    content: 'Da li ste sigurni?',
    data: {},
    success: function success() {}
  };

  if (typeof options.title !== 'undefined') {
    parsedOptions.title = options.title;
  }

  if (typeof options.content !== 'undefined') {
    parsedOptions.content = options.content;
  }

  if (typeof options.data !== 'undefined') {
    parsedOptions.data = options.data;
  }

  if (typeof options.success !== 'undefined') {
    parsedOptions.success = options.success;
  }

  var confirmModalDom = document.querySelector('#flexConfirmationModal');
  var confirmModalTitle = confirmModalDom.querySelector('[data-title]');
  var confirmModalContent = confirmModalDom.querySelector('[data-content]');
  var confirmModalSuccess = confirmModalDom.querySelector('[data-confirmation-success]');
  window.Flex.Util.clearElements([confirmModalTitle, confirmModalContent]);
  confirmModalTitle.appendChild(document.createTextNode(parsedOptions.title));
  confirmModalContent.innerHTML = parsedOptions.content;
  confirmModalSuccess.addEventListener('click', function () {
    $('#flexConfirmationModal').modal('hide');
    parsedOptions.success(parsedOptions.data);
  });
  $('#flexConfirmationModal').modal('show');
};

/***/ }),

/***/ "./resources/js/menu-items/module.js":
/*!*******************************************!*\
  !*** ./resources/js/menu-items/module.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.MenuItems = {};
window.Flex.Component.MenuItems.Store = {};
window.Flex.Component.MenuItems.Store.Query = {};
window.Flex.Component.MenuItems.Store.Command = {};

/***/ }),

/***/ "./resources/js/menu-items/store-cmd.js":
/*!**********************************************!*\
  !*** ./resources/js/menu-items/store-cmd.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.MenuItems.Store.Command = {
  add: function add(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/addMenuItem', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  update: function update(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/editMenuItem', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  remove: function remove(id, menuId) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/deleteMenuItem', JSON.stringify({
        id: id,
        menu_id: menuId
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  getAllChildrenMenus: function getAllChildrenMenus(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/getAllChildrenMenus', JSON.stringify({
        id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  sortMenus: function sortMenus(menus) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/sortMenus', JSON.stringify({
        menus: menus
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/menu-items/store-query.js":
/*!************************************************!*\
  !*** ./resources/js/menu-items/store-query.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.MenuItems.Store.Query = {
  list: function list(id) {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/menus/getAllMenuItems', JSON.stringify({
        id: id
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/menu/module.js":
/*!*************************************!*\
  !*** ./resources/js/menu/module.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.Menu = {};
window.Flex.Component.Menu.Store = {};
window.Flex.Component.Menu.Store.Query = {};
window.Flex.Component.Menu.Store.Command = {};

/***/ }),

/***/ "./resources/js/menu/store-cmd.js":
/*!****************************************!*\
  !*** ./resources/js/menu/store-cmd.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Menu.Store.Command = {
  add: function add(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/addMenu', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  update: function update(id, name, position) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/editMenu', JSON.stringify({
        id: id,
        name: name,
        position: position
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  remove: function remove(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/menus/deleteMenu', JSON.stringify({
        id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/menu/store-query.js":
/*!******************************************!*\
  !*** ./resources/js/menu/store-query.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Menu.Store.Query = {
  list: function list(filters, orderBy, limit, page) {
    if (typeof limit === 'undefined') {
      limit = 100;
    }

    if (typeof page === 'undefined') {
      page = 0;
    }

    if (typeof filters === 'undefined') {
      filters = {};
    }

    if (typeof orderBy === 'undefined') {
      orderBy = {};
    }

    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/menus/getAllMenus', JSON.stringify({
        limit: limit,
        page: page,
        filters: filters,
        orderBy: orderBy
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/orders/module.js":
/*!***************************************!*\
  !*** ./resources/js/orders/module.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.Order = {};
window.Flex.Component.Order.Store = {};
window.Flex.Component.Order.Store.Query = {};
window.Flex.Component.Order.Store.Command = {};

/***/ }),

/***/ "./resources/js/orders/store-cmd.js":
/*!******************************************!*\
  !*** ./resources/js/orders/store-cmd.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Order.Store.Command = {
  remove: function remove(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/orders/deleteOrder', JSON.stringify({
        id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/orders/store-query.js":
/*!********************************************!*\
  !*** ./resources/js/orders/store-query.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Order.Store.Query = {
  list: function list(offset) {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/orders/getAllOrders', JSON.stringify({
        offset: offset
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  },
  getOrder: function getOrder(id) {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/orders/getOrder', JSON.stringify({
        id: id
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/page-category/module.js":
/*!**********************************************!*\
  !*** ./resources/js/page-category/module.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.PageCategory = {};
window.Flex.Component.PageCategory.Store = {};
window.Flex.Component.PageCategory.Store.Query = {};
window.Flex.Component.PageCategory.Store.Command = {};

/***/ }),

/***/ "./resources/js/page-category/store-cmd.js":
/*!*************************************************!*\
  !*** ./resources/js/page-category/store-cmd.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.PageCategory.Store.Command = {
  add: function add(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/addCategory', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  update: function update(id, name) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/editCategory', JSON.stringify({
        id: id,
        name: name
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  remove: function remove(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/deleteCategory', JSON.stringify({
        id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/page-category/store-query.js":
/*!***************************************************!*\
  !*** ./resources/js/page-category/store-query.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.PageCategory.Store.Query = {
  list: function list() {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/pages/allCategories', JSON.stringify({}), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/page/module.js":
/*!*************************************!*\
  !*** ./resources/js/page/module.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.Page = {};
window.Flex.Component.Page.Store = {};
window.Flex.Component.Page.Store.Query = {};
window.Flex.Component.Page.Store.Command = {};

/***/ }),

/***/ "./resources/js/page/store-cmd.js":
/*!****************************************!*\
  !*** ./resources/js/page/store-cmd.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Page.Store.Command = {
  add: function add(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/addPage', JSON.stringify({
        pages: JSON.stringify([data])
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  update: function update(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/updatePage', JSON.stringify({
        pages: JSON.stringify([data])
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  getPage: function getPage(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/getPage', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  remove: function remove(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/deletePage', JSON.stringify({
        page_id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  addImage: function addImage(form) {
    var formData = new FormData(form);
    return new Promise(function (resolve, reject) {
      fetch('/api/pages/addImages', {
        method: 'POST',
        credentials: 'include',
        headers: {
          "Authorization": "Bearer " + window.Flex.User.accessToken
        },
        body: formData
      }).then(function (r) {
        resolve(r);
      })["catch"](function (r) {
        reject(r);
      });
    });
  },
  removeImage: function removeImage(id, image) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/deleteImage', JSON.stringify({
        image_id: id,
        image: image
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  sortImages: function sortImages(images) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/pages/sortImages', JSON.stringify({
        images: images
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/page/store-query.js":
/*!******************************************!*\
  !*** ./resources/js/page/store-query.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Page.Store.Query = {
  list: function list(language, limit, category) {
    /*if(typeof limit === 'undefined') { limit = 100; }
    if(typeof page === 'undefined') { page = 0; }
    if(typeof filters === 'undefined') { filters = {}; }
    if(typeof orderBy === 'undefined') { orderBy = {}; }*/
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/pages/list', JSON.stringify({
        language_id: language,
        limit: limit,
        category_id: category
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  },
  imageList: function imageList(id) {
    /*if(typeof limit === 'undefined') { limit = 100; }
    if(typeof page === 'undefined') { page = 0; }
    if(typeof filters === 'undefined') { filters = {}; }
    if(typeof orderBy === 'undefined') { orderBy = {}; }*/
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/pages/listImages', JSON.stringify({
        page_id: id
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/product-category/module.js":
/*!*************************************************!*\
  !*** ./resources/js/product-category/module.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.ProductCategory = {};
window.Flex.Component.ProductCategory.Store = {};
window.Flex.Component.ProductCategory.Store.Query = {};
window.Flex.Component.ProductCategory.Store.Command = {};

/***/ }),

/***/ "./resources/js/product-category/store-cmd.js":
/*!****************************************************!*\
  !*** ./resources/js/product-category/store-cmd.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.ProductCategory.Store.Command = {
  add: function add(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/addProductCategory', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  update: function update(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/editProductCategory', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  remove: function remove(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/deleteProductCategory', JSON.stringify({
        id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  getAllChildrenCategories: function getAllChildrenCategories(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/getAllChildrenCategories', JSON.stringify({
        id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  sortCategories: function sortCategories(categories) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/sortCategories', JSON.stringify({
        categories: categories
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/product-category/store-query.js":
/*!******************************************************!*\
  !*** ./resources/js/product-category/store-query.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.PageCategory.Store.Query = {
  list: function list() {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/pages/allCategories', JSON.stringify({}), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/product/module.js":
/*!****************************************!*\
  !*** ./resources/js/product/module.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof window.Flex === 'undefined') {
  window.Flex = {
    Component: {}
  };
}

window.Flex.Component.Product = {};
window.Flex.Component.Product.Store = {};
window.Flex.Component.Product.Store.Query = {};
window.Flex.Component.Product.Store.Command = {};

/***/ }),

/***/ "./resources/js/product/store-cmd.js":
/*!*******************************************!*\
  !*** ./resources/js/product/store-cmd.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Product.Store.Command = {
  add: function add(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/addProduct', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  update: function update(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/updateProduct', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  remove: function remove(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/deleteProduct', JSON.stringify({
        product_id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  searchProducts: function searchProducts(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/getSearchProducts', JSON.stringify({
        product_code: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  getProductsForSorting: function getProductsForSorting(id) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/getAllProductsForSorting', JSON.stringify({
        category_id: id
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  sortProducts: function sortProducts(products) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/sortProducts', JSON.stringify({
        products: products
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  toggleSpecialOffer: function toggleSpecialOffer(data) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/toggleSpecialOffer', JSON.stringify(data), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  addImage: function addImage(form) {
    var formData = new FormData(form);
    return new Promise(function (resolve, reject) {
      fetch('/api/products/addImages', {
        method: 'POST',
        credentials: 'include',
        headers: {
          "Authorization": "Bearer " + window.Flex.User.accessToken
        },
        body: formData
      }).then(function (r) {
        resolve(r);
      })["catch"](function (r) {
        reject(r);
      });
    });
  },
  removeImage: function removeImage(id, image) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/deleteImage', JSON.stringify({
        image_id: id,
        image: image
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  },
  sortImages: function sortImages(images) {
    return new Promise(function (resolve, reject) {
      window.Flex.Util.Query('/api/products/sortImages', JSON.stringify({
        images: images
      }), 'POST').then(function (json) {
        return resolve({
          data: json
        });
      })["catch"](function (r) {
        return reject(r);
      });
    });
  }
};

/***/ }),

/***/ "./resources/js/product/store-query.js":
/*!*********************************************!*\
  !*** ./resources/js/product/store-query.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Flex.Component.Product.Store.Query = {
  listCategory: function listCategory() {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/products/getAllProductCategory', JSON.stringify({}), "POST").then(function (r) {
        resolve(r);
      });
    });
  },
  list: function list(category, page, limit) {
    if (typeof limit === 'undefined') {
      limit = 2;
    }

    if (typeof page === 'undefined') {
      page = 0;
    }

    var offset = page * limit;
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/products/getAllProducts', JSON.stringify({
        category_id: category,
        limit: limit,
        offset: offset
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  },
  imageList: function imageList(id) {
    /*if(typeof limit === 'undefined') { limit = 100; }
    if(typeof page === 'undefined') { page = 0; }
    if(typeof filters === 'undefined') { filters = {}; }
    if(typeof orderBy === 'undefined') { orderBy = {}; }*/
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/products/listImages', JSON.stringify({
        product_id: id
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  },
  getProduct: function getProduct(id) {
    return new Promise(function (resolve) {
      window.Flex.Util.Query('/api/products/getProduct', JSON.stringify({
        id: id
      }), "POST").then(function (r) {
        resolve(r);
      });
    });
  }
};

/***/ }),

/***/ 1:
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/flex.js ./resources/js/menu/module.js ./resources/js/menu/store-cmd.js ./resources/js/menu/store-query.js ./resources/js/menu-items/module.js ./resources/js/menu-items/store-cmd.js ./resources/js/menu-items/store-query.js ./resources/js/page/module.js ./resources/js/page/store-cmd.js ./resources/js/page/store-query.js ./resources/js/page-category/module.js ./resources/js/page-category/store-cmd.js ./resources/js/page-category/store-query.js ./resources/js/product/module.js ./resources/js/product/store-cmd.js ./resources/js/product/store-query.js ./resources/js/product-category/module.js ./resources/js/product-category/store-cmd.js ./resources/js/product-category/store-query.js ./resources/js/discounts/module.js ./resources/js/discounts/store-cmd.js ./resources/js/discounts/store-query.js ./resources/js/orders/module.js ./resources/js/orders/store-cmd.js ./resources/js/orders/store-query.js ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\flex.js */"./resources/js/flex.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\menu\module.js */"./resources/js/menu/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\menu\store-cmd.js */"./resources/js/menu/store-cmd.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\menu\store-query.js */"./resources/js/menu/store-query.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\menu-items\module.js */"./resources/js/menu-items/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\menu-items\store-cmd.js */"./resources/js/menu-items/store-cmd.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\menu-items\store-query.js */"./resources/js/menu-items/store-query.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\page\module.js */"./resources/js/page/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\page\store-cmd.js */"./resources/js/page/store-cmd.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\page\store-query.js */"./resources/js/page/store-query.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\page-category\module.js */"./resources/js/page-category/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\page-category\store-cmd.js */"./resources/js/page-category/store-cmd.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\page-category\store-query.js */"./resources/js/page-category/store-query.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\product\module.js */"./resources/js/product/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\product\store-cmd.js */"./resources/js/product/store-cmd.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\product\store-query.js */"./resources/js/product/store-query.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\product-category\module.js */"./resources/js/product-category/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\product-category\store-cmd.js */"./resources/js/product-category/store-cmd.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\product-category\store-query.js */"./resources/js/product-category/store-query.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\discounts\module.js */"./resources/js/discounts/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\discounts\store-cmd.js */"./resources/js/discounts/store-cmd.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\discounts\store-query.js */"./resources/js/discounts/store-query.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\orders\module.js */"./resources/js/orders/module.js");
__webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\orders\store-cmd.js */"./resources/js/orders/store-cmd.js");
module.exports = __webpack_require__(/*! c:\xampp\htdocs\vebcentar\resources\js\orders\store-query.js */"./resources/js/orders/store-query.js");


/***/ })

/******/ });