Doctor Booking System
This is a Doctor Booking System developed using Laravel version 9, designed to facilitate appointments between patients and doctors.

Features
Appointment Module: Allows users to create, update, and view appointments.
User Roles: Supports patient and doctor roles with separate functionalities.
API Integration: Provides API endpoints for seamless integration with external systems.
Resource Collections: Utilizes Laravel's Resource Collections for structured API responses.
Jobs and Queues: Background job processing for tasks like appointment notifications.
Service Providers: Custom service provider for route registration and dependency binding.
CRON Jobs: Scheduled tasks for automated reminders and maintenance.


Installation
Clone the repository:https://github.com/rupesh17072000/example-app
Navigate to the project directory: cd doctor-booking-system
Install dependencies: composer install
Set up environment variables: Create a .env file by copying .env.example and configure database credentials.
Run migrations: php artisan migrate
Start the development server: php artisan serve


Usage
API Endpoints
Create Appointment: POST /api/appointments/create
Update Appointment Status: PUT /api/appointments/{id}/update-status
View Appointments: GET /api/appointments
Jobs and Queues
SendAppointmentNotification: Sends email notifications for appointments.
Service Providers
AppointmentServiceProvider: Registers API routes and dependencies.
CRON Jobs
Schedule appointments:send-reminders command for daily reminders.

Contributing
Fork the repository.
Create a new branch: git checkout -b feature/new-feature
Make your changes and commit: git commit -am 'Add new feature'
Push to the branch: git push origin feature/new-feature
Submit a pull request.
