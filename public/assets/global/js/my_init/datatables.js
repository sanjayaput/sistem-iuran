var DatatableButtons = function() {
    var _componentDatatableButtons = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }
    };
    
    // Select2 for length menu styling
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }
    
        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
    };
    
    return {
        init: function() {
            _componentDatatableButtons();
            _componentSelect2();
        }
    }
    }();
    
    document.addEventListener('DOMContentLoaded', function() {
    DatatableButtons.init();
    });
    