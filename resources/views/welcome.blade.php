<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - {{ $company->legal_name ?? 'Portal' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --gradient-color-1: {{ $gradientColor1 ?? '#6f42c1' }};
            --gradient-color-2: {{ $gradientColor2 ?? '#5a4fcf' }};
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            color: var(--gray-800);
            line-height: 1.6;
        }

        .dashboard-container {
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-card {
            max-width: 1000px;
            width: 100%;
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-header {
            background: linear-gradient(135deg, var(--gradient-color-1), var(--gradient-color-2));
            padding: 2.5rem 2rem;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .user-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
        }

        .header-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .user-info h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-info p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
        }

        .user-content {
            padding: 2.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .info-section {
            background: var(--gray-50);
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid var(--gradient-color-1);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: var(--gradient-color-1);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: var(--white);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-md);
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: rgba(111, 66, 193, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gradient-color-1);
            font-size: 1.1rem;
        }

        .info-details {
            flex: 1;
        }

        .info-label {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 500;
            color: var(--gray-800);
            font-size: 1rem;
        }

        .actions-section {
            padding-top: 2rem;
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--gradient-color-2);
            color: var(--white);
        }

        .btn-primary:hover {
            background:  var(--gradient-color-1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(111, 66, 193, 0.3);
        }

        .btn-secondary {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background: var(--gray-300);
        }

        .forms-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-200);
        }

        .forms-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .forms-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .forms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .form-card {
            background: var(--gray-50);
            padding: 1.25rem;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            position: relative;
        }

        .form-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--gradient-color-1);
        }

        .form-title {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .form-meta {
            color: var(--gray-500);
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }

        .form-link {
            color: var(--gradient-color-1);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .form-link:hover {
            color: var(--gradient-color-2);
            gap: 0.75rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .user-header {
                padding: 2rem 1.5rem;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .user-content {
                padding: 2rem 1.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .actions-section {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="user-card">
            <!-- Header -->
            <div class="user-header">
                <div class="header-content">
                    <div class="user-info">
                        <h1>
                            <i class="fas fa-user-circle"></i>
                            Welcome back, {{ Auth::user()->first_name }}!
                        </h1>
                        <p>Here's your profile information</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name) }}&background={{ substr($gradientColor1, 1) }}&color=fff" 
                         alt="Profile" 
                         class="user-avatar">
                </div>
            </div>
            
            <!-- User Content -->
            <div class="user-content">
                <div class="info-grid">
                    <!-- Personal Information -->
                    <div class="info-section">
                        <div class="section-title">
                            <i class="fas fa-user"></i>
                            Personal Information
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div class="info-details">
                                <div class="info-label">Matricule</div>
                                <div class="info-value">{{ Auth::user()->matricule }}</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-details">
                                <div class="info-label">Email Address</div>
                                <div class="info-value">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Work Information -->
                    <div class="info-section">
                        <div class="section-title">
                            <i class="fas fa-briefcase"></i>
                            Work Information
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="info-details">
                                <div class="info-label">Department</div>
                                <div class="info-value">{{ Auth::user()->department }}</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <div class="info-details">
                                <div class="info-label">Role</div>
                                <div class="info-value">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Forms Section -->
                @if(isset($forms) && $forms->count() > 0)
                <div class="forms-section">
                    <div class="forms-header">
                        <div class="forms-title">
                            <i class="fas fa-file-alt"></i>
                            Available Forms
                        </div>
                    </div>
                    
                    <div class="forms-grid">
                        @foreach($forms as $form)
                        <div class="form-card">
                            <div class="form-title">{{ $form->title }}</div>
                            <div class="form-meta">
                                Created: {{ $form->created_at->format('M d, Y') }}
                            </div>
                            <a href="{{ route('form.formulaire', ['form' => $form->id]) }}" class="form-link">
                                View Form
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Action Buttons -->
                <div class="actions-section">
                    <div>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit Profile
                        </a>
                    </div>
                    
                    <form method="POST" action="{{ route('logout', ['company' => $company->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>