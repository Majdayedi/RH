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
                            <input type="text" class="form-input @error('legal_name') is-invalid @enderror" 
                                   id="legal_name" name="legal_name" value="{{ old('legal_name') }}" required>
                            @error('legal_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="trade_name" class="form-label">Trade Name</label>
                            <input type="text" class="form-input @error('trade_name') is-invalid @enderror" 
                                   id="trade_name" name="trade_name" value="{{ old('trade_name') }}">
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
                            <input type="text" class="form-input @error('registration_number') is-invalid @enderror" 
                                   id="registration_number" name="registration_number" value="{{ old('registration_number') }}" required>
                            @error('registration_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tax_id" class="form-label">Tax ID*</label>
                            <input type="text" class="form-input @error('tax_id') is-invalid @enderror" 
                                   id="tax_id" name="tax_id" value="{{ old('tax_id') }}" required>
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
                </div>

                <!-- Step 3: Contact Information -->
                <div class="step-content" data-step="3">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="country" class="form-label">Country Code*</label>
                            <input type="text" class="form-input @error('country') is-invalid @enderror" 
                                   id="country" name="country" value="{{ old('country') }}" maxlength="2" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="tel" class="form-input @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" class="form-input @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
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
</style>
@endsection