@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Projeto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($projeto, ['route' => ['projetos.update', $projeto->id], 'method' => 'patch']) !!}

                        @include('projetos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection