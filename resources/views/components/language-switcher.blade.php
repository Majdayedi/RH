<!-- Language Switcher Component -->
<div class="language-switcher" style="{{ $style ?? '' }}">
    <select onchange="switchLanguage(this.value)" 
            style="padding: {{ $padding ?? '10px 15px' }}; border-radius: {{ $borderRadius ?? '10px' }}; border: 2px solid #e2e8f0; background: white; font-size: 14px; cursor: pointer;">
        @foreach($availableLanguages as $code => $language)
            <option value="{{ $code }}" {{ $currentLocale == $code ? 'selected' : '' }}>
                {{ $language['flag'] }} {{ $language['name'] }}
            </option>
        @endforeach
    </select>
</div>

<script>
    function switchLanguage(language) {
        window.location.href = '/language/' + language;
    }
</script>
