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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/coreui/media-cropp.js":
/*!********************************************!*\
  !*** ./resources/js/coreui/media-cropp.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("var self = this;\nthis.changePort = ''; // :8000\n\nthis.removeFolderModal = new coreui.Modal(document.getElementById('cropp-img-modal'));\nthis.cropper = null;\nthis.croppUrl = null;\nthis.croppFileId = null;\n\nthis.uploadCroppedImage = function () {\n  self.cropper.getCroppedCanvas().toBlob(function (blob) {\n    var formData = new FormData();\n    formData.append('file', blob);\n    formData.append('thisFolder', document.getElementById('this-folder-id').value);\n    formData.append('id', self.croppFileId);\n    axios.post('/media/file/cropp', formData).then(function (response) {\n      location.reload();\n    })[\"catch\"](function (error) {\n      console.log(error);\n    });\n  }\n  /*, 'image/png' */\n  );\n};\n\nthis.afterShowedCroppModal = function () {\n  if (self.cropper !== null) {\n    self.cropper.replace(self.croppUrl);\n  } else {\n    var image = document.getElementById('cropp-img-img');\n    self.cropper = new Cropper(image, {\n      minContainerWidth: 600,\n      minContainerHeight: 600\n    });\n  }\n};\n\nthis.showCroppModal = function (data) {\n  self.croppUrl = data.url;\n  self.croppUrl = self.croppUrl.replace('localhost', 'localhost' + self.changePort);\n  document.getElementById('cropp-img-img').setAttribute('src', self.croppUrl);\n  self.removeFolderModal.show();\n};\n\nthis.croppImg = function (e) {\n  self.croppFileId = e.target.getAttribute('atr');\n  axios.get('/media/file?id=' + self.croppFileId + '&thisFolder=' + document.getElementById('this-folder-id').value).then(function (response) {\n    self.showCroppModal(response.data);\n  })[\"catch\"](function (error) {\n    console.log(error);\n  });\n};\n\nvar croppFiles = document.getElementsByClassName(\"file-cropp-file\");\n\nfor (var i = 0; i < croppFiles.length; i++) {\n  croppFiles[i].addEventListener('click', this.croppImg);\n}\n\ndocument.getElementById(\"cropp-img-modal\").addEventListener(\"show.coreui.modal\", this.afterShowedCroppModal);\ndocument.getElementById('cropp-img-save-button').addEventListener('click', this.uploadCroppedImage);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY29yZXVpL21lZGlhLWNyb3BwLmpzP2E5M2YiXSwibmFtZXMiOlsic2VsZiIsImNoYW5nZVBvcnQiLCJyZW1vdmVGb2xkZXJNb2RhbCIsImNvcmV1aSIsIk1vZGFsIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImNyb3BwZXIiLCJjcm9wcFVybCIsImNyb3BwRmlsZUlkIiwidXBsb2FkQ3JvcHBlZEltYWdlIiwiZ2V0Q3JvcHBlZENhbnZhcyIsInRvQmxvYiIsImJsb2IiLCJmb3JtRGF0YSIsIkZvcm1EYXRhIiwiYXBwZW5kIiwidmFsdWUiLCJheGlvcyIsInBvc3QiLCJ0aGVuIiwicmVzcG9uc2UiLCJsb2NhdGlvbiIsInJlbG9hZCIsImVycm9yIiwiY29uc29sZSIsImxvZyIsImFmdGVyU2hvd2VkQ3JvcHBNb2RhbCIsInJlcGxhY2UiLCJpbWFnZSIsIkNyb3BwZXIiLCJtaW5Db250YWluZXJXaWR0aCIsIm1pbkNvbnRhaW5lckhlaWdodCIsInNob3dDcm9wcE1vZGFsIiwiZGF0YSIsInVybCIsInNldEF0dHJpYnV0ZSIsInNob3ciLCJjcm9wcEltZyIsImUiLCJ0YXJnZXQiLCJnZXRBdHRyaWJ1dGUiLCJnZXQiLCJjcm9wcEZpbGVzIiwiZ2V0RWxlbWVudHNCeUNsYXNzTmFtZSIsImkiLCJsZW5ndGgiLCJhZGRFdmVudExpc3RlbmVyIl0sIm1hcHBpbmdzIjoiQUFBSSxJQUFJQSxJQUFJLEdBQUcsSUFBWDtBQUVBLEtBQUtDLFVBQUwsR0FBa0IsRUFBbEIsQyxDQUFxQjs7QUFFckIsS0FBS0MsaUJBQUwsR0FBeUIsSUFBSUMsTUFBTSxDQUFDQyxLQUFYLENBQWlCQyxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsaUJBQXhCLENBQWpCLENBQXpCO0FBRUEsS0FBS0MsT0FBTCxHQUFlLElBQWY7QUFDQSxLQUFLQyxRQUFMLEdBQWdCLElBQWhCO0FBQ0EsS0FBS0MsV0FBTCxHQUFtQixJQUFuQjs7QUFFQSxL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QUtULFFBQTlDO0FBQ0g7O0FBQ0RqQyxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsaUJBQXhCLEVBQTJDeUMsZ0JBQTNDLENBQTRELG1CQUE1RCxFQUFrRixLQUFLcEIscUJBQXZGO0FBQ0F0QixRQUFRLENBQUNDLGNBQVQsQ0FBd0IsdUJBQXhCLEVBQWlEeUMsZ0JBQWpELENBQWtFLE9BQWxFLEVBQTJFLEtBQUtyQyxrQkFBaEYiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29yZXVpL21lZGlhLWNyb3BwLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiICAgIHZhciBzZWxmID0gdGhpc1xyXG5cclxuICAgIHRoaXMuY2hhbmdlUG9ydCA9ICcnIC8vIDo4MDAwXHJcblxyXG4gICAgdGhpcy5yZW1vdmVGb2xkZXJNb2RhbCA9IG5ldyBjb3JldWkuTW9kYWwoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Nyb3BwLWltZy1tb2RhbCcpKVxyXG5cclxuICAgIHRoaXMuY3JvcHBlciA9IG51bGw7XHJcbiAgICB0aGlzLmNyb3BwVXJsID0gbnVsbDtcclxuICAgIHRoaXMuY3JvcHBGaWxlSWQgPSBudWxsO1xyXG5cclxuICAgIHRoaXMudXBsb2FkQ3JvcHBlZEltYWdlID0gZnVuY3Rpb24oKXtcclxuICAgICAgICBzZWxmLmNyb3BwZXIuZ2V0Q3JvcHBlZENhbnZhcygpLnRvQmxvYigoYmxvYikgPT4ge1xyXG4gICAgICAgICAgICBjb25zdCBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xyXG4gICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoJ2ZpbGUnLCBibG9iKTtcclxuICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKCd0aGlzRm9sZGVyJywgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3RoaXMtZm9sZGVyLWlkJykudmFsdWUpO1xyXG4gICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoJ2lkJywgc2VsZi5jcm9wcEZpbGVJZCApO1xyXG4gICAgICAgICAgICBheGlvcy5wb3N0KCAnL21lZGlhL2ZpbGUvY3JvcHAnLCBmb3JtRGF0YSApXHJcbiAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChyZXNwb25zZSkge1xyXG4gICAgICAgICAgICAgICAgbG9jYXRpb24ucmVsb2FkKCk7XHJcbiAgICAgICAgICAgIH0pXHJcbiAgICAgICAgICAgIC5jYXRjaChmdW5jdGlvbiAoZXJyb3IpIHtcclxuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGVycm9yKVxyXG4gICAgICAgICAgICB9KVxyXG4gICAgICAgIH0vKiwgJ2ltYWdlL3BuZycgKi8pO1xyXG4gICAgfVxyXG5cclxuICAgIHRoaXMuYWZ0ZXJTaG93ZWRDcm9wcE1vZGFsID0gZnVuY3Rpb24oKXtcclxuICAgICAgICBpZihzZWxmLmNyb3BwZXIgIT09IG51bGwpe1xyXG4gICAgICAgICAgICBzZWxmLmNyb3BwZXIucmVwbGFjZSggc2VsZi5jcm9wcFVybCApXHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIGxldCBpbWFnZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjcm9wcC1pbWctaW1nJyk7XHJcbiAgICAgICAgICAgIHNlbGYuY3JvcHBlciA9IG5ldyBDcm9wcGVyKGltYWdlLCB7XHJcbiAgICAgICAgICAgICAgICBtaW5Db250YWluZXJXaWR0aDogNjAwLFxyXG4gICAgICAgICAgICAgICAgbWluQ29udGFpbmVySGVpZ2h0OiA2MDBcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIHRoaXMuc2hvd0Nyb3BwTW9kYWwgPSBmdW5jdGlvbihkYXRhKXtcclxuICAgICAgICBzZWxmLmNyb3BwVXJsID0gZGF0YS51cmxcclxuICAgICAgICBzZWxmLmNyb3BwVXJsID0gc2VsZi5jcm9wcFVybC5yZXBsYWNlKCAnbG9jYWxob3N0JywgJ2xvY2FsaG9zdCcgKyBzZWxmLmNoYW5nZVBvcnQgKVxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjcm9wcC1pbWctaW1nJykuc2V0QXR0cmlidXRlKCdzcmMnLCBzZWxmLmNyb3BwVXJsKVxyXG4gICAgICAgIHNlbGYucmVtb3ZlRm9sZGVyTW9kYWwuc2hvdygpXHJcbiAgICB9XHJcblxyXG4gICAgdGhpcy5jcm9wcEltZyA9IGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIHNlbGYuY3JvcHBGaWxlSWQgPSBlLnRhcmdldC5nZXRBdHRyaWJ1dGUoJ2F0cicpXHJcbiAgICAgICAgYXhpb3MuZ2V0KCAnL21lZGlhL2ZpbGU/aWQ9JyArIHNlbGYuY3JvcHBGaWxlSWQgKyAnJnRoaXNGb2xkZXI9JyArIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd0aGlzLWZvbGRlci1pZCcpLnZhbHVlIClcclxuICAgICAgICAudGhlbihmdW5jdGlvbiAocmVzcG9uc2UpIHtcclxuICAgICAgICAgICAgc2VsZi5zaG93Q3JvcHBNb2RhbChyZXNwb25zZS5kYXRhKVxyXG4gICAgICAgIH0pXHJcbiAgICAgICAgLmNhdGNoKGZ1bmN0aW9uIChlcnJvcikge1xyXG4gICAgICAgICAgICBjb25zb2xlLmxvZyhlcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgfVxyXG5cclxuICAgIGxldCBjcm9wcEZpbGVzID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcImZpbGUtY3JvcHAtZmlsZVwiKVxyXG4gICAgZm9yKGxldCBpID0gMDsgaSA8IGNyb3BwRmlsZXMubGVuZ3RoOyBpKyspe1xyXG4gICAgICAgIGNyb3BwRmlsZXNbaV0uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAgdGhpcy5jcm9wcEltZyApXHJcbiAgICB9XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImNyb3BwLWltZy1tb2RhbFwiKS5hZGRFdmVudExpc3RlbmVyKFwic2hvdy5jb3JldWkubW9kYWxcIiwgIHRoaXMuYWZ0ZXJTaG93ZWRDcm9wcE1vZGFsICk7IFxyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Nyb3BwLWltZy1zYXZlLWJ1dHRvbicpLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgdGhpcy51cGxvYWRDcm9wcGVkSW1hZ2UgKTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/coreui/media-cropp.js\n");

/***/ }),

/***/ 4:
/*!**************************************************!*\
  !*** multi ./resources/js/coreui/media-cropp.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\iir\Desktop\CODE\covid\resources\js\coreui\media-cropp.js */"./resources/js/coreui/media-cropp.js");


/***/ })

/******/ });