<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Creator</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            margin: 0;
        }

        /* Main App Container */
        #app {
            display: flex;
            height: 100vh;
            background: var(--white);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 20px;
            border-radius: 20px;
            overflow: hidden;
        }

        /* Toolbox Styles */
        .toolbox-container {
            width: 300px;
            background: var(--gray-50);
            border-right: 2px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .toolbox-header {
            padding: 20px;
            background: #ffffff;
            color: var(--gradient-color-2);
            text-align: center;
        }

        .company-logo-container {
            width: 150px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .company-logo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        .toolbox-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .toolbox-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        .toolbox-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .toolbox-section-title {
            color: var(--gray-700);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toolbox-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .toolbox-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            padding: 12px;
            cursor: grab;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .toolbox-card:hover {
            border-color: var(--gradient-color-1);
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.15);
            transform: translateY(-2px);
        }

        .toolbox-card:active {
            cursor: grabbing;
            transform: translateY(0);
        }

        .toolbox-icon {
            color: var(--gradient-color-1);
            font-size: 20px;
        }

        .toolbox-label {
            font-size: 11px;
            font-weight: 500;
            color: var(--gray-600);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--gray-50);
        }

        .toolbar {
            background: var(--white);
            padding: 15px 20px;
            border-bottom: 2px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn {
            background: var(--white);
            border: 2px solid var(--gray-300);
            color: var(--gray-700);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn:hover {
            border-color: var(--gradient-color-1);
            color: var(--gradient-color-1);
            box-shadow: 0 2px 8px rgba(111, 66, 193, 0.15);
        }

        .btn.primary {
            background: var(--gradient-color-2);
            border-color: var(--gradient-color-2);
            color: var(--white);
        }

        .btn.primary:hover {
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.3);
            transform: translateY(-1px);
        }

        .btn.active {
            background: var(--gradient-color-1);
            border-color: var(--gradient-color-1);
            color: var(--white);
        }

        .toolbar-spacer {
            flex: 1;
        }

        /* Page Info */
        .page-info {
            padding: 15px 20px;
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 5px;
        }

        .page-meta {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-indicator {
            background: var(--gradient-color-2);
            color: var(--white);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Drop Area */
        .drop-area-container {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .drop-area {
            background: var(--white);
            border: 3px dashed var(--gray-300);
            border-radius: 16px;
            min-height: 400px;
            padding: 20px;
            transition: all 0.3s;
        }

        .drop-area:hover {
            border-color: var(--gradient-color-1);
            background: rgba(111, 66, 193, 0.02);
        }

        .empty-drop {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-400);
        }

        .empty-drop svg {
            margin-bottom: 15px;
        }

        .empty-drop p {
            font-size: 16px;
            font-weight: 500;
        }

        /* Question Block */
        .question-block {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .question-block:hover {
            border-color: var(--gradient-color-1);
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.1);
        }

        .question-block.selected {
            border-color: var(--gradient-color-1);
            box-shadow: 0 4px 16px rgba(111, 66, 193, 0.2);
            background: rgba(111, 66, 193, 0.02);
        }

        .question-block label {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 8px;
            display: block;
        }

        .question-block .description {
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .section-title {
            border-bottom: 2px solid var(--gradient-color-1);
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .section-title h3 {
            color: var(--gradient-color-1);
            font-weight: 600;
            margin: 0;
        }

        .question-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .question-block:hover .question-controls {
            opacity: 1;
        }

        .btn-icon {
            background: none;
            border: none;
            padding: 6px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-icon.danger {
            color: #ef4444;
        }

        .btn-icon.danger:hover {
            background: #fef2f2;
        }

        /* Form Controls */
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--gradient-color-1);
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
        }

        .radio-group, .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .radio-option, .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Settings Panel */
        .settings-panel {
            width: 320px;
            background: var(--white);
            border-left: 2px solid var(--gray-200);
            padding: 20px;
            overflow-y: auto;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .settings-header {
            color: var(--gray-800);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gray-200);
        }

        .settings-group {
            margin-bottom: 20px;
        }

        .settings-group label {
            display: block;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
            font-size: 14px;
        }

        .option-row {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
            align-items: center;
        }

        .option-row input {
            flex: 1;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: var(--white);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            background: var(--gradient-color-2);
            color: var(--white);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--white);
            font-size: 24px;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        /* JSON Display */
        .json-display {
            background: var(--gray-900);
            color: var(--gray-100);
            padding: 20px;
            border-radius: 12px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            line-height: 1.5;
            overflow-x: auto;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .toolbox-container {
                width: 250px;
            }
            .settings-panel {
                width: 280px;
            }
        }

        @media (max-width: 768px) {
            #app {
                flex-direction: column;
                height: auto;
                margin: 10px;
            }
            
            .toolbox-container {
                width: 100%;
                max-height: 200px;
            }
            
            .toolbox-grid {
                grid-template-columns: repeat(4, 1fr);
            }
            
            .settings-panel {
                width: 100%;
                border-left: none;
                border-top: 2px solid var(--gray-200);
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-400);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-500);
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Toolbox (Left) -->
        <div class="toolbox-container">
            <div class="toolbox-header">
                @if(isset($company))
                    <div class="company-logo-container">
                        <img src="{{ asset('storage/'.$company->logo) }}" 
                             alt="{{ $company->name }} logo">
                    </div>
                @endif
                <div class="toolbox-title">Form Builder</div>
                <div class="toolbox-subtitle">Drag & Drop Components</div>
            </div>

            <div class="toolbox-content">
                <div class="toolbox-section-title">
                    <i class="fas fa-cube"></i>
                    Basic Elements
                </div>
                <div class="toolbox-grid">
                    <div v-for="item in toolboxItems"
                         :key="item.type"
                         class="toolbox-card"
                         draggable="true"
                         @dragstart="startDrag(item.type)">
                        <div class="toolbox-icon">
                            <span v-html="item.icon"></span>
                        </div>
                        <div class="toolbox-label">@{{ item.label }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content (Center) -->
        <div class="main-content">
            <!-- Toolbar -->
            <div class="toolbar">
                <button @click="undo" class="btn">
                    <i class="fas fa-undo"></i>
                    Undo
                </button>
                <button @click="redo" class="btn">
                    <i class="fas fa-redo"></i>
                    Redo
                </button>
                <button @click="addPage" class="btn">
                    <i class="fas fa-plus"></i>
                    Add Page
                </button>
                <button @click="showFormPreview" class="btn" :class="{ 'active': previewMode }">
                    <i class="fas fa-eye"></i>
                    Preview
                </button>
                
                <div class="toolbar-spacer"></div>
                
                <button @click="testFetch" class="btn primary">
                    <i class="fas fa-save"></i>
                    Save Form
                </button>
                <button @click="showJson = !showJson" class="btn">
                    <i class="fas fa-code"></i>
                    JSON
                </button>
            </div>

            <!-- Page Info -->
            <div class="page-info">
                <div class="page-title">Form Designer</div>
                <div class="page-meta">
                    <div class="page-indicator">Page 1</div>
                    <span style="color: var(--gray-500); font-size: 14px;">Resignation Form</span>
                </div>
            </div>

            <!-- Drop Area -->
            <div class="drop-area-container">
                <div class="drop-area" @dragover.prevent @drop="onDrop">
                    <div v-if="questions.length === 0" class="empty-drop">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        <p>Drag form elements here to build your form</p>
                    </div>

                    <div v-for="(question, index) in questions"
                         :key="question.id"
                         class="question-block"
                         draggable="true"
                         @dragstart="startReorder(index)"
                         @dragover.prevent
                         @drop="reorderQuestion(index)"
                         @click="selectQuestion(index)"
                         :class="{ 'selected': selectedQuestionIndex === index }">

                        <div v-if="question.type === 'section-title'" class="section-title">
                            <h3 v-text="question.label || 'Section Title'"></h3>
                        </div>

                        <div v-if="question.type !== 'section-title'">
                            <label v-text="question.label || 'Question label...'"></label>
                            <div v-if="question.description" class="description" v-text="question.description"></div>
                        </div>

                        <div v-if="question.type === 'text'">
                            <input type="text" class="form-control" :placeholder="question.placeholder || ''">
                        </div>
                        
                        <div v-if="question.type === 'select'">
                            <select class="form-control">
                                <option v-for="opt in question.options" :value="opt">@{{ opt }}</option>
                            </select>
                        </div>
                        
                        <div v-if="question.type === 'radio-group'" class="radio-group">
                            <div v-for="opt in question.options" class="radio-option">
                                <input type="radio" :name="question.id" :id="'opt-'+question.id+'-'+opt" :value="opt">
                                <label :for="'opt-'+question.id+'-'+opt">@{{ opt }}</label>
                            </div>
                        </div>
                        
                        <div v-if="question.type === 'checkbox-group'" class="checkbox-group">
                            <div v-for="opt in question.options" class="checkbox-option">
                                <input type="checkbox" :id="'chk-'+question.id+'-'+opt" :value="opt">
                                <label :for="'chk-'+question.id+'-'+opt">@{{ opt }}</label>
                            </div>
                        </div>

                        <div class="question-controls">
                            <button @click.stop="removeQuestion(index)" class="btn-icon danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JSON Display -->
            <div v-if="showJson" class="json-display">@{{ JSON.stringify(questions, null, 2) }}</div>
        </div>

        <!-- Settings Panel (Right) -->
        <div v-if="selectedQuestionIndex !== null" class="settings-panel">
            <div class="settings-header">
                <i class="fas fa-cog"></i>
                Question Settings
            </div>

            <div class="settings-group">
                <label>Label</label>
                <input type="text" class="form-control" v-model="questions[selectedQuestionIndex].label" placeholder="Question label">
            </div>

            <div v-if="['text'].includes(questions[selectedQuestionIndex].type)" class="settings-group">
                <label>Placeholder</label>
                <input type="text" class="form-control" v-model="questions[selectedQuestionIndex].placeholder" placeholder="Placeholder text">
            </div>

            <div v-if="['select', 'checkbox-group', 'radio-group'].includes(questions[selectedQuestionIndex].type)" class="settings-group">
                <label>Options</label>
                <div v-for="(option, index) in questions[selectedQuestionIndex].options" class="option-row">
                    <input type="text" class="form-control" v-model="questions[selectedQuestionIndex].options[index]" placeholder="Option">
                    <button @click="removeOption(questions[selectedQuestionIndex], index)" class="btn-icon danger">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <button @click="addOption(questions[selectedQuestionIndex])" class="btn" style="margin-top: 8px; width: 100%;">
                    <i class="fas fa-plus"></i>
                    Add Option
                </button>
            </div>

            <div class="settings-group">
                <label>Description</label>
                <textarea class="form-control" v-model="questions[selectedQuestionIndex].description" placeholder="Help text or description" rows="3"></textarea>
            </div>

            <div class="settings-group">
                <label class="checkbox-label">
                    <input type="checkbox" v-model="questions[selectedQuestionIndex].required">
                    <span>Required</span>
                </label>
            </div>

            <div v-if="questions[selectedQuestionIndex].type === 'section-title'" class="settings-group">
                <label>Section Style</label>
                <select class="form-control" v-model="questions[selectedQuestionIndex].style">
                    <option value="h3">Heading with line</option>
                    <option value="h2">Large heading</option>
                    <option value="h4">Small heading</option>
                </select>
            </div>

            <div class="settings-group" style="margin-top: 30px;">
                <button @click="duplicateQuestion(selectedQuestionIndex)" class="btn" style="width: 100%;">
                    <i class="fas fa-copy"></i>
                    Duplicate Question
                </button>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" style="display: none;" class="modal-overlay" onclick="closePreview()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2>Form Preview</h2>
            <button onclick="closePreview()" class="modal-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="popup-form-content"></div>
        </div>
    </div>
</div>


    <!-- Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <script>
        new Vue({
            el: '#app',
            data: {
                toolboxItems: [
                    // Basic Inputs
                    { 
                        type: 'text', 
                        label: 'Text Input', 
                        icon: '<i class="fas fa-font"></i>',
                        color: '#eff6ff',
                        category: 'basic'
                    },
                    { 
                        type: 'textarea', 
                        label: 'Long Text', 
                        icon: '<i class="fas fa-align-left"></i>',
                        color: '#ecfdf5',
                        category: 'basic'
                    },
                    { 
                        type: 'number', 
                        label: 'Number', 
                        icon: '<i class="fas fa-hashtag"></i>',
                        color: '#fffbeb',
                        category: 'basic'
                    },
                    { 
                        type: 'email', 
                        label: 'Email', 
                        icon: '<i class="fas fa-envelope"></i>',
                        color: '#eff6ff',
                        category: 'basic'
                    },

                    // Choice Elements
                    { 
                        type: 'radio-group', 
                        label: 'Single Choice', 
                        icon: '<i class="far fa-dot-circle"></i>',
                        color: '#ecfdf5',
                        category: 'choice'
                    },
                    { 
                        type: 'checkbox-group', 
                        label: 'Multiple Choice', 
                        icon: '<i class="fas fa-check-square"></i>',
                        color: '#fef2f2',
                        category: 'choice'
                    },
                    { 
                        type: 'select', 
                        label: 'Dropdown', 
                        icon: '<i class="fas fa-chevron-down"></i>',
                        color: '#f5f3ff',
                        category: 'choice'
                    },
                    { 
                        type: 'toggle', 
                        label: 'Toggle', 
                        icon: '<i class="fas fa-toggle-on"></i>',
                        color: '#ecfdf5',
                        category: 'choice'
                    },

                    // Date & Time
                    { 
                        type: 'date', 
                        label: 'Date', 
                        icon: '<i class="fas fa-calendar-alt"></i>',
                        color: '#f0fdf9',
                        category: 'datetime'
                    },
                    { 
                        type: 'time', 
                        label: 'Time', 
                        icon: '<i class="fas fa-clock"></i>',
                        color: '#f5f3ff',
                        category: 'datetime'
                    },

                    // Special Inputs
                    { 
                        type: 'file', 
                        label: 'File Upload', 
                        icon: '<i class="fas fa-upload"></i>',
                        color: '#fef2f2',
                        category: 'special'
                    },
                    { 
                        type: 'signature', 
                        label: 'Signature', 
                        icon: '<i class="fas fa-signature"></i>',
                        color: '#eff6ff',
                        category: 'special'
                    },
                    { 
                        type: 'rating', 
                        label: 'Rating', 
                        icon: '<i class="fas fa-star"></i>',
                        color: '#fffbeb',
                        category: 'special'
                    },
                    { 
                        type: 'range', 
                        label: 'Range Slider', 
                        icon: '<i class="fas fa-sliders-h"></i>',
                        color: '#ecfdf5',
                        category: 'special'
                    },

                    // Layout Elements
                    { 
                        type: 'section-title', 
                        label: 'Section Title', 
                        icon: '<i class="fas fa-heading"></i>',
                        color: '#f0fdf4',
                        category: 'layout'
                    },
                    { 
                        type: 'divider', 
                        label: 'Divider', 
                        icon: '<i class="fas fa-minus"></i>',
                        color: '#f8fafc',
                        category: 'layout'
                    }
                ],
                questions: [],
                draggedType: '',
                draggedIndex: null,
                previewMode: false,
                showJson: false,
                selectedQuestionIndex: null,
                activeToolboxCategory: 'basic'
            },
            methods: {
                startDrag(type) {
                    this.draggedType = type;
                },
                startReorder(index) {
                    this.draggedIndex = index;
                },
                reorderQuestion(index) {
                    if (this.draggedIndex !== null && this.draggedIndex !== index) {
                        const moved = this.questions.splice(this.draggedIndex, 1)[0];
                        this.questions.splice(index, 0, moved);
                        this.draggedIndex = null;
                    }
                },
                onDrop() {
                    if (this.draggedType) {
                        const question = {
                            id: 'q-' + Date.now(),
                            type: this.draggedType,
                            label: this.getDefaultLabel(this.draggedType),
                            required: false
                        };
                        
                        // Set type-specific defaults
                        switch(this.draggedType) {
                            case 'section-title':
                                question.style = 'h3';
                                break;
                            case 'select':
                            case 'checkbox-group':
                            case 'radio-group':
                                question.options = ['Option 1', 'Option 2'];
                                break;
                            case 'rating':
                                question.max = 5;
                                question.icon = 'star';
                                break;
                            case 'range':
                                question.min = 0;
                                question.max = 100;
                                question.step = 1;
                                break;
                            case 'toggle':
                                question.defaultValue = false;
                                break;
                        }
                        
                        this.questions.push(question);
                        this.draggedType = '';
                        this.selectedQuestionIndex = this.questions.length - 1;
                    }
                },
                getDefaultLabel(type) {
                    const defaults = {
                        'text': 'Text Input',
                        'textarea': 'Long Text',
                        'number': 'Number Input',
                        'email': 'Email Address',
                        'radio-group': 'Select One',
                        'checkbox-group': 'Select Multiple',
                        'select': 'Dropdown',
                        'toggle': 'Toggle Option',
                        'date': 'Select Date',
                        'time': 'Select Time',
                        'datetime-local': 'Select Date & Time',
                        'file': 'Upload File',
                        'signature': 'Signature',
                        'rating': 'Rating',
                        'range': 'Range',
                        'section-title': 'Section Title',
                        'divider': '',
                        'html': 'Custom Content',
                        'page-break': ''
                    };
                    return defaults[type] || '';
                },
                addOption(question) {
                    if (!question.options) question.options = [];
                    const optionCount = question.options.length + 1;
                    question.options.push(`Option ${optionCount}`);
                },
                removeOption(question, index) {
                    question.options.splice(index, 1);
                },
                removeQuestion(index) {
                    this.questions.splice(index, 1);
                    if (this.selectedQuestionIndex === index) {
                        this.selectedQuestionIndex = null;
                    } else if (this.selectedQuestionIndex > index) {
                        this.selectedQuestionIndex--;
                    }
                },
                selectQuestion(index) {
                    this.selectedQuestionIndex = index;
                },
                duplicateQuestion(index) {
                    const question = JSON.parse(JSON.stringify(this.questions[index]));
                    question.id = 'q-' + Date.now();
                    this.questions.splice(index + 1, 0, question);
                    this.selectedQuestionIndex = index + 1;
                },
                undo() { 
                    alert('Undo functionality would be implemented with a history stack');
                },
                redo() { 
                    alert('Redo functionality would be implemented with a history stack');
                },
                addPage() { 
                    alert('Multi-page support would be implemented by managing multiple question arrays');
                },
                exportFormJSON() {
                    return JSON.stringify(this.questions, null, 2);
                },
                generateFormHTML() {
                    let html = `
                        <form style="padding:30px; max-width:700px; margin:0 auto; font-family:Poppins, sans-serif; background:#fff; border-radius:16px; box-shadow:0 8px 24px rgba(0,0,0,0.1);">
                    `;

                    this.questions.forEach(q => {
                        html += `<div style="margin-bottom:24px;">`;

                        // Section title
                        if (q.type === 'section-title' && q.label) {
                            html += `
                                <h3 style="font-size:1.4rem; margin-bottom:16px; border-bottom:2px solid var(--gradient-color-1); padding-bottom:8px; color:var(--gradient-color-1); font-weight:600;">
                                    ${q.label}
                                </h3>
                            `;
                        }

                        // Label for inputs
                        if (q.type !== 'section-title' && q.label) {
                            html += `
                                <label style="display:block; margin-bottom:8px; font-weight:600; font-size:1rem; color:#374151;">
                                    ${q.label}
                                    ${q.required ? '<span style="color:#ef4444;">*</span>' : ''}
                                </label>
                            `;
                        }

                        // Description
                        if (q.description) {
                            html += `
                                <p style="margin-bottom:12px; color:#6b7280; font-size:0.9rem;">
                                    ${q.description}
                                </p>
                            `;
                        }

                        // Inputs
                        const commonInputStyle = 'width:100%; padding:12px 16px; border:2px solid #d1d5db; border-radius:10px; font-size:1rem; transition:all 0.3s; font-family:inherit;';

                        switch (q.type) {
                            case 'text':
                            case 'email':
                            case 'number':
                                html += `<input type="${q.type}" placeholder="${q.placeholder || ''}" style="${commonInputStyle}">`;
                                break;
                            case 'textarea':
                                html += `<textarea placeholder="${q.placeholder || ''}" style="${commonInputStyle} height:120px; resize:vertical;"></textarea>`;
                                break;
                            case 'select':
                                html += `<select style="${commonInputStyle} background:#fff;">`;
                                (q.options || []).forEach(opt => {
                                    html += `<option>${opt}</option>`;
                                });
                                html += `</select>`;
                                break;
                            case 'radio-group':
                                html += `<div style="display:flex; flex-direction:column; gap:12px;">`;
                                (q.options || []).forEach(opt => {
                                    html += `
                                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; padding:8px; border-radius:8px; transition:all 0.3s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'">
                                            <input type="radio" name="${q.id}" value="${opt}" style="margin:0;"> 
                                            <span>${opt}</span>
                                        </label>
                                    `;
                                });
                                html += `</div>`;
                                break;
                            case 'checkbox-group':
                                html += `<div style="display:flex; flex-direction:column; gap:12px;">`;
                                (q.options || []).forEach(opt => {
                                    html += `
                                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; padding:8px; border-radius:8px; transition:all 0.3s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'">
                                            <input type="checkbox" value="${opt}" style="margin:0;"> 
                                            <span>${opt}</span>
                                        </label>
                                    `;
                                });
                                html += `</div>`;
                                break;
                        }

                        html += `</div>`;
                    });

                    html += `
                        <button type="submit" style="padding:16px 32px; background:linear-gradient(135deg, var(--gradient-color-1), var(--gradient-color-2)); color:#fff; font-weight:600; font-size:1.1rem; border:none; border-radius:12px; cursor:pointer; transition:all 0.3s; font-family:inherit; box-shadow:0 4px 12px rgba(111, 66, 193, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(111, 66, 193, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(111, 66, 193, 0.3)'">
                            Submit Form
                        </button>
                    `;

                    html += '</form>';
                    return html;
                },
                showFormPreview() {
                    const formHTML = this.generateFormHTML();
                    document.getElementById('popup-form-content').innerHTML = formHTML;
                    document.getElementById('previewModal').style.display = 'flex';
                },
                closePreview() {
                    console.log("closing");                  
                      document.getElementById('previewModal').style.display = 'none';
                },
                async testFetch() {
                    try {
                        const formData = this.exportFormJSON();
                        const response = await fetch('/show-string', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'text/plain',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData 
                        });
                        
                        const result = await response.text();
                        alert('Form saved successfully!');
                        console.log('Form saved:', result);
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error saving form: ' + error.message);
                    }
                }
            },
            mounted() {
                const saved = localStorage.getItem('formBuilderData');
                if (saved) {
                    try {
                        this.questions = JSON.parse(saved);
                    } catch (e) {
                        console.error('Failed to parse saved form data', e);
                    }
                }
            },
            watch: {
                questions: {
                    handler() {
                        localStorage.setItem('formBuilderData', JSON.stringify(this.questions));
                    },
                    deep: true
                }
            }
        });
    </script>
    <script>
       function closePreview() {
                    console.log("closing");                  
                      document.getElementById('previewModal').style.display = 'none';
                }
    </script>
</body>
</html>

