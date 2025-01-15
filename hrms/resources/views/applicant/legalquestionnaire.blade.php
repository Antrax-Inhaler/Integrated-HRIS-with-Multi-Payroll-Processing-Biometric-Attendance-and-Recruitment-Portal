@include('applicant.psdtopbar')

<h1>Legal Questionnaire</h1>

@foreach($questionnaires as $questionnaire)
    <form method="POST" action="/applicant/legal-questionnaire/{{ $questionnaire->id }}">
        @method('PUT')
        @csrf
        <br>
        <p class="character-limit-message">
            Please note: Inputs are limited to 35 characters. Longer entries can appear crowded and may overlap in the PDF form. If you need help shortening your response, feel free to ask our chatbot for assistance.
        </p>
        <br>
        <div class="form-group">
            <label>34. Are you related by consanguinity or affinity to the appointing or recommending authority, or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, </label><br>
            <label>a. within the third degree:</label>
            <input type="radio" name="related_to_authority_within_third_degree" value="1" {{ $questionnaire->related_to_authority_within_third_degree ? 'checked' : '' }} onclick="toggleInput(this)"> YES
            <input type="radio" name="related_to_authority_within_third_degree" value="0" {{ !$questionnaire->related_to_authority_within_third_degree ? 'checked' : '' }} onclick="toggleInput(this)"> NO
            <input type="text" name="relation_details" value="{{ $questionnaire->relation_details }}" placeholder="If YES, give details:" {{ !$questionnaire->related_within_third_degree ? 'disabled' : '' }}>
        </div>
        <div class="form-group">
            <label>b. within the fourth degree (for Local Government Unit - Career Employees)?</label>
            <input type="radio" name="related_to_authority_within_fourth_degree" value="1" {{ $questionnaire->related_to_authority_within_fourth_degree ? 'checked' : '' }} onclick="toggleInput(this)"> YES
            <input type="radio" name="related_to_authority_within_fourth_degree" value="0" {{ !$questionnaire->related_to_authority_within_fourth_degree ? 'checked' : '' }} onclick="toggleInput(this)"> NO
            <input type="text" name="relation_details_fourth_degree" value="{{ $questionnaire->relation_details_fourth_degree }}" placeholder="If YES, give details:" {{ !$questionnaire->criminally_charged ? 'disabled' : '' }}>
        </div>

        <div class="form-group">
            <label>35. a. Have you ever been found guilty of any administrative offense?</label>
            <input type="radio" name="found_guilty_of_offense" value="1" {{ $questionnaire->found_guilty_of_offense ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="found_guilty_of_offense" value="0" {{ !$questionnaire->found_guilty_of_offense ? 'checked' : '' }} onclick="toggleInput(this)"> NO
            <input type="text" name="offense_details" value="{{ $questionnaire->offense_details }}" placeholder="If YES, give details:" {{ !$questionnaire->found_guilty ? 'disabled' : '' }}>
        </div>

        <div class="form-group">
            <label>b. Have you been criminally charged before any court?</label>
            <input type="radio" name="criminally_charged" value="1" {{ $questionnaire->criminally_charged ? 'checked' : '' }} onclick="toggleInput(this)"> YES
            <input type="radio" name="criminally_charged" value="0" {{ !$questionnaire->criminally_charged ? 'checked' : '' }} onclick="toggleInput(this)"> NO
            <input type="text" name="criminal_charge_details" value="{{ $questionnaire->criminal_charge_details }}" placeholder="If YES, give details:" {{ !$questionnaire->criminally_charged ? 'disabled' : '' }}>
            <label>Date Filed:</label>
            <input type="date" name="criminal_charge_date" value="{{ $questionnaire->criminal_charge_date }}" {{ !$questionnaire->criminally_charged ? 'disabled' : '' }}>
            <label>Status of Case/s:</label>
            <input type="text" name="criminal_charge_status" value="{{ $questionnaire->criminal_charge_status }}" {{ !$questionnaire->criminally_charged ? 'disabled' : '' }}>
        </div>
        

<!-- Question 36 -->
<div class="form-group">
    <label>36. Have you ever been convicted of any crime or violation of any law, decree, ordinance, or regulation by any court or tribunal?</label>
    <input type="radio" name="convicted_of_crime" value="1" {{ $questionnaire->convicted_of_crime ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="convicted_of_crime" value="0" {{ !$questionnaire->convicted_of_crime ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="conviction_details" value="{{ $questionnaire->conviction_details }}" placeholder="If YES, give details:" {{ !$questionnaire->convicted_crime ? 'disabled' : '' }}>
</div>

<!-- Question 37 -->
<div class="form-group">
    <label>37. Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract, or phased out (abolition) in the public or private sector?</label>
    <input type="radio" name="separated_from_service" value="1" {{ $questionnaire->separated_from_service ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="separated_from_service" value="0" {{ !$questionnaire->separated_from_service ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="separation_details" value="{{ $questionnaire->separation_details }}" placeholder="If YES, give details:" {{ !$questionnaire->separated_service ? 'disabled' : '' }}>
</div>

<!-- Question 38 -->
<div class="form-group">
    <label>38. a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</label>
    <input type="radio" name="election_candidate" value="1" {{ $questionnaire->election_candidate ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="election_candidate" value="0" {{ !$questionnaire->election_candidate ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="election_details" value="{{ $questionnaire->election_details }}" placeholder="If YES, give details:" {{ !$questionnaire->election_candidate ? 'disabled' : '' }}>
    
    <label>b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</label>
    <input type="radio" name="resigned_for_campaign" value="1" {{ $questionnaire->resigned_for_campaign ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="resigned_for_campaign" value="0" {{ !$questionnaire->resigned_for_campaign ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="resignation_details" value="{{ $questionnaire->resignation_details }}" placeholder="If YES, give details:" {{ !$questionnaire->resigned_to_campaign ? 'disabled' : '' }}>
</div>

<!-- Question 39 -->
<div class="form-group">
    <label>39. Have you acquired the status of an immigrant or permanent resident of another country?</label>
    <input type="radio" name="immigrant_status" value="1" {{ $questionnaire->immigrant_status ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="immigrant_status" value="0" {{ !$questionnaire->immigrant_status ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="immigrant_country" value="{{ $questionnaire->immigrant_country }}" placeholder="If YES, give details (country):" {{ !$questionnaire->immigrant_status ? 'disabled' : '' }}>
</div>

<!-- Question 40 -->
<div class="form-group">
    <label>40. Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:</label><br>
    
    <label>a. Are you a member of any indigenous group?</label>
    <input type="radio" name="indigenous_group_member" value="1" {{ $questionnaire->indigenous_group_member ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="indigenous_group_member" value="0" {{ !$questionnaire->indigenous_group_member ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="indigenous_group_details" value="{{ $questionnaire->indigenous_group_details }}" placeholder="If YES, please specify:" {{ !$questionnaire->indigenous_group ? 'disabled' : '' }}>
    
    <label>b. Are you a person with disability?</label>
    <input type="radio" name="person_with_disability" value="1" {{ $questionnaire->person_with_disability ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="person_with_disability" value="0" {{ !$questionnaire->person_with_disability ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="disability_id_number" value="{{ $questionnaire->disability_id_number }}" placeholder="If YES, please specify ID No.:" {{ !$questionnaire->person_with_disability ? 'disabled' : '' }}>
    
    <label>c. Are you a solo parent?</label>
    <input type="radio" name="solo_parent" value="1" {{ $questionnaire->solo_parent ? 'checked' : '' }} onclick="toggleInput(this)"> YES
    <input type="radio" name="solo_parent" value="0" {{ !$questionnaire->solo_parent ? 'checked' : '' }} onclick="toggleInput(this)"> NO
    <input type="text" name="solo_parent_id_number" value="{{ $questionnaire->solo_parent_id_number }}" placeholder="If YES, please specify ID No.:" {{ !$questionnaire->solo_parent ? 'disabled' : '' }}>
</div>

        <button class="submit-button" type="submit">Update</button>
    </form>

    <form method="POST" action="/applicant/legal-questionnaire/{{ $questionnaire->id }}">
        @method('DELETE')
        @csrf
        {{-- <button type="submit">Delete</button> --}}
    </form>
@endforeach
<div class="navigation-buttons">
    <button id="back-button" class="nav-button" onclick="goBack()">Back</button>
    <button id="next-button" class="nav-button" onclick="goNext()">Next</button>
</div>
</div>
</body>
<script>
    function goBack() {
        window.location.href = '/applicant/other-information';
    }
    
    function goNext() {
        window.location.href = '/applicant/references';
    }
</script>

<!-- JavaScript to enable/disable inputs based on radio button selection -->
<script>
    function toggleInput(element) {
        const formGroup = element.closest('.form-group');
        const relatedInputs = formGroup.querySelectorAll('input[type="text"], input[type="date"]');
    
        // Enable or disable inputs based on selected radio button
        if (element.value === '1') {  // When "Yes" (value 1) is selected
            relatedInputs.forEach(input => {
                input.disabled = false;  // Enable the inputs
            });
        } else {  // When "No" (value 0) is selected
            relatedInputs.forEach(input => {
                input.disabled = true;  // Disable the inputs
                input.value = '';  // Clear the input values
            });
        }
    }
    
    // Initialize the state of all inputs based on their respective radio button selections
    document.querySelectorAll('input[type="radio"]:checked').forEach(radio => toggleInput(radio));
    
    </script>
    <script>
        // Function to enforce character limit on all text inputs
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.length > 35) {
                    this.value = this.value.slice(0, 35);  // Truncate to 35 characters
                }
            });
        });
    </script>
