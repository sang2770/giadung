// Lấy lịch sử tìm kiếm từ localStorage
const history = JSON.parse(localStorage.getItem('search_history')) || []; // giả sử lưu lịch sử trong localStorage

// Hàm hiển thị lịch sử tìm kiếm
function displaySearchHistory() {
    let historyList = document.getElementById('history-list');
    historyList.innerHTML = ''; // Xóa danh sách trước đó

    // Giới hạn chỉ hiển thị 3 kết quả tìm kiếm gần nhất
    let limitedHistory = history.slice(0, 3);

    if (limitedHistory.length > 0) {
        limitedHistory.forEach(item => {
            let listItem = document.createElement('li');
            listItem.classList.add('header__search-history-item');
            listItem.innerHTML = `<a href="#" onclick="searchHistory('${item}')">${item}</a>`;
            historyList.appendChild(listItem);
        });
    }
}

// Hiển thị lịch sử tìm kiếm khi chưa nhập gì
document.getElementById('search-input').addEventListener('focus', function () {
    if (this.value === '') {
        document.getElementById('search-history').style.display = 'block';
        document.getElementById('search-suggestions').style.display = 'none';
        displaySearchHistory();
    }
});

// Lắng nghe sự kiện input khi người dùng bắt đầu nhập
document.getElementById('search-input').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 2) {  // Chỉ tìm kiếm khi nhập ít nhất 3 ký tự
        fetch(`/search-suggestions?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let suggestionList = document.getElementById('suggestion-list');
                suggestionList.innerHTML = ''; // Xóa danh sách gợi ý cũ

                if (data.suggestions.length > 0) {
                    // Hiển thị gợi ý tìm kiếm
                    data.suggestions.forEach(suggestion => {
                        let listItem = document.createElement('li');
                        listItem.classList.add('header__search-history-item');
                        listItem.innerHTML = `<a href="#" onclick="searchSuggestion('${suggestion}')">${suggestion}</a>`;
                        suggestionList.appendChild(listItem);
                    });
                    document.getElementById('search-history').style.display = 'none';
                    document.getElementById('search-suggestions').style.display = 'block';
                } else {
                    document.getElementById('search-suggestions').style.display = 'none';
                }
            });
    } else {
        document.getElementById('search-suggestions').style.display = 'none';
    }
});

// Lắng nghe sự kiện khi người dùng nhấn Enter
document.getElementById('search-input').addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        let query = this.value;
        if (query) {
            // Lưu lịch sử tìm kiếm vào localStorage
            if (!history.includes(query)) {
                history.unshift(query); // Thêm vào đầu mảng
                if (history.length > 3) history.pop(); // Giới hạn 3 tìm kiếm gần nhất
                localStorage.setItem('search_history', JSON.stringify(history)); // Lưu lại vào localStorage
            }
            // Điều hướng đến trang cửa hàng với từ khóa tìm kiếm
            window.location.href = `/cua-hang?query=${query}`;
        }
    }
});

// Tìm kiếm từ lịch sử
function searchHistory(keyword) {
    document.getElementById('search-input').value = keyword;
    window.location.href = `/cua-hang?query=${keyword}`;
}

// Tìm kiếm từ gợi ý
function searchSuggestion(suggestion) {
    document.getElementById('search-input').value = suggestion;
    window.location.href = `/cua-hang?query=${suggestion}`;
}

// Lắng nghe sự kiện nhấn icon tìm kiếm
document.querySelector('.header__search-btn').addEventListener('click', function () {
    let query = document.getElementById('search-input').value;
    if (query) {
        // Lưu lịch sử tìm kiếm vào localStorage
        if (!history.includes(query)) {
            history.unshift(query); // Thêm vào đầu mảng
            if (history.length > 3) history.pop(); // Giới hạn 3 tìm kiếm gần nhất
            localStorage.setItem('search_history', JSON.stringify(history)); // Lưu lại vào localStorage
        }
        // Điều hướng đến trang cửa hàng với từ khóa tìm kiếm
        window.location.href = `/cua-hang?query=${query}`;
    }
});
