@extends('front.layouts.app')

@section('content')
    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Orden de Compra generado con exito</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="page-item">Orden de Compra generado con exito</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <div class="wish-list-area cart-page-area section">
        <div class="container successOrder">
            <div class="row">
                <div class="success">
                    <h2>Su orden de pedido ha sido generado con exito.</h2>
                    <p>Por favor, continue comprando en nuestra plataforma</p>
                    <a href="{{ route('products.index') }}"> Continuar comprando</a> 
                </div>               
            </div>
        </div>
    </div>
@endsection