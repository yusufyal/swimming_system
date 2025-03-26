setTimeout(function() {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
        successMessage.style.display = 'none';
    }
}, 5000);

setTimeout(function() {
    var errorMessage = document.getElementById('error-messages');
    if (errorMessage) {
        errorMessage.style.display = 'none';
    }
}, 5000);