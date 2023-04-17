
require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'

import store from './store'
import router from './router'

import ViewUI from 'view-design';
import locale from 'view-design/dist/locale/en-US';
Vue.use(ViewUI,{locale: locale});


import Bars from 'vuebars';
import VueGoogleCharts from 'vue-google-charts';
import JsonExcel from 'vue-json-excel'

import VueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

Vue.use(VueQuillEditor, /* { default global options } */)


Vue.component('downloadExcel', JsonExcel)

Vue.use(VueGoogleCharts)
Vue.use(Bars)
// Vue.use(Chart)
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'

Vue.use(Chartkick.use(Chart))
// Vue.use(CanvasJS)

import VueLocalStorage from 'vue-localstorage';
Vue.use(VueLocalStorage, {
    name: 'ls',
    bind: true //created computed members from your variable declarations
  })

window._ = require('lodash');
require('es6-promise').polyfill();
require('es6-object-assign').polyfill();
//  Vue.component(VueBarcode.name, VueBarcode);
//  JsBarcode("#barcode", "Smallest width", {
//     height: 25,
//     displayValue: false,
// });
// common methods


/*custom common methods*/
import common from './common';
Vue.mixin(common);




import './theme/index.less';

Vue.component('default', require('./layout/default.vue').default);
Vue.component('login', require('./layout/login.vue').default);


const app = new Vue({
    el: '#app',
    router,
    store: store,
});


