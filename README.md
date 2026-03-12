# MarocExplore API 🌍

MarocExplore is a RESTful API built with Laravel for managing tourist itineraries and destinations in Morocco. It allows users to register, create custom trips with multiple destinations, explore popular routes, and save their favorite itineraries.

## Features ✨

*   **API Authentication:** Secure user registration and login using Laravel Sanctum.
*   **Itinerary Management:** Complete CRUD functionality for itineraries. Only authenticated authors can update or delete their own trips.
*   **Destination Handling:** Create detailed itineraries that require a minimum of 2 destinations (including rental locations, activities, and dishes to try).
*   **Query Builder & Statistics:**
    *   Filter itineraries by category and duration.
    *   Search itineraries by title keyword.
    *   Fetch the most *popular* itineraries based on the number of user favorites.
    *   Retrieve aggregate statistics (Total itineraries by category, Total user registrations by month).
*   **Favorites (Liste à visiter):** Users can toggle their favorite itineraries to save them for later.

## Technologies Used 🛠️

*   **Framework:** Laravel 11.x
*   **Language:** PHP 8.2+
*   **Database:** PostgreSQL
*   **Authentication:** Laravel Sanctum (Token-based)
*   **Testing/Documentation:** Postman

## Installation & Setup 🚀

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/imadprogram/touristApi.git
    cd touristApi
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    ```

3.  **Environment Setup:**
    Duplicate the `.env.example` file and rename it to `.env`. Update the database configuration to match your local PostgreSQL setup:
    ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=touristapi
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations:**
    This will create all the necessary tables (`users`, `itineraries`, `categories`, `destinations`, and `itinerary_user`).
    ```bash
    php artisan migrate
    ```

6.  **Start the Local Development Server:**
    ```bash
    php artisan serve
    ```
    The API will be available at `http://localhost:8000`.

## API Documentation 📚

The API follows RESTful principles. Most endpoints return JSON data. 
*Note: Endpoints involving creation, modification, deletion, or favoriting require a Bearer Token (Sanctum) obtained via the \`/api/login\` or \`/api/register\` routes.*

Detailed documentation, including request bodies and example responses, can be viewed by importing the Postman Collection.
