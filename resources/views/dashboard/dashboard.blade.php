
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
            transform: translateY(300px);
            
        }

        .logout-btn:hover {
            transform: translateY(297px);
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
                <a href="#" class="active" data-page="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="#" data-page="forms"><i class="fas fa-file-alt"></i> Forms</a>
                <a href="#" data-page="analytics"><i class="fas fa-chart-pie"></i> Analytics</a>
                <a href="#" data-page="settings"><i class="fas fa-cog"></i> Settings</a>
            </nav>
            

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
                        <h2>Welcome Back, Admin!</h2>
                        <p>Here's what's happening with your forms today.</p>
                    </div>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search for forms...">
                    </div>
                </header>

                <section class="stats">
                    <div class="card">
                        <i class="fas fa-file-alt"></i>
                        <h2>Total Forms</h2>
                        <p>24</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-check-circle"></i>
                        <h2>Active Forms</h2>
                        <p>18</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-poll"></i>
                        <h2>Total Submissions</h2>
                        <p>1,234</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-user-plus"></i>
                        <h2>Pending Invites</h2>
                        <p>5</p>
                    </div>
                </section>
                
                <section class="forms-overview">
                    <div class="header">
                        <h2>Company's users</h2>
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
                        <h2>All Forms</h2>
                        <p>Manage and organize your forms collection</p>
                    </div>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search forms..." id="form-search">
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
                <h2>Analytics</h2>
                <p>This is where the analytics content will go.</p>
            </div>

            <div id="settings-content" style="display: none;">
                <h2>Settings</h2>
                <p>This is where the settings content will go.</p>
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
        });
    </script>

</body>
</html>
