@extends('test')

@section('title', 'Company Menu')

@section('content')
<div class="container">
 
        <h2 class="section-title">Featured Products</h2>
    <input type="text" id="searchInput" name="query" class="form-control me-2" placeholder="Search companies..." autofocus value="{{ request('query') }}">
<p>    </p>
        <div class="product-grid">
@foreach($companies as $company)
		<div class="product-card">
            <span class="product-badge">✓</span>
            <div class="product-img-container">
            <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }} logo" class="product-img">            </div>
            <div class="product-info">
              <h3 class="product-title">{{$company->legal_name}}</h3>
              <div class="product-price">
                <span class="current-price">{{ $company->industry }}</span>
=              </div>
              <div class="product-actions">
              <button class="details-btn" onclick="window.location.href='{{ route('login', ['company' => $company->id]) }}'">Details</button>
                              <button class="wishlist-btn"><i class="far fa-heart"></i></button>
              </div>
            </div>
          </div>
@endforeach


		 
          
        
        </div>
      </div>
      
<script>
const searchInput = document.getElementById('searchInput');
const productGrid = document.querySelector('.product-grid');

searchInput.addEventListener('keyup', function() {
    let query = this.value;

    fetch(`{{ route('companies.index') }}?query=${encodeURIComponent(query)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
    })
    .then(companies => {
        console.log('Received companies:', companies); // Debug log
        productGrid.innerHTML = ''; // clear current products

        if (!Array.isArray(companies)) {
            console.error('Expected array but got:', typeof companies, companies);
            productGrid.innerHTML = '<p>Error: Invalid response format.</p>';
            return;
        }

        if (companies.length === 0) {
            productGrid.innerHTML = '<p>No companies found.</p>';
            return;
        }

        companies.forEach(company => {
            productGrid.innerHTML += `
            <div class="product-card">
                <span class="product-badge">✓</span>
                <div class="product-img-container">
                    <img src="/storage/${company.logo}" alt="${company.name} logo" class="product-img">
                </div>
                <div class="product-info">
                    <h3 class="product-title">${company.legal_name}</h3>
                    <div class="product-price">
                        <span class="current-price">${company.industry}</span>
                    </div>
                    <div class="product-actions">
                        <button class="details-btn" onclick="window.location.href='/login?company=${company.id}'">Details</button>
                        <button class="wishlist-btn"><i class="far fa-heart"></i></button>
                    </div>
                </div>
            </div>
            `;
        });
    })
    .catch(error => {
        console.error('Fetch error:', error);
        productGrid.innerHTML = '<p>Error loading companies. Please try again.</p>';
    });
});
</script>

@endsection
