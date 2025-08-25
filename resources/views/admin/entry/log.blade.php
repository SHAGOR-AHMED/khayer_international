 <div class="row">
	<div class="col-sm-12">
        Created by: {{ $single->created_by }}<br>
        {{ $single->created_at }}
        @if($single->updated_by)
        <hr>
        Updated by: {{ $single->updated_by }}<br>
        {{ $single->updated_at }}
        @endif
	</div>
</div>