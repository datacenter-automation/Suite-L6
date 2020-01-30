<form method="POST" action="{{ route("users.store") }}">
  @method("POST")
  @csrf

  @include('form.input', ['n' => 'name', 'l' => 'Name', 'r' => true, 'd' => 'Default Name'])
  @include('form.input', ['n' => 'email', 'l' => 'Email', 'r' => true, 'a' => true, $t => 'email'])  @include('form.submit', ['l' => 'Create Link'])
  @include('form.submit', ['l' => 'Create new User'])

</form>
