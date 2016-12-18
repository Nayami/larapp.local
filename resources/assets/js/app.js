require('./bootstrap');

Vue.component('Users', require('./components/Users.vue'));

const app = new Vue({

	el: '#app',

	created: function() {}

});