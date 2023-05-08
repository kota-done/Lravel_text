こんにちは

@foreach ($users as $val)
    <p>
        {{$val->name}}
    </p>
    
@endforeach