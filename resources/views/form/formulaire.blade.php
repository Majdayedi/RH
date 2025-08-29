<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form Generator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --gradient-color-1: {{ $gradientColor2 }};
            --gradient-color-2: {{ $gradientColor1 }};
            --primary-color: var(--gradient-color-1);
            --primary-light: var(--gradient-color-1);
            --primary-dark: var(--gradient-color-2);
            --secondary-color:var(--gradient-color-2);
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --success-color: #28a745;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: # ;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --text-dark: var(--gray-800);
            --text-medium: var(--gray-600);
            --text-light: var(--gray-500);
            --bg-light: var(--gray-50);
            --bg-white: var(--white);
            --bg-gray: var(--gray-100);
            --border-color: var(--gray-300);
            --border-light: var(--gray-200);
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.12);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --box-shadow: var(--shadow-xl);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, system-ui, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            padding: 2rem 1rem;
            color: var(--text-dark);
            line-height: 1.6;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            animation: fadeInUp 0.6s ease;
            transition: var(--transition);
            border: 1px solid var(--border-light);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            background: linear-gradient(135deg, var(--gradient-color-1) 0%, var(--gradient-color-2) 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-header h1 i {
            font-size: 1.5em;
            color: rgba(255, 255, 255, 0.9);
        }

        .form-header p {
            opacity: 0.9;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-content {
            padding: 2.5rem;
            background: var(--bg-white);
        }

        /* Form Field Styling */
        .form-field {
            margin-bottom: 2.25rem;
            animation: slideIn 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-field:nth-child(odd) {
            animation-delay: 0.1s;
            transform: translateX(-10px);
        }

        .form-field:nth-child(even) {
            animation-delay: 0.2s;
            transform: translateX(10px);
        }

        .field-label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.95rem;
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .field-label i {
            color: var(--primary-color);
            font-size: 0.9em;
        }

        .required-asterisk {
            color: var(--danger-color);
            margin-left: 0.25rem;
            font-weight: bold;
        }

        .field-description {
            font-size: 0.85rem;
            color: var(--text-medium);
            margin-top: 0.25rem;
            font-weight: 400;
        }

        /* Input Styles */
        .input-wrapper {
            position: relative;
            margin-top: 0.5rem;
        }

        input, textarea, select {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-family: inherit;
            background: var(--bg-white);
            transition: var(--transition);
            outline: none;
            color: var(--text-dark);
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.15);
            background: var(--bg-white);
        }

        input:hover, textarea:hover, select:hover {
            border-color: var(--primary-light);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        /* Toggle Switch */
        .toggle-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 0;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 32px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--bg-gray);
            transition: var(--transition);
            border-radius: 34px;
            border: 1px solid var(--border-color);
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 4px;
            bottom: 3px;
            background: white;
            transition: var(--transition);
            border-radius: 50%;
            box-shadow: 0 2px 8px var(--shadow-light);
        }

        input:checked + .toggle-slider {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(28px);
        }

        .toggle-label {
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
        }

        /* Option Groups */
        .option-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .option-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .option-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            background: var(--bg-light);
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            flex: 1 1 0;
            min-width: 120px;
        }

        .option-item:hover {
            background: var(--bg-gray);
            border-color: var(--primary-light);
        }

        .option-item input {
            width: auto;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }

        .option-item input:checked + label,
        .option-item:has(input:checked) {
            background: rgba(102, 126, 234, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-dark);
            font-weight: 500;
        }

        .option-item label {
            margin: 0;
            cursor: pointer;
            color: var(--text-dark);
            width: 100%;
        }

        /* Range Slider */
        .range-container {
            padding: 1rem 0;
        }

        .range-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .range-value {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
            background: rgba(102, 126, 234, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            min-width: 60px;
            text-align: center;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }

        input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 8px;
            background: var(--bg-gray);
            outline: none;
            margin: 1rem 0;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--primary-color);
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
            transition: var(--transition);
        }

        input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 3px 15px rgba(102, 126, 234, 0.4);
        }

        /* Rating Stars */
        .rating-container {
            display: flex;
            gap: 0.5rem;
            padding: 1rem 0;
            align-items: center;
        }

        .rating-stars {
            display: flex;
            gap: 0.25rem;
        }

        .rating-star {
            font-size: 1.8rem;
            color: var(--bg-gray);
            cursor: pointer;
            transition: var(--transition);
            line-height: 1;
        }

        .rating-star:hover {
            transform: scale(1.1);
        }

        .rating-star.active {
            color: var(--warning-color);
        }

        .rating-value {
            margin-left: 0.75rem;
            font-weight: 600;
            color: var(--text-medium);
            font-size: 0.9rem;
        }

        /* Section Styling */
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 2.5rem 0 1rem;
            color: var(--text-dark);
            position: relative;
            padding-left: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 1.5rem;
            background: var(--primary-color);
            border-radius: 3px;
        }

        .section-title i {
            color: var(--primary-color);
            font-size: 1.2em;
        }

        .section-description {
            color: var(--text-medium);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            line-height: 1.6;
            padding-left: 1.25rem;
        }

        .divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-color), transparent);
            margin: 2.5rem 0;
        }

        /* File Input */
        .file-input-wrapper {
            position: relative;
            margin-top: 0.5rem;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 2.5rem;
            border: 2px dashed var(--border-color);
            border-radius: var(--border-radius);
            background: var(--bg-light);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .file-input-label:hover {
            border-color: var(--primary-color);
            background: rgba(102, 126, 234, 0.05);
        }

        .file-input-label i {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .file-input-text {
            font-size: 0.95rem;
            color: var(--text-medium);
        }

        .file-input-hint {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 0.5rem;
        }

        /* Submit Button */
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-primary {
            background: var(--gradient-color-2);
            color: white;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 4px 15px rgba(111, 66, 193, 0.3);
        }

        .btn-primary:hover {
            background: var(--gradient-color-1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(111, 66, 193, 0.4);
        }

        .btn-secondary {
            background: var(--bg-light);
            color: var(--text-dark);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--bg-gray);
            border-color: var(--primary-light);
        }

        /* Validation Messages */
        .validation-message {
            font-size: 0.85rem;
            margin-top: 0.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-message {
            background: rgba(214, 48, 49, 0.1);
            color: var(--danger-color);
            border-left: 3px solid var(--danger-color);
        }

        .success-message {
            background: rgba(0, 184, 148, 0.1);
            color: var(--success-color);
            border-left: 3px solid var(--success-color);
        }

        /* Loading State */
        .loading {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .spinner {
            width: 18px;
            height: 18px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .form-container {
                border-radius: 10px;
            }

            .form-header {
                padding: 1.75rem 1.5rem;
            }

            .form-content {
                padding: 1.75rem;
            }

            .form-header h1 {
                font-size: 1.6rem;
            }

            .option-item {
                flex: 1 1 100%;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        /* Enhanced Light Theme Elements */
        .form-container:hover {
            box-shadow: 0 8px 30px var(--shadow-medium);
        }

        .html-content {
            padding: 1rem;
            background: var(--bg-light);
            border-radius: var(--border-radius);
            border: 1px solid var(--border-light);
            color: var(--text-dark);
        }

        /* Select dropdown styling */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        /* Custom scrollbar for textareas */
        textarea::-webkit-scrollbar {
            width: 8px;
        }

        textarea::-webkit-scrollbar-track {
            background: var(--bg-light);
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb:hover {
            background: var(--text-light);
        }

        /* Multi-page form styles */
        .page-indicator {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--gradient-color-1) 0%, var(--gradient-color-2) 100%);
            color: white;
            border-radius: var(--border-radius);
            margin: -2rem -2rem 2rem -2rem;
        }

        .page-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .page-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-dot.active {
            background: white;
            transform: scale(1.2);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .page-counter {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .page-container {
            position: relative;
            min-height: 300px;
        }

        .form-page {
            transition: all 0.3s ease;
        }

        .form-page.hidden {
            display: none;
        }

        .form-page.active {
            display: block;
            animation: fadeInUp 0.4s ease;
        }

        .page-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-light);
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--bg-light);
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            color: var(--text-color);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: var(--gradient-color-1);
            border-color: var(--gradient-color-1);
            color: white;
            transform: translateY(-2px);
        }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, var(--gradient-color-1) 0%, var(--gradient-color-2) 100%);
            border: none;
            border-radius: var(--border-radius);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(111, 66, 193, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(111, 66, 193, 0.4);
        }

        /* Satisfaction Rating Styles */
        .satisfaction-container {
            margin: 15px 0;
        }

        .satisfaction-options {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            max-width: 400px;
            flex-wrap: wrap;
        }

        .satisfaction-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 8px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--bg-white);
            min-width: 70px;
            text-align: center;
            flex: 1;
        }

        .satisfaction-option:hover {
            border-color: var(--gradient-color-1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.15);
        }

        .satisfaction-option input:checked + .emoji {
            transform: scale(1.1);
        }

        .satisfaction-option:has(input:checked) {
            border-color: var(--gradient-color-1);
            background: rgba(111, 66, 193, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(111, 66, 193, 0.2);
        }

        .satisfaction-option .emoji {
            font-size: 32px;
            margin-bottom: 6px;
            transition: transform 0.3s;
        }

        .satisfaction-option .emoji-label {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-light);
            line-height: 1.2;
        }

        .satisfaction-option:has(input:checked) .emoji-label {
            color: var(--gradient-color-1);
            font-weight: 600;
        }

        /* Signature Styles */
        .signature-container {
            margin: 15px 0;
        }

        .signature-canvas {
            display: block;
            margin: 0 auto;
            background: var(--bg-white);
            border: 2px solid var(--border-color) !important;
            border-radius: 8px !important;
            cursor: crosshair !important;
            transition: border-color 0.3s;
        }

        .signature-canvas:hover {
            border-color: var(--gradient-color-1) !important;
        }
    </style>
</head>
<body>
    <div class="form-container" id="form-container">
        <div class="form-header">
            <h1><i class="fas fa-wand-magic-sparkles"></i> Dynamic Form Generator</h1>
            <p>Create beautiful, responsive forms with ease</p>
        </div>
        <div class="form-content">
            <!-- Form will be generated here -->
        </div>
    </div>

    <script>
        // Get form data directly from Laravel
        const rawFormData = @json($form->schema ?? []);
        console.log('Raw Form Data:', rawFormData); // Debugging

        // Handle both old format (array of questions) and new format (pages structure)
        let formData = [];
        let formPages = [];

        if (Array.isArray(rawFormData)) {
            // Old format - array of questions
            formData = rawFormData;
            formPages = [{
                id: 'page-1',
                title: 'Page 1',
                questions: rawFormData
            }];
        } else if (rawFormData && rawFormData.pages) {
            // New format - pages structure
            formPages = rawFormData.pages;
            // For backward compatibility, flatten all questions for now
            formData = formPages.reduce((allQuestions, page) => {
                return allQuestions.concat(page.questions || []);
            }, []);
        } else {
            console.error('Invalid form data format');
            formData = [];
            formPages = [];
        }

        console.log('Processed Form Data:', formData);
        console.log('Form Pages:', formPages);

        // Function to generate form fields
        function createFormField(field, index) {
            const container = document.createElement('div');
            container.className = 'form-field';
            container.style.animationDelay = `${index * 0.05}s`;
            
            // Create label if exists
            if (field.label) {
                const label = document.createElement('label');
                label.className = 'field-label';
                label.htmlFor = field.id;
                
                if (field.icon) {
                    const icon = document.createElement('i');
                    icon.className = `fas fa-${field.icon}`;
                    label.appendChild(icon);
                }
                
                const labelText = document.createElement('span');
                labelText.textContent = field.label;
                label.appendChild(labelText);
                
                if (field.required) {
                    const asterisk = document.createElement('span');
                    asterisk.className = 'required-asterisk';
                    asterisk.textContent = '*';
                    label.appendChild(asterisk);
                }
                
                container.appendChild(label);
            }
            
            // Add description if exists
            if (field.description) {
                const desc = document.createElement('p');
                desc.className = 'field-description';
                desc.textContent = field.description;
                container.appendChild(desc);
            }
            
            // Create input based on type
            switch (field.type) {
                // Basic Inputs
                case 'text':
                case 'email':
                case 'number':
                case 'password':
                case 'tel':
                case 'url':
                    const input = document.createElement('input');
                    input.type = field.type;
                    input.id = field.id;
                    input.name = field.id;
                    input.className = 'form-input';
                    input.required = field.required || false;
                    if (field.placeholder) input.placeholder = field.placeholder;
                    if (field.defaultValue) input.value = field.defaultValue;
                    if (field.minLength) input.minLength = field.minLength;
                    if (field.maxLength) input.maxLength = field.maxLength;
                    if (field.pattern) input.pattern = field.pattern;
                    
                    const inputWrapper = document.createElement('div');
                    inputWrapper.className = 'input-wrapper';
                    inputWrapper.appendChild(input);
                    container.appendChild(inputWrapper);
                    break;
                    
                case 'textarea':
                    const textarea = document.createElement('textarea');
                    textarea.id = field.id;
                    textarea.name = field.id;
                    textarea.className = 'form-textarea';
                    textarea.required = field.required || false;
                    if (field.placeholder) textarea.placeholder = field.placeholder;
                    if (field.rows) textarea.rows = field.rows;
                    if (field.defaultValue) textarea.textContent = field.defaultValue;
                    
                    const textareaWrapper = document.createElement('div');
                    textareaWrapper.className = 'input-wrapper';
                    textareaWrapper.appendChild(textarea);
                    container.appendChild(textareaWrapper);
                    break;
                    
                // Choice Elements
                case 'radio-group':
                    const radioContainer = document.createElement('div');
                    radioContainer.className = 'option-group';
                    
                    if (field.layout === 'horizontal') {
                        const row = document.createElement('div');
                        row.className = 'option-row';
                        field.options.forEach(option => {
                            const optionDiv = document.createElement('div');
                            optionDiv.className = 'option-item';
                            
                            const radio = document.createElement('input');
                            radio.type = 'radio';
                            const optionValue = option.value || option;
                            radio.id = `${field.id}-${optionValue.replace(/\s+/g, '-').toLowerCase()}`;
                            radio.name = field.id;
                            radio.value = optionValue;
                            radio.required = field.required || false;
                            if (option.selected || field.defaultValue === option.value) radio.checked = true;
                            
                            const label = document.createElement('label');
                            label.htmlFor = radio.id;
                            label.textContent = option.label || option;
                            
                            optionDiv.appendChild(radio);
                            optionDiv.appendChild(label);
                            row.appendChild(optionDiv);
                        });
                        radioContainer.appendChild(row);
                    } else {
                        field.options.forEach(option => {
                            const optionDiv = document.createElement('div');
                            optionDiv.className = 'option-item';
                            
                            const radio = document.createElement('input');
                            radio.type = 'radio';
                            const optionValue = option.value || option;
                            radio.id = `${field.id}-${optionValue.replace(/\s+/g, '-').toLowerCase()}`;
                            radio.name = field.id;
                            radio.value = optionValue;
                            radio.required = field.required || false;
                            if (option.selected || field.defaultValue === option.value) radio.checked = true;
                            
                            const label = document.createElement('label');
                            label.htmlFor = radio.id;
                            label.textContent = option.label || option;
                            
                            optionDiv.appendChild(radio);
                            optionDiv.appendChild(label);
                            radioContainer.appendChild(optionDiv);
                        });
                    }
                    container.appendChild(radioContainer);
                    break;
                    
                case 'checkbox-group':
                    const checkboxContainer = document.createElement('div');
                    checkboxContainer.className = 'option-group';
                    
                    if (field.layout === 'horizontal') {
                        const row = document.createElement('div');
                        row.className = 'option-row';
                        field.options.forEach(option => {
                            const optionDiv = document.createElement('div');
                            optionDiv.className = 'option-item';
                            
                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            const optionValue = option.value || option;
                            checkbox.id = `${field.id}-${optionValue.replace(/\s+/g, '-').toLowerCase()}`;
                            checkbox.name = `${field.id}[]`;
                            checkbox.value = optionValue;
                            if (option.selected || (field.defaultValue && field.defaultValue.includes(option.value))) checkbox.checked = true;
                            
                            const label = document.createElement('label');
                            label.htmlFor = checkbox.id;
                            label.textContent = option.label || option;
                            
                            optionDiv.appendChild(checkbox);
                            optionDiv.appendChild(label);
                            row.appendChild(optionDiv);
                        });
                        checkboxContainer.appendChild(row);
                    } else {
                        field.options.forEach(option => {
                            const optionDiv = document.createElement('div');
                            optionDiv.className = 'option-item';
                            
                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            const optionValue = option.value || option;
                            checkbox.id = `${field.id}-${optionValue.replace(/\s+/g, '-').toLowerCase()}`;
                            checkbox.name = `${field.id}[]`;
                            checkbox.value = optionValue;
                            if (option.selected || (field.defaultValue && field.defaultValue.includes(option.value))) checkbox.checked = true;
                            
                            const label = document.createElement('label');
                            label.htmlFor = checkbox.id;
                            label.textContent = option.label || option;
                            
                            optionDiv.appendChild(checkbox);
                            optionDiv.appendChild(label);
                            checkboxContainer.appendChild(optionDiv);
                        });
                    }
                    container.appendChild(checkboxContainer);
                    break;
                    
                case 'select':
                    const select = document.createElement('select');
                    select.id = field.id;
                    select.name = field.id;
                    select.className = 'form-select';
                    select.required = field.required || false;
                    
                    if (field.placeholder) {
                        const placeholderOption = document.createElement('option');
                        placeholderOption.value = '';
                        placeholderOption.textContent = field.placeholder;
                        placeholderOption.disabled = true;
                        placeholderOption.selected = true;
                        select.appendChild(placeholderOption);
                    }
                    
                    field.options.forEach(option => {
                        const optionElement = document.createElement('option');
                        optionElement.value = option.value || option;
                        optionElement.textContent = option.label || option;
                        if (option.selected || field.defaultValue === option.value) optionElement.selected = true;
                        select.appendChild(optionElement);
                    });
                    
                    const selectWrapper = document.createElement('div');
                    selectWrapper.className = 'input-wrapper';
                    selectWrapper.appendChild(select);
                    container.appendChild(selectWrapper);
                    break;
                    
                case 'toggle':
                    const toggleContainer = document.createElement('div');
                    toggleContainer.className = 'toggle-container';
                    
                    const toggleSwitch = document.createElement('label');
                    toggleSwitch.className = 'toggle-switch';
                    
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = field.id;
                    checkbox.name = field.id;
                    checkbox.checked = field.defaultValue || false;
                    
                    const slider = document.createElement('span');
                    slider.className = 'toggle-slider';
                    
                    toggleSwitch.appendChild(checkbox);
                    toggleSwitch.appendChild(slider);
                    toggleContainer.appendChild(toggleSwitch);
                    
                    if (field.label) {
                        const toggleLabel = document.createElement('span');
                        toggleLabel.className = 'toggle-label';
                        toggleLabel.textContent = field.label;
                        toggleContainer.appendChild(toggleLabel);
                    }
                    
                    container.appendChild(toggleContainer);
                    break;
                    
                // Date & Time
                case 'date':
                case 'time':
                case 'datetime-local':
                case 'month':
                case 'week':
                    const datetimeInput = document.createElement('input');
                    datetimeInput.type = field.type;
                    datetimeInput.id = field.id;
                    datetimeInput.name = field.id;
                    datetimeInput.className = 'form-input';
                    datetimeInput.required = field.required || false;
                    if (field.defaultValue) datetimeInput.value = field.defaultValue;
                    if (field.min) datetimeInput.min = field.min;
                    if (field.max) datetimeInput.max = field.max;
                    
                    const datetimeWrapper = document.createElement('div');
                    datetimeWrapper.className = 'input-wrapper';
                    datetimeWrapper.appendChild(datetimeInput);
                    container.appendChild(datetimeWrapper);
                    break;
                    
                // Special Inputs
                case 'file':
                    const fileWrapper = document.createElement('div');
                    fileWrapper.className = 'file-input-wrapper';
                    
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.id = field.id;
                    fileInput.name = field.id;
                    fileInput.className = 'file-input';
                    fileInput.required = field.required || false;
                    if (field.accept) fileInput.accept = field.accept;
                    if (field.multiple) fileInput.multiple = true;
                    
                    const fileLabel = document.createElement('label');
                    fileLabel.className = 'file-input-label';
                    fileLabel.htmlFor = field.id;
                    
                    const fileIcon = document.createElement('i');
                    fileIcon.className = 'fas fa-cloud-upload-alt';
                    fileLabel.appendChild(fileIcon);
                    
                    const fileText = document.createElement('span');
                    fileText.className = 'file-input-text';
                    fileText.textContent = field.placeholder || 'Click to upload files or drag and drop';
                    fileLabel.appendChild(fileText);
                    
                    if (field.hint) {
                        const fileHint = document.createElement('span');
                        fileHint.className = 'file-input-hint';
                        fileHint.textContent = field.hint;
                        fileLabel.appendChild(fileHint);
                    }
                    
                    fileWrapper.appendChild(fileInput);
                    fileWrapper.appendChild(fileLabel);
                    container.appendChild(fileWrapper);
                    break;
                    
                case 'range':
                    const rangeContainer = document.createElement('div');
                    rangeContainer.className = 'range-container';
                    
                    const rangeHeader = document.createElement('div');
                    rangeHeader.className = 'range-header';
                    
                    if (field.label) {
                        const rangeLabel = document.createElement('span');
                        rangeLabel.className = 'field-label';
                        rangeLabel.textContent = field.label;
                        rangeHeader.appendChild(rangeLabel);
                    }
                    
                    const rangeValue = document.createElement('span');
                    rangeValue.className = 'range-value';
                    rangeValue.textContent = field.defaultValue || 50;
                    rangeHeader.appendChild(rangeValue);
                    
                    rangeContainer.appendChild(rangeHeader);
                    
                    const rangeInput = document.createElement('input');
                    rangeInput.type = 'range';
                    rangeInput.id = field.id;
                    rangeInput.name = field.id;
                    rangeInput.min = field.min || 0;
                    rangeInput.max = field.max || 100;
                    rangeInput.step = field.step || 1;
                    rangeInput.value = field.defaultValue || 50;
                    
                    rangeInput.addEventListener('input', () => {
                        rangeValue.textContent = rangeInput.value;
                    });
                    
                    rangeContainer.appendChild(rangeInput);
                    container.appendChild(rangeContainer);
                    break;
                    
                case 'rating':
                    const ratingContainer = document.createElement('div');
                    ratingContainer.className = 'rating-container';
                    
                    const starsContainer = document.createElement('div');
                    starsContainer.className = 'rating-stars';
                    
                    const ratingInput = document.createElement('input');
                    ratingInput.type = 'hidden';
                    ratingInput.name = field.id;
                    ratingInput.value = field.defaultValue || 0;
                    
                    for (let i = 1; i <= (field.max || 5); i++) {
                        const star = document.createElement('span');
                        star.className = `rating-star ${i <= (field.defaultValue || 0) ? 'active' : ''}`;
                        star.dataset.value = i;
                        star.innerHTML = '★';
                        star.addEventListener('click', () => {
                            ratingInput.value = i;
                            document.querySelectorAll(`#${field.id} ~ .rating-stars .rating-star`).forEach((s, idx) => {
                                s.classList.toggle('active', idx < i);
                            });
                        });
                        starsContainer.appendChild(star);
                    }
                    
                    const ratingValue = document.createElement('span');
                    ratingValue.className = 'rating-value';
                    ratingValue.textContent = field.defaultValue ? `${field.defaultValue} of ${field.max || 5}` : 'Not rated';
                    
                    ratingContainer.appendChild(starsContainer);
                    ratingContainer.appendChild(ratingValue);
                    ratingContainer.appendChild(ratingInput);
                    container.appendChild(ratingContainer);
                    break;

                case 'satisfaction':
                    const satisfactionContainer = document.createElement('div');
                    satisfactionContainer.className = 'satisfaction-container';

                    const satisfactionOptions = document.createElement('div');
                    satisfactionOptions.className = 'satisfaction-options';

                    // Define satisfaction emojis based on scale type
                    const scaleType = field.scaleType || '5-point';
                    let emojis = [];

                    switch (scaleType) {
                        case '3-point':
                            emojis = [
                                { icon: '😞', label: 'Dissatisfied', value: 1 },
                                { icon: '😐', label: 'Neutral', value: 2 },
                                { icon: '😊', label: 'Satisfied', value: 3 }
                            ];
                            break;
                        case '7-point':
                            emojis = [
                                { icon: '😡', label: 'Extremely Dissatisfied', value: 1 },
                                { icon: '😠', label: 'Very Dissatisfied', value: 2 },
                                { icon: '😞', label: 'Dissatisfied', value: 3 },
                                { icon: '😐', label: 'Neutral', value: 4 },
                                { icon: '🙂', label: 'Satisfied', value: 5 },
                                { icon: '😊', label: 'Very Satisfied', value: 6 },
                                { icon: '😍', label: 'Extremely Satisfied', value: 7 }
                            ];
                            break;
                        default: // 5-point
                            emojis = [
                                { icon: '😡', label: 'Very Dissatisfied', value: 1 },
                                { icon: '😞', label: 'Dissatisfied', value: 2 },
                                { icon: '😐', label: 'Neutral', value: 3 },
                                { icon: '😊', label: 'Satisfied', value: 4 },
                                { icon: '😍', label: 'Very Satisfied', value: 5 }
                            ];
                    }

                    emojis.forEach(emoji => {
                        const optionLabel = document.createElement('label');
                        optionLabel.className = 'satisfaction-option';

                        const optionInput = document.createElement('input');
                        optionInput.type = 'radio';
                        optionInput.name = field.id;
                        optionInput.value = emoji.value;
                        optionInput.required = field.required || false;
                        optionInput.style.display = 'none';

                        const emojiSpan = document.createElement('div');
                        emojiSpan.className = 'emoji';
                        emojiSpan.textContent = emoji.icon;

                        const labelSpan = document.createElement('div');
                        labelSpan.className = 'emoji-label';
                        labelSpan.textContent = emoji.label;

                        optionLabel.appendChild(optionInput);
                        optionLabel.appendChild(emojiSpan);
                        optionLabel.appendChild(labelSpan);

                        satisfactionOptions.appendChild(optionLabel);
                    });

                    satisfactionContainer.appendChild(satisfactionOptions);
                    container.appendChild(satisfactionContainer);
                    break;

                case 'signature':
                    const signatureContainer = document.createElement('div');
                    signatureContainer.className = 'signature-container';

                    const signatureCanvas = document.createElement('canvas');
                    signatureCanvas.id = field.id;
                    signatureCanvas.width = 400;
                    signatureCanvas.height = 200;
                    signatureCanvas.className = 'signature-canvas';
                    signatureCanvas.style.border = '2px solid #d1d5db';
                    signatureCanvas.style.borderRadius = '8px';
                    signatureCanvas.style.cursor = 'crosshair';

                    const clearButton = document.createElement('button');
                    clearButton.type = 'button';
                    clearButton.className = 'btn btn-secondary';
                    clearButton.textContent = 'Clear Signature';
                    clearButton.style.marginTop = '10px';

                    // Basic signature functionality
                    let isDrawing = false;
                    const ctx = signatureCanvas.getContext('2d');

                    signatureCanvas.addEventListener('mousedown', (e) => {
                        isDrawing = true;
                        ctx.beginPath();
                        ctx.moveTo(e.offsetX, e.offsetY);
                    });

                    signatureCanvas.addEventListener('mousemove', (e) => {
                        if (isDrawing) {
                            ctx.lineTo(e.offsetX, e.offsetY);
                            ctx.stroke();
                        }
                    });

                    signatureCanvas.addEventListener('mouseup', () => {
                        isDrawing = false;
                    });

                    clearButton.addEventListener('click', () => {
                        ctx.clearRect(0, 0, signatureCanvas.width, signatureCanvas.height);
                    });

                    signatureContainer.appendChild(signatureCanvas);
                    signatureContainer.appendChild(clearButton);
                    container.appendChild(signatureContainer);
                    break;

                // Layout Elements
                case 'section-title':
                    const sectionTitle = document.createElement('h3');
                    sectionTitle.className = 'section-title';
                    
                    if (field.icon) {
                        const icon = document.createElement('i');
                        icon.className = `fas fa-${field.icon}`;
                        sectionTitle.appendChild(icon);
                    }
                    
                    const titleText = document.createElement('span');
                    titleText.textContent = field.label || 'Section Title';
                    sectionTitle.appendChild(titleText);
                    
                    container.appendChild(sectionTitle);
                    if (field.description) {
                        const desc = document.createElement('p');
                        desc.className = 'section-description';
                        desc.textContent = field.description;
                        container.appendChild(desc);
                    }
                    break;
                    
                case 'divider':
                    const divider = document.createElement('hr');
                    divider.className = 'divider';
                    container.appendChild(divider);
                    break;
                    
                case 'html':
                    const htmlContent = document.createElement('div');
                    htmlContent.className = 'html-content';
                    htmlContent.innerHTML = field.content || '';
                    container.appendChild(htmlContent);
                    break;
                    
                default:
                    const warning = document.createElement('div');
                    warning.className = 'validation-message error-message';
                    warning.innerHTML = `<i class="fas fa-exclamation-circle"></i> Unsupported field type: ${field.type}`;
                    container.appendChild(warning);
            }
            
            // Add validation message container
            const validationMsg = document.createElement('div');
            validationMsg.className = 'validation-message';
            validationMsg.id = `${field.id}-validation`;
            container.appendChild(validationMsg);
            
            return container;
        }

        // Function to generate the complete form
        function generateForm() {
            const formContent = document.querySelector('.form-content');
            formContent.innerHTML = '';

            const form = document.createElement('form');
            form.id = 'dynamic-form';
            form.method = 'POST';
            form.action = '/test';
            form.noValidate = true;

            // Add CSRF token for POST requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);

            // Add multi-page support if there are multiple pages
            if (formPages.length > 1) {
                generateMultiPageForm(form);
            } else {
                // Single page form - add all fields directly
                formData.forEach((field, index) => {
                    form.appendChild(createFormField(field, index));
                });

                // Add submit button for single page
                const submitBtn = document.createElement('button');
                submitBtn.type = 'submit';
                submitBtn.className = 'submit-btn';
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Form';
                form.appendChild(submitBtn);
            }

            formContent.appendChild(form);

            // Setup form submission handler
            setupFormSubmission(form);
        }

        // Function to generate multi-page form
        function generateMultiPageForm(form) {
            let currentPageIndex = 0;

            // Create page container
            const pageContainer = document.createElement('div');
            pageContainer.className = 'page-container';

            // Create page indicator
            const pageIndicator = document.createElement('div');
            pageIndicator.className = 'page-indicator';
            pageIndicator.innerHTML = `
                <div class="page-dots">
                    ${formPages.map((_, index) =>
                        `<div class="page-dot ${index === 0 ? 'active' : ''}" data-page="${index}"></div>`
                    ).join('')}
                </div>
                <div class="page-title">${formPages[0].title}</div>
                <div class="page-counter">Page 1 of ${formPages.length}</div>
            `;
            form.appendChild(pageIndicator);

            // Create pages
            formPages.forEach((page, pageIndex) => {
                const pageDiv = document.createElement('div');
                pageDiv.className = `form-page ${pageIndex === 0 ? 'active' : 'hidden'}`;
                pageDiv.dataset.page = pageIndex;

                // Add page questions
                page.questions.forEach((field, fieldIndex) => {
                    pageDiv.appendChild(createFormField(field, fieldIndex));
                });

                pageContainer.appendChild(pageDiv);
            });

            form.appendChild(pageContainer);

            // Create navigation buttons
            const navContainer = document.createElement('div');
            navContainer.className = 'page-navigation';
            navContainer.innerHTML = `
                <button type="button" class="nav-btn prev-btn" style="display: none;">
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <button type="button" class="nav-btn next-btn">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
                <button type="submit" class="submit-btn" style="display: none;">
                    <i class="fas fa-paper-plane"></i> Submit Form
                </button>
            `;
            form.appendChild(navContainer);

            // Add navigation functionality
            setupPageNavigation(form, currentPageIndex);
        }

        // Function to setup page navigation
        function setupPageNavigation(form, currentPageIndex) {
            const prevBtn = form.querySelector('.prev-btn');
            const nextBtn = form.querySelector('.next-btn');
            const submitBtn = form.querySelector('.submit-btn');
            const pages = form.querySelectorAll('.form-page');
            const dots = form.querySelectorAll('.page-dot');
            const pageTitle = form.querySelector('.page-title');
            const pageCounter = form.querySelector('.page-counter');

            function updatePage(newIndex) {
                // Hide all pages
                pages.forEach(page => {
                    page.classList.remove('active');
                    page.classList.add('hidden');
                });

                // Show current page
                pages[newIndex].classList.remove('hidden');
                pages[newIndex].classList.add('active');

                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === newIndex);
                });

                // Update page info
                pageTitle.textContent = formPages[newIndex].title;
                pageCounter.textContent = `Page ${newIndex + 1} of ${formPages.length}`;

                // Update button visibility
                prevBtn.style.display = newIndex === 0 ? 'none' : 'inline-flex';
                nextBtn.style.display = newIndex === formPages.length - 1 ? 'none' : 'inline-flex';
                submitBtn.style.display = newIndex === formPages.length - 1 ? 'inline-flex' : 'none';

                currentPageIndex = newIndex;
            }

            // Previous button
            prevBtn.addEventListener('click', () => {
                if (currentPageIndex > 0) {
                    updatePage(currentPageIndex - 1);
                }
            });

            // Next button
            nextBtn.addEventListener('click', () => {
                if (currentPageIndex < formPages.length - 1) {
                    updatePage(currentPageIndex + 1);
                }
            });

            // Dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    updatePage(index);
                });
            });
        }

            
           
    
        // Add form submission handler after form is generated
        function setupFormSubmission(form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                // Clear previous validation messages
                document.querySelectorAll('.validation-message').forEach(el => {
                    el.textContent = '';
                    el.className = 'validation-message';
                });

                // Prepare submission data
                const submissionData = [];

                // Process all fields from all pages
                const allFields = [];

                if (formPages.length > 1) {
                    // Multi-page form: collect fields from all pages
                    formPages.forEach(page => {
                        if (page.questions) {
                            allFields.push(...page.questions);
                        }
                    });
                } else {
                    // Single page form: use formData directly
                    allFields.push(...formData);
                }

                // Process each field
                allFields.forEach(field => {
                    // Skip layout elements that don't have values
                    if (field.type === 'section-title' || field.type === 'divider' || field.type === 'html') {
                        return;
                    }

                    const value = getFieldValue(field, form);
                    console.log(`Field ${field.id} (${field.type}):`, value);

                    submissionData.push({
                        questionId: field.id,
                        answer: value !== null && value !== undefined ? value : '',
                        fieldType: field.type,
                        pageId: field.pageId || 'page-1', // Include page information
                        label: field.label || '', // Include field label for reference
                        required: field.required || false
                    });
                });

                console.log('=== FORM SUBMISSION DEBUG ===');
                console.log('Form Type:', formPages.length > 1 ? 'Multi-page' : 'Single-page');
                console.log('Total Pages:', formPages.length);
                console.log('Total Fields:', allFields.length);
                console.log('Submission Data:', submissionData);
                console.log('============================');
const submitButton = form.querySelector('.submit-btn');
const originalText = submitButton.innerHTML;

try {
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    submitButton.disabled = true;

    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
const route = isAuthenticated ? '/test' : '/test_anonymous';

const response = await fetch(route, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
        form_id: '{{ $id }}',
        data: submissionData,
        form_type: formPages.length > 1 ? 'multi-page' : 'single-page',
        total_pages: formPages.length
    })
});

    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

    // Success
    const successMessage = document.createElement('div');
    successMessage.className = 'success-message';
    successMessage.innerHTML = `<div style="text-align:center;padding:2rem;background:#10b981;color:white;border-radius:12px;margin:2rem 0;">
        <i class="fas fa-check-circle" style="font-size:3rem;margin-bottom:1rem;"></i>
        <h2>Form Submitted Successfully!</h2>
        <p>Thank you for your submission. Your response has been recorded.</p>
        <p><strong>Submission ID:</strong> ${Date.now()}</p>
        <p><strong>Form Type:</strong> ${formPages.length > 1 ? 'Multi-page' : 'Single-page'}</p>
        <p><strong>Total Fields:</strong> ${submissionData.length}</p>
    </div>`;

    form.innerHTML = '';
    form.appendChild(successMessage);

    // Only redirect authenticated users
    if (isAuthenticated) {
        setTimeout(() => { window.location.href = '/home'; }, 3000);
    }

} catch (error) {
    console.error('Submission Error:', error);
    alert('Error submitting form. Please try again.');
    
    // Reset button state
    submitButton.innerHTML = originalText;
    submitButton.disabled = false;
}

            });
        }
       

        // Helper function to get field values based on type
        function getFieldValue(field, formElement) {
            switch (field.type) {
                // Text-based inputs
                case 'text':
                case 'textarea':
                case 'email':
                case 'number':
                case 'date':
                case 'time':
                case 'range':
                    return formElement.querySelector(`#${field.id}`)?.value || null;

                // Choice inputs
                case 'checkbox-group':
                    return Array.from(formElement.querySelectorAll(`input[name="${field.id}[]"]:checked`))
                               .map(checkbox => checkbox.value);

                case 'radio-group':
                case 'satisfaction':
                case 'rating':
                    return formElement.querySelector(`input[name="${field.id}"]:checked`)?.value || null;

                case 'select':
                    return formElement.querySelector(`#${field.id}`)?.value || null;

                case 'toggle':
                    return formElement.querySelector(`#${field.id}`)?.checked || false;

                // File input
                case 'file':
                    const fileInput = formElement.querySelector(`#${field.id}`);
                    return fileInput?.files?.length > 0 ? Array.from(fileInput.files).map(f => f.name) : null;

                // Signature field
                case 'signature':
                    const signatureCanvas = formElement.querySelector(`#${field.id}`);
                    return signatureCanvas?.toDataURL ? signatureCanvas.toDataURL() : null;

                // Layout elements (no values)
                case 'section-title':
                case 'divider':
                    return null; // These don't have values

                // Default fallback
                default:
                    return formElement.querySelector(`#${field.id}`)?.value || null;
            }
        }

        // Basic validation function
        function validateForm() {
            let isValid = true;
            // Add your validation logic here
            return isValid;
        }

        // Generate the form when page loads
        document.addEventListener('DOMContentLoaded', generateForm);
    </script>
</body>
</html>