@extends('layouts.app')
@section('title', 'Mi perfil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="h4 mb-4">Mi perfil</h1>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>
                    <button class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Ver historial de pedidos</a>
    </div>
</div>
@endsection
