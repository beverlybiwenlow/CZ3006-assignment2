function blur(id) {
    // blurs total cost preview when element in focus
    document.getElementById(id).blur()
}

// checks that fruit quantities are valid
function sanitize_input(id){
    fruit = document.getElementById(id)
    fruit_order = fruit.value
    cost_output = document.getElementById("cost_output")
    cost_output.value = ""

    if (isNaN(fruit_order)){
        alert("Input quantity is invalid. Please enter an integer.");
        // automatically removes input for user for convenience
        // and to prevent invalid inputs from being submitted
        fruit.value = "";
        return;
      } else {
        // checks if input is an integer
        if (fruit_order % 1 == 0){
            calculateTotal()
        } else {
          alert("Please enter an integer.");
          fruit.value = "";
          return;
        }
      }
}

// calculates total cost of order, updates the preview text input
function calculateTotal(){
    var apple_order = document.getElementById("apple_input").value
    var orange_order = document.getElementById("orange_input").value
    var banana_order = document.getElementById("banana_input").value

    // sanitization checks for fruit order inputs
    if (!isNaN(apple_order) && !isNaN(orange_order) && !isNaN(banana_order) && apple_order != null && orange_order != null && banana_order != null){
        var total_cost = apple_order * 0.69 + orange_order * 0.59 + banana_order * 0.39
            cost_output.value = total_cost.toFixed(2)
    }
}

// checks if user submits 0 fruit orders before sending order to the back-end
function empty(){
    var total_qty = document.getElementById("apple_input").value
                  + document.getElementById("orange_input").value
                  + document.getElementById("banana_input").value;
    console.log(total_qty)
    console.log(typeof(total_qty))

    // if at least 1 fruit ordered
    if(total_qty > 0){
        alert("Your order has been submitted!");
        return true; // form is submitted
    
    // no fruits ordered at all
    } else {
        alert("Sorry, you cannot submit an empty order.");
        return false; // form is not submitted
    }
}