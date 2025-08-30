window.addEventListener("load", () => {
  const today = new Date();
  const yyyy = today.getFullYear();
  const mm = String(today.getMonth() + 1).padStart(2, '0');
  const dd = String(today.getDate()).padStart(2, '0');
  const minDate = `${yyyy}-${mm}-${dd}`;
  
  document.getElementById("date").setAttribute("min", minDate);

  const timeSelect = document.getElementById("time");
  const dateInput = document.querySelector("[name='date']");

  function loadHours() {
    timeSelect.innerHTML = '<option value="">-- Select a time --</option>';

    const now = new Date();
    const todayStr = now.toISOString().split("T")[0]; // YYYY-MM-DD
    const currentHour = now.getHours();

    for (let h = 8; h <= 17; h++) {
      let hourStr = String(h).padStart(2, "0") + ":00";

      // If the selected date is today, skip past hours
      if (dateInput.value === todayStr && h <= currentHour) {
        continue;
      }

      let option = document.createElement("option");
      option.value = hourStr;
      option.textContent = hourStr;
      timeSelect.appendChild(option);
    }
  }

  // Load hours on page load
  loadHours();

  // Recalculate when the date changes
  dateInput.addEventListener("change", loadHours);
});
