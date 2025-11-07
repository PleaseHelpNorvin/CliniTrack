$(document).ready(function() {
    // Status select change
    $('#statusSelect').on('change', function () {
        $('#referredToField').toggle(this.value === 'referred');
    });

    // Initialize Select2
    $('#studentSelect').select2({
        placeholder: "-- Search Student --",
        width: '100%'  
    });
});