document.addEventListener("DOMContentLoaded", () => {

    const customerBtn = document.getElementById("customerBtn");
    const craftmanBtn = document.getElementById("craftmanBtn");

    const customerForm = document.getElementById("customerForm");
    const craftmanForm = document.getElementById("craftmanForm");

    const customerCircle = customerBtn.querySelector(".circle");
    const craftmanCircle = craftmanBtn.querySelector(".circle");

    customerBtn.addEventListener("click", () => selectType("customer"));
    craftmanBtn.addEventListener("click", () => selectType("craftman"));

    function selectType(type) {
        if (type === "customer") {
            customerBtn.classList.add("selected");
            craftmanBtn.classList.remove("selected");

            customerForm.classList.remove("form-hidden");
            customerForm.classList.add("form-visible");

            customerCircle.classList.add("active");
            craftmanCircle.classList.remove("active");

            craftmanForm.classList.remove("form-visible");
            craftmanForm.classList.add("form-hidden");
        }

        if (type === "craftman") {
            craftmanBtn.classList.add("selected");
            customerBtn.classList.remove("selected");
            
            craftmanCircle.classList.add("active");
            customerCircle.classList.remove("active");
            
            craftmanForm.classList.remove("form-hidden");
            craftmanForm.classList.add("form-visible");

            customerForm.classList.remove("form-visible");
            customerForm.classList.add("form-hidden");
        }
    }
});
