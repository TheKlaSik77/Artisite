(() => {
  const ENDPOINT = "index.php?page=signup&action=checkDuplicate";

  const debounce = (fn, delay = 350) => {
    let t;
    return (...args) => {
      clearTimeout(t);
      t = setTimeout(() => fn(...args), delay);
    };
  };

  function setMsg(input, msg, ok) {
    if (!input) return;
    const msgEl = document.getElementById(`${input.id}-msg`);
    input.setCustomValidity(ok ? "" : msg);
    if (msgEl) msgEl.textContent = msg || "";
  }

  function getTypeFromVisibleForm() {
    const craftForm = document.getElementById("craftmanForm");
    if (!craftForm) return "user";
    const isCraftVisible = craftForm.classList.contains("form-visible");
    return isCraftVisible ? "craftman" : "user";
  }

  function normalize(field, value) {
    let v = (value ?? "").toString().trim();
    if (field === "email") v = v.toLowerCase();
    if (field === "phone_number") v = v.replace(/\s+/g, "");
    if (field === "siret") v = v.replace(/\s+/g, "");
    return v;
  }

  const controllers = new Map();

  async function check(field, input) {
    const type = getTypeFromVisibleForm();
    const value = normalize(field, input.value);

    if (!value) {
      setMsg(input, "", true);
      return;
    }

    if (field === "siret" && type !== "craftman") {
      setMsg(input, "", true);
      return;
    }

    if ((field === "username" || field === "email" || field === "phone_number") && type !== "user") {
      setMsg(input, "", true);
      return;
    }

    if (controllers.has(field)) controllers.get(field).abort();
    const ac = new AbortController();
    controllers.set(field, ac);

    const url = new URL(ENDPOINT, window.location.href);
    url.searchParams.set("type", type);
    url.searchParams.set("field", field);
    url.searchParams.set("value", value);

    try {
      const res = await fetch(url.toString(), {
        method: "GET",
        headers: { Accept: "application/json" },
        signal: ac.signal,
      });

      const data = await res.json();
      const exists = !!data.exists;

      setMsg(input, data.message || (exists ? "Déjà utilisé." : "Disponible."), !exists);
    } catch (e) {
      if (e.name === "AbortError") return;
      setMsg(input, "Erreur serveur", false);
    }
  }

  const debounced = debounce(check, 350);

  const map = [
    ["username", "username"],
    ["email", "email"],
    ["phone_number", "phone_number"],
    ["siret", "siret"],
  ];

  for (const [id, field] of map) {
    const input = document.getElementById(id);
    if (!input) continue;

    input.addEventListener("input", () => debounced(field, input));
    input.addEventListener("blur", () => check(field, input));
  }

  const customerBtn = document.getElementById("customerBtn");
  const craftmanBtn = document.getElementById("craftmanBtn");

  function recheck() {
    for (const [id, field] of map) {
      const input = document.getElementById(id);
      if (!input) continue;
      check(field, input);
    }
  }

  if (customerBtn) customerBtn.addEventListener("click", recheck);
  if (craftmanBtn) craftmanBtn.addEventListener("click", recheck);


  const pass = document.getElementById("password");
  const pass2 = document.getElementById("password_confirm");

  function checkPasswordsUser() {
    if (!pass || !pass2) return;
    if (!pass2.value) return setMsg(pass2, "", true);

    const ok = pass.value === pass2.value;
    setMsg(pass2, ok ? "" : "Les mots de passe ne correspondent pas.", ok);
  }

  if (pass) pass.addEventListener("input", checkPasswordsUser);
  if (pass2) pass2.addEventListener("input", checkPasswordsUser);
  if (pass2) pass2.addEventListener("blur", checkPasswordsUser);


  const passC = document.getElementById("password_craft");
  const passC2 = document.getElementById("password_confirm_craft");

  function setMsgCustom(input, msg, ok) {
    if (!input) return;
    const msgEl = document.getElementById(`${input.id}-msg`);
    input.setCustomValidity(ok ? "" : msg);
    if (msgEl) msgEl.textContent = msg || "";
  }

  function checkPasswordsCraft() {
    if (!passC || !passC2) return;
    if (!passC2.value) return setMsgCustom(passC2, "", true);

    const ok = passC.value === passC2.value;
    setMsgCustom(passC2, ok ? "" : "Les mots de passe ne correspondent pas.", ok);
  }

  if (passC) passC.addEventListener("input", checkPasswordsCraft);
  if (passC2) passC2.addEventListener("input", checkPasswordsCraft);
  if (passC2) passC2.addEventListener("blur", checkPasswordsCraft);
})();
