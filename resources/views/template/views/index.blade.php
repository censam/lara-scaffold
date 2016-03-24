{{$names->blade()}}extends('Layout')

{{$names->blade()}}section('contents')
 <div class = 'container'>
            <h1>{{$names->TableName()}} Index</h1>
            <div class="row">
            <form class = 'col s3' method = 'get' action = '{{$names->relationalUrl()}}/create'>
                <button class = 'btn red' type = 'submit'>Create New {{$names->TableName()}}</button>
            </form>
            @if($dataSystem->relationAttr != null)

                <ul id="dropdown" class="dropdown-content">
            @foreach($dataSystem->relationAttr as $key => $value)

                    <li><a href="{{URL::to('/')}}/{{lcfirst(str_singular($key))}}">{{ucfirst(str_singular($key))}}</a></li>
            @endforeach

                </ul>
                <a class="col s3 btn dropdown-button #1e88e5 blue darken-1" href="#!" data-activates="dropdown">Associate<i class="mdi-navigation-arrow-drop-down right"></i></a>
            @endif
            </div>
            <table>
                <thead>
                    @foreach($dataSystem->dataScaffold('v') as $value)

                    <th>{{$value}}</th>
                    @endforeach

                    @if($dataSystem->relationAttr != null)

                    @foreach($dataSystem->relationAttr as $key => $value)

                    @foreach($value as $key1 => $value1)

                    <th>{{$value1}}</th>
                    @endforeach

                    @endforeach

                    @endif

                    <th>actions</th>
                </thead>
                <tbody>
                    {{$names->foreachh()}}

                    <tr>
                        @foreach($dataSystem->dataScaffold('v') as $value)

                        <td>{{$names->open()}}$value->{{$value}}{{$names->close()}}</td>
                        @endforeach

                        @if($dataSystem->relationAttr != null)

                        @foreach($dataSystem->relationAttr as $key=>$value)

                        @foreach($value as $key1 => $value1)

                        <td>{{$names->open()}}$value->{{str_singular($key)}}->{{$value1}}{{$names->close()}}</td>
                        @endforeach

                        @endforeach

                        @endif

                        <td>
                            <div class = 'row'>
                                <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "{{$names->relationalUrl()}}/{{$names->open()}}$value->id{{$names->close()}}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                                <a href = '#' class = 'viewEdit btn-floating blue' data-link = '{{$names->relationalUrl()}}/{{$names->open()}}$value->id{{$names->close()}}/edit'><i class = 'material-icons'>edit</i></a>
                                <a href = '#' class = 'viewShow btn-floating orange' data-link = '{{$names->relationalUrl()}}/{{$names->open()}}$value->id{{$names->close()}}'><i class = 'material-icons'>info</i></a>
                            </div>
                        </td>
                    </tr>
                    {{$names->endforeachh()}}
                </tbody>
            </table>
        </div>

{{$names->blade()}}stop
{{$names->blade()}}section('footer')
<div class="footer"></div>
{{$names->blade()}}stop       
        
