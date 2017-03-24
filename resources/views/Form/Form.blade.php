<form action="{{ action('ApiController@findPackage') }}" method="get">
    {{ csrf_field() }}
    <input type="text" name="packageName" value="" id="packageName" required>
    <button name="submit" type="submit">Submit</button>
</form>
