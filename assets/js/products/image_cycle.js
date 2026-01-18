
    document.addEventListener('DOMContentLoaded', () => {
      const intervalMs = 2500;

      document.querySelectorAll('.js-product-img').forEach((img) => {
        let images = [];
        try {
          images = JSON.parse(img.dataset.images || '[]');
        } catch (e) {
          images = [];
        }

        if (!Array.isArray(images) || images.length <= 1) return;

        let idx = 0;
        setInterval(() => {
          idx = (idx + 1) % images.length;
          img.src = images[idx];
        }, intervalMs);
      });
    });