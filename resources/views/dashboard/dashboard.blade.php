
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-gradient: {{$gradientColor2}};
            --secondary-gradient: {{$gradientColor1}};
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --info-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --sidebar-gradient: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            --main-color: #2d3748;
            --text-light: #718096;
            --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --hover-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            color: var(--main-color);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            height: 100vh;
            position: relative;
        }

        .dashboard-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 300px;
            background: var(--primary-gradient);
            z-index: -1;
            border-radius: 0 0 50px 50px;
        }

        .sidebar {
            width: 280px;
            background: var(--sidebar-gradient);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            box-shadow: var(--card-shadow);
            border-radius: 0 25px 25px 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 3rem;
            padding: 1rem;
            background:#ffffff;
            border-radius: 15px;
            color: white;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .sidebar .logo img {
    display: block;
    max-width: 100%;
    height: auto;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 8px; /* optional for smooth corners */
}

        

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 1.5rem;
            color: var(--main-color);
            text-decoration: none;
            border-radius: 15px;
            margin-bottom: 0.8rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-weight: 500;
        }

        .sidebar nav a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .sidebar nav a:hover::before,
        .sidebar nav a.active::before {
            left: 0;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            color: #ffffff;
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .sidebar nav a i {
            width: 24px;
            font-size: 1.1rem;
        }

        
        .sidebar .user-profile .btn {
    padding: 10px 16px;
    background: linear-gradient(135deg, rgba(79, 172, 254, 1), rgba(102, 126, 234, 1));
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
        .sidebar .user-profile button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .main-content header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            backdrop-filter: blur(10px);
        }

        .main-content header h2 {
            font-size: 2rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .main-content header p {
            color: var(--text-light);
            font-weight: 400;
            margin-top: 0.5rem;
        }

        .main-content header .search-bar {
            position: relative;
            width: 350px;
        }

        .main-content header .search-bar input {
            width: 100%;
            padding: 1rem 3rem;
            border: 2px solid transparent;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .main-content header .search-bar input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .main-content header .search-bar i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .main-content .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .main-content .stats .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .main-content .stats .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .main-content .stats .card:nth-child(1)::before {
            background: var(--primary-gradient);
        }
        .main-content .stats .card:nth-child(2)::before {
            background: var(--success-gradient);
        }
        .main-content .stats .card:nth-child(3)::before {
            background: var(--warning-gradient);
        }
        .main-content .stats .card:nth-child(4)::before {
            background: var(--danger-gradient);
        }

        .main-content .stats .card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }
        
        .main-content .stats .card i {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 15px;
            background: rgba(102, 126, 234, 0.1);
            display: inline-block;
        }

        .main-content .stats .card:nth-child(1) i {
            background: var(--primary-gradient);
            color: white;
        }
        .main-content .stats .card:nth-child(2) i {
            background: var(--success-gradient);
            color: white;
        }
        .main-content .stats .card:nth-child(3) i {
            background: var(--warning-gradient);
            color: white;
        }
        .main-content .stats .card:nth-child(4) i {
            background: var(--danger-gradient);
            color: white;
        }

        .main-content .stats .card h2 {
            font-size: 1.1rem;
            margin-bottom: 0.8rem;
            color: var(--text-light);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .main-content .stats .card p {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--main-color);
        }
        
        .main-content .forms-overview {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .main-content .forms-overview:hover {
            box-shadow: var(--hover-shadow);
        }

        .main-content .forms-overview .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f7fafc;
        }

        .main-content .forms-overview .header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .main-content .forms-overview .header .btn-create {
            background: var(--primary-gradient);
            color: #ffffff;
            padding: 1rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .main-content .forms-overview .header .btn-create:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .main-content .forms-overview table {
            width: 100%;
            border-collapse: collapse;
        }

        .main-content .forms-overview th {
            padding: 1.5rem 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--main-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .main-content .forms-overview td {
            padding: 1.5rem 1rem;
            text-align: left;
            border-bottom: 1px solid #f7fafc;
            font-weight: 500;
        }

        .main-content .forms-overview tbody tr {
            transition: all 0.3s ease;
        }

        .main-content .forms-overview tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }
        
        .main-content .forms-overview .status {
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .main-content .forms-overview .status.published {
            background: var(--success-gradient);
            color: white;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        .main-content .forms-overview .status.draft {
            background: var(--danger-gradient);
            color: white;
            box-shadow: 0 5px 15px rgba(250, 112, 154, 0.3);
        }

        .main-content .forms-overview td a {
            color: var(--primary-gradient);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .main-content .forms-overview td a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Submitters expandable section styles */
       


      

        .expand-icon {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .expand-icon.expanded {
            transform: rotate(90deg);
        }

        .submitters-row {
            background: #f8f9fa;
            border-left: 4px solid var(--primary-gradient);
        }

        .submitters-container {
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            margin: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .submitters-container h4 {
            color: var(--main-color);
            margin-bottom: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .submitters-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .submitter-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 3px solid var(--secondary-gradient);
            transition: all 0.2s ease;
        }

        .submitter-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .submitter-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .submitter-name {
            font-weight: 600;
            color: var(--main-color);
            font-size: 0.95rem;
        }

        .submitter-email {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .submission-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.25rem;
        }

        .submission-date {
            color: var(--text-light);
            font-size: 0.8rem;
        }

        .submission-status {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .submission-status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .submission-status.approved {
            background: #d4edda;
            color: #155724;
        }

        .submission-status.rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .no-submissions {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
        }

        .no-submissions i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            opacity: 0.5;
        }

        .no-submissions p {
            margin: 0;
            font-style: italic;
        }

        /* Status indicators */
        .status {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status.published {
            background: #d4edda;
            color: #155724;
        }

        .status.draft {
            background: #fff3cd;
            color: #856404;
        }

        .status.active {
            background: #d1ecf1;
            color: #0c5460;
        }

        .main-content .analytics {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .main-content .analytics:hover {
            box-shadow: var(--hover-shadow);
        }

        .main-content .analytics h2 {
            font-size: 1.8rem;
            font-weight: 600;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
        }

        /* Forms Page Styles - Minimalist Design */
        .forms-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .form-filters {
            display: flex;
            gap: 0.5rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: white;
            color: var(--primary-gradient);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--secondary-gradient);
            color: white;
            border-color: #667eea;
        }

        .btn-create-new {
            background: #ffffff;
            color: var(--primary-gradient);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-create-new:hover {
             transform: translateY(-3px);
        }

        .forms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid #e9ecef;
        }

        .form-card:hover {
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .form-card-number {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: #adb5bd;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .form-card-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1.5rem;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #6c757d;
            border: 1px solid #e9ecef;
        }

        .form-card:hover .form-card-icon {
            background: var(--primary-gradient  );
            color: white;
            border-color: #667eea;
        }

        .form-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--main-color);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .form-card p {
            color: var(--text-light);
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .form-card-meta {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .form-card-status {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .form-card-status.published {
            background: #d4edda;
            color: #155724;
        }

        .form-card-status.draft {
            background: #fff3cd;
            color: #856404;
        }

        .form-card-btn {
            display: inline-block;
            background: var(--primary-gradient);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 50%;
        }

        .form-card-btn:hover {
            background: var(--secondary-gradient);
        }

        .form-card-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .form-card-actions .btn-secondary {
            background: transparent;
            color: var(--text-light);
            border: 1px solid #e9ecef;
            flex: 1;
            padding: 0.5rem;
            font-size: 0.75rem;
        }

        .form-card-actions .btn-secondary:hover {
            background: #f8f9fa;
            color: var(--main-color);
        }
        .logout-btn {
            background: var(--secondary-gradient);
            color: #ffffff;
            padding: 1rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            width: 100%;
            border-color:var(--secondary-gradient) ;
            
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
            background: var(--primary-gradient);
            border-color:var(--primary-gradient) ;

        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                border-radius: 0;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .main-content .stats {
                grid-template-columns: 1fr;
            }
            
            .main-content header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .main-content header .search-bar {
                width: 100%;
            }

            .forms-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .forms-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .form-filters {
                justify-content: center;
            }

            .form-card-footer {
                flex-direction: column;
                gap: 0.8rem;
            }

            .btn-action {
                justify-content: center;
            }
        }
        .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    color: var(--primary-gradient);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
}

.close-btn:hover {
    color: red;
}
.act-btn {
    color: var(--primary-gradient);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
    background: transparent;
    border:transparent;
    font-size: 1.0rem;
}

    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">

            <div class="logo">
                @if(isset($company))
                    <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }} logo">
                @endif
            </div>
            <nav>
                <a href="#" class="active" data-page="dashboard"><i class="fas fa-tachometer-alt"></i> {{ __('messages.dashboard') }}</a>
                <a href="#" data-page="forms"><i class="fas fa-file-alt"></i> {{ __('messages.forms') }}</a>
                <a href="#" data-page="analytics"><i class="fas fa-chart-pie"></i> {{ __('messages.analytics') }}</a>
                <a href="#" data-page="settings"><i class="fas fa-cog"></i> {{ __('messages.settings') }}</a>
            </nav>
             <div class="language-switcher">
                            <select onchange="switchLanguage(this.value)" style="padding: 10px 15px; border-radius: 10px; border: 2px solid #e2e8f0; background: white; font-size: 14px; cursor: pointer;">
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 English</option>
                                <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
                                <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>🇸🇦 العربية</option>
                            </select>
                        </div>

  <form method="POST" action="{{ route('logout', ['company' => $company->id]) }}">
            @csrf
            <button type="submit" class="logout-btn">
                <span>Logout</span>
            </button>
        </form>
            
        </aside>

        <main class="main-content">
            <div id="dashboard-content">
                <header>
                    <div>
                        <h2>{{ __('messages.welcome_back') }}, {{ __('messages.admin') }}!</h2>
                        <p>{{ __('messages.happening_today') }}</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <!-- Language Switcher -->
                        @include('components.language-switcher')
                        <div class="search-bar">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="{{ __('messages.search_forms') }}">
                        </div>
                    </div>
                </header>

                <section class="stats">
                    <div class="card">
                        <i class="fas fa-file-alt"></i>
                        <h2>{{ __('messages.total_forms') }}</h2>
                        <p>24</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-check-circle"></i>
                        <h2>{{ __('messages.active_forms') }}</h2>
                        <p>18</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-poll"></i>
                        <h2>{{ __('messages.total_submissions') }}</h2>
                        <p>1,234</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-user-plus"></i>
                        <h2>{{ __('messages.total_users') }}</h2>
                        <p>5</p>
                    </div>
                </section>
                
                <section class="forms-overview">
                    <div class="header">
                        <h2>{{ __('messages.company_users') }}</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach ($userc as $user)
                        <tbody>
                            <tr>
                                <td>"{{ $user->matricule }}"</td>
                                <td>"{{ $user->first_name }}"</td>
                                @if ($user->is_active)
                                    <td><span class="status published">Active</span></td>
                                @else
                                    <td><span class="status draft">Inactive</span></td>
                                @endif
                                <td>"{{ $user->role }}"</td>
                                <td><a href="#">Edit</a> | 
                                @if (!$user->is_active)
                                <form action="{{ route('user.active', ['user_id' => $user->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="act-btn">Activate</button>
                                </form>
                                @else
                                <form action="{{ route('user.active', ['user_id' => $user->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="act-btn">Disactivate</button>
                                </form>                                @endif
                                <td>
   
</td>
                               
                            </tr>
                        @endforeach
                           
                        </tbody>
                    </table>
                </section>

                <section class="analytics">
                    <h2>Submissions in the last 30 days</h2>
                    <canvas id="submissionsChart"></canvas>
                </section>
            </div>

            <div id="forms-content" style="display: none;">
                <header>
                    <div>
                        <h2>{{ __('messages.all_forms') }}</h2>
                        <p>{{ __('messages.manage_forms') }}</p>
                    </div>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="{{ __('messages.search_forms') }}" id="forms-search">
                    </div>
                </header>

                <div class="forms-actions" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                    <div class="form-filters">
                        <button class="filter-btn active" data-filter="all">All Forms</button>
                        <button class="filter-btn" data-filter="published">Published</button>
                        <button class="filter-btn" data-filter="draft">Drafts</button>
                    </div>
                    <a href="{{ route('form', ['company' => $company->id]) }}" class="btn-create-new">+ Create New Form</a>
                </div>

                <div class="forms-grid" id="forms-grid">
                @foreach ($forms as $form)

                <div class="form-card" data-status="published">
                    <form action="{{ route('form.delete',['form_id'=>$form->id])}}" method="POST" >
                        @csrf
                        <button class="close-btn">×</button>

                    </form>

    <div class="form-card-icon">
        <i class="fas fa-clipboard-list"></i>
    </div>
    
    @if ($form->is_active)
    <div class="form-card-status published">
        <i class="fas fa-check-circle"></i>
        Published
    </div>
    @else
    <div class="form-card-status draft">
        <i class="fas fa-check-circle"></i>
        draft
    </div>
    @endif

    <h3>{{ $form->title }}</h3>
    <p>{{ $form->description }}</p>

    <div class="form-card-meta">
        <span>245 responses</span>
        <span>{{ $form->created_at }}</span>
    </div>

    <div class="form-card-actions">
    <button class="form-card-btn">Edit</button>

    <form action="{{ route('form.publish',['form_id'=>$form->id]) }}" method="POST" style="flex: 1;">
        @csrf
        <button class="btn-secondary" style="width: 100%; height: 100%;">
            {{ $form->is_active ? 'Hide' : 'Publish' }}
        </button>
    </form>
</div>

</div>

                    @endforeach
                    
                </div>
            </div>

           <div id="analytics-content" style="display: none;">
    <header>
        <div>
            <h2>{{ __('messages.analytics') }}</h2>
            <p>{{ __('messages.manage_forms') }}</p>
        </div>
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="{{ __('messages.search_forms') }}" id="analytics-search">
        </div>
    </header>

    <section class="forms-overview">
        <div class="header">
            <h2>{{ __('messages.forms_analytics') }}</h2>
            <p style="color: var(--text-light); margin: 0; font-size: 0.9rem;">{{ __('messages.click_row_details') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Form Title</th>
                    <th></th>
                    <th></th>
                    <th>Response Rate</th>
                    <th>Submissions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                <tr class="form-row" data-form-id="{{ $form->id }}">
                    <td>{{ $form->title }}</td>
                    <td></td>
                    <td></td>
                    <td>
                        @php
                            $submissionCount = \App\Models\Submission::where('form_id', $form->id)->count();
                            $totalUsers = \App\Models\User::where('company_id', $form->company_id)->count();
                            $responseRate = $totalUsers > 0 ? round(($submissionCount / $totalUsers) * 100, 1) : 0;
                        @endphp
                        {{ $responseRate }}%
                    </td>
                    <td style="color:var(--secondary-gradient); cursor: pointer;">
                        <i class="fas fa-chevron-right expand-icon" id="icon-{{ $form->id }}"></i>
                        {{ $submissionCount }} Submissions
                    </td>
                    <td>
                        
                        
                    </td>
                </tr>
                <!-- Submitters row (initially hidden) -->
                <tr class="submitters-row" id="submitters-{{ $form->id }}" style="display: none;">
                    <td colspan="5">
                        <div class="submitters-container">
                            <div class="submitters-list">
                                @php
                                    $submissions = \App\Models\Submission::where('form_id', $form->id)->with('user')->get();
                                @endphp
                                    @if($submissions->count() > 0)
                                        @foreach($submissions as $submission)
                                        @php
                                                // Create a map of question ID to question data
                                                $questionMap = [];
                                                $answerMap = [];
                                                $schema = json_decode($form->schema, true);
                                                // Check if data is already an array or needs decoding
                                                $submissionData = is_array($submission->data) ? $submission->data : json_decode($submission->data, true);

                                                // Build question map
                                                if (isset($schema['pages'][0]['questions'])) {
                                                    foreach ($schema['pages'][0]['questions'] as $q) {
                                                        $questionMap[$q['id']] = [
                                                            'label' => $q['label'],
                                                            'type' => $q['type'],
                                                            'options' => $q['options'] ?? null
                                                        ];
                                                    }
                                                }

                                                // Build answer map
                                                if (isset($submissionData['answers'])) {
                                                    foreach ($submissionData['answers'] as $answer) {
                                                        $answerMap[$answer['questionId']] = $answer['answer'];
                                                    }
                                                }

                                                // Create combined map
                                                $dataMap = [];
                                                foreach ($questionMap as $questionId => $questionData) {
                                                    $dataMap[$questionId] = [
                                                        'question' => $questionData,
                                                        'answer' => $answerMap[$questionId] ?? 'No answer'
                                                    ];
                                                }
                                                $preRenderedHtml = '';
                                                foreach($dataMap as $questionId => $data) {
                                                    $preRenderedHtml .= "<p><strong>{$data['question']['label']}:</strong> {$data['answer']}</p>";
                                                }
                                            @endphp

                                        <div class="submitter-item"  onclick='showSubmissionDetails(@json($submission->data), @json($form->schema), "{{ $submission->user->first_name ?? 'Anonymous' }}", "{{ $submission->user->email ?? 'No email' }}", "{{ $submission->created_at->format('M d, Y H:i') }}",{!! json_encode($preRenderedHtml) !!})'>
                                            <div class="submitter-info">
                                                <span class="submitter-name">{{ $submission->user->first_name ?? 'Anonymous' }}</span>
                                                <span class="submitter-email">{{ $submission->user->email ?? 'No email' }}</span>
                                            </div>
                                            <div class="submission-meta">
                                                <span class="submission-date">{{ $submission->created_at->format('M d, Y H:i') }}</span>
                                            </div>
                                         
                                        </div>
                                       
                                        
                                    @endforeach

                                    <a href="{{ route('statistics', ['form_id' => $form->id]) }}" type="button" class="act-btn" style="background: #ffffffff; margin-left: 10px;" >
                            <i class="fas fa-chart-bar"></i> AI Report
                                            </a>
                                @else
                                    <div class="no-submissions">
                                        <i class="fas fa-inbox"></i>
                                        <p>No submissions yet</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
         <div id="submission-popup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 8px; max-width: 600px; width: 90%;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3>Submission Details</h3>
                    
                    <button onclick="closeSubmissionPopup()" style="background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
                </div>
                <div id="submission-content">
                    
                </div>
            </div>
        </div>
    </section>

   
    <!-- Example: Display Forms Map Data -->

</div>

<!-- Single Modal for all submission details (placed outside loops) -->



            <div id="settings-content" style="display: none;">
                <h2>Settings</h2>
                <p>This is where the settings content will go.</p>
            </div>
            
        </div>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('submissionsChart').getContext('2d');
        const submissionsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan 1', 'Jan 5', 'Jan 10', 'Jan 15', 'Jan 20', 'Jan 25', 'Jan 30'],
                datasets: [{
                    label: 'Submissions',
                    data: [12, 19, 3, 5, 2, 3, 9],
                    backgroundColor: 'rgba(66, 153, 225, 0.2)',
                    borderColor: 'rgba(66, 153, 225, 1)',
                    borderWidth: 1,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.sidebar nav a');

            function switchPage(pageId) {
                // Hide all content sections
                document.getElementById('dashboard-content').style.display = 'none';
                document.getElementById('forms-content').style.display = 'none';
                document.getElementById('analytics-content').style.display = 'none';
                document.getElementById('settings-content').style.display = 'none';

                // Show the selected content section
                document.getElementById(pageId + '-content').style.display = 'block';

                // Re-initialize page-specific functionality
                if (pageId === 'analytics') {
                    initializeAnalyticsPage();
                }

                // Update active class on nav links
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.dataset.page === pageId) {
                        link.classList.add('active');
                    }
                });
            }

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const pageId = this.dataset.page;
                    switchPage(pageId);
                });
            });

            // Show default page
            switchPage('{{ $page }}');

            // Initialize analytics page if it's the default page
            if ('{{ $page }}' === 'analytics') {
                setTimeout(initializeAnalyticsPage, 100);
            }
        });

        // Function to toggle submitters visibility
        function toggleSubmitters(formId) {
            console.log('toggleSubmitters called with formId:', formId);

            // Debug: Check what elements exist
            const allSubmitterRows = document.querySelectorAll('[id^="submitters-"]');
            const allIcons = document.querySelectorAll('[id^="icon-"]');
            console.log('All submitter rows found:', allSubmitterRows.length);
            console.log('All icons found:', allIcons.length);

            const submittersRowId = 'submitters-' + formId;
            const expandIconId = 'icon-' + formId;

            console.log('Looking for submittersRow ID:', submittersRowId);
            console.log('Looking for expandIcon ID:', expandIconId);

            const submittersRow = document.getElementById(submittersRowId);
            const expandIcon = document.getElementById(expandIconId);

            console.log('submittersRow found:', submittersRow);
            console.log('expandIcon found:', expandIcon);

            if (!submittersRow) {
                console.error('Submitters row not found for ID:', submittersRowId);
                // Try alternative selector
                const altSubmittersRow = document.querySelector(`tr[id="${submittersRowId}"]`);
                console.log('Alternative submitters row:', altSubmittersRow);
            }

            if (!expandIcon) {
                console.error('Expand icon not found for ID:', expandIconId);
                // Try alternative selector
                const altExpandIcon = document.querySelector(`i[id="${expandIconId}"]`);
                console.log('Alternative expand icon:', altExpandIcon);
            }

            if (!submittersRow || !expandIcon) {
                console.error('Elements not found for formId:', formId);
                return;
            }

            if (submittersRow.style.display === 'none' || submittersRow.style.display === '') {
                // Show submitters
                console.log('Showing submitters');
                submittersRow.style.display = 'table-row';
                expandIcon.classList.add('expanded');
                expandIcon.classList.remove('fa-chevron-right');
                expandIcon.classList.add('fa-chevron-down');
            } else {
                // Hide submitters
                console.log('Hiding submitters');
                submittersRow.style.display = 'none';
                expandIcon.classList.remove('expanded');
                expandIcon.classList.remove('fa-chevron-down');
                expandIcon.classList.add('fa-chevron-right');
            }
        }

        // Make sure the function is available globally
        window.toggleSubmitters = toggleSubmitters;

        // Function to generate AI report for specific form
      

        // Function to show report in popup
        function showReportPopup(content, title) {
            // Remove existing popup if any
            const existingPopup = document.getElementById('ai-report-popup');
            if (existingPopup) {
                existingPopup.remove();
            }

            // Create popup
            const popup = document.createElement('div');
            popup.id = 'ai-report-popup';
            popup.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.8);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                box-sizing: border-box;
            `;

            popup.innerHTML = `
                <div style="
                    background: white;
                    border-radius: 10px;
                    max-width: 90%;
                    max-height: 90%;
                    overflow-y: auto;
                    position: relative;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                ">
                    <div style="
                        position: sticky;
                        top: 0;
                        background: white;
                        padding: 20px;
                        border-bottom: 1px solid #eee;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        border-radius: 10px 10px 0 0;
                    ">
                        <h3 style="margin: 0; color: #333;">AI Report: ${title}</h3>
                        <button onclick="closeReportPopup()" style="
                            background: #dc3545;
                            color: white;
                            border: none;
                            border-radius: 5px;
                            padding: 8px 15px;
                            cursor: pointer;
                            font-size: 14px;
                        ">Close</button>
                    </div>
                    <div style="padding: 20px;">
                        ${content}
                    </div>
                </div>
            `;

            document.body.appendChild(popup);

            // Close on background click
            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    closeReportPopup();
                }
            });
        }

        // Function to close report popup
        function closeReportPopup() {
            const popup = document.getElementById('ai-report-popup');
            if (popup) {
                popup.remove();
            }
        }

        // Make functions globally available
        window.closeReportPopup = closeReportPopup;

        // Function to initialize analytics page functionality
        let analyticsInitialized = false;
        function initializeAnalyticsPage() {
            if (analyticsInitialized) {
                console.log('Analytics page already initialized, skipping...');
                return;
            }

            console.log('Initializing analytics page...');

            // Remove any existing event listeners to prevent duplicates
            const existingRows = document.querySelectorAll('.form-row');
            existingRows.forEach(row => {
                row.removeEventListener('click', handleRowClick);
            });

            // Add event listeners to form rows
            const formRows = document.querySelectorAll('.form-row');
            formRows.forEach(row => {
                row.addEventListener('click', handleRowClick);
            });

            analyticsInitialized = true;
            console.log('Analytics page initialized with', formRows.length, 'form rows');
        }

        // Handle row click
        function handleRowClick(e) {
            e.preventDefault();
            const formId = this.getAttribute('data-form-id');
            if (formId) {
                console.log('Row clicked, formId:', formId);
                toggleSubmitters(formId);
            }
        }

        // Remove the event delegation backup to prevent double firing
        // The direct event listeners should be sufficient

        // Popup functions
        function showSubmissionDetails(submission, form, userName, userEmail, submissionDate, dataMap) {
            document.getElementById('submission-popup').style.display = 'block';
            document.getElementById('submission-content').innerHTML = `
                <p><strong>Submitter:</strong> ${userName}</p>
                <p><strong>Email:</strong> ${userEmail}</p>
                <p><strong>Date:</strong> ${submissionDate}</p>
                <hr style="margin: 15px 0;">
                ${dataMap}`
                
            ;
        }

        function closeSubmissionPopup() {
            document.getElementById('submission-popup').style.display = 'none';
        }

        // Close popup when clicking outside
        document.getElementById('submission-popup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSubmissionPopup();
            }
        });

        // Language switching function
        function switchLanguage(language) {
            window.location.href = '/language/' + language;
        }
    </script>

</body>
</html>
