document.addEventListener("DOMContentLoaded", function() {
    fetchBookings();
});

function fetchBookings() {
    fetch('fetch_bookings.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('bookings-table-body');
            tableBody.innerHTML = ''; // Clear existing rows

            data.forEach(booking => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${booking.id}</td>
                    <td>${booking.full_name}</td>
                    <td>${booking.email}</td>
                    <td>${booking.phone}</td>
                    <td>${booking.package}</td>
                    <td>${booking.preferred_date}</td>
                    <td>${booking.special_requests}</td>
                    <td><button onclick="removeBooking(${booking.id})">Remove</button></td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching bookings:', error));
}

function removeBooking(id) {
    if (confirm('Are you sure you want to remove this booking?')) {
        fetch(`remove_booking.php?id=${id}`, { method: 'DELETE' })
            .then(response => {
                if (response.ok) {
                    alert('Booking removed successfully!');
                    fetchBookings(); // Refresh the bookings list
                } else {
                    alert('Error removing booking.');
                }
            })
            .catch(error => console.error('Error removing booking:', error));
    }
}