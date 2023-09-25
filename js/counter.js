const inputField = document.getElementById('furniture-price');


  inputField.addEventListener('change', function() {
    const value = parseFloat(this.value); // Parse the input value as a float
    if (isNaN(value)) return; // Return if the value is not a number

    if (value < 0) {
      this.value = '0'; // Set the input value to 0 if it's negative
    }
  });

