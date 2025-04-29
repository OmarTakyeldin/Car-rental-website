const customerEmailSelect = document.getElementById('customer-email');
const startDateInput = document.getElementById('start-date');
const endDateInput = document.getElementById('end-date');
const carTypeSelect = document.getElementById('car-type');
const checkAvailabilityBtn = document.getElementById('check-availability');
const availableCarsDiv = document.getElementById('available-cars');
const submitBtn = document.getElementById('submit-btn');
const reservationIdInput = document.getElementById('reservation_id');

// Fetch available cars based on the selected dates and car type
async function fetchAvailableCars() {
    
    const startDate = startDateInput.value;
    const endDate = endDateInput.value;
    const carType = carTypeSelect.value;
    const reservationId = reservationIdInput ? reservationIdInput.value : ''; // Get the reservation ID from the input field
    
    if (startDate && endDate && carType) {
        
        const response = await fetch(`get_available_cars.php?start_date=${startDate}&end_date=${endDate}&car_type=${carType}&reservation_id=${reservationId}`);
        // console.log(await response.text());
        const availableCars = await response.json();
        availableCarsDiv.innerHTML = '';
        if (availableCars.length > 0) {
            for (const car of availableCars) {
                const div = document.createElement('div');
                div.classList.add('img-card');
    
                const img = document.createElement('img');
                img.src = car.car_img;
                img.alt = car.car_name;
                div.appendChild(img);
    
                const reserveBtn = document.createElement('button');
                reserveBtn.textContent = 'Reserve Car';
                reserveBtn.classList.add('reserve-btn');
                reserveBtn.dataset.carId = car.car_id; // Store the car_id value as a data attribute
                reserveBtn.onclick = reserveCar;
                div.appendChild(reserveBtn);

                const editDiv = document.createElement('div');
                editDiv.classList.add('edit');
                editDiv.appendChild(reserveBtn);
                div.appendChild(editDiv);

                availableCarsDiv.appendChild(div);
            }
            submitBtn.disabled = false;
        } else {
            const p = document.createElement('p');
            p.textContent = 'No cars available for the selected dates and car type.';
            availableCarsDiv.appendChild(p);
            submitBtn.disabled = true;
        }
    }
}

function reserveCar(event) {
    const carId = event.target.dataset.carId;
    const carIdInput = document.getElementById('car_id');
    carIdInput.value = carId;
    document.getElementById('submit-reservation').click();
}

function validateDates() {
    const startDate = document.getElementById("start-date");
    const endDate = document.getElementById("end-date");

    if (startDate.value && endDate.value && startDate.value > endDate.value) {
        alert("Start date cannot be after the end date.");
        return false;
    }
    return true;
}

checkAvailabilityBtn.addEventListener("click", () => {
    // Validate the dates before checking for available cars
    if (validateDates()) {
      fetchAvailableCars();
    }
  });
