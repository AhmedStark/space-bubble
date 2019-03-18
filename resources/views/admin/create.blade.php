<form action="/admin/create"method='POST'>
{{csrf_field()}}
<li><input type="text" name="name" id=""></li>
<li><input type="email" name="email" id=""></li>
<li><input type="password" name="pwd" id=""></li>
<input type="submit" value="submit">

</form>