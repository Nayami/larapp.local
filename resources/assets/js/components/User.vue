<style lang="sass">
	.panel-footer {

		i {
			font-size    : 20px;
			margin-left  : 5px;
			margin-right : 5px;
		}

	}
</style>

<template>
	<div class="UserComponent-scope clearfix">
		<div class="panel panel-default">
			<div class="panel-heading">

				<div class="form-group" v-bind:class="{'has-error': errors.email}" v-if="edit">
					<input type="text" class="form-control" v-model="editedUser.email">
					<span class="help-block" v-for="error in errors.email">{{error}}</span>
				</div>
				<span v-else>{{user.email}}</span>

			</div>
			<div class="panel-body">
				<div class="form-group" v-bind:class="{'has-error': errors.username}" v-if="edit">
					<input type="text" class="form-control" v-model="editedUser.username">
					<span class="help-block" v-for="error in errors.username">{{error}}</span>
				</div>
				<span v-else>{{user.username}}</span>
			</div>
			<div class="panel-footer text-right">
				<a href="#" @click.prevent="$emit('delete-user', user)"><i class="fa fa-remove"></i></a>
				<a href="#" @click.prevent="editUser"><i class="fa fa-edit"></i></a>
				<a href="#" @click.prevent="updateUser" v-if="edit"><i class="fa fa-check"></i></a>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['user'],

		created() {

			this.$on('delete-user', function() {
				this.edit = false;
				this.editedUser = {};
			})

		},

		data() {
			return {
				errors    : [],
				edit      : false,
				editedUser: {}
			}
		},

		methods: {

			editUser(){
				this.edit = !this.edit;
				this.editedUser = this.user
			},

			updateUser() {

				this.$http.patch('/users/' + this.editedUser.id, this.editedUser)
					.then(response => {
							console.log(response);
							this.edit = false;
							this.editedUser = {};
						},
						errors => { // Handle Errors
							this.errors = errors.body;
							console.log(this.errors);
						})

			}

		}

	}
</script>
