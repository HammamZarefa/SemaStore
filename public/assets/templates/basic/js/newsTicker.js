// Import jQuery
const $ = require("jquery");

// Function to display news ticker
function displayNewsTicker(newsItems) {
    // Create news ticker container
    const newsTickerContainer = $('<div id="news-ticker"></div>');
    $("body").append(newsTickerContainer);

    // Loop through news items
    newsItems.forEach((item, index) => {
        // Create span for news item
        const newsItemSpan = $(`<span class="news-item">${item}</span>`);

        // Append news item to container with delay
        setTimeout(() => {
            newsTickerContainer.append(newsItemSpan);
        }, index * 2000); // 2 seconds delay between each news item
    });
}

// Export the function
module.exports = displayNewsTicker;
