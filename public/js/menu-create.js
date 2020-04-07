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

/***/ "./resources/js/coreui/menu-create.js":
/*!********************************************!*\
  !*** ./resources/js/coreui/menu-create.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/* 11.12.2019 */\nvar self = this;\n\nthis.buildSelectParent = function (data) {\n  var result = '<option value=\"none\">Do not have parent</option>';\n\n  for (var i = 0; i < data.length; i++) {\n    result += '<option value=\"' + data[i].id + '\">' + data[i].name + '</option>';\n  }\n\n  return result;\n};\n\nthis.updateSelectParent = function () {\n  axios.get('/menu/element/get-parents?menu=' + document.getElementById(\"menu\").value).then(function (response) {\n    document.getElementById(\"parent\").innerHTML = self.buildSelectParent(response.data);\n  })[\"catch\"](function (error) {\n    // handle error\n    console.log(error);\n  });\n};\n\nthis.toggleDivs = function () {\n  var value = document.getElementById(\"type\").value;\n\n  if (value === 'title') {\n    document.getElementById('div-href').classList.add('d-none');\n    document.getElementById('div-dropdown-parent').classList.add('d-none');\n    document.getElementById('div-icon').classList.add('d-none');\n  } else if (value === 'link') {\n    document.getElementById('div-href').classList.remove('d-none');\n    document.getElementById('div-dropdown-parent').classList.remove('d-none');\n    document.getElementById('div-icon').classList.remove('d-none');\n  } else {\n    document.getElementById('div-href').classList.add('d-none');\n    document.getElementById('div-dropdown-parent').classList.remove('d-none');\n    document.getElementById('div-icon').classList.remove('d-none');\n  }\n};\n\nthis.updateSelectParent();\nthis.toggleDivs();\n\ndocument.getElementById(\"menu\").onchange = function () {\n  self.updateSelectParent();\n};\n\ndocument.getElementById(\"type\").onchange = function () {\n  self.toggleDivs();\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY29yZXVpL21lbnUtY3JlYXRlLmpzP2YyMGMiXSwibmFtZXMiOlsic2VsZiIsImJ1aWxkU2VsZWN0UGFyZW50IiwiZGF0YSIsInJlc3VsdCIsImkiLCJsZW5ndGgiLCJpZCIsIm5hbWUiLCJ1cGRhdGVTZWxlY3RQYXJlbnQiLCJheGlvcyIsImdldCIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJ2YWx1ZSIsInRoZW4iLCJyZXNwb25zZSIsImlubmVySFRNTCIsImVycm9yIiwiY29uc29sZSIsImxvZyIsInRvZ2dsZURpdnMiLCJjbGFzc0xpc3QiLCJhZGQiLCJyZW1vdmUiLCJvbmNoYW5nZSJdLCJtYXBwaW5ncyI6IkFBQUE7QUFFQSxJQUFJQSxJQUFJLEdBQUcsSUFBWDs7QUFFQSxLQUFLQyxpQkFBTCxHQUF5QixVQUFVQyxJQUFWLEVBQWdCO0FBQ3JDLE1BQUlDLE1BQU0sR0FBRyxrREFBYjs7QUFDQSxPQUFJLElBQUlDLENBQUMsR0FBRyxDQUFaLEVBQWVBLENBQUMsR0FBQ0YsSUFBSSxDQUFDRyxNQUF0QixFQUE4QkQsQ0FBQyxFQUEvQixFQUFrQztBQUM5QkQsVUFBTSxJQUFJLG9CQUFvQkQsSUFBSSxDQUFDRSxDQUFELENBQUosQ0FBUUUsRUFBNUIsR0FBaUMsSUFBakMsR0FBd0NKLElBQUksQ0FBQ0UsQ0FBRCxDQUFKLENBQVFHLElBQWhELEdBQXVELFdBQWpFO0FBQ0g7O0FBQ0QsU0FBT0osTUFBUDtBQUNILENBTkQ7O0FBUUEsS0FBS0ssa0JBQUwsR0FBMEIsWUFBVTtBQUNoQ0MsT0FBSyxDQUFDQyxHQUFOLENBQVcsb0NBQW9DQyxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsTUFBeEIsRUFBZ0NDLEtBQS9FLEVBQ0NDLElBREQsQ0FDTSxVQUFVQyxRQUFWLEVBQW9CO0FBQ3RCSixZQUFRLENBQUNDLGNBQVQsQ0FBd0IsUUFBeEIsRUFBa0NJLFNBQWxDLEdBQThDaEIsSUFBSSxDQUFDQyxpQkFBTCxDQUF1QmMsUUFBUSxDQUFDYixJQUFoQyxDQUE5QztBQUNILEdBSEQsV0FJTyxVQUFVZSxLQUFWLEVBQWlCO0FBQ3BCO0FBQ0FDLFdBQU8sQ0FBQ0MsR0FBUixDQUFZRixLQUFaO0FBQ0gsR0FQRDtBQVFILENBVEQ7O0FBV0EsS0FBS0csVUFBTCxHQUFrQixZQUFVO0FBQ3hCLE1BQUlQLEtBQUssR0FBR0YsUUFBUSxDQUFDQyxjQUFULENBQXdCLE1BQXhCLEVBQWdDQyxLQUE1Qzs7QUFDQSxNQUFHQSxLQUFLLEtBQUssT0FBYixFQUFxQjtBQUNqQkYsWUFBUSxDQUFDQyxjQUFULENBQXdCLFVBQXhCLEVBQW9DUyxTQUFwQyxDQUE4Q0MsR0FBOUMsQ0FBa0QsUUFBbEQ7QUFDQVgsWUFBUSxDQUFDQyxjQUFULENBQXdCLHFCQUF4QixFQUErQ1MsU0FBL0MsQ0FBeURDLEdBQXpELENBQTZELFFBQTdEO0FBQ0FYLFlBQVEsQ0FBQ0MsY0FBVCxDQUF3QixVQUF4QixFQUFvQ1MsU0FBcEMsQ0FBOENDLEdBQTlDLENBQWtELFFBQWxEO0FBQ0gsR0FKRCxNQUlNLElBQUdULEtBQUssS0FBSyxNQUFiLEVBQW9CO0FBQ3RCRixZQUFRLENBQUNDLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NTLFNBQXBDLENBQThDRSxNQUE5QyxDQUFxRCxRQUFyRDtBQUNBWixZQUFRLENBQUNDLGNBQVQsQ0FBd0IscUJBQXhCLEVBQStDUyxTQUEvQyxDQUF5REUsTUFBekQsQ0FBZ0UsUUFBaEU7QUFDQVosWUFBUSxDQUFDQyxjQUFULENBQXdCLFVBQXhCLEVBQW9DUyxTQUFwQyxDQUE4Q0UsTUFBOUMsQ0FBcUQsUUFBckQ7QUFDSCxHQUpLLE1BSUQ7QUFDRFosWUFBUSxDQUFDQyxjQUFULENBQXdCLFVBQXhCLEVBQW9DUyxTQUFwQyxDQUE4Q0MsR0FBOUMsQ0FBa0QsUUFBbEQ7QUFDQVgsWUFBUSxDQUFDQyxjQUFULENBQXdCLHFCQUF4QixFQUErQ1MsU0FBL0MsQ0FBeURFLE1BQXpELENBQWdFLFFBQWhFO0FBQ0FaLFlBQVEsQ0FBQ0MsY0FBVCxDQUF3QixVQUF4QixFQUFvQ1MsU0FBcEMsQ0FBOENFLE1BQTlDLENBQXFELFFBQXJEO0FBQ0g7QUFDSixDQWZEOztBQWlCQSxLQUFLZixrQkFBTDtBQUNBLEtBQUtZLFVBQUw7O0FBQ0FULFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixNQUF4QixFQUFnQ1ksUUFBaEMsR0FBMkMsWUFBVTtBQUFDeEIsTUFBSSxDQUFDUSxrQkFBTDtBQUEwQixDQUFoRjs7QUFDQUcsUUFBUSxDQUFDQyxjQUFULENBQXdCLE1BQXhCLEVBQWdDWSxRQUFoQyxHQUEyQyxZQUFVO0FBQUN4QixNQUFJLENBQUNvQixVQUFMO0FBQWtCLENBQXhFIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2NvcmV1aS9tZW51LWNyZWF0ZS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qIDExLjEyLjIwMTkgKi9cclxuXHJcbmxldCBzZWxmID0gdGhpcztcclxuXHJcbnRoaXMuYnVpbGRTZWxlY3RQYXJlbnQgPSBmdW5jdGlvbiggZGF0YSApe1xyXG4gICAgbGV0IHJlc3VsdCA9ICc8b3B0aW9uIHZhbHVlPVwibm9uZVwiPkRvIG5vdCBoYXZlIHBhcmVudDwvb3B0aW9uPidcclxuICAgIGZvcihsZXQgaSA9IDA7IGk8ZGF0YS5sZW5ndGg7IGkrKyl7XHJcbiAgICAgICAgcmVzdWx0ICs9ICc8b3B0aW9uIHZhbHVlPVwiJyArIGRhdGFbaV0uaWQgKyAnXCI+JyArIGRhdGFbaV0ubmFtZSArICc8L29wdGlvbj4nXHJcbiAgICB9XHJcbiAgICByZXR1cm4gcmVzdWx0XHJcbn1cclxuXHJcbnRoaXMudXBkYXRlU2VsZWN0UGFyZW50ID0gZnVuY3Rpb24oKXtcclxuICAgIGF4aW9zLmdldCggJy9tZW51L2VsZW1lbnQvZ2V0LXBhcmVudHM/bWVudT0nICsgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJtZW51XCIpLnZhbHVlIClcclxuICAgIC50aGVuKGZ1bmN0aW9uIChyZXNwb25zZSkge1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicGFyZW50XCIpLmlubmVySFRNTCA9IHNlbGYuYnVpbGRTZWxlY3RQYXJlbnQocmVzcG9uc2UuZGF0YSlcclxuICAgIH0pXHJcbiAgICAuY2F0Y2goZnVuY3Rpb24gKGVycm9yKSB7XHJcbiAgICAgICAgLy8gaGFuZGxlIGVycm9yXHJcbiAgICAgICAgY29uc29sZS5sb2coZXJyb3IpXHJcbiAgICB9KVxyXG59XHJcblxyXG50aGlzLnRvZ2dsZURpdnMgPSBmdW5jdGlvbigpe1xyXG4gICAgbGV0IHZhbHVlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJ0eXBlXCIpLnZhbHVlXHJcbiAgICBpZih2YWx1ZSA9PT0gJ3RpdGxlJyl7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rpdi1ocmVmJykuY2xhc3NMaXN0LmFkZCgnZC1ub25lJylcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGl2LWRyb3Bkb3duLXBhcmVudCcpLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpXHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rpdi1pY29uJykuY2xhc3NMaXN0LmFkZCgnZC1ub25lJylcclxuICAgIH1lbHNlIGlmKHZhbHVlID09PSAnbGluaycpe1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXYtaHJlZicpLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpXHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rpdi1kcm9wZG93bi1wYXJlbnQnKS5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKVxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXYtaWNvbicpLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpXHJcbiAgICB9ZWxzZXtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGl2LWhyZWYnKS5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKVxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXYtZHJvcGRvd24tcGFyZW50JykuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJylcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGl2LWljb24nKS5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKVxyXG4gICAgfVxyXG59XHJcblxyXG50aGlzLnVwZGF0ZVNlbGVjdFBhcmVudCgpXHJcbnRoaXMudG9nZ2xlRGl2cygpXHJcbmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibWVudVwiKS5vbmNoYW5nZSA9IGZ1bmN0aW9uKCl7c2VsZi51cGRhdGVTZWxlY3RQYXJlbnQoKX1cclxuZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJ0eXBlXCIpLm9uY2hhbmdlID0gZnVuY3Rpb24oKXtzZWxmLnRvZ2dsZURpdnMoKX1cclxuXHJcblxyXG5cclxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/coreui/menu-create.js\n");

/***/ }),

/***/ 1:
/*!**************************************************!*\
  !*** multi ./resources/js/coreui/menu-create.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\iir\Desktop\CODE\covid\resources\js\coreui\menu-create.js */"./resources/js/coreui/menu-create.js");


/***/ })

/******/ });