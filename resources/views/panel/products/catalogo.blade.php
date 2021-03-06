@extends ('/panel.layout.layout')
@section('title')
	Catalogo de pruductos existentes en el sistema.
@endsection
@section('script_add')
	<link rel="stylesheet" href="/panel/css/jquery.dataTables.css">
	<script src="/panel/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/panel/js/jquery.dataTables.min.js"></script>
	<script src="/panel/js/table.js"></script>
@endsection
@section('content')
<div class="tab-main">
	<!--/tabs-inner-->
		<div class="tab-inner">
			<div id="tabs" class="tabs">
				<h2 class="inner-tittle" style="margin-bottom: 0em;">Panel 3.0 Pro || {{ Request::path() }}</h2>
			
					<div class="col-md-4">
						<p style="margin-bottom: 2em;">Funciones disponibles para ARTICULOS</p>
					</div>
					<div class="col-md-4">
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-2">
						<a href="/NUEVO-ARTICULO">
							<button style="margin-top: 14%;" type="button" class="btn btn-primary">Crear Articulo</button>
						</a>
					</div>
				</div>

				<div class="col-md-12" style="padding-top: 3em;">
					
							<table id="tabla" class="display" cellspacing="0" width="100%">
						        <thead>
								    <tr>
								      <th scope="col">IMG</th>
								      <th scope="col">TITULO</th>
								      <th scope="col">CODIGO</th>
								      <th scope="col">COSTO</th>
								      <th scope="col">RENT(%)</th>
								      <th scope="col">ACCIONES</th>
								    </tr>
								</thead>
						        <tbody>

						        	
						        	@foreach ($productos as $element)
										<!--GENERO UN CONTADOR PARA LIMITAR A 1 FOTO-->
						        		@php $count=0; @endphp
						        		@php $exist='0'; @endphp
							    		<tr>
									      <td class="col-md-2">
									      	@foreach ($img_productos as $img)
										      	@if ($element->id == $img->producto_id && $count == 0)
										      		<img src="/uploads/{{ $element->id }}/min_{{ $img->file_name }}" class="img-responsive" alt="" style="width: 50%;">
										      	@php $count=1; @endphp
										      	@php $exist='1'; @endphp
										      	@php $file_name=$img->file_name; @endphp
										      	@endif
									      	@endforeach
									      	@if ($exist=='0')
										      		<img src="/panel/images/no_image.jpg" class="img-responsive" alt="" style="width: 50%;">
										    @endif
									      </td>
									      <td class="col-md-4">{{ $element->titulo }}</td>
									      <td class="col-md-2">({{ $element->codigo }})</td>
									      <td class="col-md-1">u${{ $element->costo }}</td>
									      <td class="col-md-1">%{{ $element->rent }}</td>
									      <td class="col-md-2" style="display: inline-flex;">
									      	<form style="margin: 0em 0em 0em 0em;" method="post" action="/EDITAR-ARTICULO-IMG/{{ $element->id }}">
											 	{{ csrf_field() }}
											 	{{ method_field('PATCH') }}
											 <button type="submit" class="btn btn-primary">Editar Fotos</button>
											 </form>

											 <form method="post" action="/EDITAR-ARTICULO/{{ $element->id }}">
											 	{{ csrf_field() }}
											 	{{ method_field('PATCH') }}
											 <button style="margin-left: 0.5em;" type="submit" class="btn btn-primary">Editar Info</button>
											 </form>

											 <form action="/ELIMINAR-ARTICULO/{{$element->id}}" method="post">
										      	{{ method_field('DELETE') }}
										      	{{ csrf_field() }}
									      		<button type="button" class="btn btn-primary btn-delete" style="margin-left: 0.5em;">Eliminar</button>
											      	
											</form>
									      </td>
									    </tr>
								    @endforeach
								  </tbody>
						    </table>

				</div>
			</div>
		</div>
</div>
@endsection
@section('script')
	<script>
		$('.btn-delete').on('click', function(e){
					if(confirm('Seguro deseas eliminar este articulo ?')){
						$(this).parents('form:first').submit();
					}
				})
		</script>
@endsection