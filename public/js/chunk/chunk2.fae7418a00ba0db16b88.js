webpackJsonp([2],{"+4aN":function(t,e,a){var r=a("SRWl");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("eddde2fc",r,!0,{})},"1au8":function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},"2usV":function(t,e,a){var r=a("VU/8")(a("dwAs"),a("vdic"),!1,function(t){a("ve7q")},"data-v-5ed84211",null);t.exports=r.exports},"5uVT":function(t,e,a){var r=a("HdUJ");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("e167a204",r,!0,{})},"6NqX":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:{data:{}},data:function(){return{loading:!1}},methods:{change:function(t){!1===t&&this.$emit("on-change")}}}},"6saD":function(t,e,a){var r=a("VGfQ");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("21599598",r,!0,{})},Apbl:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},DVXi:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});e.Validator=function(t){return{name:[{required:!0,type:"string",message:"用户姓名不能为空",trigger:"blur"},{type:"string",min:2,max:10,message:"用户姓名必须在 2 到 10 个字符之间",trigger:"blur"}],email:[{required:!0,message:"用户邮箱不能为空",trigger:"blur"},{type:"email",message:"邮箱格式不正确",trigger:"blur"}],role_id:[{required:!0,type:"number",message:"用户角色必须选择",trigger:"change"}],password:[{required:!0,message:"用户密码不能为空",trigger:"blur"},{min:6,max:20,type:"string",message:"用户密码必须在 6 到 20 个字符之间",trigger:"blur"}],password_confirmation:[{required:!0,message:"确认密码不能为空",trigger:"blur"},{validator:function(e,a,r){t.formCreate.password!==a?r(new Error("两次密码不相同")):r()},trigger:"blur"}]}}},"F+EQ":function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("component-modal",{attrs:{title:"创建用户"}},[a("Form",{ref:"formCreate",attrs:{model:t.formCreate,"label-width":80,rules:t.ruleCreate}},[a("FormItem",{attrs:{label:"用户姓名",prop:"name"}},[a("Input",{attrs:{placeholder:"用户邮箱"},model:{value:t.formCreate.name,callback:function(e){t.$set(t.formCreate,"name",e)},expression:"formCreate.name"}})],1),t._v(" "),a("FormItem",{attrs:{label:"用户邮箱",prop:"email"}},[a("Input",{attrs:{placeholder:"用户邮箱"},model:{value:t.formCreate.email,callback:function(e){t.$set(t.formCreate,"email",e)},expression:"formCreate.email"}})],1),t._v(" "),a("FormItem",{attrs:{label:"用户角色",prop:"role_id"}},[a("roles-select",{model:{value:t.formCreate.role_id,callback:function(e){t.$set(t.formCreate,"role_id",e)},expression:"formCreate.role_id"}})],1),t._v(" "),a("FormItem",{attrs:{label:"用户密码",prop:"password"}},[a("Input",{attrs:{placeholder:"用户密码"},model:{value:t.formCreate.password,callback:function(e){t.$set(t.formCreate,"password",e)},expression:"formCreate.password"}})],1),t._v(" "),a("FormItem",{attrs:{label:"确认密码",prop:"password_confirmation"}},[a("Input",{attrs:{placeholder:"确认密码"},model:{value:t.formCreate.password_confirmation,callback:function(e){t.$set(t.formCreate,"password_confirmation",e)},expression:"formCreate.password_confirmation"}})],1),t._v(" "),a("FormItem",{attrs:{label:"是否开启",prop:"status"}},[a("RadioGroup",{attrs:{type:"button"},model:{value:t.formCreate.status,callback:function(e){t.$set(t.formCreate,"status",e)},expression:"formCreate.status"}},[a("Radio",{attrs:{label:1,value:1}},[t._v("开启")]),t._v(" "),a("Radio",{attrs:{label:0,value:0}},[t._v("关闭")])],1)],1)],1),t._v(" "),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("Button",{attrs:{loading:t.loading},on:{click:function(e){t.createSubmit("formCreate","admin")}}},[t._v("创建")])],1)],1)},staticRenderFns:[]}},HdUJ:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},"HtL/":function(t,e,a){var r=a("VU/8")(a("i1uw"),a("uI0F"),!1,function(t){a("6saD")},"data-v-e32415a4",null);t.exports=r.exports},"Q/YR":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"my-lists",props:{value:{type:Object,default:function(){return{data:[],page:{total:100,current:1,page_size:20}}}},columns:{type:Array,default:function(){return[]}}},data:function(){return{leftCol:[{title:"序号",render:function(t,e){var a=e.index;return t("span",null,[++a])},width:75}],rightCol:[]}},computed:{tableCol:function(){return this.leftCol.concat(this.columns,this.rightCol)}},methods:{change:function(t){this.$emit("change",t)}}}},SRWl:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},UM8K:function(t,e,a){var r=a("VU/8")(a("dRV6"),a("F+EQ"),!1,function(t){a("5uVT")},"data-v-3b5081b8",null);t.exports=r.exports},VGfQ:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,".modal-body[data-v-e32415a4]{max-height:500px;overflow-y:auto}",""])},ZDhg:function(t,e,a){var r=a("Apbl");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("326d4e39",r,!0,{})},bt0p:function(t,e,a){var r=a("VU/8")(a("yVci"),a("gZBE"),!1,function(t){a("obEK")},"data-v-4aa7e9c1",null);t.exports=r.exports},dRV6:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=u(a("HtL/")),o=u(a("xi7R")),n=u(a("bO6f")),s=a("DVXi"),i=u(a("2usV")),l=u(a("6NqX"));function u(t){return t&&t.__esModule?t:{default:t}}e.default={name:"create",components:{RolesSelect:i.default,PhotoOnce:n.default,ComponentModal:r.default},mixins:[l.default,o.default],data:function(){return{formCreate:{name:"",password:"",password_confirmation:"",status:1,role_id:"",email:""},ruleCreate:(0,s.Validator)(this)}}}},dSCJ:function(t,e,a){var r=a("VU/8")(a("Q/YR"),a("n1Kp"),!1,function(t){a("+4aN")},"data-v-087d0e2b",null);t.exports=r.exports},dwAs:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"roles-select",props:{value:[String,Number]},data:function(){return{model:this.value}},computed:{roles:function(){return this.$store.state.Role.data}},mounted:function(){var t=this;this.$nextTick(function(){0===t.$store.state.Role.data.length&&t.$http.get("role/select").then(function(e){t.$store.commit("setRolesData",e.data.data)})})},methods:{setValue:function(t){this.$emit("input",t)}},watch:{value:function(t){this.model=t}}}},gZBE:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("my-lists",{attrs:{columns:t.columns},on:{change:t.search},model:{value:t.data,callback:function(e){t.data=e},expression:"data"}},[a("Button",{attrs:{slot:"button",size:"small",type:"success"},on:{click:function(e){t.showComponent("Create")}},slot:"button"},[t._v("添加")]),t._v(" "),a(t.component.current,{tag:"components",attrs:{data:t.component.data},on:{"on-change":t.hideComponent}})],1)},staticRenderFns:[]}},h7KM:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r,o=a("nf43"),n=(r=o)&&r.__esModule?r:{default:r};e.default={mixins:[n.default],data:function(){return{searchForm:{},data:{data:[],page:{total:0,current:1,page_size:20}},component:{current:"",data:{}}}},mounted:function(){this.search()},methods:{search:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0]},assignmentData:function(t){this.data.data=t.data,this.data.page.total=t.total,this.data.page.current=t.current_page,this.data.page.page_size=t.per_page},showComponent:function(t,e){this.component.current=t,this.component.data=e},hideComponent:function(){this.component.current="",this.component.data={},this.search()},destroyItem:function(t,e){var a=this;this.$http.delete(e).then(function(t){a.search()}).catch(function(t){a.formatErrors(t)})},request:function(t){var e=JSON.parse(JSON.stringify(this.searchForm));return e.page=t,e}}}},i1uw:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"component-modal",props:{title:{type:String,default:"弹窗"}},computed:{loading:function(){return this.$parent.loading}},methods:{change:function(t){this.$parent.$emit("on-change")}}}},i4jm:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=l(a("HtL/")),o=l(a("xi7R")),n=a("pDQs"),s=l(a("2usV")),i=l(a("6NqX"));function l(t){return t&&t.__esModule?t:{default:t}}e.default={name:"update",components:{RolesSelect:s.default,ComponentModal:r.default},mixins:[i.default,o.default],data:function(){return{formUpdate:{name:"",password:"",password_confirmation:"",status:1,role_id:"",email:""},ruleUpdate:(0,n.Validator)(this)}},mounted:function(){var t=this;this.$nextTick(function(){t.$http.get("admin/"+t.data.id).then(function(e){t.formUpdate=Object.assign(t.unObserver(t.formUpdate),e.data.data)}).catch(function(e){t.formatErrors(e)})})}}},lLwU:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("component-modal",{attrs:{title:"更新用户"}},[a("Form",{ref:"formUpdate",attrs:{model:t.formUpdate,"label-width":80,rules:t.ruleUpdate}},[a("FormItem",{attrs:{label:"用户姓名",prop:"name"}},[a("Input",{attrs:{placeholder:"用户邮箱"},model:{value:t.formUpdate.name,callback:function(e){t.$set(t.formUpdate,"name",e)},expression:"formUpdate.name"}})],1),t._v(" "),a("FormItem",{attrs:{label:"用户邮箱",prop:"email"}},[a("Input",{attrs:{placeholder:"用户邮箱"},model:{value:t.formUpdate.email,callback:function(e){t.$set(t.formUpdate,"email",e)},expression:"formUpdate.email"}})],1),t._v(" "),a("FormItem",{attrs:{label:"用户角色",prop:"role_id"}},[a("roles-select",{model:{value:t.formUpdate.role_id,callback:function(e){t.$set(t.formUpdate,"role_id",e)},expression:"formUpdate.role_id"}})],1),t._v(" "),a("FormItem",{attrs:{label:"用户密码",prop:"password"}},[a("Input",{attrs:{placeholder:"用户密码"},model:{value:t.formUpdate.password,callback:function(e){t.$set(t.formUpdate,"password",e)},expression:"formUpdate.password"}})],1),t._v(" "),a("FormItem",{attrs:{label:"确认密码",prop:"password_confirmation"}},[a("Input",{attrs:{placeholder:"确认密码"},model:{value:t.formUpdate.password_confirmation,callback:function(e){t.$set(t.formUpdate,"password_confirmation",e)},expression:"formUpdate.password_confirmation"}})],1),t._v(" "),a("FormItem",{attrs:{label:"是否开启",prop:"status"}},[a("RadioGroup",{attrs:{type:"button"},model:{value:t.formUpdate.status,callback:function(e){t.$set(t.formUpdate,"status",e)},expression:"formUpdate.status"}},[a("Radio",{attrs:{label:1,value:1}},[t._v("开启")]),t._v(" "),a("Radio",{attrs:{label:0,value:0}},[t._v("关闭")])],1)],1)],1),t._v(" "),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("Button",{attrs:{loading:t.loading},on:{click:function(e){t.updateSubmit("formUpdate","admin/"+t.data.id)}}},[t._v("创建")])],1)],1)},staticRenderFns:[]}},lnaK:function(t,e,a){var r=a("VU/8")(a("i4jm"),a("lLwU"),!1,function(t){a("ZDhg")},"data-v-61685039",null);t.exports=r.exports},n1Kp:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._t("default"),t._v(" "),a("div",{staticClass:"box-flex-list"},[a("Card",{attrs:{bordered:!1}},[a("p",{attrs:{slot:"title"},slot:"title"},[a("span",[t._v("列表")]),t._v(" "),t._t("button")],2),t._v(" "),a("Table",{ref:"table",attrs:{columns:t.tableCol,data:t.value.data,size:"small"}}),t._v(" "),a("Page",{attrs:{total:t.value.page.total,size:"small",current:t.value.page.current,"page-size":t.value.page.page_size,"show-total":""},on:{"on-change":t.change}})],1)],1)],2)},staticRenderFns:[]}},n5hb:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},obEK:function(t,e,a){var r=a("1au8");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("286fd22a",r,!0,{})},pDQs:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});e.Validator=function(t){return{name:[{required:!0,type:"string",message:"用户姓名不能为空",trigger:"blur"},{type:"string",min:2,max:10,message:"用户姓名必须在 2 到 10 个字符之间",trigger:"blur"}],email:[{required:!0,message:"用户邮箱不能为空",trigger:"blur"},{type:"email",message:"邮箱格式不正确",trigger:"blur"}],role_id:[{required:!0,type:"number",message:"用户角色必须选择",trigger:"change"}],password:[{min:6,max:20,type:"string",message:"用户密码必须在 6 到 20 个字符之间",trigger:"blur"}],password_confirmation:[{validator:function(e,a,r){t.formUpdate.password!==a?r(new Error("两次密码不相同")):r()},trigger:"blur"}]}}},uI0F:function(t,e){t.exports={render:function(){var t=this.$createElement,e=this._self._c||t;return e("Modal",{attrs:{title:this.title,value:!0,transfer:!1,loading:this.loading,"mask-closable":!1},on:{"on-visible-change":this.change}},[e("div",{staticClass:"modal-body"},[this._t("default")],2),this._v(" "),e("div",{attrs:{slot:"footer"},slot:"footer"},[this._t("footer")],2)])},staticRenderFns:[]}},vdic:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Select",{attrs:{placeholder:"请选择角色"},on:{"on-change":t.setValue},model:{value:t.model,callback:function(e){t.model=e},expression:"model"}},t._l(t.roles,function(e,r){return a("Option",{key:r,attrs:{value:e.id}},[t._v(t._s(e.name))])}))},staticRenderFns:[]}},ve7q:function(t,e,a){var r=a("n5hb");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("a7ec9a5c",r,!0,{})},xi7R:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r,o=a("nf43"),n=(r=o)&&r.__esModule?r:{default:r};e.default={mixins:[n.default],data:function(){return{loading:!1}},methods:{unObserver:function(t){return JSON.parse(JSON.stringify(t))},updateSubmit:function(t,e){var a=this;this.$refs[t].validate(function(r){r?(a.loading=!0,a.$http.put(e,a.unObserver(a._data[t])).then(function(t){a.$Message.success("Success!"),a.change(!1)}).catch(function(t){a.formatErrors(t)}).finally(function(){a.loading=!1})):a.$Message.error("验证不通过!")})},createSubmit:function(t,e){var a=this;this.$refs[t].validate(function(r){r&&(a.loading=!0,a.$http.post(e,a._data[t]).then(function(t){a.$Message.success("Success!"),a.change(!1)}).catch(function(t){a.formatErrors(t)}).finally(function(){a.loading=!1}))})}}}},yVci:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=i(a("dSCJ")),o=i(a("h7KM")),n=i(a("lnaK")),s=i(a("UM8K"));function i(t){return t&&t.__esModule?t:{default:t}}e.default={name:"index",components:{MyLists:r.default,Create:s.default,Update:n.default},mixins:[o.default],data:function(){var t=this;return{columns:[{title:"登录邮箱",key:"email"},{title:"所属角色",render:function(t,e){return t("span",null,[e.row.roles.name])}},{title:"状态",render:function(t,e){return t("span",null,[1===e.row.status?"开启":"关闭"])}},{title:"操作",render:function(e,a){var r=a.row;return e("button-group",null,[e("i-button",{attrs:{size:"small",disabled:0!=r.roles.super},on:{click:function(){return t.showComponent("Update",r)}}},["修改"]),e("poptip",{attrs:{confirm:!0,transfer:!0,title:"确定要删除吗？"},on:{"on-ok":function(){return t.destroyItem(r,"admin/"+r.id)}}},[e("i-button",{attrs:{size:"small",disabled:0!=r.roles.super}},["删除"])])])}}]}},methods:{search:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;this.$http.get("admin",{params:this.request(e)}).then(function(e){t.assignmentData(e.data.data)}).catch(function(e){t.formatErrors(e)})}}}}});