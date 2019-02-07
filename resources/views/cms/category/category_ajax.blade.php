<option value="0">Root</option>
@if($categoryList)
    @foreach($categoryList as $item)
    <option value="{{$item['id']}}" class="text-warning">--{{$item['name']}}</option>
        @if($item['child'])
            @foreach($item['child'] as $value)
            <option value="{{$value['id']}}" class="text-primary">&nbsp; --|--{{$value['name']}}</option>
            @endforeach
        @endif
    @endforeach
@endif
