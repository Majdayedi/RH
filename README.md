# 📋 RH Form Management System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
  <img src="https://img.shields.io/badge/AI-Powered-purple.svg" alt="AI Powered">
</p>

A comprehensive Laravel-based form management system designed for HR departments and organizations to create, manage, and analyze forms with AI-powered insights.

## ✨ Features

### 🎯 Core Features
- **Dynamic Form Builder** - Drag & drop form creation with multiple field types
- **Multi-Language Support** - English, French, and Arabic with RTL support
- **AI-Powered Analytics** - Generate intelligent reports from form submissions
- **Company Management** - Multi-tenant system with company isolation
- **User Authentication** - Secure login system with role-based access
- **Real-time Dashboard** - Live statistics and form management

### 📊 Form Management
- **Visual Form Builder** - Intuitive drag-and-drop interface
- **Multiple Field Types**:
  - Text Input, Textarea, Email, Phone, URL
  - Select Dropdown, Radio Buttons, Checkboxes
  - File Upload, Date Picker, Number Input
  - Satisfaction Rating, Section Titles
- **Form Status Management** - Draft, Published, Archived states
- **Form Analytics** - Submission tracking and statistics

### 🤖 AI Features
- **Intelligent Report Generation** - AI-powered analysis of form responses
- **Sentiment Analysis** - Automatic sentiment detection in text responses
- **Statistical Insights** - Comprehensive data analysis and recommendations
- **PDF Export** - Professional report generation with editing capabilities
- **Multi-language AI** - Support for analysis in multiple languages

### 🌍 Internationalization
- **3 Languages Supported**: English (🇺🇸), French (🇫🇷), Arabic (🇸🇦)
- **RTL Support** - Full right-to-left layout for Arabic
- **Dynamic Language Switching** - Change language on-the-fly
- **Comprehensive Translations** - All UI elements translated

## 🛠️ Technology Stack

- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Vanilla JavaScript, HTML5, CSS3
- **Database**: MySQL/PostgreSQL
- **AI Integration**: Python with Transformers library
- **Authentication**: Laravel Sanctum
- **Real-time**: Livewire 3.6
- **Styling**: Custom CSS with modern design

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL 8.0+ or PostgreSQL 13+
- Python 3.8+ (for AI features)
- Web server (Apache/Nginx)

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/rh-form-management.git
cd rh-form-management
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rh_forms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Install Python Dependencies (for AI features)
```bash
pip install transformers torch numpy
```

### 7. Start the Application
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 📖 Usage Guide

### 🏢 Company Setup
1. Register a new company account
2. Upload company logo and configure settings
3. Create user accounts for your organization

### 📝 Creating Forms
1. Navigate to **Forms** section
2. Click **Create Form**
3. Use the drag-and-drop builder to add fields
4. Configure field properties (labels, validation, options)
5. Save as draft or publish immediately

### 📊 Managing Submissions
1. View submissions in the **Analytics** section
2. Click on any form to see detailed responses
3. Export data or generate AI reports

### 🤖 AI Reports
1. Go to **Statistics** section
2. Select a form with submissions
3. Click **Generate AI Report**
4. View insights, edit content, and export to PDF

### 🌍 Language Settings
- Use the language dropdown in the header
- Choose from English, French, or Arabic
- Language preference is saved per session

## 🔧 Configuration

### AI Configuration
The AI analysis system uses Python scripts located in the project root:
- `ai_analysis.py` - Main AI analysis script
- Supports offline analysis with transformers library
- Fallback system for when AI libraries are unavailable

### Multi-language Setup
Language files are located in `resources/lang/`:
- `en/messages.php` - English translations
- `fr/messages.php` - French translations
- `ar/messages.php` - Arabic translations

### Database Schema
Key models and relationships:
- **Company** - Multi-tenant organization management
- **User** - Authentication and user management
- **Form** - Form definitions and metadata
- **Question** - Individual form fields
- **Submission** - Form response data
- **Answer** - Individual field responses

## 🎨 Customization

### Themes and Styling
- CSS files located in `public/css/`
- Responsive design with mobile support
- Dark/light theme ready
- RTL layout support for Arabic

### Adding New Languages
1. Create new language file: `resources/lang/xx/messages.php`
2. Add language to `AppServiceProvider.php`
3. Update language switcher component
4. Add flag icon and language name

## 🔒 Security Features

- **CSRF Protection** - All forms protected against CSRF attacks
- **Input Validation** - Server-side validation for all inputs
- **SQL Injection Prevention** - Eloquent ORM with prepared statements
- **Authentication** - Secure session-based authentication
- **Company Isolation** - Multi-tenant data separation

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📈 Performance

- **Optimized Queries** - Efficient database queries with eager loading
- **Caching** - Session-based caching for language preferences
- **Minimal Dependencies** - Lightweight frontend with no heavy frameworks
- **AI Optimization** - Fallback system for AI features

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Create an issue on GitHub
- Check the documentation
- Review the code comments for implementation details

## 🙏 Acknowledgments

- Laravel Framework team
- Transformers library contributors
- Multi-language community contributors
- Open source community

---

**Built with ❤️ for modern HR management**
