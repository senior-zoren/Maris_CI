document.addEventListener("DOMContentLoaded", () => {
  const sliders = [
    {
      id: "ratingSlider",
      min: 1,
      max: 10,
      step: 0.1,
      defaultValue: 1,
    },
    {
      id: "accuracySlider",
      min: 1,
      max: 10,
      step: 0.1,
      defaultValue: 1,
    },
  ];

  sliders.forEach((slider) => {
    generateLegends(slider.id, slider.min, slider.max);
    updateSliderValue(slider.id, slider.defaultValue);

    const sliderElement = document.getElementById(slider.id);
    sliderElement.addEventListener("input", () =>
      updateSliderValue(slider.id, sliderElement.value)
    );
  });

  const form = document.querySelector("form");
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    Swal.fire({
      toast: true,
      icon: "success",
      title: "Feedback submitted, thank you for your cooperation.",
      position: "top-end",
      showConfirmButton: false,
      timer: 1200,
      timerProgressBar: false,
    });

  
    setTimeout(() => form.submit(), 1200);
  });
});

/**
 * Updates the value display dynamically as the slider moves.
 * @param {string} id 
 * @param {string} value 
 */
function updateSliderValue(id, value) {
  document.getElementById(`${id}Value`).innerText = parseFloat(value).toFixed(1);
}

/**
 * Generates legends for the slider based on min and max values.
 * @param {string} id 
 * @param {number} min 
 * @param {number} max 
 */
function generateLegends(id, min, max) {
  const legends = document.getElementById(`${id}Legends`);
  legends.innerHTML = ""; 

  for (let i = min; i <= max; i++) {
    const legend = document.createElement("span");
    legend.classList.add("slider-legend");
    legend.innerText = i;
    legends.appendChild(legend);
  }
}
