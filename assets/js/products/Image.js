document.addEventListener("DOMContentLoaded", () => {
  // =========================
  // Thumbnails -> main image
  // =========================
  const mainImg = document.getElementById("mainProductImage");
  const thumbs = document.querySelectorAll(".product-thumbs .thumb");

  if (mainImg && thumbs.length > 0) {
    thumbs.forEach((btn) => {
      btn.addEventListener("click", () => {
        const src = btn.getAttribute("data-img");
        if (!src) return;

        mainImg.src = src;

        thumbs.forEach((b) => b.classList.remove("thumb-active"));
        btn.classList.add("thumb-active");
      });
    });
  }
});
