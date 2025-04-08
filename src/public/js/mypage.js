document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("cancelModal");
        const cancelForm = document.getElementById("cancelForm");
        const cancelButtons = document.querySelectorAll(".cancel-btn");

        cancelButtons.forEach(button => {
            button.addEventListener("click", function () {
                const reservationId = this.getAttribute("data-reservation-id");
                console.log("予約ID:", reservationId);
                cancelForm.action = `/reservations/${reservationId}`;
                console.log(cancelForm.action);
                modal.style.display = "block";
            });
        });

        // モーダルを閉じる処理
        document.querySelector(".modal-cancel-icon").addEventListener("click", function (event) {
            event.preventDefault();
            modal.style.display = "none";
        });
    });