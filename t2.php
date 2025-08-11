<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form id="advanced-search-form">
    <input type="text" name="keyword" placeholder="Keyword">
    <input type="text" name="location" placeholder="Location">
    <select name="property_type">
        <option value="">Any Type</option>
        <option value="1">Apartment</option>
        <option value="2">House</option>
    </select>
    <input type="number" name="min_price" placeholder="Min Price">
    <input type="number" name="max_price" placeholder="Max Price">
    <button id="advanced-search">Search</button>
</form>

<div id="property-results"></div>



<script>
    document.getElementById('advanced-search').addEventListener('click', function (e) {
    e.preventDefault();

    // Get the form element
    const form = document.getElementById('advanced-search-form');

    // Collect form data
    const formData = new FormData(form);

    // Convert FormData to an object
    const data = {};
    formData.forEach((value, key) => {
        if (value.trim() !== '') {
            data[key] = value; // Add non-empty values to the data object
        }
    });

    // Convert data object to a query string
    const params = new URLSearchParams(data).toString();

    console.log('Request URL:', 'advancedsearch.php?' + params); // Debugging

    // Send the data using fetch as a GET request
    fetch('advancedsearch.php?' + params)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((result) => {
            if (result.status === 'success') {
                console.log(result);
                // Render the properties
                renderProperties(result.data, result.pagination);
            } else {
                console.error(result.message);
            }
        })
        .catch((error) => console.error('Fetch error:', error));
});

// Render function example
function renderProperties(properties, pagination) {
    const container = document.getElementById('property-results');
    container.innerHTML = ''; // Clear previous results

    properties.forEach((property) => {
        const propertyCard = `
            <div class="property-card">
                <h3>${property.property_title}</h3>
                <p>${property.description}</p>
                <p>Location: ${property.location}</p>
                <p>Price: ${property.price}</p>
                <div class="images">
                    ${property.images.map((img) => `<img src="${img}" alt="${property.property_title}">`).join('')}
                </div>
            </div>`;
        container.innerHTML += propertyCard;
    });

    // Pagination info
    console.log('Pagination:', pagination);
}

</script>
</body>
</html>