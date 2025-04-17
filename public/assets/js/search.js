// File: public/assets/js/search.js
const input = document.querySelector('.header__search-input');
const texts = [
    "Tìm nồi, chảo, ly, tách bạn cần...",
    "Đang giảm giá: máy xay, nồi chiên không dầu!",
    "Bạn cần gì cho gian bếp hôm nay?",
    "Từ nhà bếp đến phòng khách – tìm ngay!",
    "Gợi ý: bộ dao kéo inox, ấm đun siêu tốc...",
    "Tìm sản phẩm hot cho căn bếp của bạn 🔥",
    "Món đồ gia dụng nào bạn đang cần?",
];

let index = 0;
let charIndex = 0;
let currentText = '';
let isDeleting = false;

function typeEffect() {
    currentText = texts[index];
    let displayText = currentText.substring(0, charIndex);

    input.setAttribute('placeholder', displayText + (charIndex % 2 === 0 ? '' : ''));

    if (!isDeleting) {
        charIndex++;
        if (charIndex > currentText.length + 10) {
            isDeleting = true;
        }
    } else {
        charIndex--;
        if (charIndex === 0) {
            isDeleting = false;
            index = (index + 1) % texts.length;
        }
    }

    setTimeout(typeEffect, 60);
}

typeEffect();




