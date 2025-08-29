<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            color: #2d3748;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1400px;
            margin: 40px auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            padding: 2rem;
        }
        h1 {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #2d3748;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        th {
            background: #f4f4f4;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
        }
        tr:hover {
            background: #f7fafc;
        }
        .logo-img {
            max-width: 60px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        /* Search Functionality Styles */
        .companies-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin-bottom: 1rem;
        }

        .search-bar {
            transition: transform 0.2s ease;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        #companies-results-counter {
            padding: 0.5rem 1rem;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 8px;
            display: inline-block;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            border: 2px dashed #e2e8f0;
        }

        .no-results i {
            color: #cbd5e0;
            margin-bottom: 1rem;
            font-size: 3rem;
        }

        .no-results h3 {
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .no-results p {
            color: #718096;
        }

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

        /* Responsive Design */
        @media (max-width: 768px) {
            .companies-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .companies-header h1 {
                margin-bottom: 0;
            }

            .search-bar {
                width: 100%;
                min-width: auto;
            }

            .container {
                margin: 20px;
                padding: 1rem;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 0.75rem 0.5rem;
            }

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
        .actions a {
            color: #3182ce;
            text-decoration: none;
            font-weight: 500;
            margin-right: 1rem;
            transition: color 0.2s;
        }
        .actions a:hover {
            color: #2b6cb0;
            text-decoration: underline;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(44,62,80,0.25);
        }
        .modal-content {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            margin: 0 auto;
            padding: 32px 24px;
            border-radius: 16px;
            width: 95%;
            max-width: 700px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.15);
            animation: fadeIn 0.3s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-60%);}
            to { opacity: 1; transform: translateY(-50%);}
        }
        .modal-close {
            float: right;
            font-size: 1.8rem;
            color: #888;
            cursor: pointer;
            transition: color 0.2s;
        }
        .modal-close:hover {
            color: #e74c3c;
        }
        .company-card {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 18px;
        }
        .company-logo-big {
            max-width: 90px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(44,62,80,0.08);
            background: #f4f4f4;
        }
        .company-details {
            margin-top: 10px;
        }
        .company-details p {
            margin: 8px 0;
            font-size: 1.05rem;
        }
        .company-details i {
            color: #3182ce;
            margin-right: 8px;
        }
        .legal-docs a {
            display: inline-block;
            margin: 2px 8px 2px 0;
            padding: 2px 8px;
            background: #eaf6ff;
            color: #3182ce;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.97rem;
            transition: background 0.2s;
        }
        .legal-docs a:hover {
            background: #d0eaff;
        }
        .modal-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 18px;
            color: #2d3748;
        }
        .company-card h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
        }
        .company-card p {
            margin: 0;
            color: #666;
            font-size: 1rem;
        }
        @media (max-width: 600px) {
            .modal-content { padding: 18px 6px; }
            .company-card { flex-direction: column; align-items: flex-start; gap: 8px;}
        }
    </style>
    <style>


.search-bar {
    position: relative;
    min-width: 250px;
    max-width: 400px;
    flex-shrink: 0;
}

.search-bar i {
    position: absolute;
    left: 15px;
    top: 50%;
    color: #718096;
}

.search-bar input {
    width: 50%;
    padding: 12px 45px;
    border: 2px solid #e2e8f0;
    border-radius: 25px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.search-bar input:focus {
    border-color: #3182ce;
    outline: none;
}
</style>

</head>
<body>
    <div class="container">
        <!-- User Credentials Message (10 seconds) -->
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

        <div class="header">
                        @csrf
                        <a type="submit"  href ="{{ route('admin') }}" class="btn btn-secondary">
                            <i class="fas fa-sign-out-alt"></i>

    </a>

        </div>

        <!-- Companies Header with Search -->
       <div class="companies-header">
    <h1>Companies</h1>
    
    <!-- Companies Search Bar -->
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" id="companies-search" placeholder="Search companies by name...">
    </div>
</div>



        <!-- Companies Results Counter -->
        <div id="companies-results-counter" style="margin-bottom: 1rem; color: #718096; font-size: 14px; font-weight: 500;">
            @php
                $companyCount = isset($companies) ? count($companies) : 0;
            @endphp
            Showing {{ $companyCount }} of {{ $companyCount }} companies
        </div>

        <table id="companies-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr class="company-row" data-legalname="{{ strtolower($company->legal_name) }}" data-email="{{ strtolower($company->email) }}">
                    <td>
                        @if($company->logo)
                            <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }} logo" class="logo-img">
                        @else
                            <span>No Logo</span>
                        @endif
                    </td>
                    <td>{{ $company->legal_name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->phone }}</td>
                    <td class="actions">
                        <a href="javascript:void(0);" onclick='showDetails(@json($company))'><i class="fas fa-eye"></i> Details</a>
                        @if($company->is_active)
                            <a href="{{ route('company.activate', ['id' => $company->id]) }}"><i class="fas fa-ban"></i> Deactivate</a>
                        @else
                            <a href="{{ route('company.activate', ['id' => $company->id]) }}"><i class="fas fa-check"></i> Activate</a>
                        @endif
                        <a href="{{ route('company.delete', ['id' => $company->id]) }}"><i class="fas fa-delete"></i>X Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="details" class="modal">
          <div class="modal-content">
            <span class="modal-close" onclick="document.getElementById('details').style.display='none'">&times;</span>
            <h2>Company Details</h2>
            <div id="company-info" style="padding: 10px;">
              <!-- Company info will be injected here -->
            </div>
          </div>
        </div>

        <div id="imgModal" class="modal">
          <div class="modal-content" style="max-width:600px;text-align:center;">
            <span class="modal-close" onclick="document.getElementById('imgModal').style.display='none'">&times;</span>
            <img id="modalImg" src="" alt="Document" style="max-width:100%;border-radius:12px;">
            <div id="imgCaption" style="margin-top:10px;color:#555;"></div>
          </div>
        </div>
    </div>

    <!-- Credentials Message Functionality -->
    <script>
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

    <!-- Companies Search Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companiesSearchInput = document.getElementById('companies-search');
            const companiesTable = document.getElementById('companies-table');
            const companiesResultsCounter = document.getElementById('companies-results-counter');

            if (companiesSearchInput && companiesTable) {
                const companyRows = document.querySelectorAll('.company-row');
                const totalCompanies = companyRows.length;

                function performCompaniesSearch() {
                    const query = companiesSearchInput.value.toLowerCase().trim();
                    let visibleCount = 0;

                    companyRows.forEach(row => {
                        const legal_name = row.dataset.legalname || '';
                        const email = row.dataset.email || '';

                        if (query === '' || legal_name.includes(query) || email.includes(query)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Update counter
                    if (companiesResultsCounter) {
                        companiesResultsCounter.textContent = `Showing ${visibleCount} of ${totalCompanies} companies`;
                    }

                    // Show no results message
                    showCompaniesNoResults(visibleCount === 0 && query !== '');
                }

                function showCompaniesNoResults(show) {
                    let noResultsRow = document.getElementById('companies-no-results');
                    if (show && !noResultsRow) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.id = 'companies-no-results';
                        noResultsRow.innerHTML = `
                            <td colspan="6" class="no-results">
                                <i class="fas fa-search"></i>
                                <h3>No companies found</h3>
                                <p>Try adjusting your search terms</p>
                            </td>
                        `;
                        companiesTable.querySelector('tbody').appendChild(noResultsRow);
                    } else if (!show && noResultsRow) {
                        noResultsRow.remove();
                    }
                }

                // Add search event listener
                companiesSearchInput.addEventListener('input', performCompaniesSearch);

                // Add focus effect
                companiesSearchInput.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                companiesSearchInput.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            }
        });
    </script>

<script>

    </script>
    <script>
        function showDetails(company) {
            let html = `
              <div class="company-card">
                ${company.logo ? `<img src="/storage/${company.logo}" alt="Logo" class="company-logo-big" style="cursor:pointer;" onclick="showImgModal('/storage/${company.logo}', 'Company Logo')">` : ''}
                <div>
                  <h3>${company.legal_name ?? ''}</h3>
                  <p>${company.trade_name ?? ''}</p>
                </div>
              </div>
              <div class="company-details">
                <p><i class="fas fa-id-card"></i> <strong>Registration Number:</strong> ${company.registration_number ?? ''}</p>
                <p><i class="fas fa-file-alt"></i> <strong>Tax ID:</strong> ${company.tax_id ?? ''}</p>
                <p><i class="fas fa-calendar"></i> <strong>Incorporation Date:</strong> ${company.incorporation_date ?? ''}</p>
                <p><i class="fas fa-university"></i> <strong>Legal Structure:</strong> ${company.legal_structure ?? ''}</p>
                <p><i class="fas fa-globe"></i> <strong>Jurisdiction:</strong> ${company.jurisdiction ?? ''}</p>
                <p><i class="fas fa-industry"></i> <strong>Industry:</strong> ${company.industry ?? ''}</p>
                <p><i class="fas fa-check-circle"></i> <strong>Active:</strong> ${company.is_active ? 'Yes' : 'No'}</p>
                <p><i class="fas fa-map-marker-alt"></i> <strong>Headquarters Address:</strong> ${company.headquarters_address ?? ''}</p>
                <p><i class="fas fa-flag"></i> <strong>Country:</strong> ${company.country ?? ''}</p>
                <p><i class="fas fa-phone"></i> <strong>Phone:</strong> ${company.phone ?? ''}</p>
                <p><i class="fas fa-envelope"></i> <strong>Email:</strong> ${company.email ?? ''}</p>
                <p><i class="fas fa-globe"></i> <strong>Website:</strong> ${company.website ?? ''}</p>
                <p><i class="fas fa-file"></i> <strong>Certificate of Incorporation:</strong> 
                  ${company.certificate_of_incorporation 
                    ? `<img src="/storage/${company.certificate_of_incorporation}" alt="Certificate of Incorporation" style="max-width:60px;cursor:pointer;border-radius:6px;border:1px solid #ccc;" onclick="showImgModal('/storage/${company.certificate_of_incorporation}', 'Certificate of Incorporation')">`
                    : 'Not uploaded'}
                </p>
                <p><i class="fas fa-file"></i> <strong>Tax Registration Certificate:</strong> 
                  ${company.tax_registration_certificate 
                    ? `<img src="/storage/${company.tax_registration_certificate}" alt="Tax Registration Certificate" style="max-width:60px;cursor:pointer;border-radius:6px;border:1px solid #ccc;" onclick="showImgModal('/storage/${company.tax_registration_certificate}', 'Tax Registration Certificate')">`
                    : 'Not uploaded'}
                </p>
                
              </div>
            `;
            document.getElementById('company-info').innerHTML = html;
            document.getElementById('details').style.display = 'block';
        }

        function showImgModal(src, caption) {
            document.getElementById('modalImg').src = src;
            document.getElementById('imgCaption').innerText = caption;
            document.getElementById('imgModal').style.display = 'block';
        }
        </script>
</body>
</html>
