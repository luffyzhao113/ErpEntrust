webpackJsonp([20],{

/***/ 105:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(149)
}
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(151)
/* template */
var __vue_template__ = __webpack_require__(153)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\admin\\js\\views\\common\\profile.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-67a5a7d8", Component.options)
  } else {
    hotAPI.reload("data-v-67a5a7d8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 149:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(150);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(2)("f3db42be", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-67a5a7d8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./profile.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-67a5a7d8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./profile.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 150:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(1)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 151:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _index = __webpack_require__(152);

exports.default = {
  data: function data() {
    return {
      formUpdate: this.$store.getters.user,
      ruleCreate: (0, _index.Validator)(this),
      setPassword: false,
      loadingVisible: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$http.get('auth').then(function (res) {
      _this.formUpdate = res.data.data;
      _this.$store.commit('setAuthData', res.data.data);
    });
  },

  methods: {
    updateSubmit: function updateSubmit(name, url) {
      var _this2 = this;

      this.$refs[name].validate(function (valid) {
        if (valid) {
          _this2.$http.put(url, _this2._data[name]).then(function (res) {
            _this2.$store.commit('setAuthData', res.data.data);
            _this2.$Message.success('Success!');
          }).catch(function (res) {
            _this2.formatErrors(res);
          }).finally(function () {
            _this2.loading = false;
          });
        } else {
          _this2.$Message.error('验证不通过!');
        }
      });
    }
  }
}; //
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/***/ }),

/***/ 152:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
var Validator = exports.Validator = function Validator(data) {
  var validateConfirm = function validateConfirm(rule, value, callback) {
    if (data.formUpdate.password !== value) {
      callback(new Error('两次密码不相同'));
    } else {
      callback();
    }
  };

  return {
    name: [{ required: true, type: 'string', message: '用户姓名不能为空', trigger: 'blur' }, { type: 'string', min: 2, max: 10, message: '用户姓名必须在 2 到 10 个字符之间', trigger: 'blur' }],
    email: [{ required: true, message: '用户邮箱不能为空', trigger: 'blur' }, { type: 'email', message: '邮箱格式不正确', trigger: 'blur' }],
    password: [{ min: 6, max: 20, type: 'string', message: '用户密码必须在 6 到 20 个字符之间', trigger: 'blur' }],
    password_confirmation: [{ validator: validateConfirm, trigger: 'blur' }]
  };
};

/***/ }),

/***/ 153:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("Card", { attrs: { bordered: false } }, [
        _c(
          "p",
          { attrs: { slot: "title" }, slot: "title" },
          [_c("Icon", { attrs: { type: "ios-person" } }), _vm._v("个人信息")],
          1
        ),
        _vm._v(" "),
        _c(
          "div",
          [
            _c(
              "Form",
              {
                ref: "formUpdate",
                attrs: {
                  model: _vm.formUpdate,
                  "label-position": "right",
                  "label-width": 100,
                  rules: _vm.ruleCreate
                }
              },
              [
                _c(
                  "FormItem",
                  { attrs: { label: "用户姓名:", prop: "name" } },
                  [
                    _c("Input", {
                      staticStyle: { width: "300px" },
                      model: {
                        value: _vm.formUpdate.name,
                        callback: function($$v) {
                          _vm.$set(_vm.formUpdate, "name", $$v)
                        },
                        expression: "formUpdate.name"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "FormItem",
                  { attrs: { label: "登录邮箱:", prop: "email" } },
                  [
                    _c("Input", {
                      staticStyle: { width: "300px" },
                      model: {
                        value: _vm.formUpdate.email,
                        callback: function($$v) {
                          _vm.$set(_vm.formUpdate, "email", $$v)
                        },
                        expression: "formUpdate.email"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "FormItem",
                  { attrs: { label: "用户密码", prop: "password" } },
                  [
                    _c("Input", {
                      staticStyle: { width: "300px" },
                      attrs: { placeholder: "用户密码" },
                      model: {
                        value: _vm.formUpdate.password,
                        callback: function($$v) {
                          _vm.$set(_vm.formUpdate, "password", $$v)
                        },
                        expression: "formUpdate.password"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "FormItem",
                  {
                    attrs: { label: "确认密码", prop: "password_confirmation" }
                  },
                  [
                    _c("Input", {
                      staticStyle: { width: "300px" },
                      attrs: { placeholder: "确认密码" },
                      model: {
                        value: _vm.formUpdate.password_confirmation,
                        callback: function($$v) {
                          _vm.$set(_vm.formUpdate, "password_confirmation", $$v)
                        },
                        expression: "formUpdate.password_confirmation"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "FormItem",
                  [
                    _c(
                      "Button",
                      {
                        staticStyle: { width: "100px" },
                        attrs: { type: "primary" },
                        on: {
                          click: function($event) {
                            _vm.updateSubmit("formUpdate", "auth/user")
                          }
                        }
                      },
                      [_vm._v("保存")]
                    )
                  ],
                  1
                )
              ],
              1
            )
          ],
          1
        )
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-67a5a7d8", module.exports)
  }
}

/***/ })

});