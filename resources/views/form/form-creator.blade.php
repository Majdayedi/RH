@extends('layouts.form1')

@section('content')
<div id="app" style="display: flex; height: 100vh; font-family: Inter, Arial, sans-serif;">

    {{-- Toolbox (Left) --}}
    <div style="width: 280px; background: #f8fafc; padding: 15px; border-right: 1px solid #e2e8f0; display: flex; flex-direction: column;">
        <div style="margin-bottom: 20px;">
            <h3 style="color: #1e293b; font-size: 18px; font-weight: 600;">{{ $company->legal_name }}</h3>
            <p style="color: #64748b; font-size: 14px;">Resignation Form</p>
        </div>

        <h4 style="color: #334155; font-size: 15px; font-weight: 500; margin-bottom: 15px;">Toolbox</h4>
        <div style="height: 600px; overflow-y: auto; padding-right: 8px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
            <div v-for="item in toolboxItems"
                 :key="item.type"
                 class="toolbox-card"
                 draggable="true"
                 @dragstart="startDrag(item.type)"
                 :style="{ backgroundColor: item.color }">
                <div class="toolbox-icon">
                    <span v-html="item.icon"></span>
                </div>
                <div class="toolbox-label">@{{ item.label }}</div>
            </div>
        </div>
    </div>

    {{-- Main Content (Center) --}}
    <div style="flex: 1; padding: 20px; display: flex; flex-direction: column; background: #f9fafb;">

        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <button @click="undo" class="btn secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10h10a10 10 0 0 1 10 10v2M3 10l6-6M3 10l6 6"/></svg>
                Undo
            </button>
            <button @click="redo" class="btn secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10H11a10 10 0 0 0-10 10v2M21 10l-6-6M21 10l-6 6"/></svg>
                Redo
            </button>
            <button @click="addPage" class="btn secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Add Page
            </button>
            <button @click="showFormPreview" class="btn" :class="{ 'active': previewMode }">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
    Preview
</button>
            <div style="flex: 1;"></div>
            <button @click="saveToLocalStorage" class="btn secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                Save
            </button>
            <button @click="showJson = !showJson" class="btn secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2z"></path><path d="M10 8h4"></path><path d="M10 12h4"></path><path d="M10 16h4"></path></svg>
                JSON
            </button>
        </div>

        <div style="margin-bottom: 20px;">
            <h3 style="color: #334155; font-size: 16px; font-weight: 500;">Pages</h3>
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="background: #e2e8f0; padding: 4px 12px; border-radius: 20px; font-size: 14px;">Page 1</span>
                <button class="btn secondary" @click="addPage">+ Add Page</button>
            </div>
        </div>

        <div class="page-container">
            <h4 style="color: #1e293b; font-size: 20px; font-weight: 600; margin-bottom: 5px;">Drafts/ Resignation form</h4>

            <div class="drop-area" @dragover.prevent @drop="onDrop">

                <div v-if="questions.length === 0" class="empty-drop">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <p>Drag questions here</p>
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
                        <hr>
                    </div>

                    <div v-if="question.type !== 'section-title'">
                        <label v-text="question.label || 'Question label...'"></label>
                        <div v-if="question.description" class="description" v-text="question.description"></div>
                    </div>

                    <div v-if="question.type === 'text'">
                        <input type="text" :placeholder="question.placeholder || ''">
                    </div>
                    
                    <div v-if="question.type === 'select'">
                        <select>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </button>
                    </div>

                </div>

            </div>
        </div>

        <pre v-if="showJson" style="margin-top: 20px; padding: 15px; background: #1e293b; color: #f8fafc; border-radius: 6px;">@{{ JSON.stringify(questions, null, 2) }}</pre>

        
     <div id="myModal" style="
    display:none; 
    position:fixed; 
    top:0; 
    left:0; 
    width:100%; 
    height:100%; 
    background:rgba(0,0,0,0.4); 
    z-index:1000; 
    justify-content:center; 
    align-items:center;
    font-family: Inter, Arial, sans-serif;
">
    <div style="
        background:white; 
        width:90%; 
        max-width:700px; 
        margin:auto; 
        padding:30px; 
        border-radius:16px; 
        box-shadow:0 8px 24px rgba(0,0,0,0.2);
        max-height:85vh; 
        overflow-y:auto;
        display:flex; 
        flex-direction:column;
    ">
        <div style="
            display:flex; 
            justify-content:space-between; 
            align-items:center; 
            margin-bottom:20px;
            border-bottom:1px solid #eee;
            padding-bottom:10px;
        ">
            <h2 style="
                margin:0; 
                font-size:1.5rem; 
                font-weight:600; 
                color:#4f46e5;
            ">
                Form Preview
            </h2>
            <button @click="closePreview" style="
                background:none; 
                border:none; 
                font-size:1.5rem; 
                font-weight:bold; 
                cursor:pointer; 
                color:#999;
                transition:color 0.3s;
            " 
            onmouseover="this.style.color='#4f46e5'" 
            onmouseout="this.style.color='#999'">
                ×
            </button>
        </div>

        <div id="popup-form-content" style="flex:1;"></div>
    </div>
</div>





    </div>

    {{-- Settings Panel (Right) --}}
    <div v-if="selectedQuestionIndex !== null" style="width: 300px; background: #fff; border-left: 1px solid #e2e8f0; padding: 20px; overflow-y: auto;">
        <h3 style="color: #1e293b; font-size: 18px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
            Question Settings
        </h3>

        <div class="settings-group">
            <label>Label</label>
            <input type="text" v-model="questions[selectedQuestionIndex].label" placeholder="Question label">
        </div>

        <div v-if="['text'].includes(questions[selectedQuestionIndex].type)" class="settings-group">
            <label>Placeholder</label>
            <input type="text" v-model="questions[selectedQuestionIndex].placeholder" placeholder="Placeholder text">
        </div>

        <div v-if="['select', 'checkbox-group', 'radio-group'].includes(questions[selectedQuestionIndex].type)" class="settings-group">
            <label>Options</label>
            <div v-for="(option, index) in questions[selectedQuestionIndex].options" class="option-row">
                <input type="text" v-model="questions[selectedQuestionIndex].options[index]" placeholder="Option">
                <button @click="removeOption(questions[selectedQuestionIndex], index)" class="btn-icon danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <button @click="addOption(questions[selectedQuestionIndex])" class="btn secondary" style="margin-top: 5px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Add Option
            </button>
        </div>

        <div class="settings-group">
            <label>Description</label>
            <textarea v-model="questions[selectedQuestionIndex].description" placeholder="Help text or description" rows="3"></textarea>
        </div>

        <div class="settings-group">
            <label class="checkbox-label">
                <input type="checkbox" v-model="questions[selectedQuestionIndex].required">
                <span>Required</span>
            </label>
        </div>

        <div v-if="questions[selectedQuestionIndex].type === 'section-title'" class="settings-group">
            <label>Section Style</label>
            <select v-model="questions[selectedQuestionIndex].style" style="width: 100%;">
                <option value="h3">Heading with line</option>
                <option value="h2">Large heading</option>
                <option value="h4">Small heading</option>
            </select>
        </div>

        <div class="settings-group" style="margin-top: 20px;">
            <button @click="duplicateQuestion(selectedQuestionIndex)" class="btn secondary" style="width: 100%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                Duplicate
            </button>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>



{{-- Vue App --}}
<script>
    new Vue({
        el: '#app',
        data: {
            toolboxItems: [
                // Basic Inputs
                { 
                    type: 'text', 
                    label: 'Text Input', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>',
                    color: '#eff6ff',
                    category: 'basic'
                },
                { 
                    type: 'textarea', 
                    label: 'Long Text', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>',
                    color: '#ecfdf5',
                    category: 'basic'
                },
                { 
                    type: 'number', 
                    label: 'Number', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path><path d="M9 10h6"></path><path d="M12 7v6"></path></svg>',
                    color: '#fffbeb',
                    category: 'basic'
                },
                { 
                    type: 'email', 
                    label: 'Email', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
                    color: '#eff6ff',
                    category: 'basic'
                },

                // Choice Elements
                { 
                    type: 'radio-group', 
                    label: 'Single Choice', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle></svg>',
                    color: '#ecfdf5',
                    category: 'choice'
                },
                { 
                    type: 'checkbox-group', 
                    label: 'Multiple Choice', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>',
                    color: '#fef2f2',
                    category: 'choice'
                },
                { 
                    type: 'select', 
                    label: 'Dropdown', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>',
                    color: '#f5f3ff',
                    category: 'choice'
                },
                { 
                    type: 'toggle', 
                    label: 'Toggle', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="5" width="22" height="14" rx="7"></rect><circle cx="8" cy="12" r="3"></circle></svg>',
                    color: '#ecfdf5',
                    category: 'choice'
                },

                // Date & Time
                { 
                    type: 'date', 
                    label: 'Date', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',
                    color: '#f0fdf9',
                    category: 'datetime'
                },
                { 
                    type: 'time', 
                    label: 'Time', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
                    color: '#f5f3ff',
                    category: 'datetime'
                },
                { 
                    type: 'datetime-local', 
                    label: 'Date & Time', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
                    color: '#eff6ff',
                    category: 'datetime'
                },

                // Special Inputs
                { 
                    type: 'file', 
                    label: 'File Upload', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>',
                    color: '#fef2f2',
                    category: 'special'
                },
                { 
                    type: 'signature', 
                    label: 'Signature', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21h12a2 2 0 0 0 2-2v-2H10v2a2 2 0 0 1-4 0V5a2 2 0 0 0-4 0v3h4"></path><path d="m19 17-3-3-3 3"></path><path d="m19 14-3 3-3-3"></path></svg>',
                    color: '#eff6ff',
                    category: 'special'
                },
                { 
                    type: 'rating', 
                    label: 'Rating', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>',
                    color: '#fffbeb',
                    category: 'special'
                },
                { 
                    type: 'range', 
                    label: 'Range Slider', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M16 12h-6M8 12H2"></path></svg>',
                    color: '#ecfdf5',
                    category: 'special'
                },

                // Layout Elements
                { 
                    type: 'section-title', 
                    label: 'Section Title', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
                    color: '#f0fdf4',
                    category: 'layout'
                },
                { 
                    type: 'divider', 
                    label: 'Divider', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>',
                    color: '#f8fafc',
                    category: 'layout'
                },
                { 
                    type: 'html', 
                    label: 'HTML Content', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>',
                    color: '#f0fdf9',
                    category: 'layout'
                },
                { 
                    type: 'page-break', 
                    label: 'Page Break', 
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>',
                    color: '#fef2f2',
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
        computed: {
            filteredToolboxItems() {
                return this.toolboxItems.filter(item => item.category === this.activeToolboxCategory);
            }
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
            
              saveToLocalStorage() {
    localStorage.setItem('formBuilderData', JSON.stringify(this.questions));
    // This saves the form configuration as JSON

            },
            loadFromLocalStorage() {
    const saved = localStorage.getItem('formBuilderData');
    if (saved) {
        this.questions = JSON.parse(saved); // This loads form from JSON
        alert('Form loaded from browser storage!');
    }
},
            exportForm() {
                this.showJson = true;
                // In a real app, you might want to implement actual export functionality
            },
            importForm(json) {
                try {
                    const data = JSON.parse(json);
                    this.questions = data;
                    this.showJson = false;
                    alert('Form imported successfully!');
                } catch (e) {
                    alert('Invalid JSON format');
                }
            },
            setToolboxCategory(category) {
                this.activeToolboxCategory = category;
            },
            undo() { 
                // Implement undo functionality with a history stack
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
    
    importFormJSON(jsonString) {
        try {
            const parsed = JSON.parse(jsonString);
            this.questions = parsed;
            return true;
        } catch (e) {
            console.error("Invalid JSON", e);
            return false;
        }
    },
    generateFormHTML() {
    let html = `
        <form style="padding:20px; max-width:600px; margin:0 auto; font-family:Inter, Arial, sans-serif; background:#fff; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
    `;

    this.questions.forEach(q => {
        html += `<div style="margin-bottom:20px;">`;

        // Section title
        if (q.type === 'section-title' && q.label) {
            html += `
                <h3 style="font-size:1.25rem; margin-bottom:10px; border-bottom:1px solid #eee; padding-bottom:5px; color:#4f46e5;">
                    ${q.label}
                </h3>
            `;
        }

        // Label for inputs
        if (q.type !== 'section-title' && q.label) {
            html += `
                <label style="display:block; margin-bottom:6px; font-weight:600; font-size:0.95rem; color:#333;">
                    ${q.label}
                </label>
            `;
        }

        // Inputs
        const commonInputStyle = 'width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:1rem;';

        switch (q.type) {
            case 'text':
            case 'email':
            case 'number':
                html += `<input type="${q.type}" placeholder="${q.placeholder || ''}" style="${commonInputStyle}">`;
                break;
            case 'textarea':
                html += `<textarea placeholder="${q.placeholder || ''}" style="${commonInputStyle} height:100px; resize:vertical;"></textarea>`;
                break;
            case 'select':
                html += `<select style="${commonInputStyle} appearance:none; background:#fff;">`;
                (q.options || []).forEach(opt => {
                    html += `<option>${opt}</option>`;
                });
                html += `</select>`;
                break;
            case 'radio-group':
                html += `<div style="display:flex; flex-direction:column; gap:8px;">`;
                (q.options || []).forEach(opt => {
                    html += `
                        <label style="display:flex; align-items:center; gap:8px;">
                            <input type="radio" name="${q.id}" value="${opt}"> ${opt}
                        </label>
                    `;
                });
                html += `</div>`;
                break;
            case 'checkbox-group':
                html += `<div style="display:flex; flex-direction:column; gap:8px;">`;
                (q.options || []).forEach(opt => {
                    html += `
                        <label style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" value="${opt}"> ${opt}
                        </label>
                    `;
                });
                html += `</div>`;
                break;
        }

        html += `</div>`;
    });

    html += `
        <button type="submit" style="padding:12px 20px; background:#4f46e5; color:#fff; font-weight:bold; font-size:1rem; border:none; border-radius:8px; cursor:pointer; transition:background 0.3s;">
            Submit
        </button>
    `;

    html += '</form>';

    return html;
}
,
    showFormPreview() {
        const formHTML = this.generateFormHTML();
        document.getElementById('popup-form-content').innerHTML = formHTML;
        document.getElementById('myModal').style.display = 'block';
    },
    
    closePreview() {
        document.getElementById('myModal').style.display = 'none';
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
        }
    });
</script>

@endsection