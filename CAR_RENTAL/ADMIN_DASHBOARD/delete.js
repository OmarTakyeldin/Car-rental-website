function deleteReservation(reservationId) {
    if (confirm('Are you sure you want to delete this reservation?')) {
        fetch(`delete_reservation.php?reservation_id=${reservationId}`)
            .then((response) => response.text())
            .then((deletedId) => {
                if (!isNaN(parseInt(deletedId))) {
                    alert(`Reservation with ID ${deletedId} has been deleted.`);
                    location.reload(); // Reload the page to update the table
                } else {
                    alert('An error occurred while deleting the reservation.');
                }
            });
    }
}

function deleteCustomer(customerId) {
    if (confirm('Are you sure you want to remove this customer and all related reservations?')) {
        fetch(`delete_customer.php?customer_id=${customerId}`)
            .then((response) => response.text())
            .then((deletedId) => {
                if (!isNaN(parseInt(deletedId))) {
                    alert(`Customer with ID ${deletedId} has been deleted.`);
                    location.reload(); // Reload the page to update the table
                } else {
                    alert('An error occurred while deleting the customer.');
                }
            });
    }
}

function deleteCoupon(couponId) {
    if (confirm('Are you sure you want to remove this coupon?')) {
        fetch(`delete_coupon.php?coupon_id=${couponId}`)
            .then((response) => response.text())
            .then((deletedId) => {
                if (!isNaN(parseInt(deletedId))) {
                    alert(`Coupon with ID ${deletedId} has been deleted.`);
                    location.reload(); // Reload the page to update the page
                } else {
                    alert('An error occurred while deleting the coupon.');
                }
            });
    }
}

function deleteSupport(supportId) {
    if (confirm('Are you sure you want to remove this support ticket?')) {
        fetch(`delete_support.php?support_id=${supportId}`)
            .then((response) => response.text())
            .then((deletedId) => {
                if (!isNaN(parseInt(deletedId))) {
                    alert(`Support ticket with ID ${deletedId} has been deleted.`);
                    location.reload(); // Reload the page to update the page
                } else {
                    alert('An error occurred while deleting the support ticket.');
                }
            });
    }
}