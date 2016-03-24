{{$names->blade()}}extends('Layout')

{{$names->blade()}}section('contents')
        <div class = 'container'>
            <h1>Create {{$names->TableName()}}</h1>
            <form method = 'get' action = '{{$names->relationalUrl()}}'>
                <button class = 'btn blue'>{{$names->TableName()}} Index</button>
            </form>
            <br>
            <form method = 'POST' action = '{{$names->relationalUrl()}}'>
                <input type = 'hidden' name = '_token' value = '{{$names->open()}}Session::token(){{$names->close()}}'>
                @foreach($dataSystem->dataScaffold('v') as $value)

                <div class="input-field col s6">
                    <input id="{{$value}}" name = "{{$value}}" type="text" class="validate">
                    <label for="{{$value}}">{{$value}}</label>
                </div>
                @endforeach

                @foreach($dataSystem->foreignKeys as $key)

                <div class="input-field col s12">
                    <select name = '{{lcfirst(str_singular($key))}}_id'>
                        {{$names->blade()}}foreach(${{str_plural($key)}} as $key1 => $value1)
                        <option value="@{{$key1}}">@{{$value1}}</option>
                        {{$names->blade()}}endforeach
                    </select>
                    <label>{{$key}} Select</label>
                </div>
                @endforeach

                <button class = 'btn red' type ='submit'>Create</button>
            </form>
        </div>
    
{{$names->blade()}}stop
{{$names->blade()}}section('footer')
<div class="footer"></div>
{{$names->blade()}}stop       
        
