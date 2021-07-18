(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @inertiajs/inertia-vue3 */ "./node_modules/@inertiajs/inertia-vue3/dist/index.js");
/* harmony import */ var _inertiajs_progress__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @inertiajs/progress */ "./node_modules/@inertiajs/progress/dist/index.js");
__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js"); // Import modules...





var el = document.getElementById('app');
(0,vue__WEBPACK_IMPORTED_MODULE_0__.createApp)({
  render: function render() {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_1__.App, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: function resolveComponent(name) {
        return __webpack_require__("./resources/js/Pages lazy recursive ^\\.\\/.*$")("./".concat(name)).then(function (module) {
          return module["default"];
        });
      }
    });
  }
}).mixin({
  methods: {
    route: route
  }
}).use(_inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_1__.plugin).mount(el);
_inertiajs_progress__WEBPACK_IMPORTED_MODULE_2__.InertiaProgress.init({
  color: '#4B5563'
}); //Vue.config.devtools = true
//createApp.config.devtools = true

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var laravel_echo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-echo */ "./node_modules/laravel-echo/dist/echo.js");
window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


window.Pusher = __webpack_require__(/*! pusher-js */ "./node_modules/pusher-js/dist/web/pusher.js"); // Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

window.EchoService = {
  // initialise echo instance/pusher connection only when and where called not on app launch and every page
  init: function init() {
    return new laravel_echo__WEBPACK_IMPORTED_MODULE_0__.default({
      broadcaster: 'pusher',
      key: "75776d8b6015bf99040b",
      cluster: "eu",
      forceTLS: true,
      authEndpoint: '/pusher/auth',
      auth: {
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      }
    });
  }
}; // window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,1
//     forceTLS: true,
//     authEndpoint: '/pusher/auth',
//     auth: {
//         headers: {
//             'X-CSRF-TOKEN': '{{ csrf_token() }}',
//         }
//     }
// });
// import Vue from 'vue';
// window.Vue = require('vue');
// Vue.config.devtools = true;

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/Pages lazy recursive ^\\.\\/.*$":
/*!************************************************************!*\
  !*** ./resources/js/Pages/ lazy ^\.\/.*$ namespace object ***!
  \************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./AdminShowProfile": [
		"./resources/js/Pages/AdminShowProfile.vue",
		"resources_js_Pages_AdminShowProfile_vue"
	],
	"./AdminShowProfile.vue": [
		"./resources/js/Pages/AdminShowProfile.vue",
		"resources_js_Pages_AdminShowProfile_vue"
	],
	"./AllUsers": [
		"./resources/js/Pages/AllUsers.vue",
		"resources_js_Pages_AllUsers_vue"
	],
	"./AllUsers.vue": [
		"./resources/js/Pages/AllUsers.vue",
		"resources_js_Pages_AllUsers_vue"
	],
	"./Auth/ConfirmPassword": [
		"./resources/js/Pages/Auth/ConfirmPassword.vue",
		"resources_js_Pages_Auth_ConfirmPassword_vue"
	],
	"./Auth/ConfirmPassword.vue": [
		"./resources/js/Pages/Auth/ConfirmPassword.vue",
		"resources_js_Pages_Auth_ConfirmPassword_vue"
	],
	"./Auth/ForgotPassword": [
		"./resources/js/Pages/Auth/ForgotPassword.vue",
		"resources_js_Pages_Auth_ForgotPassword_vue"
	],
	"./Auth/ForgotPassword.vue": [
		"./resources/js/Pages/Auth/ForgotPassword.vue",
		"resources_js_Pages_Auth_ForgotPassword_vue"
	],
	"./Auth/Login": [
		"./resources/js/Pages/Auth/Login.vue",
		"resources_js_Pages_Auth_Login_vue"
	],
	"./Auth/Login.vue": [
		"./resources/js/Pages/Auth/Login.vue",
		"resources_js_Pages_Auth_Login_vue"
	],
	"./Auth/Register": [
		"./resources/js/Pages/Auth/Register.vue",
		"resources_js_Pages_Auth_Register_vue"
	],
	"./Auth/Register.vue": [
		"./resources/js/Pages/Auth/Register.vue",
		"resources_js_Pages_Auth_Register_vue"
	],
	"./Auth/ResetPassword": [
		"./resources/js/Pages/Auth/ResetPassword.vue",
		"resources_js_Pages_Auth_ResetPassword_vue"
	],
	"./Auth/ResetPassword.vue": [
		"./resources/js/Pages/Auth/ResetPassword.vue",
		"resources_js_Pages_Auth_ResetPassword_vue"
	],
	"./Auth/VerifyEmail": [
		"./resources/js/Pages/Auth/VerifyEmail.vue",
		"resources_js_Pages_Auth_VerifyEmail_vue"
	],
	"./Auth/VerifyEmail.vue": [
		"./resources/js/Pages/Auth/VerifyEmail.vue",
		"resources_js_Pages_Auth_VerifyEmail_vue"
	],
	"./Auth/VerifyPhoneNumber": [
		"./resources/js/Pages/Auth/VerifyPhoneNumber.vue",
		"resources_js_Pages_Auth_VerifyPhoneNumber_vue"
	],
	"./Auth/VerifyPhoneNumber.vue": [
		"./resources/js/Pages/Auth/VerifyPhoneNumber.vue",
		"resources_js_Pages_Auth_VerifyPhoneNumber_vue"
	],
	"./Auth/VerifyTwoFa": [
		"./resources/js/Pages/Auth/VerifyTwoFa.vue",
		"resources_js_Pages_Auth_VerifyTwoFa_vue"
	],
	"./Auth/VerifyTwoFa.vue": [
		"./resources/js/Pages/Auth/VerifyTwoFa.vue",
		"resources_js_Pages_Auth_VerifyTwoFa_vue"
	],
	"./CloseAccount": [
		"./resources/js/Pages/CloseAccount.vue",
		"resources_js_Pages_CloseAccount_vue"
	],
	"./CloseAccount.vue": [
		"./resources/js/Pages/CloseAccount.vue",
		"resources_js_Pages_CloseAccount_vue"
	],
	"./CreateProfile": [
		"./resources/js/Pages/CreateProfile.vue",
		"resources_js_Pages_CreateProfile_vue"
	],
	"./CreateProfile.vue": [
		"./resources/js/Pages/CreateProfile.vue",
		"resources_js_Pages_CreateProfile_vue"
	],
	"./Dashboard": [
		"./resources/js/Pages/Dashboard.vue",
		"resources_js_Pages_Dashboard_vue"
	],
	"./Dashboard.vue": [
		"./resources/js/Pages/Dashboard.vue",
		"resources_js_Pages_Dashboard_vue"
	],
	"./EditProfile": [
		"./resources/js/Pages/EditProfile.vue",
		"resources_js_Pages_EditProfile_vue"
	],
	"./EditProfile.vue": [
		"./resources/js/Pages/EditProfile.vue",
		"resources_js_Pages_EditProfile_vue"
	],
	"./Pde": [
		"./resources/js/Pages/Pde.vue",
		"resources_js_Pages_Pde_vue"
	],
	"./Pde.vue": [
		"./resources/js/Pages/Pde.vue",
		"resources_js_Pages_Pde_vue"
	],
	"./Settings": [
		"./resources/js/Pages/Settings.vue",
		"resources_js_Pages_Settings_vue"
	],
	"./Settings.vue": [
		"./resources/js/Pages/Settings.vue",
		"resources_js_Pages_Settings_vue"
	],
	"./ShowProfile": [
		"./resources/js/Pages/ShowProfile.vue",
		"resources_js_Pages_ShowProfile_vue"
	],
	"./ShowProfile.vue": [
		"./resources/js/Pages/ShowProfile.vue",
		"resources_js_Pages_ShowProfile_vue"
	],
	"./TwoFa": [
		"./resources/js/Pages/TwoFa.vue",
		"/js/vendor",
		"resources_js_Pages_TwoFa_vue"
	],
	"./TwoFa.vue": [
		"./resources/js/Pages/TwoFa.vue",
		"/js/vendor",
		"resources_js_Pages_TwoFa_vue"
	],
	"./Welcome": [
		"./resources/js/Pages/Welcome.vue",
		"/js/vendor",
		"resources_js_Pages_Welcome_vue"
	],
	"./Welcome.vue": [
		"./resources/js/Pages/Welcome.vue",
		"/js/vendor",
		"resources_js_Pages_Welcome_vue"
	]
};
function webpackAsyncContext(req) {
	if(!__webpack_require__.o(map, req)) {
		return Promise.resolve().then(() => {
			var e = new Error("Cannot find module '" + req + "'");
			e.code = 'MODULE_NOT_FOUND';
			throw e;
		});
	}

	var ids = map[req], id = ids[0];
	return Promise.all(ids.slice(1).map(__webpack_require__.e)).then(() => {
		return __webpack_require__(id);
	});
}
webpackAsyncContext.keys = () => (Object.keys(map));
webpackAsyncContext.id = "./resources/js/Pages lazy recursive ^\\.\\/.*$";
module.exports = webpackAsyncContext;

/***/ }),

/***/ "?4f7e":
/*!********************************!*\
  !*** ./util.inspect (ignored) ***!
  \********************************/
/***/ (() => {

/* (ignored) */

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["css/app","/js/vendor"], () => (__webpack_exec__("./resources/js/app.js"), __webpack_exec__("./resources/css/app.css")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);