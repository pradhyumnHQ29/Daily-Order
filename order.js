// Function to change the quantity of an item
function changeQuantity(amount) {
    // Get the current quantity value from the input field
    let quantityInput = document.getElementById('quantity');
    
    // Calculate the new quantity by adding the amount (increase/decrease)
    let newQuantity = parseInt(quantityInput.value) + amount;

    // Only allow positive quantities (i.e., minimum 1 item)
    if (newQuantity >= 1) {
        // Update the input field with the new quantity
        quantityInput.value = newQuantity;

        // Calculate the total price by multiplying pricePerItem by new quantity
        // Update the total price text displayed on the page
        document.getElementById('totalPrice').innerText = (pricePerItem * newQuantity).toFixed(2);
    }
}
