
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            table-layout: fixed;
        }

        .main-content .forms-overview th {
            padding: 0.6rem 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--main-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }
        
        .main-content .forms-overview td {
            padding: 0.6rem 1rem;
            text-align: left;
            border-bottom: 1px solid #f7fafc;
            font-weight: 500;
        }

        /* Analytics table: exactly 3 columns */
        .main-content .forms-overview th:first-child,
        .main-content .forms-overview td:first-child {
            width: 56%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .main-content .forms-overview th:nth-child(2),
        .main-content .forms-overview td:nth-child(2) {
            width: 22%;
            text-align: center;
        }

        .main-content .forms-overview th:nth-child(3),
        .main-content .forms-overview td:nth-child(3) {
            width: 22%;
            text-align: center;
        }

        .main-content .forms-overview tbody tr {
            transition: all 0.3s ease;
        }

        .main-content .forms-overview tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }

        #analytics-table .analytics-form-row {
            display: table-row;
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
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        /* Enhanced Search and Filter Styles */
        .search-filter-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .form-filters {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            background: white;
            color: #4a5568;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .filter-btn i {
            font-size: 0.85rem;
        }

        .sort-options select {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            background: white;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sort-options select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        #results-counter {
            font-weight: 500;
            padding: 0.5rem 1rem;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 8px;
            display: inline-block;
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            border: 2px dashed #e2e8f0;
        }

        .no-results i {
            color: #cbd5e0;
            margin-bottom: 1rem;
        }

        .no-results h3 {
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .no-results p {
            color: #718096;
        }

        /* Table Search Bars */
        .forms-overview .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .forms-overview .header h2 {
            margin: 0;
            flex: 1;
        }

        .forms-overview .header .search-bar {
            position: relative;
            min-width: 250px;
        }

        .forms-overview .header .search-bar input {
            transition: all 0.3s ease;
        }

        .forms-overview .header .search-bar input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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
                gap: 0.5rem;
            }

            .filter-btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
            }

            .search-filter-container {
                padding: 1rem;
            }

            .sort-options {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }

            .sort-options select {
                width: 100%;
            }

            .forms-overview .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .forms-overview .header .search-bar {
                width: 100%;
                min-width: auto;
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
    <style>
        /* Settings Page Specific Styles */
        .settings-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .settings-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-gradient);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .section-title i {
            font-size: 1.1rem;
            color: var(--secondary-gradient);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-gradient), var(--secondary-gradient));
            color: white;
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
            padding: 0.875rem 2rem;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            border-color: #cbd5e0;
        }

        /* Error Messages */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .error-message::before {
            content: "⚠";
            font-size: 0.75rem;
        }

        /* Form Link Popup Styles */
        .form-link-popup-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0, 0, 0, 0.6) !important;
            backdrop-filter: blur(5px);
            z-index: 10000 !important;
            align-items: center !important;
            justify-content: center !important;
            animation: fadeIn 0.3s ease;
            display:none;
        }

        .form-link-popup-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        .popup-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 2rem 1rem 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .popup-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a202c;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .popup-header i {
            color: var(--secondary-gradient);
            font-size: 1.25rem;
        }

        .close-popup-btn {
            background: #f7fafc;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: #64748b;
        }

        .close-popup-btn:hover {
            background: #e2e8f0;
            color: #1a202c;
            transform: scale(1.1);
        }

        .popup-body {
            padding: 2rem;
        }

        .popup-body p {
            margin: 0 0 1.5rem 0;
            color: #4a5568;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .link-container {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            background: #f8fafc;
            padding: 1rem;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
        }

        .link-input {
            flex: 1;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            background: white;
            color: #2d3748;
        }

        .link-input:focus {
            outline: none;
            border-color: var(--secondary-gradient);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .copy-link-btn {
            background: linear-gradient(135deg, var(--primary-gradient), var(--secondary-gradient));
            color: white;
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .copy-link-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .copy-link-btn.copied {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .copy-status {
            text-align: center;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            min-height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .copy-status.success {
            color: #10b981;
            font-weight: 500;
        }

        .link-info {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 12px;
            padding: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            color: #0369a1;
            font-size: 0.95rem;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-item i {
            width: 20px;
            text-align: center;
            color: #0284c7;
        }

        .popup-footer {
            padding: 1rem 2rem 2rem 2rem;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 0 0 20px 20px;
        }

        .popup-footer small {
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            line-height: 1.5;
        }

        .popup-footer i {
            color: #fbbf24;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .form-link-popup-content {
                width: 95%;
                margin: 1rem;
            }

            .popup-header, .popup-body, .popup-footer {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .link-container {
                flex-direction: column;
            }

            .copy-link-btn {
                justify-content: center;
            }
        }
    </style>
    <style>
        /* Form Section Container */
.info-section {
    background: #f8fafc;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #e2e8f0;
}

/* Form Row Layout (settings/profile only) */
#settings-content .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Form Group (label + input) */
.form-group {
    display: flex;
    flex-direction: column;
}

/* Form Labels */
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

/* Form Inputs */
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

/* Error Message */
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

/* Help Text */
.form-help {
    color: #718096;
    font-size: 0.8rem;
}

/* Actions Section */
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

/* Responsive Design for Forms */
@media (max-width: 768px) {
    #settings-content .form-row {
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
                    
                </header>

                <section class="stats">
                    <div class="card">
                        <i class="fas fa-file-alt"></i>
                        <h2>{{ __('messages.total_forms') }}</h2>
                        <p>{{  App\Models\form::where('company_id', $company->id)->count() }}</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-check-circle"></i>
                        <h2>{{ __('messages.active_forms') }}</h2>
                        <p>{{  App\Models\form::where('company_id', $company->id)->where('is_active', true)->count() }}</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-poll"></i>
                        <h2>{{ __('messages.total_submissions') }}</h2>
                        <p>
                        {{ App\Models\Submission::whereHas('form', function($query) use ($company) {
                        $query->where('company_id', $company->id);
                        })->count() }}
                        </p>
                    </div>
                    <div class="card">
                        <i class="fas fa-user-plus"></i>
                        <h2>{{ __('messages.total_users') }}</h2>
                        <p>{{  App\Models\user::where('company_id', $company->id)->count() }}</p>
                    </div>
                </section>
                
                <section class="forms-overview">
                    <div class="header">
                        <h2>{{ __('messages.company_users') }}</h2>
                        <!-- Users Search Bar -->
                        <div class="search-bar" style="max-width: 300px;">
                            <i class="fas fa-search"></i>
                            <input type="text" id="users-search" placeholder="{{ __('messages.search_users') }}"
                                   style="width: 100%; padding: 10px 40px; border: 2px solid #e2e8f0; border-radius: 20px; font-size: 14px;">
                        </div>
                    </div>

                    <!-- Users Results Counter -->
                    <div id="users-results-counter" style="margin-bottom: 1rem; color: #718096; font-size: 14px;">
                        @php
                            $userCount = isset($userc) ? count($userc) : 0;
                        @endphp
                        {{ __('messages.showing') }} {{ $userCount }} {{ __('messages.of') }} {{ $userCount }} {{ __('messages.users') }}
                    </div>

                    <table id="users-table">
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
                            <tr class="user-row" data-name="{{ strtolower($user->first_name) }}" data-matricule="{{ strtolower($user->matricule) }}">
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

                <!-- Enhanced Search and Filter Section -->
                <div class="forms-actions" style="margin-bottom: 2rem;">
                    <!-- Search Bar -->
                    <div class="search-filter-container" style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="search-bar" style="flex: 1; max-width: 400px;">
                                <i class="fas fa-search"></i>
                                <input type="text" id="form-search" placeholder="{{ __('messages.search_forms') }}"
                                       style="width: 100%; padding: 12px 45px; border: 2px solid #e2e8f0; border-radius: 25px; font-size: 14px;">
                            </div>
                            <a href="{{ route('form', ['company' => $company->id]) }}" class="btn-create-new">
                                <i class="fas fa-plus"></i> {{ __('messages.create_new_form') }}
                            </a>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="form-filters" style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <button class="filter-btn active" data-filter="all">
                                <i class="fas fa-list"></i> {{ __('messages.all_forms') }}
                            </button>
                            <button class="filter-btn" data-filter="published">
                                <i class="fas fa-check-circle"></i> {{ __('messages.published') }}
                            </button>
                            <button class="filter-btn" data-filter="draft">
                                <i class="fas fa-edit"></i> {{ __('messages.drafts') }}
                            </button>
                            <button class="filter-btn" data-filter="recent">
                                <i class="fas fa-clock"></i> {{ __('messages.recent') }}
                            </button>
                        </div>

                        <!-- Sort Options -->
                        <div class="sort-options" style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-weight: 500; color: #4a5568;">{{ __('messages.sort_by') }}:</span>
                            <select id="sort-select" style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; background: white;">
                                <option value="created_at_desc">{{ __('messages.newest_first') }}</option>
                                <option value="created_at_asc">{{ __('messages.oldest_first') }}</option>
                                <option value="title_asc">{{ __('messages.title_a_z') }}</option>
                                <option value="title_desc">{{ __('messages.title_z_a') }}</option>
                                <option value="responses_desc">{{ __('messages.most_responses') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Results Counter -->
                    <div id="results-counter" style="margin-bottom: 1rem; color: #718096; font-size: 14px;">
                        @php
                            $formCount = isset($forms) ? count($forms) : 0;
                        @endphp
                        {{ __('messages.showing') }} {{ $formCount }} {{ __('messages.of') }} {{ $formCount }} {{ __('messages.forms') }}
                    </div>

                  
                </div>

                <div class="forms-grid" id="forms-grid">
                @foreach ($forms as $form)

                <div class="form-card"
                     data-status="{{ $form->is_active ? 'published' : 'draft' }}"
                     data-created="{{ $form->created_at->toISOString() }}"
                     data-responses="{{ $form->submissions->count() ?? 0 }}">
                    <form action="{{ route('form.delete',['form_id'=>$form->id])}}" method="POST" >
                        @csrf
                        <button class="close-btn">X</button>

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

    <h3 class="form-title">{{ $form->title }}</h3>
    <p class="form-description">{{ $form->description }}</p>

    <div class="form-card-meta">
        <span>{{app\models\Submission::where('form_id', $form->id)->count()}}</span>
        <span>{{ $form->created_at }}</span>
    </div>

    <div class="form-card-actions">
    <button class="form-card-btn" onclick="showFormLinkPopup('{{ $form->id }}', '{{ $form->title }}')">
        <i class="fas fa-link"></i> Get Link
    </button>

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

            <!-- Form Link Popup Modal -->
         <div id="formLinkPopup" class="form-link-popup-overlay">
    <div class="form-link-popup-content">
        <div class="popup-header">
            <h3><i class="fas fa-share-alt"></i> <span id="popupFormTitle">Form Submission Link</span></h3>
            <button onclick="closeFormLinkPopup()" class="close-popup-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="popup-body">
            <p><i class="fas fa-info-circle"></i> Share this link with outsiders to submit this company:</p>
            <div class="link-container">
                <input type="text" id="formSubmissionLink" readonly class="link-input">
                <button onclick="copyFormLink()" class="copy-link-btn" id="copyBtn">
                    <i class="fas fa-copy"></i> Copy Link
                </button>
            </div>
            <div class="copy-status" id="copyStatus"></div>
        </div>
        <div class="popup-footer">
            <small><i class="fas fa-lightbulb"></i> Tip: You can share this link via email, social media, or embed it on your website.</small>
        </div>
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
        <table id="analytics-table">
            <colgroup>
                <col style="width:56%;">
                <col style="width:22%;">
                <col style="width:22%;">
            </colgroup>
            <thead>
                <tr>
                    <th>Form Title</th>
                    
                    <th>Response Rate</th>
                    <th>Submissions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                <tr class="form-row analytics-form-row" data-form-id="{{ $form->id }}" data-title="{{ strtolower($form->title) }}">
                    <td>{{ $form->title }}</td>
                    
                    <td>@php
                            $submissionCount = \App\Models\Submission::where('form_id', $form->id)->count();
                            $totalUsers = \App\Models\User::where('company_id', $form->company_id)->count();
                            $responseRate = $totalUsers > 0 ? round(($submissionCount / $totalUsers) * 100, 1) : 0;
                        @endphp
                        {{ $responseRate }}%</td>
                    <td style="color:var(--secondary-gradient); cursor: pointer;">
                        <i class="fas fa-chevron-right expand-icon" id="icon-{{ $form->id }}"></i>{{ $submissionCount }} Submissions</td>
                </tr>
                <!-- Submitters row (initially hidden) -->
                <tr class="submitters-row" id="submitters-{{ $form->id }}" style="display: none;">
                    <td colspan="3">
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

                                        <div class="submitter-item"
                                            data-submission='@json($submission->data, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT)'
                                            data-schema='@json($form->schema, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT)'
                                            data-name="{{ $submission->user->first_name ?? 'Anonymous' }}"
                                            data-email="{{ $submission->user->email ?? 'No email' }}"
                                            data-date="{{ $submission->created_at->format('M d, Y H:i') }}"
                                            data-pre="{{ base64_encode($preRenderedHtml) }}"
                                            onclick="showSubmissionDetailsFromElement(this)">
                                            <div class="submitter-info">
                                                <span class="submitter-name">{{ $submission->user->first_name ?? 'Anonymous' }}</span>
                                                <span class="submitter-email">{{ $submission->user->email ?? 'No email' }}</span>
                                            </div>
                                            <div class="submission-meta">
                                                <span class="submission-date">{{ $submission->created_at->format('M d, Y H:i') }}</span>
                                            </div>
                                         
                                        </div>
                                       
                                        
                                    @endforeach

                                    <a href="{{ route('statistics', ['form_id' => $form->id]) }}" class="act-btn" style="background: #ffffffff; margin-left: 10px;" target="_blank" rel="noopener noreferrer">
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
            <div id="submission-popup" style="display: none; position: fixed; inset: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
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

   

</div>





            <div id="settings-content" style="display: none;">
                <header class="dashboard-header">
                    <div class="header-content">
                        <h1><i class="fas fa-cog"></i> {{ __('messages.settings') }}</h1>
                        <p>{{ __('messages.manage_profile_settings') }}</p>
                    </div>
                </header>

              
                <section class="forms-overview">
                    <div class="header">
                        <h2>{{ __('messages.profile_settings') }}</h2>
                        <p style="color: var(--text-light); margin: 0; font-size: 0.9rem;">{{ __('messages.update_profile_info') }}</p>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="alert alert-success" style="margin-bottom: 1.5rem; padding: 1rem; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 8px; color: #155724;">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->has('error'))
                        <div class="alert alert-error" style="margin-bottom: 1.5rem; padding: 1rem; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px; color: #721c24;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.updateDASH') }}" method="POST" enctype="multipart/form-data" id="profileForm" style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information Section -->
                        <div class="settings-section">
                            <h3 class="section-title">
                                <i class="fas fa-user"></i>
                                {{ __('messages.personal_information', [], app()->getLocale()) }}
                            </h3>

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
                        <div class="action-buttons">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i>
                                {{ __('messages.save_changes', [], app()->getLocale()) }}
                            </button>

                            <button type="button" class="btn-secondary" onclick="resetForm()">
                                <i class="fas fa-undo"></i>
                                {{ __('messages.reset', [], app()->getLocale()) }}
                            </button>
                        </div>
                    </form>
                </section>
            </div>
            
        </div>
        </main>
    </div>

    <script>
       

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
            const existingRows = document.querySelectorAll('.analytics-form-row');
            existingRows.forEach(row => {
                row.removeEventListener('click', handleRowClick);
            });

            // Add event listeners to form rows
            const formRows = document.querySelectorAll('.analytics-form-row');
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
        function showSubmissionDetailsFromElement(el) {
            try {
                const submission = el.dataset.submission ? JSON.parse(el.dataset.submission) : null;
                const form = el.dataset.schema ? JSON.parse(el.dataset.schema) : null;
                const userName = el.dataset.name || '';
                const userEmail = el.dataset.email || '';
                const submissionDate = el.dataset.date || '';
                const dataMap = el.dataset.pre ? atob(el.dataset.pre) : '';
                showSubmissionDetails(submission, form, userName, userEmail, submissionDate, dataMap);
            } catch (e) {
                console.error('Failed to parse submission data', e);
            }
        }

        function showSubmissionDetails(submission, form, userName, userEmail, submissionDate, dataMap) {
            const popup = document.getElementById('submission-popup');
            if (!popup) return;
            if (popup.parentElement !== document.body) {
                document.body.appendChild(popup);
            }
            popup.style.display = 'block';
            document.getElementById('submission-content').innerHTML = `
                <p><strong>Submitter:</strong> ${userName}</p>
                <p><strong>Email:</strong> ${userEmail}</p>
                <p><strong>Date:</strong> ${submissionDate}</p>
                <hr style="margin: 15px 0;">
                ${dataMap}`
                
            ;
        }

        function closeSubmissionPopup() {
            const popup = document.getElementById('submission-popup');
            if (popup) popup.style.display = 'none';
        }

        // Close popup when clicking outside
        const submissionPopup = document.getElementById('submission-popup');
        if (submissionPopup) {
            if (submissionPopup.parentElement !== document.body) {
                document.body.appendChild(submissionPopup);
            }
            submissionPopup.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeSubmissionPopup();
                }
            });
        }

        // Language switching function
        function switchLanguage(language) {
            window.location.href = '/language/' + language;
        }
    </script>

    <!-- Enhanced Forms Search and Filter Script -->
    <script>
        // Forms Search and Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('form-search');
            const formsGrid = document.getElementById('forms-grid');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const sortSelect = document.getElementById('sort-select');
            const resultsCounter = document.getElementById('results-counter');

            let currentFilter = 'all';
            let currentSort = 'created_at_desc';
            let allForms = [];

            // Initialize forms data
            function initializeForms() {
                const formCards = document.querySelectorAll('.form-card');
                allForms = Array.from(formCards).map(card => {
                    return {
                        element: card,
                        title: card.querySelector('.form-title')?.textContent.toLowerCase() || '',
                        description: card.querySelector('.form-description')?.textContent.toLowerCase() || '',
                        status: card.dataset.status || 'draft',
                        createdAt: card.dataset.created || new Date().toISOString(),
                        responses: parseInt(card.dataset.responses || '0')
                    };
                });
            }

            // Search functionality
            function performSearch() {
                const query = searchInput.value.toLowerCase().trim();
                let filteredForms = allForms;

                // Apply search filter
                if (query) {
                    filteredForms = allForms.filter(form =>
                        form.title.includes(query) ||
                        form.description.includes(query)
                    );
                }

                // Apply status filter
                if (currentFilter !== 'all') {
                    filteredForms = filteredForms.filter(form => {
                        switch(currentFilter) {
                            case 'published':
                                return form.status === 'published';
                            case 'draft':
                                return form.status === 'draft';
                            case 'recent':
                                const weekAgo = new Date();
                                weekAgo.setDate(weekAgo.getDate() - 7);
                                return new Date(form.createdAt) > weekAgo;
                            default:
                                return true;
                        }
                    });
                }

                // Apply sorting
                filteredForms.sort((a, b) => {
                    switch(currentSort) {
                        case 'created_at_desc':
                            return new Date(b.createdAt) - new Date(a.createdAt);
                        case 'created_at_asc':
                            return new Date(a.createdAt) - new Date(b.createdAt);
                        case 'title_asc':
                            return a.title.localeCompare(b.title);
                        case 'title_desc':
                            return b.title.localeCompare(a.title);
                        case 'responses_desc':
                            return b.responses - a.responses;
                        default:
                            return 0;
                    }
                });

                // Update display
                updateFormsDisplay(filteredForms);
                updateResultsCounter(filteredForms.length, allForms.length);
            }

            // Update forms display
            function updateFormsDisplay(filteredForms) {
                // Hide all forms first
                allForms.forEach(form => {
                    form.element.style.display = 'none';
                });

                // Show filtered forms
                filteredForms.forEach(form => {
                    form.element.style.display = 'block';
                });

                // Show no results message if needed
                if (filteredForms.length === 0) {
                    showNoResultsMessage();
                } else {
                    hideNoResultsMessage();
                }
            }

            // Update results counter
            function updateResultsCounter(showing, total) {
                resultsCounter.textContent = `{{ __('messages.showing') }} ${showing} {{ __('messages.of') }} ${total} {{ __('messages.forms') }}`;
            }

            // Show no results message
            function showNoResultsMessage() {
                let noResultsDiv = document.getElementById('no-results-message');
                if (!noResultsDiv) {
                    noResultsDiv = document.createElement('div');
                    noResultsDiv.id = 'no-results-message';
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.innerHTML = `
                        <div style="text-align: center; padding: 3rem; color: #718096;">
                            <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <h3 style="margin-bottom: 0.5rem;">{{ __('messages.no_forms_found') }}</h3>
                            <p>{{ __('messages.try_different_search') }}</p>
                        </div>
                    `;
                    formsGrid.appendChild(noResultsDiv);
                }
                noResultsDiv.style.display = 'block';
            }

            // Hide no results message
            function hideNoResultsMessage() {
                const noResultsDiv = document.getElementById('no-results-message');
                if (noResultsDiv) {
                    noResultsDiv.style.display = 'none';
                }
            }

            // Event listeners
            searchInput.addEventListener('input', performSearch);

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active filter button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Update current filter
                    currentFilter = this.dataset.filter;
                    performSearch();
                });
            });

            sortSelect.addEventListener('change', function() {
                currentSort = this.value;
                performSearch();
            });

            // Initialize
            initializeForms();
            performSearch();
        });

        // Users Search Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const usersSearchInput = document.getElementById('users-search');
            const usersTable = document.getElementById('users-table');
            const usersResultsCounter = document.getElementById('users-results-counter');

            if (usersSearchInput && usersTable) {
                const userRows = document.querySelectorAll('.user-row');
                const totalUsers = userRows.length;

                function performUsersSearch() {
                    const query = usersSearchInput.value.toLowerCase().trim();
                    let visibleCount = 0;

                    userRows.forEach(row => {
                        const name = row.dataset.name || '';
                        const matricule = row.dataset.matricule || '';

                        if (query === '' || name.includes(query) || matricule.includes(query)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Update counter
                    if (usersResultsCounter) {
                        usersResultsCounter.textContent = `{{ __('messages.showing') }} ${visibleCount} {{ __('messages.of') }} ${totalUsers} {{ __('messages.users') }}`;
                    }

                    // Show no results message
                    showUsersNoResults(visibleCount === 0 && query !== '');
                }

                function showUsersNoResults(show) {
                    let noResultsRow = document.getElementById('users-no-results');
                    if (show && !noResultsRow) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.id = 'users-no-results';
                        noResultsRow.innerHTML = `
                            <td colspan="5" style="text-align: center; padding: 2rem; color: #718096;">
                                <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <div>{{ __('messages.no_users_found') }}</div>
                                <small>{{ __('messages.try_different_search') }}</small>
                            </td>
                        `;
                        usersTable.querySelector('tbody').appendChild(noResultsRow);
                    } else if (!show && noResultsRow) {
                        noResultsRow.remove();
                    }
                }

                usersSearchInput.addEventListener('input', performUsersSearch);
            }
        });

        // Analytics Search Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const analyticsSearchInput = document.getElementById('analytics-search');
            const analyticsTable = document.getElementById('analytics-table');
            const analyticsResultsCounter = document.getElementById('analytics-results-counter');

            if (analyticsSearchInput && analyticsTable) {
                const formRows = document.querySelectorAll('.analytics-form-row');
                const totalForms = formRows.length;

                function performAnalyticsSearch() {
                    const query = analyticsSearchInput.value.toLowerCase().trim();
                    let visibleCount = 0;

                    formRows.forEach(row => {
                        const title = row.dataset.title || '';

                        if (query === '' || title.includes(query)) {
                            row.style.display = '';
                            // Also show/hide the submitters row if it exists
                            const submittersRow = document.getElementById('submitters-' + row.dataset.formId);
                            if (submittersRow && submittersRow.style.display === 'table-row') {
                                submittersRow.style.display = 'table-row';
                            }
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                            // Hide submitters row too
                            const submittersRow = document.getElementById('submitters-' + row.dataset.formId);
                            if (submittersRow) {
                                submittersRow.style.display = 'none';
                            }
                        }
                    });

                    // Update counter
                    if (analyticsResultsCounter) {
                        analyticsResultsCounter.textContent = `{{ __('messages.showing') }} ${visibleCount} {{ __('messages.of') }} ${totalForms} {{ __('messages.forms') }}`;
                    }

                    // Show no results message
                    showAnalyticsNoResults(visibleCount === 0 && query !== '');
                }

                function showAnalyticsNoResults(show) {
                    let noResultsRow = document.getElementById('analytics-no-results');
                    if (show && !noResultsRow) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.id = 'analytics-no-results';
                        noResultsRow.innerHTML = `
                            <td colspan="3" style="text-align: center; padding: 2rem; color: #718096;">
                                <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <div>{{ __('messages.no_forms_found') }}</div>
                                <small>{{ __('messages.try_different_search') }}</small>
                            </td>
                        `;
                        analyticsTable.querySelector('tbody').appendChild(noResultsRow);
                    } else if (!show && noResultsRow) {
                        noResultsRow.remove();
                    }
                }

                analyticsSearchInput.addEventListener('input', performAnalyticsSearch);
            }
        });
document.addEventListener('DOMContentLoaded', () => {

    const popup = document.getElementById('formLinkPopup');
    const titleElement = document.getElementById('popupFormTitle');
    const linkInput = document.getElementById('formSubmissionLink');
    const copyStatus = document.getElementById('copyStatus');
    const copyBtn = document.getElementById('copyBtn');

    // Open popup with dynamic title/link
    window.showFormLinkPopup = function(formId, formTitle) {
        if (!popup) return;

        titleElement.textContent = `${formTitle} - Submission Link`;
        linkInput.value = `${window.location.origin}/formulaire?form=${formId}`;

        // Reset copy button/status
        copyBtn.innerHTML = '<i class="fas fa-copy"></i> Copy Link';
        copyStatus.textContent = '';
        copyStatus.className = 'copy-status';

        popup.style.display = 'flex';
        linkInput.select();
    };

    // Close popup
    window.closeFormLinkPopup = function() {
        if (popup) popup.style.display = 'none';
    };

    // Copy link
    window.copyFormLink = function() {
        if (!linkInput) return;

        navigator.clipboard.writeText(linkInput.value).then(() => {
            copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            copyBtn.classList.add('copied');
            copyStatus.innerHTML = '<i class="fas fa-check-circle"></i> Link copied to clipboard!';

            setTimeout(() => {
                copyBtn.innerHTML = '<i class="fas fa-copy"></i> Copy Link';
                copyBtn.classList.remove('copied');
                copyStatus.textContent = '';
            }, 3000);
        }).catch(() => {
            linkInput.select();
            document.execCommand('copy');
        });
    };

    // Close on click outside
    popup.addEventListener('click', (e) => {
        if (!e.target.closest('.form-link-popup-content')) {
            closeFormLinkPopup();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeFormLinkPopup();
    });

});

        // Close popup with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const popup = document.getElementById('formLinkPopup');
                if (popup && popup.style.display === 'flex') {
                    closeFormLinkPopup();
                }
            }
        });
    </script>


</body>
</html>
