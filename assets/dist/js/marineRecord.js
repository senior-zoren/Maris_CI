function showDetails(event) {
  event.preventDefault();
  const listItem = event.currentTarget;

  const description = listItem.getAttribute("data-description");
  const commonName = listItem.getAttribute("data-common-name");
  const scientificName = listItem.getAttribute("data-scientific-name");
  const imagePath = listItem.getAttribute("data-image-path");

  const cardBody = document.querySelector(".card-body");

  if (cardBody) {
    // console.log(imagePath); 

    const imageHtml = imagePath
      ? `<img src="${imagePath}" alt="${commonName}" style="max-width:100%; max-height:300px;">`
      : "<p>No image available.</p>";


    cardBody.innerHTML = `
      ${imageHtml}
      <h3>${commonName}</h3>
      <p><strong>Scientific Name:</strong> ${scientificName}</p>
      <p><strong>Description:</strong> ${description}</p>
    `;
  } else {
    console.error("No element with class 'card-body' found.");
  }
}

// Make sure the DOM is ready before adding event listeners
document.addEventListener("DOMContentLoaded", () => {
  // Find all clickable list items
  const listItems = document.querySelectorAll(".clickable-item");

  // Attach the showDetails function to each list item
  listItems.forEach((item) => {
    item.addEventListener("click", showDetails);
  });
});
