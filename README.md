# BlogPost

A brief description of what this project does and who it's for.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Installation

Follow these steps to set up the project on your local machine.

1. **Clone the repository:**

    ```sh
    git clone git@github.com:saad-alabyad78/BlogPost.git
    ```

2. **Navigate to the project directory:**

    ```sh
    cd BlogPost
    ```

3. **Install PHP dependencies using Composer:**

    ```sh
    composer install
    ```

4. **Copy the example environment file to `.env`:**

    ```sh
    cp .env.example .env
    ```

5. **Install JavaScript dependencies using npm:**

    ```sh
    npm install
    ```

6. **Generate the application key:**

    ```sh
    php artisan key:generate
    ```

## Usage

To run the project, use the following commands in separate terminals:

1. **Start the PHP server:**

    ```sh
    php artisan serve
    ```

2. **Compile assets using npm:**

    ```sh
    npm run dev
    ```

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
