const elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');
// console.log();
elixir(mix => {
	mix.sass('app.scss')
		.webpack('app.js');
});