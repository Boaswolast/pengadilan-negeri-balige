// script.js
document.getElementById('formDataDiri').addEventListener('submit', function(event) {
    event.preventDefault();
    var isValid = true;
  
    // Clear previous errors
    document.getElementById('statusPihakError').textContent = '';
  
    // Validate select input
    var statusPihakSelect = document.querySelector('select[name="status_pihak"]');
    if (!statusPihakSelect.value) {
      isValid = false;
      document.getElementById('statusPihakError').textContent = 'Status Pihak is required.';
    }
  
    // If the form is valid, you can proceed with form submission or further processing
    if (isValid) {
      // Form is valid, you can submit the form or do further processing here
      console.log('Form is valid!');
      // For demonstration purposes, let's just log the form data
      var formData = new FormData(document.getElementById('myForm'));
      console.log('Status Pihak:', formData.get('status_pihak'));
    }
  });