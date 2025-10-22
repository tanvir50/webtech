// Form Validation
function validateForm() {
    let firstName = document.getElementById('firstname').value;
    let lastName = document.getElementById('lastname').value;
    let email = document.getElementById('email').value;

    // Check if required fields are empty
    if (firstName === '' || lastName === '' || email === '') {
        alert('Please fill out all required fields.');
        return false; // Prevent form submission if required fields are empty
    }

    return true; // Proceed with form submission if validation is passed
}

// Donation Amount Calculation and Display
function updateDonationMessage() {
    let donationAmount = document.querySelector('input[name="donation_ammount"]:checked');
    let otherAmount = document.getElementById('other_ammount').value;

    let message = '';

    // Check if a donation amount has been selected
    if (donationAmount) {
        message = `You selected a donation amount of $${donationAmount.value}.`;
    } else if (otherAmount) {
        message = `You entered a donation amount of $${otherAmount}.`;
    } else {
        message = 'You have not selected a donation amount.';
    }

    // Display the donation amount message
    document.getElementById('donationMessage').innerText = message;
}

// Listen to changes in donation amount and other amount fields
document.querySelectorAll('input[name="donation_ammount"]').forEach((radio) => {
    radio.addEventListener('change', updateDonationMessage); // Update the message when a radio button is selected
});

document.getElementById('other_ammount').addEventListener('input', updateDonationMessage); // Update the message when the "Other Amount" field is changed
