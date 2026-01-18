document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('profile_image');
  const img = document.querySelector('.profile-avatar img');
  if (!input || !img) return;

  input.addEventListener('change', () => {
    const file = input.files && input.files[0];
    if (!file) return;

    const url = URL.createObjectURL(file);
    img.src = url;
    img.onload = () => URL.revokeObjectURL(url);
  });
});