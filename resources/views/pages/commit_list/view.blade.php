@extends('master')

@section('content')

<br>

<div class="row">
  <div class="col-md-12"><a class="btn btn-default" href="{{url('')}}" role="button">Home</a></div>  
</div>

<br>

<div class="row">
  <div class="col-md-12"><h2>Github repo for user:  {{$username}}</h2></div>  
</div>
  
<div class="row">
  <div class="col-md-12">
    <div class="list-group">
        @foreach ($gitUserInfo as $repo)                
                <a href="{{array_get($repo,'repo_info.html_url')}}" target=_BLANK class="list-group-item active">
                    Repo: {{array_get($repo,'repo_info.name')}}
                </a>

                @foreach (array_get($repo,'commit_info') as $value) 
                    <a href="{{array_get($value,'html_url')}}" target=_BLANK class="list-group-item">Commits: {{array_get($value,'commit_message')}}</a>
                @endforeach                
          @endforeach
       </div>
    </div>  
</div>
@stop