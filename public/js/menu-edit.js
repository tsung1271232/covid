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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/coreui/menu-edit.js":
/*!******************************************!*\
  !*** ./resources/js/coreui/menu-edit.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/* 11.12.2019 */\nvar self = this;\n\nthis.buildSelectParent = function (data) {\n  var result = '<option value=\"none\">Do not have parent</option>';\n  $parentId = document.getElementById('parentId').value;\n  $menuElementId = document.getElementById('menuElementId').value;\n\n  for (var i = 0; i < data.length; i++) {\n    if (data[i].id != $menuElementId) {\n      if (data[i].id == $parentId) {\n        result += '<option value=\"' + data[i].id + '\" selected>' + data[i].name + '</option>';\n      } else {\n        result += '<option value=\"' + data[i].id + '\">' + data[i].name + '</option>';\n      }\n    }\n  }\n\n  return result;\n};\n\nthis.updateSelectParent = function () {\n  axios.get('/menu/element/get-parents?menu=' + document.getElementById(\"menu\").value).then(function (response) {\n    document.getElementById(\"parent\").innerHTML = self.buildSelectParent(response.data);\n  })[\"catch\"](function (error) {\n    // handle error\n    console.log(error);\n  });\n};\n\nthis.toggleDivs = function () {\n  var value = document.getElementById(\"type\").value;\n\n  if (value === 'title') {\n    document.getElementById('div-href').classList.add('d-none');\n    document.getElementById('div-dropdown-parent').classList.add('d-none');\n    document.getElementById('div-icon').classList.add('d-none');\n  } else if (value === 'link') {\n    document.getElementById('div-href').classList.remove('d-none');\n    document.getElementById('div-dropdown-parent').classList.remove('d-none');\n    document.getElementById('div-icon').classList.remove('d-none');\n  } else {\n    document.getElementById('div-href').classList.add('d-none');\n    document.getElementById('div-dropdown-parent').classList.remove('d-none');\n    document.getElementById('div-icon').classList.remove('d-none');\n  }\n};\n\nthis.updateSelectParent();\nthis.toggleDivs();\n\ndocument.getElementById(\"menu\").onchange = function () {\n  self.updateSelectParent();\n};\n\ndocument.getElementById(\"type\").onchange = function () {\n  self.toggleDivs();\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY29yZXVpL21lbnUtZWRpdC5qcz9iNWM1Il0sIm5hbWVzIjpbInNlbGYiLCJidWlsZFNlbGVjdFBhcmVudCIsImRhdGEiLCJyZXN1bHQiLCIkcGFyZW50SWQiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwidmFsdWUiLCIkbWVudUVsZW1lbnRJZCIsImkiLCJsZW5ndGgiLCJpZCIsIm5hbWUiLCJ1cGRhdGVTZWxlY3RQYXJlbnQiLCJheGlvcyIsImdldCIsInRoZW4iLCJyZXNwb25zZSIsImlubmVySFRNTCIsImVycm9yIiwiY29uc29sZSIsImxvZyIsInRvZ2dsZURpdnMiLCJjbGFzc0xpc3QiLCJhZGQiLCJyZW1vdmUiLCJvbmNoYW5nZSJdLCJtYXBwaW5ncyI6IkFBQUE7QUFFQSxJQUFJQSxJQUFJLEdBQUcsSUFBWDs7QUFFQSxLQUFLQyxpQkFBTCxHQUF5QixVQUFVQyxJQUFWLEVBQWdCO0FBQ3JDLE1BQUlDLE1BQU0sR0FBRyxrREFBYjtBQUNBQyxXQUFTLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixVQUF4QixFQUFvQ0MsS0FBaEQ7QUFDQUMsZ0JBQWMsR0FBR0gsUUFBUSxDQUFDQyxjQUFULENBQXdCLGVBQXhCLEVBQXlDQyxLQUExRDs7QUFDQSxPQUFJLElBQUlFLENBQUMsR0FBRyxDQUFaLEVBQWVBLENBQUMsR0FBQ1AsSUFBSSxDQUFDUSxNQUF0QixFQUE4QkQsQ0FBQyxFQUEvQixFQUFrQztBQUM5QixRQUFHUCxJQUFJLENBQUNPLENBQUQsQ0FBSixDQUFRRSxFQUFSLElBQWNILGNBQWpCLEVBQWdDO0FBQzVCLFVBQUdOLElBQUksQ0FBQ08sQ0FBRCxDQUFKLENBQVFFLEVBQVIsSUFBY1AsU0FBakIsRUFBMkI7QUFDdkJELGNBQU0sSUFBSSxvQkFBb0JELElBQUksQ0FBQ08sQ0FBRCxDQUFKLENBQVFFLEVBQTVCLEdBQWlDLGFBQWpDLEdBQWlEVCxJQUFJLENBQUNPLENBQUQsQ0FBSixDQUFRRyxJQUF6RCxHQUFnRSxXQUExRTtBQUNILE9BRkQsTUFFSztBQUNEVCxjQUFNLElBQUksb0JBQW9CRCxJQUFJLENBQUNPLENBQUQsQ0FBSixDQUFRRSxFQUE1QixHQUFpQyxJQUFqQyxHQUF3Q1QsSUFBSSxDQUFDTyxDQUFELENBQUosQ0FBUUcsSUFBaEQsR0FBdUQsV0FBakU7QUFDSDtBQUNKO0FBQ0o7O0FBQ0QsU0FBT1QsTUFBUDtBQUNILENBZEQ7O0FBZ0JBLEtBQUtVLGtCQUFMLEdBQTBCLFlBQVU7QUFDaENDLE9BQUssQ0FBQ0MsR0FBTixDQUFXLG9DQUFvQ1YsUUFBUSxDQUFDQyxjQUFULENBQXdCLE1BQXhCLEVBQWdDQyxLQUEvRSxFQUNDUyxJQURELENBQ00sVUFBVUMsUUFBVixFQUFvQjtBQUN0QlosWUFBUSxDQUFDQyxjQUFULENBQXdCLFFBQXhCLEVBQWtDWSxTQUFsQyxHQUE4Q2xCLElBQUksQ0FBQ0MsaUJBQUwsQ0FBdUJnQixRQUFRLENBQUNmLElBQWhDLENBQTlDO0FBQ0gsR0FIRCxXQUlPLFVBQVVpQixLQUFWLEVBQWlCO0FBQ3BCO0FBQ0FDLFdBQU8sQ0FBQ0MsR0FBUixDQUFZRixLQUFaO0FBQ0gsR0FQRDtBQVFILENBVEQ7O0FBV0EsS0FBS0csVUFBTCxHQUFrQixZQUFVO0FBQ3hCLE1BQUlmLEtBQUssR0FBR0YsUUFBUSxDQUFDQyxjQUFULENBQXdCLE1BQXhCLEVBQWdDQyxLQUE1Qzs7QUFDQSxNQUFHQSxLQUFLLEtBQUssT0FBYixFQUFxQjtBQUNqQkYsWUFBUSxDQUFDQyxjQUFULENBQXdCLFVBQXhCLEVBQW9DaUIsU0FBcEMsQ0FBOENDLEdBQTlDLENBQWtELFFBQWxEO0FBQ0FuQixZQUFRLENBQUNDLGNBQVQsQ0FBd0IscUJBQXhCLEVBQStDaUIsU0FBL0MsQ0FBeURDLEdBQXpELENBQTZELFFBQTdEO0FBQ0FuQixZQUFRLENBQUNDLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NpQixTQUFwQyxDQUE4Q0MsR0FBOUMsQ0FBa0QsUUFBbEQ7QUFDSCxHQUpELE1BSU0sSUFBR2pCLEtBQUssS0FBSyxNQUFiLEVBQW9CO0FBQ3RCRixZQUFRLENBQUNDLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NpQixTQUFwQyxDQUE4Q0UsTUFBOUMsQ0FBcUQsUUFBckQ7QUFDQXBCLFlBQVEsQ0FBQ0MsY0FBVCxDQUF3QixxQkFBeEIsRUFBK0NpQixTQUEvQyxDQUF5REUsTUFBekQsQ0FBZ0UsUUFBaEU7QUFDQXBCLFlBQVEsQ0FBQ0MsY0FBVCxDQUF3QixVQUF4QixFQUFvQ2lCLFNBQXBDLENBQThDRSxNQUE5QyxDQUFxRCxRQUFyRDtBQUNILEdBSkssTUFJRDtBQUNEcEIsWUFBUSxDQUFDQyxjQUFULENBQXdCLFVBQXhCLEVBQW9DaUIsU0FBcEMsQ0FBOENDLEdBQTlDLENBQWtELFFBQWxEO0FBQ0FuQixZQUFRLENBQUNDLGNBQVQsQ0FBd0IscUJBQXhCLEVBQStDaUIsU0FBL0MsQ0FBeURFLE1BQXpELENBQWdFLFFBQWhFO0FBQ0FwQixZQUFRLENBQUNDLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NpQixTQUFwQyxDQUE4Q0UsTUFBOUMsQ0FBcUQsUUFBckQ7QUFDSDtBQUNKLENBZkQ7O0FBaUJBLEtBQUtaLGtCQUFMO0FBQ0EsS0FBS1MsVUFBTDs7QUFDQWpCLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixNQUF4QixFQUFnQ29CLFFBQWhDLEdBQTJDLFlBQVU7QUFBQzFCLE1BQUksQ0FBQ2Esa0JBQUw7QUFBMEIsQ0FBaEY7O0FBQ0FSLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixNQUF4QixFQUFnQ29CLFFBQWhDLEdBQTJDLFlBQVU7QUFBQzFCLE1BQUksQ0FBQ3NCLFVBQUw7QUFBa0IsQ0FBeEUiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29yZXVpL21lbnUtZWRpdC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qIDExLjEyLjIwMTkgKi9cclxuXHJcbmxldCBzZWxmID0gdGhpcztcclxuXHJcbnRoaXMuYnVpbGRTZWxlY3RQYXJlbnQgPSBmdW5jdGlvbiggZGF0YSApe1xyXG4gICAgbGV0IHJlc3VsdCA9ICc8b3B0aW9uIHZhbHVlPVwibm9uZVwiPkRvIG5vdCBoYXZlIHBhcmVudDwvb3B0aW9uPidcclxuICAgICRwYXJlbnRJZCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwYXJlbnRJZCcpLnZhbHVlXHJcbiAgICAkbWVudUVsZW1lbnRJZCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtZW51RWxlbWVudElkJykudmFsdWVcclxuICAgIGZvcihsZXQgaSA9IDA7IGk8ZGF0YS5sZW5ndGg7IGkrKyl7XHJcbiAgICAgICAgaWYoZGF0YVtpXS5pZCAhPSAkbWVudUVsZW1lbnRJZCl7XHJcbiAgICAgICAgICAgIGlmKGRhdGFbaV0uaWQgPT0gJHBhcmVudElkKXtcclxuICAgICAgICAgICAgICAgIHJlc3VsdCArPSAnPG9wdGlvbiB2YWx1ZT1cIicgKyBkYXRhW2ldLmlkICsgJ1wiIHNlbGVjdGVkPicgKyBkYXRhW2ldLm5hbWUgKyAnPC9vcHRpb24+J1xyXG4gICAgICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgICAgIHJlc3VsdCArPSAnPG9wdGlvbiB2YWx1ZT1cIicgKyBkYXRhW2ldLmlkICsgJ1wiPicgKyBkYXRhW2ldLm5hbWUgKyAnPC9vcHRpb24+J1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgcmV0dXJuIHJlc3VsdFxyXG59XHJcblxyXG50aGlzLnVwZGF0ZVNlbGVjdFBhcmVudCA9IGZ1bmN0aW9uKCl7XHJcbiAgICBheGlvcy5nZXQoICcvbWVudS9lbGVtZW50L2dldC1wYXJlbnRzP21lbnU9JyArIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibWVudVwiKS52YWx1ZSApXHJcbiAgICAudGhlbihmdW5jdGlvbiAocmVzcG9uc2UpIHtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInBhcmVudFwiKS5pbm5lckhUTUwgPSBzZWxmLmJ1aWxkU2VsZWN0UGFyZW50KHJlc3BvbnNlLmRhdGEpXHJcbiAgICB9KVxyXG4gICAgLmNhdGNoKGZ1bmN0aW9uIChlcnJvcikge1xyXG4gICAgICAgIC8vIGhhbmRsZSBlcnJvclxyXG4gICAgICAgIGNvbnNvbGUubG9nKGVycm9yKVxyXG4gICAgfSlcclxufVxyXG5cclxudGhpcy50b2dnbGVEaXZzID0gZnVuY3Rpb24oKXtcclxuICAgIGxldCB2YWx1ZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidHlwZVwiKS52YWx1ZVxyXG4gICAgaWYodmFsdWUgPT09ICd0aXRsZScpe1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXYtaHJlZicpLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpXHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rpdi1kcm9wZG93bi1wYXJlbnQnKS5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKVxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXYtaWNvbicpLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpXHJcbiAgICB9ZWxzZSBpZih2YWx1ZSA9PT0gJ2xpbmsnKXtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGl2LWhyZWYnKS5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKVxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXYtZHJvcGRvd24tcGFyZW50JykuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJylcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGl2LWljb24nKS5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKVxyXG4gICAgfWVsc2V7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rpdi1ocmVmJykuY2xhc3NMaXN0LmFkZCgnZC1ub25lJylcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGl2LWRyb3Bkb3duLXBhcmVudCcpLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpXHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rpdi1pY29uJykuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJylcclxuICAgIH1cclxufVxyXG5cclxudGhpcy51cGRhdGVTZWxlY3RQYXJlbnQoKVxyXG50aGlzLnRvZ2dsZURpdnMoKVxyXG5kb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm1lbnVcIikub25jaGFuZ2UgPSBmdW5jdGlvbigpe3NlbGYudXBkYXRlU2VsZWN0UGFyZW50KCl9XHJcbmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidHlwZVwiKS5vbmNoYW5nZSA9IGZ1bmN0aW9uKCl7c2VsZi50b2dnbGVEaXZzKCl9XHJcblxyXG5cclxuXHJcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/coreui/menu-edit.js\n");

/***/ }),

/***/ 2:
/*!************************************************!*\
  !*** multi ./resources/js/coreui/menu-edit.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\iir\Desktop\CODE\covid\resources\js\coreui\menu-edit.js */"./resources/js/coreui/menu-edit.js");


/***/ })

/******/ });