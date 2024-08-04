document.addEventListener("DOMContentLoaded", function () {
    // Add interactivity if needed
});
document.addEventListener("DOMContentLoaded", function () {
    fetchVideos();

    function fetchVideos() {
        const apiKey ='AIzaSyCYUxc1OYHFHXlx91rzXDWHImH-lKjtHpE'; // Replace with your actual API key
        const channelId = 'UC1uU0sXucXtOvSwIAGBCnyQ';
        const maxResults = 6;
        const url = `https://www.googleapis.com/youtube/v3/search?key=${apiKey}&channelId=${channelId}&part=snippet,id&order=date&maxResults=${maxResults}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const videos = data.items;
                const videosContainer = document.getElementById('videosContainer');

                videos.forEach(video => {
                    const videoElement = document.createElement('div');
                    videoElement.className = 'bg-white rounded-lg shadow-md overflow-hidden';
                    videoElement.innerHTML = `
                        <img src="${video.snippet.thumbnails.high.url}" alt="${video.snippet.title}" class="w-full">
                        <div class="p-4">
                            <h3 class="font-bold text-xl mb-2">${video.snippet.title}</h3>
                            <p class="text-gray-600">${video.snippet.description}</p>
                        </div>
                    `;
                    videosContainer.appendChild(videoElement);
                });
            })
            .catch(error => console.error('Error fetching videos:', error));
    }
});
