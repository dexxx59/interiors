@extends('layouts.app')

@section('title', 'Bienvenido a App Shop')

@section('body-class', 'product-page')


@section('content')

<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Registrar nuevo producto</h2>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('/admin/products/') }}">
                {{ csrf_field() }}
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons"></i></span>
                            <input type="text" placeholder="Nombre del producto" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        </div>
                    </div>

                     <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons"></i></span>
                            <input type="number" step="0.01" placeholder="Precio del producto" name="precioUnit" class="form-control" value="{{ old('precioUnit') }}">
                        </div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons"></i></span>
                            <input type="number" placeholder="Cantidad del producto" name="stock" class="form-control" value="{{ old('stock') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">                   
                        <select class="form-control" name="marca_id">
                           <option value="">Selecionar Marca</option>
                           @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                           @endforeach
                       </select>           
                    </div>
                </div>

                 <div class="row">
                      <div class="col-sm-6">
                        <div class="input-group">
                         <span class="input-group-addon">
                                <i class="material-icons">description</i></span>                       
                            <input type="text" placeholder="Descripción corta" name="description" class="form-control" value="{{ old('description') }}">
                          </div>
                        </div>  
                        <div class="col-sm-6">
                            <select class="form-control" name="categoria_id">
                                <option value="">Selecionar Categoria</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                                @endforeach
                            </select>                                                                                
                        </div>
                 </div>

                 <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" name="color_id">
                                <option value="">Selecionar Color</option>
                                @foreach ($colors as $col)
                                <option value="{{ $col->id }}">{{ $col->color }}</option>
                                @endforeach
                            </select>                                                                                
                        </div>
                        <div class="col-sm-6">  
                         <div class="input-group">                
                              <label class="control-label">Imágen de la Pintura</label>
                              <input type="file" id="imagen" name="image" >
                          </div>
                        </div>   
                 </div>
                
                <button class="btn btn-primary">Registrar producto</button>
                <a href="{{ url('/admin/products') }}" class="btn btn-default">Cancelar</a>
            </form>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection