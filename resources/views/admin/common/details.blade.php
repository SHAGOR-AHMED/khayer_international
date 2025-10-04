<div class="col-md-4">

    <div class="form-group">
        <label>Agent Name: </label>
        {{ $single->agent->name }}
    </div>

    <div class="form-group">
        <label>RL No: </label>
        {{ $single->rl_no }}
    </div>

    <div class="form-group">
        <label>Country: </label>
        {{ $single->country }}
    </div>

    <div class="form-group">
        <label>Passenger Name: </label>
        {{ $single->user->name }}
    </div>

    <div class="form-group">
        <label>Profession: </label>
        {{ $single->profession ? $single->profession : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Office Visa: </label>
        {{ $single->office_visa ? $single->office_visa : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Processing: </label>
        {{ $single->processing ? $single->processing : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Sponsor No: </label>
        {{ $single->sponsor_no ? $single->sponsor_no : 'N/A' }}
    </div>

    <div class="form-group">
        <label for="password">PC Ref No:</label>
        {{ $single->pc_ref_no ? $single->pc_ref_no : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Test Medical Report:</label>
        {{ $single->medical_report }}
    </div>

    <div class="form-group">
        <label>GCC Medical Report:</label>
        {{ $single->gcc_medical_report }}
    </div>

    <div class="form-group">
        <label>Entry Date:</label>
        {{ $single->created_at }}
    </div>

    <div class="form-group">
        <label>Note: </label>
        {{ $single->note ? $single->note : 'N/A' }}
    </div>

</div>

<div class="col-md-4">

    <div class="form-group">
        <label>Visa NO: </label>
        {{ $single->visa_no ? $single->visa_no : 'N/A' }}
    </div>

    <div class="form-group">
        <label>ID NO: </label>
        {{ $single->id_no ? $single->id_no : 'N/A' }}
    </div>

    <div class="form-group">
        <label>WAKALA Date: </label>
        {{ $single->wakala_date ? $single->wakala_date : 'N/A' }}
    </div>

    <div class="form-group">
        <label>MOFA NO: </label>
        {{ $single->mofa_no ? $single->mofa_no : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Tasheer Finger Date: </label>
        {{ $single->tasheer_finger_date ? $single->tasheer_finger_date : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Visa Issued Date: </label>
        {{ $single->visa_issued_date ? $single->visa_issued_date : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Finger And TTC Note: </label>
        {{ $single->finger_ttc_note ? $single->finger_ttc_note : 'N/A' }}
    </div>

    <div class="form-group">
        <label>Manpower Date: </label>
        {{ $single->manpower_date ? $single->manpower_date : 'N/A' }}
    </div>

</div>
