
<!-- INICIO -->

<div class="box">
	<div class="box-header">
	</div>
	<div class="box-body">
		@if()
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5">
				<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
					Showing {{$items->currentPage()}} to {{$items->lastPage()}} of {{$items->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
					@if(isset($search))
					{!!$items->appends(['search' => $search, 'category'=>$category])->render()!!}
					@else
					{!!$items->render()!!}
					@endif
				</div>
			</div>
		</div>
		@else
		<h3 class="text-muted text-center">No Results</h3>
		<br>
		
		@endif
	</div>
</div>

<!-- FIN -->