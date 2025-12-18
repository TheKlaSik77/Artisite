document.addEventListener("DOMContentLoaded", () => {
  const customerBtn = document.getElementById("customerBtn");
  const craftmanBtn = document.getElementById("craftmanBtn");

  const customerFields = document.getElementById("customerFields");
  const craftmanFields = document.getElementById("craftmanFields");

  const accountType = document.getElementById("accountType");

  const emailInput = document.querySelector('input[name="email"]');
  const siretInput = document.querySelector('input[name="siret"]');

  const setSelected = (type) => {
    const isCustomer = type === "customer";

    accountType.value = type;

    customerBtn.classList.toggle("selected", isCustomer);
    craftmanBtn.classList.toggle("selected", !isCustomer);

    customerBtn.querySelector(".circle")?.classList.toggle("active", isCustomer);
    craftmanBtn.querySelector(".circle")?.classList.toggle("active", !isCustomer);

    customerFields.style.display = isCustomer ? "block" : "none";
    craftmanFields.style.display = isCustomer ? "none" : "block";

    // required toggle (important so the browser doesn't block submit)
    if (emailInput) emailInput.required = isCustomer;
    if (siretInput) siretInput.required = !isCustomer;
  };

  customerBtn.addEventListener("click", () => setSelected("customer"));
  craftmanBtn.addEventListener("click", () => setSelected("craftman"));

  // keyboard accessibility
  [customerBtn, craftmanBtn].forEach((el) => {
    el.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        el.click();
      }
    });
  });

  // default
  setSelected("customer");
});
