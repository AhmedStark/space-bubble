<form action="/admin/login"method='POST'>
{{csrf_field()}}
<li><input type="email" name="email" id=""></li>
<li><input type="password" name="pwd" id=""></li>
<input type="submit" value="submit">

</form>