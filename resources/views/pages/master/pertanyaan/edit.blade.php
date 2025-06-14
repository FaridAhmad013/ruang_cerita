<form action="{{ route($module.'.update', $id) }}" method="POST" id="myForm">
@csrf
@method('PUT')
@include('pages.'.$folder.'.form')
</form>
<div id="response_container"></div>
