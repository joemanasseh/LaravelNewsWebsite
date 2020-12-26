
@foreach($user->readlists as $red)
{{ $red->articles->title }}
@endforeach

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@foreach($readlist as $real)
{{ $real->articles }}
@endforeach

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@foreach($readlist as $read)

{{ $read->articles_id }}

@endforeach


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


{{ $readlist }}


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


{{ $articulate }}