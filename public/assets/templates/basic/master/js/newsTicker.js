// Fetch the news items from the backend
function fetchNewsItems() {
    fetch("/api/news-items")
        .then((response) => response.json())
        .then((newsItems) => displayNewsItems(newsItems));
}

// Display the fetched news items in a scrolling manner
function displayNewsItems(newsItems) {
    const newsTicker = document.getElementById("news-ticker");
    newsItems.forEach((newsItem) => {
        const newsItemElement = document.createElement("div");
        newsItemElement.textContent = newsItem.title;
        newsTicker.appendChild(newsItemElement);
    });
}

// Handle the responsiveness of the News Ticker
function handleResponsiveness() {
    const newsTicker = document.getElementById("news-ticker");
    window.addEventListener("resize", () => {
        const windowWidth = window.innerWidth;
        newsTicker.style.width = `${windowWidth}px`;
        newsTicker.style.animationDuration = `${windowWidth / 100}s`;
    });
}

// Call the functions
fetchNewsItems();
handleResponsiveness();
