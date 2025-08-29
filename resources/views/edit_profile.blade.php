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

        /* Form Styles */
        .info-section {
            background: #f8fafc;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-label i {
            color: #667eea;
            font-size: 0.85rem;
        }

        .form-input {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .error-message {
            color: #e53e3e;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .error-message::before {
            content: "⚠";
            font-size: 0.7rem;
        }



        .form-help {
            color: #718096;
            font-size: 0.8rem;
        }

        .actions-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            background: #f8fafc;
            border-radius: 15px;
            margin-top: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .alert-success {
            background: #f0fff4;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }

        .alert-success i {
            color: #38a169;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #feb2b2;
        }

        .alert-error i {
            color: #e53e3e;
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

            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }



            .actions-section {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.5rem;
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
                   
                </div>
            </div>

            <!-- User Content -->
            <div class="user-content">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->has('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('error') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="info-section">
                        <div class="section-title">
                            <i class="fas fa-user"></i>
                            {{ __('messages.personal_information', [], app()->getLocale()) }}
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    {{ __('messages.first_name', [], app()->getLocale()) }}
                                </label>
                                <input type="text" id="first_name" name="first_name"
                                       value="{{ old('first_name', Auth::user()->first_name) }}"
                                       class="form-input" required>
                                @error('first_name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="matricule" class="form-label">
                                    <i class="fas fa-id-card"></i>
                                    {{ __('messages.matricule', [], app()->getLocale()) }}
                                </label>
                                <input type="text" id="matricule" name="matricule"
                                       value="{{ old('matricule', Auth::user()->matricule) }}"
                                       class="form-input" required>
                                @error('matricule')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    {{ __('messages.email', [], app()->getLocale()) }}
                                </label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email', Auth::user()->email) }}"
                                       class="form-input" required>
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-tag"></i>
                                    {{ __('messages.role', [], app()->getLocale()) }}
                                </label>
                                <select id="role" name="role" class="form-input" required>
                                    <option value="employee" {{ old('role', Auth::user()->role) == 'employee' ? 'selected' : '' }}>
                                        {{ __('messages.employee', [], app()->getLocale()) }}
                                    </option>
                                    <option value="hr_staff" {{ old('role', Auth::user()->role) == 'hr_staff' ? 'selected' : '' }}>
                                        {{ __('messages.hr_staff', [], app()->getLocale()) }}
                                    </option>
                                    <option value="hr_admin" {{ old('role', Auth::user()->role) == 'hr_admin' ? 'selected' : '' }}>
                                        {{ __('messages.hr_admin', [], app()->getLocale()) }}
                                    </option>
                                    <option value="manager" {{ old('role', Auth::user()->role) == 'manager' ? 'selected' : '' }}>
                                        {{ __('messages.manager', [], app()->getLocale()) }}
                                    </option>
                                </select>
                                @error('role')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="department" class="form-label">
                                    <i class="fas fa-building"></i>
                                    {{ __('messages.department', [], app()->getLocale()) }}
                                </label>
                                <input type="text" id="department" name="department"
                                       value="{{ old('department', Auth::user()->department) }}"
                                       class="form-input" required>
                                @error('department')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Work Information Section -->
                   

                    <!-- Security Section -->
                    <div class="info-section">
                        <div class="section-title">
                            <i class="fas fa-lock"></i>
                            {{ __('messages.security_settings', [], app()->getLocale()) }}
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="current_password" class="form-label">
                                    <i class="fas fa-key"></i>
                                    {{ __('messages.current_password', [], app()->getLocale()) }}
                                </label>
                                <input type="password" id="current_password" name="current_password"
                                       class="form-input" placeholder="{{ __('messages.leave_blank_no_change', [], app()->getLocale()) }}">
                                @error('current_password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i>
                                    {{ __('messages.new_password', [], app()->getLocale()) }}
                                </label>
                                <input type="password" id="password" name="password"
                                       class="form-input" placeholder="{{ __('messages.leave_blank_no_change', [], app()->getLocale()) }}">
                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock"></i>
                                    {{ __('messages.confirm_password', [], app()->getLocale()) }}
                                </label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-input" placeholder="{{ __('messages.leave_blank_no_change', [], app()->getLocale()) }}">
                            </div>
                        </div>
                    </div>



                    <!-- Form Actions -->
                    <div class="actions-section">
                        <div class="action-buttons">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                {{ __('messages.save_changes', [], app()->getLocale()) }}
                            </button>

                            <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                <i class="fas fa-undo"></i>
                                {{ __('messages.reset', [], app()->getLocale()) }}
                            </button>
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('messages.back_to_dashboard', [], app()->getLocale()) }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Form reset functionality
        function resetForm() {
            if (confirm('{{ __("messages.confirm_reset", [], app()->getLocale()) }}')) {
                document.getElementById('profileForm').reset();
            }
        }

        // Form validation
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password && password !== confirmPassword) {
                e.preventDefault();
                alert('{{ __("messages.passwords_do_not_match", [], app()->getLocale()) }}');
                return false;
            }
        });
    </script>
</body>
</html>