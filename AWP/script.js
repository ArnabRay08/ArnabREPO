document.addEventListener("DOMContentLoaded", () => {
    const locationInput = document.getElementById("locationInput");
    const getWeatherBtn = document.getElementById("getWeatherBtn");
    const unitSelect = document.getElementById("unitSelect");
    const weatherDisplay = document.getElementById("weatherDisplay");
    const errorDisplay = document.getElementById("errorDisplay");

    getWeatherBtn.addEventListener("click", () => {
        const location = locationInput.value;
        const unit = unitSelect.value;

        if (location.trim() === "") {
            showError("Please enter a location.");
            return;
        }
        
        const apiKey = "3192c1b402e655d6cb7206a27ed143c9";
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${location}&units=${unit}&appid=${apiKey}`;

        fetch(apiUrl)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Weather data not found.");
                }
                return response.json();
            })
            .then((data) => {
                displayWeather(data);
            })
            .catch((error) => {
                showError(error.message);
            });

        const geolocationBtn = document.getElementById("geolocationBtn");
        geolocationBtn.addEventListener("click", () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                const unit = unitSelect.value;
    
                const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=${unit}&appid=${apiKey}`;
    
                fetch(apiUrl)
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Weather data not found.");
                        }
                        return response.json();
                    })
                    .then((data) => {
                        displayWeather(data);
                    })
                    .catch((error) => {
                        showError(error.message);
                    });
            });
        } else {
            showError("Geolocation is not supported in your browser.");
        }
     });
    });
    

    function displayWeather(data) {
        const temperature = data.main.temp;
        const humidity = data.main.humidity;
        const windSpeed = data.wind.speed;
        const description = data.weather[0].description;

        const unitSymbol = unitSelect.value === "metric" ? "°C" : "°F";

        const weatherHTML = `
            <div class="weather-card">
                <h2>${data.name}, ${data.sys.country}</h2>
                <p>Temperature: ${temperature} ${unitSymbol}</p>
                <p>Humidity: ${humidity}%</p>
                <p>Wind Speed: ${windSpeed} m/s</p>
                <p>Description: ${description}</p>
            </div>
        `;

        weatherDisplay.innerHTML = weatherHTML;
        errorDisplay.innerHTML = "";
    }

    function showError(message) {
        errorDisplay.innerHTML = `<div class="error-card">${message}</div>`;
        weatherDisplay.innerHTML = "";
    }

 
});
