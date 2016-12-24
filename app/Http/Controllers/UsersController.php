<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

	public function index()
	{
		return User::all();
	}

	public function create()
	{
		//
	}

	public function store( Request $request )
	{
		$this->validate( $request, [
			'username' => 'required',
			'email'    => 'required|email|unique:users'
		] );

		$user = User::create( [
			'username' => $request->input( 'username' ),
			'email'    => $request->input( 'email' ),
			'password' => Hash::make( $request->input( 'email' ) )
		] );

		return response()->json( [
			'message' => 'User was created successfully',
			'user'    => $user,
		] );
	}

	public function show( $id )
	{
		return User::findOrFail( $id );
	}

	public function edit( $id )
	{
		//
	}

	public function update( Request $request, $id )
	{
		$user = User::find( $id );
		$input = $request->all();

		$this->validate( $request, [
			'username' => 'required',
			'email'    => 'required|email|unique:users,email,'.$id
		] );

		$user->fill($input)->save();

		return response()->json( [
			'message' => 'User updated successfully',
			'user'    => $user
		] );
	}

	public function destroy( $id )
	{
		User::find( $id )->delete();

		return response()->json( [
			'message' => 'User was deleted successfully'
		] );
	}
}
