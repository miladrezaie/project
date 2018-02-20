<!DOCTYPE html>
<html>


<head>
    <title>ajax</title>
</head>

<body>

<script>
    var request = new XMLHttpRequest();
    {{--request.open('GET', '{{route('ajax')}}');--}}
    request.open('GET', 'milad');
    request.setRequestHeader('X-Test', 'one');
    request.send();
    console.log(request);


</script>


</body>
</html>


