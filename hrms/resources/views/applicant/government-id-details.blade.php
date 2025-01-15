<form action="{{ route('applicant.government-id-details.storeOrUpdate') }}" method="POST">
    @csrf
    <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
    
    <div class="form-group">
        <label for="government_issued_id">Government Issued ID:</label>
        <input type="text" name="government_issued_id" value="{{ $governmentIdDetail->government_issued_id ?? '' }}">
    </div>

    <div class="form-group">
        <label for="id_license_passport_no">ID/License/Passport No.:</label>
        <input type="text" name="id_license_passport_no" value="{{ $governmentIdDetail->id_license_passport_no ?? '' }}">
    </div>

    <div class="form-group">
        <label for="date_place_of_issuance">Date/Place of Issuance:</label>
        <input type="text" name="date_place_of_issuance" value="{{ $governmentIdDetail->date_place_of_issuance ?? '' }}">
    </div>

    <div class="form-group">
        <label for="date_accomplished">Date Accomplished:</label>
        <input type="date" name="date_accomplished" value="{{ $governmentIdDetail->date_accomplished ?? '' }}">
    </div>

    <div class="form-group">
        <label for="right_thumbmark">Right Thumbmark:</label>
        <input type="checkbox" name="right_thumbmark" value="1" {{ isset($governmentIdDetail) && $governmentIdDetail->right_thumbmark ? 'checked' : '' }}>
    </div>

    <div class="form-group">
        <label for="person_administering_oath">Person Administering Oath:</label>
        <input type="text" name="person_administering_oath" value="{{ $governmentIdDetail->person_administering_oath ?? '' }}">
    </div>

    <button class="submit-button" type="submit">Save</button>
</form>
