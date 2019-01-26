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

/***/ "./resources/js/contact.js":
/*!*********************************!*\
  !*** ./resources/js/contact.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Contains codes exclusive for Contacts
(function ($) {
  var NewContactForm = $('#new-contact-form');
  var Contact = {
    init: function init() {
      Contact.getContacts();
      $('.contact-menu a').on('click', function (e) {
        Contact.preventDefault(e);
        $('.contact-content').removeClass('show');
        $($(this).attr('href')).addClass('show');
      });
      $('.new-info').on('click', function (e) {
        Contact.preventDefault(e);
        $('.info-holder').append(Contact.newInfo($('.info-holder .form-group').length));
      });
      NewContactForm.on('change', '.info-type', function () {
        if ($(this).val() == 'other') {
          $(this).siblings('input').removeClass('hidden');
        } else {
          $(this).siblings('input').addClass('hidden');
        }
      }).on('submit', function (e) {
        Contact.preventDefault(e);
        Contact.ajax(APP_URL + '/api/' + 'contacts/new', function (data) {
          console.log('response', data);
        }, $(this).serialize(), 'POST');
      });
    },
    getContacts: function getContacts() {
      Contact.ajax(APP_URL + '/api/' + 'contacts/list', function (data) {
        console.log('response', data);
      });
    },
    newInfo: function newInfo() {
      var index = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      index++;
      return $('<div class="form-group">\
				<label for="info">\
					<select class="info-type" name="info[' + index + '][type]">\
						<option value="email">Email</option>\
						<option value="mobile">Mobile</option>\
						<option value="tel">Tel</option>\
						<option value="fax">Fax</option>\
						<option value="work">Work</option>\
						<option value="address">Address</option>\
						<option value="other">Other</option>\
					</select>\
					<input type="text" class="hidden" name="info[' + index + '][custom]" placeholder="custom"></span>\
				</label>\
				<input type="text" id="info" name="info[' + index + '][value]" class="form-control">\
			</div>');
    },
    preventDefault: function preventDefault(e) {
      e.preventDefault();
      e.stopPropagation();
    },

    /**
     * Create a custom AJAX request to always include our token
     */
    ajax: function ajax(url) {
      var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'functon(data){}';
      var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
      var type = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 'GET';
      var response;
      $.ajax({
        url: url,
        data: data,
        type: type,
        beforeSend: function beforeSend(xhr) {
          xhr.setRequestHeader('Authorization', 'Bearer ' + window.Laravel.apiToken);
        },
        success: callback
      });
      return;
    } // Execute on DomReady

  };
  $(function () {
    Contact.init();
  });
})(jQuery);

/***/ }),

/***/ 1:
/*!***************************************!*\
  !*** multi ./resources/js/contact.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /media/rex/data/htdocs/contact-manager/resources/js/contact.js */"./resources/js/contact.js");


/***/ })

/******/ });