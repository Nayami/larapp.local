<style lang="sass"></style>

<template>
	<div class="UserComponent-scope clearfix">
		<div class="panel panel-default">
			<div class="panel-heading">{{user.email}}</div>
			<div class="panel-body">{{user.username}} </div>
		</div>
	</div>
</template>

<script>
	export default {
		props:['user']
	}
</script>
