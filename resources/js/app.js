require('./bootstrap');

window.Vue = require('vue');


Vue.component('tasks-component', require('./components/TasksComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent').default)
Vue.component('my-tasks-component', require('./components/MyTasksComponent').default)

const app = new Vue({
    el: '#app'
});
