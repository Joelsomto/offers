  <!-- <script>
    // Select the form and alert elements
const form = document.getElementById('property-form'); // Change 'property-form' to your form's ID
const submitButton = document.getElementById('submit-button'); // The submit button ID (optional for disabling button during submission)
const successMessage = document.getElementById('success-message'); // Success alert
const errorMessage = document.getElementById('error-message'); // Error alert

form.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Disable the submit button to prevent multiple submissions (optional)
    submitButton.disabled = true;

    // Reset alert messages
    successMessage.style.display = 'none';
    errorMessage.style.display = 'none';

    const formData = new FormData(form);

    // Send the POST request with the form data
    fetch('submit-property.php', { 
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // Get response as plain text
    .then(data => {
        // Check if the response contains "Success:"
        if (data.startsWith('Success:')) {
            // Show success message and hide error message
            successMessage.style.display = 'block';
        } else {
            // Show error message and hide success message
            errorMessage.style.display = 'block';
        }
    })
    .catch(error => {
        // Handle any errors during the fetch request (e.g., network issues)
        console.error('Error submitting form:', error);
        // Show error message on failure
        errorMessage.style.display = 'block';
    })
    .finally(() => {
        // Re-enable the submit button after the request is complete
        submitButton.disabled = false;
    });
});

  </script>  -->
  
  <!-- <script>
    let selectedFiles = []; // Array to store selected files
    const maxSizeMB = 2;    // Maximum file size (2 MB)
    const maxFiles = 5;     // Maximum number of files allowed
    const previewContainer = document.getElementById("previewContainer");
    const uploadMessage = document.getElementById("uploadMessage");
    const dropZone = document.getElementById("dropZone");

    // Update the file selection prompt
    function updateFilePrompt() {
        const prompt = document.getElementById("uploadPrompt");
        prompt.innerText = selectedFiles.length > 0 
            ? `${selectedFiles.length} file(s) selected` 
            : "Drag & drop images here or click to upload (Max 5 files)";
    }

    // Handle file selection from input
    document.getElementById("imageUpload").addEventListener("change", function(event) {
        console.log("Files selected:", event.target.files);
        handleFiles(event.target.files);
        event.target.value = ""; // Clear input to allow re-selection
    });

    // Handle drag and drop files
    dropZone.addEventListener("dragover", (event) => {
        event.preventDefault();
        dropZone.classList.add("drag-over"); // Optional: Add CSS to indicate active drag
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("drag-over");
    });

    dropZone.addEventListener("drop", (event) => {
        event.preventDefault();
        dropZone.classList.remove("drag-over");
        handleFiles(event.dataTransfer.files);
    });

    // Function to handle files
    function handleFiles(files) {
        const newFiles = Array.from(files);
        uploadMessage.innerText = ""; // Clear previous messages

        // Check if adding the new files will exceed the max file limit
        if (selectedFiles.length + newFiles.length > maxFiles) {
            uploadMessage.innerText = `Please select up to ${maxFiles} files in total.`;
            return;
        }

        newFiles.forEach(file => {
            if (file.size > maxSizeMB * 1024 * 1024) {
                uploadMessage.innerText = `Each file must be smaller than ${maxSizeMB} MB.`;
            } else {
                // Add the file to the selected files array and preview it
                selectedFiles.push(file);
                previewImage(file);
            }
        });
        
        updateFilePrompt(); // Update file count display
    }

    // Function to display image preview with remove option
    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgContainer = document.createElement("div");
            imgContainer.className = "image-preview";
            
            const img = document.createElement("img");
            img.src = e.target.result;
            img.style.width = "100px"; // Thumbnail size
            img.style.margin = "5px";
            
            const removeButton = document.createElement("button");
            removeButton.innerText = "Remove";
            removeButton.className = "remove-button";
            removeButton.addEventListener("click", function() {
                removeImage(file);
                imgContainer.remove(); // Remove the preview image
            });
            
            imgContainer.appendChild(img);
            imgContainer.appendChild(removeButton);
            previewContainer.appendChild(imgContainer);
        };
        reader.readAsDataURL(file);
    }

    // Function to remove an image
    function removeImage(file) {
        selectedFiles = selectedFiles.filter(f => f !== file); // Remove file from array
        updateFilePrompt(); // Update file count display
    }

    // Trigger file selection when the drop zone is clicked
    dropZone.addEventListener("click", function() {
        document.getElementById("imageUpload").click(); // Open file dialog
    });

    // Form submit handler
    document.querySelector("form").addEventListener("submit", (event) => {
        if (selectedFiles.length === 0) {
            event.preventDefault(); // Prevent form submission if no files are selected
            uploadMessage.innerText = "Please select at least one file to upload.";
        }
    });
</script> -->
<!-- The form submission script -->
