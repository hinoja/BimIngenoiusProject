// Glightbox
document.addEventListener('DOMContentLoaded', function () {
    GLightbox({ selector: '.glightbox' });
});

// Modal
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('quoteModal');
    var openBtn = document.getElementById('openQuoteModal');
    var closeBtn = document.getElementById('closeQuoteModal');

    openBtn.onclick = function() {
        modal.classList.add('open');
    };
    closeBtn.onclick = function() {
        modal.classList.remove('open');
    };
    modal.onclick = function(e) {
        if (e.target === this) modal.classList.remove('open');
    };
});