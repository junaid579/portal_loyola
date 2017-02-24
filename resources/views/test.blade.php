<form method="POST">
	

    {{ csrf_field() }}

	<input type="text" name="name">Name
	<input type="password" name="password">Password
	<input type="submit" name="save" value="Save">Save
	<input type="submit" name="show" value="Show">Show
</form>


