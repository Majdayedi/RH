<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Application')</title>
  <link rel="icon" type="image/png" href="images/icons/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    /* ====== Global Styles ====== */
    :root {
      --primary-color: #5f00dd;
      --secondary-color: #3d0686;
      --accent-color: #fff;
      --text-dark: #222;
      --text-medium: #555;
      --text-light: #777;
      --bg-light: #f8f9fa;
      --white: #fff;
      --shadow-sm: 0 2px 10px rgba(0,0,0,0.1);
      --shadow-md: 0 5px 15px rgba(0,0,0,0.1);
      --shadow-lg: 0 10px 25px rgba(0,0,0,0.15);
      --transition: all 0.3s ease;
    }
    
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }
    
    body {
      display: flex;
      flex-direction: column;
      color: var(--text-dark);
      background: var(--bg-light);
      line-height: 1.6;
    }
    
    .container-main {
      flex: 1;
    }
    
    /* ====== Header ====== */
    .header {
      padding: 20px 0;
      box-shadow: var(--shadow-sm);
      background: var(--white);
      position: sticky;
      top: 0;
      z-index: 1000;
      transition: var(--transition);
    }
    
    .header.scrolled {
      padding: 10px 0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .navbar-brand img {
      transition: var(--transition);
    }
    
    .header.scrolled .navbar-brand img {
      height: 40px;
    }
    
    .nav-link {
      font-weight: 500;
      color: var(--text-dark);
      margin: 0 15px;
      position: relative;
      transition: var(--transition);
    }
    
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary-color);
      transition: var(--transition);
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
      width: 100%;
    }
    
    .header-icons a {
      color: var(--text-dark);
      margin-left: 20px;
      font-size: 18px;
      position: relative;
      transition: var(--transition);
    }
    
    .header-icons a:hover {
      color: var(--primary-color);
    }
    
    .cart-count {
      position: absolute;
      top: -10px;
      right: -10px;
      background: #e65540;
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    /* ====== Hero Section ====== */
    .hero-section {
      background: linear-gradient(135deg, #f5f7fa 0%, #e8c8fb 100%);
      padding: 100px 0;
      text-align: center;
    }
    
    .hero-title {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: var(--text-dark);
    }
    
    .hero-subtitle {
      font-size: 1.2rem;
      color: var(--text-medium);
      max-width: 700px;
      margin: 0 auto 40px;
    }
    
    /* ====== Product Cards ====== */
    .products-section {
      padding: 80px 0;
      background: var(--white);
    }
    
    .section-title {
      text-align: center;
      margin-bottom: 60px;
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--text-dark);
      position: relative;
    }
    
    .section-title::after {
      content: '';
      display: block;
      width: 80px;
      height: 4px;
      background: var(--primary-color);
      margin: 15px auto 0;
      border-radius: 2px;
    }
    
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
    }
    
    .product-card {
      background: var(--white);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
      position: relative;
    }
    
    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-lg);
    }
    
    .product-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background: var(--primary-color);
      color: var(--white);
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      z-index: 1;
    }
    
    .product-img-container {
      height: 220px;
      overflow: hidden;
      position: relative;
      background: var(--accent-color);
    }
    
    .product-img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      transition: var(--transition);
      padding: 20px;
    }
    
    .product-card:hover .product-img {
      transform: scale(1.05);
    }
    
    .product-info {
      padding: 20px;
    }
    
    .product-title {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--text-dark);
    }
    
    .product-price {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 15px;
    }
    
    .current-price {
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--primary-color);
    }
    
    .original-price {
      font-size: 0.9rem;
      color: var(--text-light);
      text-decoration: line-through;
    }
    
    .product-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .details-btn {
      padding: 10px 25px;
      background: var(--primary-color);
      color: var(--white);
      border: none;
      border-radius: 30px;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 4px 15px rgba(95, 0, 221, 0.3);
    }
    
    .details-btn:hover {
      background: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(95, 0, 221, 0.4);
    }
    
    .wishlist-btn {
      background: none;
      border: none;
      color: var(--text-light);
      font-size: 1.2rem;
      cursor: pointer;
      transition: var(--transition);
    }
    
    .wishlist-btn:hover {
      color: #e65540;
    }
    
    /* ====== Companies Section ====== */
    .companies-section {
      padding: 80px 0;
      background: var(--bg-light);
    }
    
    .company-card {
      background: var(--white);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
    }
    
    .company-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }
    
    .company-img-container {
      height: 180px;
      overflow: hidden;
    }
    
    .company-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: var(--transition);
    }
    
    .company-card:hover .company-img {
      transform: scale(1.05);
    }
    
    .company-info {
      padding: 25px;
    }
    
    .company-name {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--text-dark);
    }
    
    .company-details {
      color: var(--text-medium);
      font-size: 0.9rem;
      margin-bottom: 20px;
    }
    
    .company-link {
      display: inline-block;
      padding: 10px 25px;
      background: var(--primary-color);
      color: var(--white);
      text-decoration: none;
      border-radius: 30px;
      font-size: 0.9rem;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .company-link:hover {
      background: var(--secondary-color);
      transform: translateY(-2px);
    }
    
    /* ====== Footer ====== */
    footer {
      background: #222;
      color: #fff;
      padding: 80px 0 30px;
    }
    
    .footer-title {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .footer-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 2px;
      background: var(--primary-color);
    }
    
    .footer-links {
      list-style: none;
      padding: 0;
    }
    
    .footer-links li {
      margin-bottom: 12px;
    }
    
    .footer-links a {
      color: #aaa;
      text-decoration: none;
      transition: var(--transition);
    }
    
    .footer-links a:hover {
      color: var(--white);
      padding-left: 5px;
    }
    
    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }
    
    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      color: var(--white);
      transition: var(--transition);
    }
    
    .social-links a:hover {
      background: var(--primary-color);
      transform: translateY(-3px);
    }
    
    .newsletter-input {
      width: 100%;
      padding: 12px 15px;
      background: rgba(255,255,255,0.1);
      border: none;
      border-radius: 30px;
      color: var(--white);
      margin-bottom: 15px;
    }
    
    .newsletter-input::placeholder {
      color: #aaa;
    }
    
    .subscribe-btn {
      width: 100%;
      padding: 12px;
      background: var(--primary-color);
      color: var(--white);
      border: none;
      border-radius: 30px;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
    }
    
    .subscribe-btn:hover {
      background: var(--secondary-color);
    }
    
    .copyright {
      text-align: center;
      padding-top: 30px;
      margin-top: 30px;
      border-top: 1px solid rgba(255,255,255,0.1);
      color: #aaa;
      font-size: 0.9rem;
    }
    
    /* ====== Back to Top ====== */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background: var(--primary-color);
      color: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transition: var(--transition);
      z-index: 999;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .back-to-top.active {
      opacity: 1;
      visibility: visible;
    }
    
    .back-to-top:hover {
      background: var(--secondary-color);
      transform: translateY(-3px);
    }
    
    /* ====== Responsive Styles ====== */
    @media (max-width: 992px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .section-title {
        font-size: 2rem;
      }
    }
    
    @media (max-width: 768px) {
      .hero-section {
        padding: 80px 0;
      }
      
      .hero-title {
        font-size: 2rem;
      }
      
      .hero-subtitle {
        font-size: 1rem;
      }
      
      .section-title {
        font-size: 1.8rem;
        margin-bottom: 40px;
      }
      
      .product-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      }
    }
    
    @media (max-width: 576px) {
      .hero-title {
        font-size: 1.8rem;
      }
      
      .section-title {
        font-size: 1.5rem;
      }
      
      .product-img-container {
        height: 180px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.html">
          <img src="images/icons/logo.png" alt="Fashion Store" width="120">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="shop.html">Shop</a></li>
            <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
          </ul>
          <div class="header-icons">
            <a href="#" class="search-toggle"><i class="fas fa-search"></i></a>
            <a href="#" class="account"><i class="fas fa-user"></i>  Manage companies</a>
            
          </div>
        </div>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container-main">
    <!-- Hero Section -->
	<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
	  <h1 class="hero-title mb-4">
  Join Our Trusted Professional Network
</h1>

<p class="hero-subtitle mb-4">
  Add your company today and become part of a secure, streamlined platform built to manage employee forms, data, and compliance — all in one place.
</p>


<div class="hero-features mb-4">
          <div class="feature-item">
            <i class="fas fa-check-circle me-2"></i>
            <span>Verified Company Profiles</span>
          </div>
          <div class="feature-item">
            <i class="fas fa-star me-2"></i>
            <span>Smart Form Management</span>
          </div>
          <div class="feature-item">
            <i class="fas fa-shield-alt me-2"></i>
            <span>Secure Infrastructure</span>
          </div>
        </div>



        
        <div class="hero-cta">
		<a href="{{ route('companies.companyform') }}" class="btn btn-primary btn-lg me-3">
        <i class="fas fa-building me-2"></i> List Your Company
    </a>
          <button class="btn btn-outline-light btn-lg">
            <i class="fas fa-search me-2"></i> Browse Companies
          </button>
        </div>
      </div>
      
      <div class="col-lg-6 d-none d-lg-block">
        <div class="hero-image-container">
          <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf" alt="Business professionals networking" class="img-fluid rounded">
          <div class="stats-overlay">
            <div class="stat-item">
              <div class="stat-number">5,000+</div>
              <div class="stat-label">Companies</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">120+</div>
              <div class="stat-label">Industries</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">98%</div>
              <div class="stat-label">Satisfaction Rate</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.hero-section {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  padding: 100px 0;
  position: relative;
}

.hero-title {
  font-size: 2.8rem;
  font-weight: 700;
  color: #2c3e50;
  line-height: 1.2;
}

.hero-subtitle {
  font-size: 1.2rem;
  color: #495057;
  max-width: 600px;
}

.hero-features {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.feature-item {
  display: flex;
  align-items: center;
  color: #495057;
  font-size: 1rem;
}

.feature-item i {
  color: #5f00dd;
}

.hero-cta {
  display: flex;
  gap: 15px;
  margin-top: 30px;
}

.btn-primary {
  background-color: #5f00dd;
  border-color: #5f00dd;
  padding: 12px 24px;
}

.btn-outline-light {
  border-color: #5f00dd;
  color: #5f00dd;
  padding: 12px 24px;
}

.hero-image-container {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.hero-image-container img {
  width: 100%;
  height: auto;
  object-fit: cover;
}

.stats-overlay {
  position: absolute;
  bottom: 20px;
  left: 20px;
  right: 20px;
  background: rgba(255,255,255,0.9);
  border-radius: 8px;
  padding: 15px;
  display: flex;
  justify-content: space-around;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.stat-item {
  text-align: center;
}

.stat-number {
  font-size: 1.5rem;
  font-weight: 700;
  color: #5f00dd;
  line-height: 1;
}

.stat-label {
  font-size: 0.8rem;
  color: #6c757d;
  margin-top: 5px;
}

@media (max-width: 992px) {
  .hero-title {
    font-size: 2.2rem;
  }
  
  .hero-section {
    padding: 80px 0;
    text-align: center;
  }
  
  .hero-subtitle {
    margin-left: auto;
    margin-right: auto;
  }
  
  .hero-features {
    align-items: center;
  }
  
  .hero-cta {
    justify-content: center;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 1.8rem;
  }
  
  .hero-cta {
    flex-direction: column;
    gap: 10px;
  }
  
  .hero-cta .btn {
    width: 100%;
  }
}
</style>

    <!-- Products Section -->
    <section class="products-section">
     @yield('content')
    </section>

    <!-- Companies Section -->
    <section class="companies-section">
      <div class="container">
        <h2 class="section-title">Our Partners</h2>
        <div class="row">
          <!-- Company 1 -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="company-card">
              <div class="company-img-container">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Tech Company" class="company-img">
              </div>
              <div class="company-info">
                <h3 class="company-name">Tech Innovators</h3>
                <p class="company-details">Leading technology solutions provider with 200+ employees worldwide, specializing in AI and cloud computing.</p>
                <a href="#" class="company-link">View Profile</a>
              </div>
            </div>
          </div>
          
          <!-- Company 2 -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="company-card">
              <div class="company-img-container">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Design Studio" class="company-img">
              </div>
              <div class="company-info">
                <h3 class="company-name">Creative Design Co.</h3>
                <p class="company-details">Award-winning design agency with 50 creative professionals focused on branding and user experience.</p>
                <a href="#" class="company-link">View Profile</a>
              </div>
            </div>
          </div>
          
          <!-- Company 3 -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="company-card">
              <div class="company-img-container">
                <img src="https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Green Energy" class="company-img">
              </div>
              <div class="company-info">
                <h3 class="company-name">EcoPower Solutions</h3>
                <p class="company-details">Pioneers in renewable energy with 150 employees, delivering sustainable power solutions since 2010.</p>
                <a href="#" class="company-link">View Profile</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h3 class="footer-title">Categories</h3>
          <ul class="footer-links">
            <li><a href="#">Women</a></li>
            <li><a href="#">Men</a></li>
            <li><a href="#">Shoes</a></li>
            <li><a href="#">Accessories</a></li>
            <li><a href="#">New Arrivals</a></li>
          </ul>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h3 class="footer-title">Help</h3>
          <ul class="footer-links">
            <li><a href="#">Track Order</a></li>
            <li><a href="#">Returns</a></li>
            <li><a href="#">Shipping</a></li>
            <li><a href="#">FAQs</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h3 class="footer-title">Contact</h3>
          <p style="color: #aaa; margin-bottom: 20px;">
            123 Fashion Street<br>
            New York, NY 10001<br>
            Phone: (+1) 96 716 6879<br>
            Email: info@fashionstore.com
          </p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <h3 class="footer-title">Newsletter</h3>
          <p style="color: #aaa; margin-bottom: 20px;">
            Subscribe to our newsletter for the latest updates and offers.
          </p>
          <form>
            <input type="email" class="newsletter-input" placeholder="Your email address">
            <button type="submit" class="subscribe-btn">Subscribe</button>
          </form>
        </div>
      </div>
      
      <div class="copyright">
        © 2023 Fashion Store. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Back to Top Button -->
  <div class="back-to-top" id="backToTop">
    <i class="fas fa-chevron-up"></i>
  </div>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Back to Top Button
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        backToTop.classList.add('active');
      } else {
        backToTop.classList.remove('active');
      }
    });

    backToTop.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Mobile Menu Toggle
    document.querySelector('.navbar-toggler').addEventListener('click', function() {
      document.querySelector('.navbar-collapse').classList.toggle('show');
    });

    // Product hover effects
    document.addEventListener("DOMContentLoaded", function() {
      const productCards = document.querySelectorAll('.product-card');
      
      productCards.forEach(card => {
        const img = card.querySelector('.product-img');
        
        card.addEventListener('mouseenter', function() {
          img.style.transform = 'scale(1.05)';
        });
        
        card.addEventListener('mouseleave', function() {
          img.style.transform = 'scale(1)';
        });
      });
    });
  </script>
</body>
</html>