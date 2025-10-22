// Predefined list of product names for autocomplete
const productNames = [];

// Fetching products from ajax.json
fetch('ajax.json')  // Make sure the file is in the correct path
    .then(response => response.json())  // Parse the JSON response
    .then(data => {
        // Store the product names for the autocomplete functionality
        data.forEach(product => {
            productNames.push(product.name);  // Push product names to the array
        });
    })
    .catch(error => console.error('Error loading ajax.json:', error));

// Function to show suggestions based on user input
function showSuggestions(query) {
    const suggestionsBox = document.getElementById('suggestions');
    suggestionsBox.innerHTML = ''; // Clear previous suggestions

    if (query.length === 0) {
        return; // Don't show suggestions if the search bar is empty
    }

    // Filter products based on the search query
    const filteredSuggestions = productNames.filter(product => product.toLowerCase().includes(query.toLowerCase()));

    // Display filtered suggestions
    filteredSuggestions.forEach(suggestion => {
        const suggestionItem = document.createElement('div');
        suggestionItem.classList.add('suggestion-item');
        suggestionItem.textContent = suggestion;
        suggestionItem.onclick = () => selectSuggestion(suggestion); // Set the suggestion when clicked
        suggestionsBox.appendChild(suggestionItem);  // Add the suggestion to the suggestions box
    });
}

// Function to handle the selection of a suggestion
function selectSuggestion(suggestion) {
    document.getElementById('search').value = suggestion; // Set the selected suggestion in the input field
    document.getElementById('suggestions').innerHTML = ''; // Clear suggestions box after selection
}

// Function to update the price range value
document.getElementById('price-range').addEventListener('input', function() {
    document.getElementById('price-val').innerText = this.value;  // Show the selected price range
});
