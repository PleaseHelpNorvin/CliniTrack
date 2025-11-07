$(document).ready(function() {

    // Function to show/hide fields
    function toggleFields() {
        // Show/hide "Referred To"
        if ($('#statusSelect').val() === 'referred') {
            $('#referredToField').removeClass('d-none').addClass('d-block');
        } else {
            $('#referredToField').removeClass('d-block').addClass('d-none');
        }

        // Show/hide "Other Reason"
        if ($('#reasonSelect').val() === 'other') {
            $('#otherReasonField').removeClass('d-none').addClass('d-block');
        } else {
            $('#otherReasonField').removeClass('d-block').addClass('d-none');
        }
    }

    // Initial check on page load
    toggleFields();

    // Update on select change
    $('#statusSelect, #reasonSelect').on('change', toggleFields);

    // Initialize Select2
    $('#studentSelect').select2({
        placeholder: "-- Search Student --",
        width: '100%'
    });
});
