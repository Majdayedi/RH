@extends('layouts.form1')

@section('title', 'Register Company')

@section('content')
<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h2><i class="fas fa-building me-2"></i> Company Registration</h2>
            <p class="mb-0">Join our network of trusted businesses</p>
        </div>
        
        <div class="form-body">
            <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data" id="multiStepForm">
                @csrf

                <!-- Step Indicators -->
                <div class="step-indicator mb-4">
                    <div class="step active" data-step="1">Basic Info</div>
                    <div class="step" data-step="2">Legal Details</div>
                    <div class="step" data-step="3">Contact Info</div>
                    <div class="step" data-step="4">Documents</div>
                </div>

                <!-- Step 1: Basic Information -->
                <div class="step-content active" data-step="1">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="legal_name" class="form-label">Legal Name*</label>
                            <div class="input-group">
                                <input type="text" class="form-input @error('legal_name') is-invalid @enderror"
                                       id="legal_name" name="legal_name" value="{{ old('legal_name') }}"
                                       required maxlength="255" data-validate="company-name">
                                <div class="input-feedback">
                                    <span class="char-count">0/255</span>
                                    <i class="validation-icon"></i>
                                </div>
                            </div>
                            <div class="validation-message"></div>
                            @error('legal_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="trade_name" class="form-label">Trade Name</label>
                            <div class="input-group">
                                <input type="text" class="form-input @error('trade_name') is-invalid @enderror"
                                       id="trade_name" name="trade_name" value="{{ old('trade_name') }}"
                                       maxlength="255" data-validate="company-name">
                                <div class="input-feedback">
                                    <span class="char-count">0/255</span>
                                    <i class="validation-icon"></i>
                                </div>
                            </div>
                            <div class="validation-message"></div>
                            @error('trade_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="headquarters_address" class="form-label">Headquarters Address*</label>
                        <textarea class="form-input @error('headquarters_address') is-invalid @enderror" 
                                  id="headquarters_address" name="headquarters_address" rows="3" required>{{ old('headquarters_address') }}</textarea>
                        @error('headquarters_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back
                        </a>
                        <button type="button" class="btn btn-primary next-step">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Legal Details -->
                <div class="step-content" data-step="2">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="registration_number" class="form-label">Registration Number*</label>
                            <div class="input-group">
                                <input type="text" class="form-input @error('registration_number') is-invalid @enderror"
                                       id="registration_number" name="registration_number" value="{{ old('registration_number') }}"
                                       required maxlength="100" data-validate="registration-number"
                                       placeholder="e.g., REG-123456789">
                                <div class="input-feedback">
                                    <span class="char-count">0/100</span>
                                    <i class="validation-icon"></i>
                                </div>
                            </div>
                            <div class="validation-message"></div>
                            @error('registration_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tax_id" class="form-label">Tax ID*</label>
                            <div class="input-group">
                                <input type="text" class="form-input @error('tax_id') is-invalid @enderror"
                                       id="tax_id" name="tax_id" value="{{ old('tax_id') }}"
                                       required maxlength="100" data-validate="tax-id"
                                       placeholder="e.g., TAX-123456789">
                                <div class="input-feedback">
                                    <span class="char-count">0/100</span>
                                    <i class="validation-icon"></i>
                                </div>
                            </div>
                            <div class="validation-message"></div>
                            @error('tax_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="incorporation_date" class="form-label">Incorporation Date*</label>
                            <input type="date" class="form-input @error('incorporation_date') is-invalid @enderror" 
                                   id="incorporation_date" name="incorporation_date" value="{{ old('incorporation_date') }}" required>
                            @error('incorporation_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="legal_structure" class="form-label">Legal Structure*</label>
                            <select class="form-input @error('legal_structure') is-invalid @enderror" 
                                    id="legal_structure" name="legal_structure" required>
                                <option value="">Select...</option>
                                <option value="LLC" @selected(old('legal_structure') == 'LLC')>LLC</option>
                                <option value="Corporation" @selected(old('legal_structure') == 'Corporation')>Corporation</option>
                                <option value="Partnership" @selected(old('legal_structure') == 'Partnership')>Partnership</option>
                            </select>
                            @error('legal_structure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="industry" class="form-label">Industry*</label>
                            <select class="form-input @error('industry') is-invalid @enderror" 
                                    id="industry" name="industry" required>
                                <option value="">Select...</option>
                                <option value="Technology" @selected(old('industry') == 'Technology')>Technology</option>
                                <option value="Finance" @selected(old('industry') == 'Finance')>Finance</option>
                                <option value="Healthcare" @selected(old('industry') == 'Healthcare')>Healthcare</option>
                            </select>
                            @error('industry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step">
                            <i class="fas fa-arrow-left me-2"></i> Previous
                        </button>
                        <button type="button" class="btn btn-primary next-step">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                    <div class="col-md-4">
    <label for="jurisdiction" class="form-label">Jurisdiction</label>
    <input type="text" class="form-input @error('jurisdiction') is-invalid @enderror" 
           id="jurisdiction" name="jurisdiction" value="{{ old('jurisdiction') }}">
    @error('jurisdiction')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                </div>

                <!-- Step 3: Contact Information -->
                <div class="step-content" data-step="3">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="country" class="form-label">Country Code*</label>
                            <div class="input-group">
                                <input type="text" class="form-input @error('country') is-invalid @enderror"
                                       id="country" name="country" value="{{ old('country') }}"
                                       maxlength="2" required data-validate="country-code"
                                       placeholder="US, TN, FR" style="text-transform: uppercase;">
                                <div class="input-feedback">
                                    <span class="char-count">0/2</span>
                                    <i class="validation-icon"></i>
                                </div>
                            </div>
                            <div class="validation-message"></div>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Phone*</label>
                            <div class="input-group">
                                <input type="tel" class="form-input @error('phone') is-invalid @enderror"
                                       id="phone" name="phone" value="{{ old('phone') }}"
                                       required maxlength="20" data-validate="phone"
                                       placeholder="+1 (555) 123-4567">
                                <div class="input-feedback">
                                    <span class="char-count">0/20</span>
                                    <i class="validation-icon"></i>
                                </div>
                            </div>
                            <div class="validation-message"></div>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email*</label>
                            <div class="input-group">
                                <input type="email" class="form-input @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}"
                                       required maxlength="255" data-validate="email"
                                       placeholder="company@example.com">
                                <div class="input-feedback">
                                    <span class="char-count">0/255</span>
                                    <i class="validation-icon"></i>
                                </div>
                            </div>
                            <div class="validation-message"></div>
                            <div class="email-availability-check"></div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" class="form-input @error('website') is-invalid @enderror" 
                               id="website" name="website" value="{{ old('website') }}" placeholder="https://">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step">
                            <i class="fas fa-arrow-left me-2"></i> Previous
                        </button>
                        <button type="button" class="btn btn-primary next-step">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Documents -->
                <div class="step-content" data-step="4">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Company Logo</label>
                            <div class="file-upload btn btn-outline-primary w-100">
                                <span><i class="fas fa-upload me-2"></i>Upload Logo</span>
                                <input type="file" class="file-upload-input" name="logo" accept="image/*">
                            </div>
                            <small class="text-muted">PNG, JPG (Max 2MB)</small>
                            @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Incorporation Certificate</label>
                            <div class="file-upload btn btn-outline-primary w-100">
                                <span><i class="fas fa-upload me-2"></i>Upload Certificate</span>
                                <input type="file" class="file-upload-input" name="certificate_of_incorporation" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted">PDF, JPG (Max 5MB)</small>
                            @error('certificate_of_incorporation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Tax Certificate</label>
                            <div class="file-upload btn btn-outline-primary w-100">
                                <span><i class="fas fa-upload me-2"></i>Upload Certificate</span>
                                <input type="file" class="file-upload-input" name="tax_registration_certificate" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted">PDF, JPG (Max 5MB)</small>
                            @error('tax_registration_certificate')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step">
                            <i class="fas fa-arrow-left me-2"></i> Previous
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i> Submit Registration
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .step {
        flex: 1;
        text-align: center;
        padding: 10px;
        background-color: #f8f9fa;
        color: #6c757d;
        border-radius: 5px;
        margin: 0 5px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .step.active {
        background-color: #0d6efd;
        color: white;
    }
    
    .step-content {
        display: none;
    }
    
    .step-content.active {
        display: block;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('multiStepForm');
        const steps = document.querySelectorAll('.step');
        const stepContents = document.querySelectorAll('.step-content');
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        
        let currentStep = 1;
        
        // Initialize form
        showStep(currentStep);

        // Initialize typing control services
        initializeTypingControls();
        
        // Step indicators click event
        steps.forEach(step => {
            step.addEventListener('click', function() {
                const stepNumber = parseInt(this.getAttribute('data-step'));
                if (stepNumber < currentStep) {
                    currentStep = stepNumber;
                    showStep(currentStep);
                }
            });
        });
        
        // Next button click event
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get all required inputs in current step
                const currentStepContent = document.querySelector(`.step-content[data-step="${currentStep}"]`);
                const requiredInputs = currentStepContent.querySelectorAll('[required]');
                let isValid = true;
                
                // Validate each required field
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                
                // If valid, proceed to next step
                if (isValid) {
                    currentStep++;
                    showStep(currentStep);
                    
                    // Scroll to top of form for better UX
                    document.querySelector('.form-container').scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Previous button click event
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentStep--;
                showStep(currentStep);
                
                // Scroll to top of form for better UX
                document.querySelector('.form-container').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        function showStep(stepNumber) {
            // Update step indicators
            steps.forEach((step, index) => {
                if (index + 1 === stepNumber) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
                
                // Mark completed steps
                if (index + 1 < stepNumber) {
                    step.classList.add('completed');
                } else {
                    step.classList.remove('completed');
                }
            });
            
            // Show current step content
            stepContents.forEach(content => {
                const contentStep = parseInt(content.getAttribute('data-step'));
                if (contentStep === stepNumber) {
                    content.classList.add('active');
                } else {
                    content.classList.remove('active');
                }
            });
        }

        // Typing Control Services
        function initializeTypingControls() {
            const inputs = document.querySelectorAll('input[data-validate]');

            inputs.forEach(input => {
                const inputGroup = input.closest('.input-group');
                const charCount = inputGroup.querySelector('.char-count');
                const validationIcon = inputGroup.querySelector('.validation-icon');
                const validationMessage = inputGroup.parentElement.querySelector('.validation-message');

                // Character counting
                input.addEventListener('input', function() {
                    updateCharCount(this, charCount);
                    validateInput(this, validationIcon, validationMessage);

                    // Add typing animation
                    inputGroup.classList.add('typing');
                    clearTimeout(this.typingTimer);
                    this.typingTimer = setTimeout(() => {
                        inputGroup.classList.remove('typing');
                    }, 500);
                });

                // Real-time validation on blur
                input.addEventListener('blur', function() {
                    validateInput(this, validationIcon, validationMessage, true);
                });

                // Initialize character count
                updateCharCount(input, charCount);
            });

            // Special handling for email availability check
            const emailInput = document.getElementById('email');
            if (emailInput) {
                let emailCheckTimeout;
                emailInput.addEventListener('input', function() {
                    clearTimeout(emailCheckTimeout);
                    emailCheckTimeout = setTimeout(() => {
                        checkEmailAvailability(this);
                    }, 1000);
                });
            }

            // Email availability check function
            function checkEmailAvailability(emailInput) {
                const email = emailInput.value.trim();
                const checkElement = emailInput.parentElement.parentElement.querySelector('.email-availability-check');

                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    checkElement.textContent = '';
                    return;
                }

                checkElement.textContent = 'Checking availability...';
                checkElement.className = 'email-availability-check checking';

                // API call to check email availability
                fetch('/api/check-email-availability', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        checkElement.textContent = '✓ Email is available';
                        checkElement.className = 'email-availability-check available';
                    } else {
                        checkElement.textContent = '✗ Email is already registered';
                        checkElement.className = 'email-availability-check taken';
                    }
                })
                .catch(error => {
                    checkElement.textContent = '';
                    console.error('Email check failed:', error);
                });
            }

            // Phone number formatting
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function() {
                    formatPhoneNumber(this);
                });
            }

            // Country code formatting
            const countryInput = document.getElementById('country');
            if (countryInput) {
                countryInput.addEventListener('input', function() {
                    this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
                });
            }
        }

        function updateCharCount(input, charCountElement) {
            const current = input.value.length;
            const max = input.getAttribute('maxlength') || 255;
            charCountElement.textContent = `${current}/${max}`;

            // Color coding for character count
            const percentage = (current / max) * 100;
            if (percentage > 90) {
                charCountElement.style.color = '#dc3545';
            } else if (percentage > 75) {
                charCountElement.style.color = '#ffc107';
            } else {
                charCountElement.style.color = '#6c757d';
            }
        }

        function validateInput(input, iconElement, messageElement, showMessage = false) {
            const value = input.value.trim();
            const validateType = input.getAttribute('data-validate');
            const inputGroup = input.closest('.input-group');

            let isValid = false;
            let message = '';

            switch (validateType) {
                case 'company-name':
                    isValid = value.length >= 2 && /^[a-zA-Z0-9\s\-&.,()]+$/.test(value);
                    message = isValid ? 'Valid company name' : 'Company name must be at least 2 characters and contain only letters, numbers, and common symbols';
                    break;

                case 'registration-number':
                    isValid = value.length >= 3 && /^[A-Z0-9\-]+$/i.test(value);
                    message = isValid ? 'Valid registration number' : 'Registration number must be at least 3 characters (letters, numbers, hyphens only)';
                    break;

                case 'tax-id':
                    isValid = value.length >= 3 && /^[A-Z0-9\-]+$/i.test(value);
                    message = isValid ? 'Valid tax ID' : 'Tax ID must be at least 3 characters (letters, numbers, hyphens only)';
                    break;

                case 'country-code':
                    isValid = /^[A-Z]{2}$/.test(value);
                    message = isValid ? 'Valid country code' : 'Country code must be exactly 2 letters (e.g., US, TN, FR)';
                    break;

                case 'phone':
                    isValid = /^[\+]?[0-9\s\-\(\)]{10,20}$/.test(value);
                    message = isValid ? 'Valid phone number' : 'Please enter a valid phone number';
                    break;

                case 'email':
                    isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                    message = isValid ? 'Valid email format' : 'Please enter a valid email address';
                    break;

                default:
                    isValid = value.length > 0;
                    message = isValid ? 'Valid input' : 'This field is required';
            }

            // Update visual feedback
            iconElement.className = 'validation-icon';
            if (value.length === 0) {
                iconElement.classList.add('fas', 'fa-circle');
                inputGroup.classList.remove('valid', 'invalid');
                input.classList.remove('valid', 'invalid');
            } else if (isValid) {
                iconElement.classList.add('fas', 'fa-check-circle', 'valid');
                inputGroup.classList.add('valid');
                inputGroup.classList.remove('invalid');
                input.classList.add('valid');
                input.classList.remove('invalid');
            } else {
                iconElement.classList.add('fas', 'fa-times-circle', 'invalid');
                inputGroup.classList.add('invalid');
                inputGroup.classList.remove('valid');
                input.classList.add('invalid');
                input.classList.remove('valid');
            }

            // Show validation message
            if (showMessage || (!isValid && value.length > 0)) {
                messageElement.textContent = message;
                messageElement.className = `validation-message ${isValid ? 'valid' : 'invalid'}`;
            } else {
                messageElement.textContent = '';
                messageElement.className = 'validation-message';
            }

            return isValid;
        }

        function formatPhoneNumber(phoneInput) {
            let value = phoneInput.value.replace(/\D/g, '');

            if (value.length >= 10) {
                // Format as (XXX) XXX-XXXX for US numbers
                if (value.length === 10) {
                    value = `(${value.slice(0, 3)}) ${value.slice(3, 6)}-${value.slice(6)}`;
                } else if (value.length === 11 && value[0] === '1') {
                    value = `+1 (${value.slice(1, 4)}) ${value.slice(4, 7)}-${value.slice(7, 11)}`;
                }
            }

            phoneInput.value = value;
        }
    });
</script>

<style>
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .step {
        flex: 1;
        text-align: center;
        padding: 10px;
        background-color: #f8f9fa;
        color: #6c757d;
        border-radius: 5px;
        margin: 0 5px;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }
    
    .step.active {
        background-color: #0d6efd;
        color: white;
    }
    
    .step.completed {
        background-color: #198754;
        color: white;
    }
    
    .step-content {
        display: none;
    }
    
    .step-content.active {
        display: block;
        animation: fadeIn 0.5s;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Enhanced Input Controls */
    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-feedback {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 10;
    }

    .char-count {
        font-size: 0.75rem;
        color: #6c757d;
        background: rgba(255, 255, 255, 0.9);
        padding: 2px 6px;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .validation-icon {
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .validation-icon.valid {
        color: #28a745;
    }

    .validation-icon.invalid {
        color: #dc3545;
    }

    .validation-icon.checking {
        color: #ffc107;
        animation: spin 1s linear infinite;
    }

    .validation-message {
        font-size: 0.875rem;
        margin-top: 0.25rem;
        min-height: 1.2rem;
        transition: all 0.3s ease;
    }

    .validation-message.valid {
        color: #28a745;
    }

    .validation-message.invalid {
        color: #dc3545;
    }

    .validation-message.warning {
        color: #ffc107;
    }

    .form-input {
        padding-right: 80px !important;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        border-color: #80bdff;
    }

    .form-input.valid {
        border-color: #28a745;
        background-color: #f8fff9;
    }

    .form-input.invalid {
        border-color: #dc3545;
        background-color: #fff8f8;
    }

    .email-availability-check {
        font-size: 0.875rem;
        margin-top: 0.25rem;
        min-height: 1.2rem;
    }

    .email-availability-check.available {
        color: #28a745;
    }

    .email-availability-check.taken {
        color: #dc3545;
    }

    .email-availability-check.checking {
        color: #ffc107;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Input Type Specific Styles */
    input[data-validate="country-code"] {
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    input[data-validate="phone"] {
        font-family: 'Courier New', monospace;
    }

    input[data-validate="email"] {
        text-transform: lowercase;
    }

    /* Real-time feedback animations */
    .input-group.typing .form-input {
        border-color: #007bff;
        box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.15);
    }

    .input-group.valid .form-input {
        border-color: #28a745;
        box-shadow: 0 0 0 0.1rem rgba(40, 167, 69, 0.15);
    }

    .input-group.invalid .form-input {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.1rem rgba(220, 53, 69, 0.15);
    }
</style>
@endsection