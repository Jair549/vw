
    //close feedback message toast
    const closeButtons = document.querySelectorAll(
        '[data-dismiss="toast"][aria-label="Close"]'
    );
    closeButtons.forEach((closeButton) =>
        closeButton.addEventListener("click", (event) =>
            event.target.closest(".toast").classList.remove("show")
        )
    );

    let width = 0;
    const toastSuccess = document.querySelector(".toast .progress-close");

    if (toastSuccess) {
        const hideMessage = setInterval(() => {
            width++;
            toastSuccess.style.width = `${width}%`;
            if (width >= 100) {
                toastSuccess.closest(".toast").classList.remove("show");
                clearInterval(hideMessage);
            }
        }, 30);
    }
    const toastError = document.querySelector(".toast .progress-close");

    if (toastError) {
        const hideMessage = setInterval(() => {
            width++;
            toastError.style.width = `${width}%`;
            if (width >= 100) {
                toastError.closest(".toast").classList.remove("show");
                clearInterval(hideMessage);
            }
        }, 30);
    }  