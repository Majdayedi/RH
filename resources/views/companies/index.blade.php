@extends('test')

@section('title', 'Company Menu')

@section('content')
<div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="product-grid">
@foreach($companies as $company)
		<div class="product-card">
            <span class="product-badge">Sale</span>
            <div class="product-img-container">
            <img src="{{ asset('build/assets/'.$company->logo) }}" alt="{{ $company->name }} logo" class="product-img">            </div>
            <div class="product-info">
              <h3 class="product-title">{{$company->legal_name}}</h3>
              <div class="product-price">
                <span class="current-price">₹3998</span>
                <span class="original-price">₹3999</span>
              </div>
              <div class="product-actions">
                <button class="details-btn">Details</button>
                <button class="wishlist-btn"><i class="far fa-heart"></i></button>
              </div>
            </div>
          </div>
@endforeach


		 
          
        
        </div>
      </div>
@endsection
