document.addEventListener("DOMContentLoaded", () => {
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const btn = item.querySelector(".faq-question");
    btn.addEventListener("click", () => {
      faqItems.forEach((other) => {
        if (other !== item) other.classList.remove("open");
      });
      item.classList.toggle("open");
    });
  });

  const faqSearchInput = document.getElementById("faqSearch");
  const faqEmpty = document.getElementById("faqEmpty");

  faqSearchInput.addEventListener("input", () => {
    const query = faqSearchInput.value.toLowerCase().trim();
    let visibleCount = 0;

    faqItems.forEach((item) => {
      const questionText = item.querySelector(".faq-question-text").textContent.toLowerCase();
      const tags = (item.dataset.tags || "").toLowerCase();
      const matches = questionText.includes(query) || tags.includes(query);

      if (!query || matches) {
        item.style.display = "";
        visibleCount++;
      } else {
        item.style.display = "none";
        item.classList.remove("open");
      }
    });

    faqEmpty.style.display = visibleCount === 0 ? "block" : "none";
  });
});
