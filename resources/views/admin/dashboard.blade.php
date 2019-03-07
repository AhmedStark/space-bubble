<form action="/admi/dashboard">
<label for="name">name</label>
    <input type="text" name="name" placeholder="name" id="name">
    {{csrf_field()}}
    <button>Add</button>
    Fill the name
</form>