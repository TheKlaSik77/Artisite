(() => {
  // --- Utils ---
  const NAME_RE = /^[\p{L}\s'-]+$/u;

  function setMsgByInput(input, msg, ok) {
    if (!input) return ok;

    const msgEl = document.getElementById(`${input.id}-msg`);
    input.setCustomValidity(ok ? "" : msg);
    if (msgEl) msgEl.textContent = msg || "";

    return ok;
  }

  function getTypeFromVisibleForm() {
    const craftForm = document.getElementById("craftmanForm");
    if (!craftForm) return "user";
    return craftForm.classList.contains("form-visible") ? "craftman" : "user";
  }

  function trim(v) {
    return (v ?? "").toString().trim();
  }

  function vUsername() {
    const input = document.getElementById("username");
    const v = trim(input?.value);
    return setMsgByInput(input, v ? "" : "Pseudo requis.", !!v);
  }

  function vFirstName() {
    const input = document.getElementById("first_name");
    const v = trim(input?.value);
    if (!v) return setMsgByInput(input, "Prénom requis.", false);
    const ok = NAME_RE.test(v);
    return setMsgByInput(input, ok ? "" : "Prénom invalide (pas de chiffres).", ok);
  }

  function vLastName() {
    const input = document.getElementById("last_name");
    const v = trim(input?.value);
    if (!v) return setMsgByInput(input, "Nom requis.", false);
    const ok = NAME_RE.test(v);
    return setMsgByInput(input, ok ? "" : "Nom invalide (pas de chiffres).", ok);
  }

  function vEmail() {
    const input = document.getElementById("email");
    const v = trim(input?.value).toLowerCase();
    if (!v) return setMsgByInput(input, "Email requis.", false);
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
    return setMsgByInput(input, ok ? "" : "Email invalide.", ok);
  }

  function vPhone() {
    const input = document.getElementById("phone_number");
    const v = trim(input?.value);
    if (!v) return setMsgByInput(input, "Téléphone requis.", false);

    const digits = v.replace(/\D/g, "");
    const ok = digits.length >= 8 && digits.length <= 15;
    return setMsgByInput(input, ok ? "" : "Téléphone invalide.", ok);
  }

  function vUserPasswords() {
    const p1 = document.getElementById("password");
    const p2 = document.getElementById("password_confirm");
    if (!p1 || !p2) return true;

    const pass = p1.value || "";
    const conf = p2.value || "";

    if (pass.length < 8) return setMsgByInput(p2, "Mot de passe trop court (8 caractères min).", false);
    if (!conf) return setMsgByInput(p2, "Veuillez confirmer le mot de passe.", false);
    if (pass !== conf) return setMsgByInput(p2, "Les mots de passe ne correspondent pas.", false);

    return setMsgByInput(p2, "", true);
  }

  function vSiret() {
    const input = document.getElementById("siret");
    const v = trim(input?.value).replace(/\s+/g, "");
    if (!v) return setMsgByInput(input, "SIRET requis.", false);

    const ok = /^\d{14}$/.test(v);
    return setMsgByInput(input, ok ? "" : "SIRET invalide (14 chiffres).", ok);
  }

  function vCompanyName() {
    const input = document.getElementById("company_name");
    const v = trim(input?.value);
    const ok = v.length >= 2;
    return setMsgByInput(input, ok ? "" : "Nom d'entreprise requis.", ok);
  }

  function vCraftPasswords() {
    const p1 = document.getElementById("password_craft");
    const p2 = document.getElementById("password_confirm_craft");
    if (!p1 || !p2) return true;

    const pass = p1.value || "";
    const conf = p2.value || "";

    if (pass.length < 8) return setMsgByInput(p2, "Mot de passe trop court (8 caractères min).", false);
    if (!conf) return setMsgByInput(p2, "Veuillez confirmer le mot de passe.", false);
    if (pass !== conf) return setMsgByInput(p2, "Les mots de passe ne correspondent pas.", false);

    return setMsgByInput(p2, "", true);
  }

  function vDescription() {
    const input = document.getElementById("description");
    const v = trim(input?.value);

    const ok = v.length >= 10;
    return setMsgByInput(input, ok ? "" : "Description trop courte (10 caractères min).", ok);
  }


  function hookUser() {
    document.getElementById("username")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "user") vUsername();
    });

    document.getElementById("first_name")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "user") vFirstName();
    });

    document.getElementById("last_name")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "user") vLastName();
    });

    document.getElementById("email")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "user") vEmail();
    });

    document.getElementById("phone_number")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "user") vPhone();
    });

    document.getElementById("password")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "user") vUserPasswords();
    });

    document.getElementById("password_confirm")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "user") vUserPasswords();
    });
  }

  function hookCraft() {
    document.getElementById("siret")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "craftman") vSiret();
    });

    document.getElementById("company_name")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "craftman") vCompanyName();
    });

    document.getElementById("password_craft")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "craftman") vCraftPasswords();
    });

    document.getElementById("password_confirm_craft")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "craftman") vCraftPasswords();
    });

    document.getElementById("description")?.addEventListener("input", () => {
      if (getTypeFromVisibleForm() === "craftman") vDescription();
    });
  }

  hookUser();
  hookCraft();

  function onSubmit(e) {
    const type = getTypeFromVisibleForm();
    let ok = true;

    if (type === "user") {
      ok = vUsername() && ok;
      ok = vFirstName() && ok;
      ok = vLastName() && ok;
      ok = vEmail() && ok;
      ok = vPhone() && ok;
      ok = vUserPasswords() && ok;

      if (!ok) {
        e.preventDefault();
        document.getElementById("customerForm")?.querySelector(":invalid")?.focus();
      }
    } else {
      ok = vSiret() && ok;
      ok = vCompanyName() && ok;
      ok = vCraftPasswords() && ok;
      ok = vDescription() && ok;

      if (!ok) {
        e.preventDefault();
        document.getElementById("craftmanForm")?.querySelector(":invalid")?.focus();
      }
    }
  }

  document.getElementById("customerForm")?.addEventListener("submit", onSubmit);
  document.getElementById("craftmanForm")?.addEventListener("submit", onSubmit);
})();
