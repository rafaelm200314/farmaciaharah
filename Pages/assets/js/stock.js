function displayMedData() {
  fetch("../PHP/stock_get_med.php")
    .then((response) => response.json())
    .then((data) => {
      const medicineGrid = document.getElementById("medicineGrid");

      if (data.length === 0) {
        // Display message when no stocks are available
        medicineGrid.innerHTML = "<p>No stocks available</p>";
      } else {
        medicineGrid.innerHTML = ""; // Clear any previous content

        data.forEach((medicine) => {
          // Parse expiry date to ensure it's in a recognizable format
          const expiryParts = medicine.med_expiry.split("-");
          const formattedExpiry = new Date(
            expiryParts[0],
            expiryParts[1] - 1,
            expiryParts[2]
          );
          
          // Format expiry date to MM-DD-YYYY
          const formattedExpiryString = `${formattedExpiry.getMonth() + 1}-${formattedExpiry.getDate()}-${formattedExpiry.getFullYear()}`;

          // Generate card for each medicine
          const card = document.createElement("div");
          card.classList.add("card");

          const imageContainer = document.createElement("div");
          imageContainer.classList.add("image-container");

          const image = document.createElement("img");
          image.src = medicine.med_photo;
          image.alt = "Medicine Picture";
          imageContainer.appendChild(image);
          card.appendChild(imageContainer);

          const details = document.createElement("div");
          details.classList.add("details");
          details.innerHTML = `
            <h3>${medicine.med_name}</h3>
            <p><strong>Price:</strong> ${medicine.med_price}</p>
            <p><strong>Expiry:</strong> ${formattedExpiryString}</p>
            <p><strong>Quantity:</strong> ${medicine.med_quantity}</p>
            <p><strong>Details:</strong> ${medicine.med_details}</p>
          `;
          card.appendChild(details);

          medicineGrid.appendChild(card);
        });
      }
    })
    .catch((error) => console.error("Error fetching data:", error));
}

window.onload = displayMedData;
