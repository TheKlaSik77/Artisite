console.log("[profilModification] loaded ✅");

(function () {
  // init: ensure view mode
  function initForm(form) {
    form.classList.remove("is-editing");
    form.querySelectorAll(".value-input, .value-textarea").forEach((el) => {
      el.disabled = true;
    });

    const btnCancel = form.querySelector('[data-action="cancel"]');
    const btnSave = form.querySelector('[data-action="save"]');
    if (btnCancel) btnCancel.style.display = "none";
    if (btnSave) btnSave.style.display = "none";
  }

  document.querySelectorAll("[data-profile-form]").forEach(initForm);

  document.addEventListener("click", function (e) {
    const btn = e.target.closest("[data-action]");
    if (!btn) return;

    const action = btn.getAttribute("data-action");
    if (action !== "edit" && action !== "cancel") return;

    const form = btn.closest("[data-profile-form]");
    if (!form) return;

    const inputs = form.querySelectorAll(".value-input, .value-textarea");
    const btnEdit = form.querySelector('[data-action="edit"]');
    const btnCancel = form.querySelector('[data-action="cancel"]');
    const btnSave = form.querySelector('[data-action="save"]');

    // store initial values once
    if (!form._initialValues) {
      form._initialValues = new Map();
      inputs.forEach((el) => form._initialValues.set(el, el.value));
    }

    function setEditing(isEditing) {
      form.classList.toggle("is-editing", isEditing);
      inputs.forEach((el) => (el.disabled = !isEditing));

      if (btnEdit) btnEdit.style.display = isEditing ? "none" : "";
      if (btnCancel) btnCancel.style.display = isEditing ? "" : "none";
      if (btnSave) btnSave.style.display = isEditing ? "" : "none";
    }

    if (action === "edit") {
      setEditing(true);
      const first = form.querySelector(".value-input, .value-textarea");
      if (first) first.focus();
    }

    if (action === "cancel") {
      inputs.forEach((el) => {
        const v = form._initialValues.get(el);
        if (v !== undefined) el.value = v;
      });
      setEditing(false);
    }
  });
})();
