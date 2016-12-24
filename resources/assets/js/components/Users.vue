<template>
	<div class="clearfix">
		<form @submit.prevent="createUser" method="post" role="form">

			<legend>Add a new User</legend>

			<div class="row">
				<div class="form-group col-md-6" v-bind:class="{'has-error': errors.username}">
					<label for="username">User Name</label>
					<input v-model="user.username"
								 type="text" class="form-control" id="username" placeholder="User name">
					<span class="help-block" v-for="error in errors.username">{{error}}</span>
				</div>

				<div class="form-group col-md-6" v-bind:class="{'has-error': errors.email}">
					<label for="useremail">User Email</label>
					<input v-model="user.email"
								 type="email" class="form-control" id="useremail" placeholder="User Email">
					<span class="help-block" v-for="error in errors.email">{{error}}</span>
				</div>
			</div>


			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<hr>

		<User v-for="user in users" v-bind:user="user" @delete-user="deleteUser"></User>
	</div>
</template>

<script>
	import User from './User.vue';
	export default {
		data() {
			return {
				users : [],
				user  : {},
				errors: [],
			}
		},

		components: {
			User
		},

		calculated: {
			scopeUsers: function() {

			}
		},

		created(){
			this.fetchUsers();
		},

		methods: {

			deleteUser(user){
				this.$http.delete('/users/' + user.id).then(response => {
					let index = this.users.indexOf(user);
					this.users.splice(index, 1);

				});

			},

			fetchUsers(){ // Get All Users
				this.$http.get('/users')
					.then(function(response) {
						this.users = response.body
					})
			},

			createUser() { // Create a new User
				this.$http.post('/users', this.user)
					.then(response => {
							this.users.push(response.body.user)
							this.user = {}
							this.errors = []
						},
						errors => { // Handle Errors
							this.errors = errors.body;
						})

			}

		},

		mounted() {
			console.log('Component ready.')
		}

	}
</script>
