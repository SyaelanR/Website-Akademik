// Animasi fade-in ketika halaman load
document.addEventListener("DOMContentLoaded", () => {
    document.body.style.opacity = 0;
    setTimeout(() => {
        document.body.style.transition = "opacity 0.6s ease-in-out";
        document.body.style.opacity = 1;
    }, 100);
});
