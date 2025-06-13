<form action="{{ route($module.'.store') }}" method="POST" id="myForm">
  @csrf
  @include('pages.'.$folder.'.form')
</form>
<div id="response_container"></div>
