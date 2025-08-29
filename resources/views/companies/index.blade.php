@extends('test')

@section('title', 'Company Menu')

@section('content')
<div class="container">
    <!-- User Credentials Message (8 seconds) -->
    @if(session('user_credentials'))
    <div id="credentials-message" class="credentials-alert">
        <div class="credentials-content">
            <div class="credentials-header">
                <i class="fas fa-user-plus"></i>
                <h3>HR Admin Account Created!</h3>
                <span id="countdown">8</span>
            </div>
            <div class="credentials-body">
                <p><strong>Company:</strong> {{ session('user_credentials')['company_name'] }}</p>
                <div class="credential-item">
                    <label>Email:</label>
                    <span class="credential-value">{{ session('user_credentials')['email'] }}</span>
                    <button onclick="copyToClipboard('{{ session('user_credentials')['email'] }}')" class="copy-btn">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <div class="credential-item">
                    <label>Matricule:</label>
                    <span class="credential-value">{{ session('user_credentials')['matricule'] }}</span>
                    <button onclick="copyToClipboard('{{ session('user_credentials')['matricule'] }}')" class="copy-btn">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <div class="credential-item">
                    <label>Password:</label>
                    <span class="credential-value">{{ session('user_credentials')['password'] }}</span>
                    <button onclick="copyToClipboard('{{ session('user_credentials')['password'] }}')" class="copy-btn">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
            <div class="credentials-footer">
                <small><i class="fas fa-exclamation-triangle"></i> Save these credentials now! This message will disappear in <span id="countdown-text">8</span> seconds.</small>
                <button onclick="closeCredentialsMessage()" class="close-btn">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
    @endif

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

    // Credentials message countdown and auto-hide
    @if(session('user_credentials'))
    document.addEventListener('DOMContentLoaded', function() {
        let countdown = 8;
        const countdownElement = document.getElementById('countdown');
        const countdownTextElement = document.getElementById('countdown-text');
        const credentialsMessage = document.getElementById('credentials-message');

        const timer = setInterval(function() {
            countdown--;
            countdownElement.textContent = countdown;
            countdownTextElement.textContent = countdown;

            if (countdown <= 0) {
                clearInterval(timer);
                closeCredentialsMessage();
            }
        }, 1000);
    });
    @endif

    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show temporary success message
            const button = event.target.closest('.copy-btn');
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i>';
            button.style.background = 'rgba(34, 197, 94, 0.3)';

            setTimeout(function() {
                button.innerHTML = originalHTML;
                button.style.background = 'rgba(255,255,255,0.2)';
            }, 1000);
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
        });
    }

    // Close credentials message
    function closeCredentialsMessage() {
        const credentialsMessage = document.getElementById('credentials-message');
        if (credentialsMessage) {
            credentialsMessage.style.animation = 'slideOutRight 0.5s ease-in';
            setTimeout(function() {
                credentialsMessage.remove();
            }, 500);
        }
    }
</script>

<style>
/* Credentials Alert Styles */
.credentials-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.3), 0 10px 10px -5px rgba(0,0,0,0.2);
    max-width: 450px;
    animation: slideInRight 0.5s ease-out;
}

.credentials-content {
    padding: 1.5rem;
}

.credentials-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    padding-bottom: 1rem;
}

.credentials-header h3 {
    margin: 0;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.credentials-header i {
    font-size: 1.5rem;
    color: #ffd700;
}

#countdown {
    background: rgba(255,255,255,0.2);
    padding: 0.25rem 0.5rem;
    border-radius: 50%;
    font-weight: bold;
    min-width: 30px;
    text-align: center;
}

.credentials-body p {
    margin: 0 0 1rem 0;
    font-weight: 500;
}

.credential-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    background: rgba(255,255,255,0.1);
    padding: 0.75rem;
    border-radius: 8px;
}

.credential-item label {
    font-weight: 600;
    min-width: 80px;
}

.credential-value {
    flex: 1;
    margin: 0 0.5rem;
    font-family: 'Courier New', monospace;
    background: rgba(255,255,255,0.2);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    word-break: break-all;
}

.copy-btn {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    padding: 0.5rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.copy-btn:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.credentials-footer {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255,255,255,0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.credentials-footer small {
    flex: 1;
    opacity: 0.9;
}

.close-btn {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 1rem;
}

.close-btn:hover {
    background: rgba(255,255,255,0.3);
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

/* Mobile responsive */
@media (max-width: 768px) {
    .credentials-alert {
        position: fixed;
        top: 10px;
        left: 10px;
        right: 10px;
        max-width: none;
    }

    .credential-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .credential-value {
        width: 100%;
        margin: 0;
    }

    .credentials-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .close-btn {
        margin-left: 0;
        width: 100%;
    }
}
</style>

@endsection
