# Soil Moisture Monitor - IoT Project

This project is an IoT-based soil moisture monitoring system built with Laravel. It collects data from ThingSpeak by soil moisture sensors, consume the API and displays it on a web interface. The data can be viewed in real-time, and the system includes various functionalities such as setting wet and dry values, manual water records, and more.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [License](#license)

## Features

- Collects soil moisture data from sensors to ThingSpeak.
- Collects data consuming the API.
- Displays data on a responsive web interface.
- Real-time data visualization.
- Configurable wet and dry values.
- Manual water record tracking.
- Email notifications based on soil moisture levels.

## Installation

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL
- Node.js and npm
- Laravel 11.x

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/soil-moisture-monitor.git
    cd soil-moisture-monitor
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    npm run dev
    ```

3. Copy the `.env` file and configure your environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Set up your database and run migrations:
    ```bash
    php artisan migrate
    ```

5. Seed the database (optional):
    ```bash
    php artisan db:seed
    ```

6. Start the local development server:
    ```bash
    php artisan serve
    ```

## Usage

- Access the web interface at `http://localhost:8000`.
- View soil moisture data in real-time.
- Configure sensor settings and monitor soil conditions.

## Configuration

- Update the `.env` file with your database credentials and other environment-specific settings.
- Configure email settings in the `.env` file for email notifications.

## API Endpoints

- `GET /api/data`: Retrieve the latest soil moisture data.
- `POST /api/data`: Submit new soil moisture data.
- `GET /api/config`: Retrieve sensor configuration settings.
- `POST /api/config`: Update sensor configuration settings.

## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m 'Add your feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
