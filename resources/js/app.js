require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';


Vue.component('v-select', vSelect)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);




 Vue.component('docente-component', require('./components/docentes/principal.vue').default);
 Vue.component('save-component', require('./components/docentes/registro.vue').default);
 Vue.component('clases-component', require('./components/clases/registro.vue').default);
 Vue.component('estudiante-component', require('./components/estudiantes/registro.vue').default);
 Vue.component('notas-component', require('./components/notas/registro.vue').default);
 Vue.component('notas-ver-component', require('./components/notas/VerNotas.vue').default);


const app = new Vue({
    el: '#app',
    data:{
        menu: 0,
    }
});
