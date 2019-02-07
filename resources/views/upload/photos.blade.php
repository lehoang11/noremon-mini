@php $idImages = basename($fileImage); @endphp
<div class="col-sm-3 {{$idImages[0]}}">
	<div class="upload-photo-layout">
		<img src="{{BASE_URL}}{{$fileImage}}">
		<input type="hidden" name="photos[]" value="{{$fileImage}}">
		<a href="javascript:void(0)" data-id ="{{$idImages[0]}}" class="btn-del-photo"><i class="fa fa-trash-o bigfonts" aria-hidden="true"></i></a>
	</div>
</div>