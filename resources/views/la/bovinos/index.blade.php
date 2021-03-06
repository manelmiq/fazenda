@extends("la.layouts.app")

@section("contentheader_title", "Bovinos")
@section("contentheader_description", "Bovinos listing")
@section("section", "Bovinos")
@section("sub_section", "Listing")
@section("htmlheader_title", "Bovinos Listing")

@section("headerElems")
@la_access("Bovinos", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Bovino</button>
@endla_access
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Bovinos", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Cadastrar Bovino</h4>
			</div>
			{!! Form::open(['action' => 'LA\BovinosController@store', 'id' => 'bovino-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					<table class="table table-bordered">
						<tr><td>@la_input($module, 'nome')</td><td>	@la_input($module, 'codigo')</td></tr>
						<tr><td>@la_input($module, 'sexo')</td><td>	@la_input($module, 'nascimento')</td></tr>
						<tr><td>@la_input($module, 'pai')</td><td>	@la_input($module, 'mae')</td></tr>
						<tr><td>@la_input($module, 'data_entrada')</td><td>	@la_input($module, 'peso')</td></tr>
						<tr><td>@la_input($module, 'origem')</td><td>	@la_input($module, 'cateagoria')</td></tr>
						<tr><td>@la_input($module, 'foto')</td><td>	@la_input($module, 'raca')</td></tr>
						<tr><td>@la_input($module, 'grau_sangue')</td></tr>
					</table>				
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
				{!! Form::submit( 'Cadastrar', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/bovino_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#bovino-add-form").validate({
		
	});
});
</script>
@endpush
