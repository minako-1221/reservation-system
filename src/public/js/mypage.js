document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("cancelModal");
        const cancelForm = document.getElementById("cancelForm");
        const cancelButtons = document.querySelectorAll(".cancel-btn");

        cancelButtons.forEach(button => {
            button.addEventListener("click", function () {
                const reservationId = this.getAttribute("data-reservation-id");
                cancelForm.action = `/reservations/${reservationId}`;
                modal.style.display = "block";
            });
        });

        // モーダルを閉じる処理
        const modalCloseIcon = document.querySelector(".modal-cancel-icon");
        if (modalCloseIcon) {
            modalCloseIcon.addEventListener("click", function (event) {
                event.preventDefault();
                modal.style.display = "none";
            });
        }

        const currentBtn = document.getElementById("current-btn");
        const pastBtn = document.getElementById("past-btn");
        const currentReservations = document.getElementById("current-reservations");
        const pastReservations = document.getElementById("past-reservations");

        currentBtn.addEventListener("click", function () {
            currentBtn.classList.add("active");
            pastBtn.classList.remove("active");
            currentReservations.style.display = "block";
            pastReservations.style.display = "none";
        });

        pastBtn.addEventListener("click", function () {
            pastBtn.classList.add("active");
            currentBtn.classList.remove("active");
            currentReservations.style.display = "none";
            pastReservations.style.display = "block";
        });

        // 初期表示（現在の予約）
        currentReservations.style.display = "block";
        pastReservations.style.display = "none";
    });