function addStudent() {
    // Get input values
    const nameInput = document.getElementById("name").value.trim();
    const marksInput = document.getElementById("marks").value.trim();
    
    // Get the error elements
    const nameError = document.getElementById("nameError");
    const marksError = document.getElementById("marksError");

    // Reset error messages
    nameError.textContent = "";
    marksError.textContent = "";

    // Validate Name: Only letters, no empty
    const namePattern = /^[A-Za-z]+$/;
    if (!namePattern.test(nameInput)) {
        nameError.textContent = "Name must contain only letters and cannot be empty.";
        return;
    }

    // Validate Marks: Number between 0 and 100
    const marks = Number(marksInput);
    if (isNaN(marks) || marks < 0 || marks > 100) {
        marksError.textContent = "Marks must be a number between 0 and 100.";
        return;
    }

    // Add student to table if valid
    const tableBody = document.getElementById("studentTable").getElementsByTagName("tbody")[0];
    const newRow = tableBody.insertRow();
    const nameCell = newRow.insertCell(0);
    const marksCell = newRow.insertCell(1);

    nameCell.textContent = nameInput;
    marksCell.textContent = marks;

    // Change background color based on marks
    if (marks > 50) {
        newRow.style.backgroundColor = "lightgreen";
    } else {
        newRow.style.backgroundColor = "lightcoral";
    }

    // Clear input fields
    document.getElementById("name").value = "";
    document.getElementById("marks").value = "";
}
