import Vue from 'vue'
import App from './App.vue'
import router from './router'

import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Charts from 'fusioncharts/fusioncharts.charts';
import Widgets from 'fusioncharts/fusioncharts.widgets';
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';
Widgets(FusionCharts);
Charts(FusionCharts);
FusionTheme(FusionCharts);
// register VueFusionCharts component
Vue.use(VueFusionCharts, FusionCharts);

import VueDisqus from 'vue-disqus'
Vue.use(VueDisqus)

window.axios = require('axios');
Vue.prototype.$http = window.axios;


Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
