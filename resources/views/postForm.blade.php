<html>
<body>
<form action="{{ route('post.add') }}" method="post" >
    {{ csrf_field() }}
    @if ($errors->any())
        <ul>{!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}</ul>
    @endif
    <input type="number" name="user_id" placeholder="Enter Integer Number"/>
    <input type="text" name="key_name" placeholder="Enter Key Name"/>
    <input type="text" name="key_value" placeholder="Enter Key Value"/>
    <input type="submit" value="submit">
</form>
</body>
</html>