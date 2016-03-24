{{$names->blade()}}extends('Layout')

{{$names->blade()}}section('contents')
        <div class = 'container'>
            <h1>Show {{$names->TableName()}}</h1>
            <form method = 'get' action = '{{$names->relationalUrl()}}'>
                <button class = 'btn blue'>{{$names->TableName()}} Index</button>
            </form>
            <table class = 'highlight bordered'>
                <thead>
                    <th>Key</th>
                    <th>Value</th>
                </thead>
                <tbody>

                    @foreach($dataSystem->dataScaffold('v') as $value)

                    <tr>
                        <td>
                            <b><i>{{$value}} : </i></b>
                        </td>
                        <td>{{$names->open()}}${{$names->TableNameSingle()}}->{{$value}}{{$names->close()}}</td>
                    </tr>
                    @endforeach


                        @if($dataSystem->relationAttr != null)
                        @foreach($dataSystem->relationAttr as $key=>$value)

                        @foreach($value as $key1 => $value1)

                        <tr>
                        <td>
                            <b><i>{{$value1}} : </i><b>
                        </td>
                        <td>{{$names->open()}}${{$names->TableNameSingle()}}->{{str_singular($key)}}->{{$value1}}{{$names->close()}}</td>
                        </tr>
                        @endforeach

                        @endforeach

                        @endif

                </tbody>
            </table>
        </div>
    {{$names->blade()}}stop
{{$names->blade()}}section('footer')
<div class="footer"></div>
{{$names->blade()}}stop       