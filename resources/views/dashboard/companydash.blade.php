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
</head>
<body>
    <div class="container">
        <h1>Companies</h1>
        <table>
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
                <tr>
                    <td>
                        @if($company->logo)
                            <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }} logo" class="logo-img">
                        @else
                            <span>No Logo</span>
                        @endif
                    </td>
                    <td>{{ $company->name }}</td>
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
