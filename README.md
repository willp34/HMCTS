Task Management CRUD API Demo
Overview
This project demonstrates a practical use of a CRUD API using Postman and a simple web-based frontend. It simulates a basic task management system with operations to Create, Read, Update, and Delete tasks.

Database Setup   


Create a database named hmtcs  and import to *.sql file
id (Primary Key)

title

description

status

due_date

created_by

created_at

Note: created_at should automatically store the date and time a task is created.

API Functionality
The API uses standard HTTP methods:

GET – Fetch all tasks (excluding overdue tasks).

POST – Create a new task.

PUT – Update an existing task.

DELETE – Remove a task.

Frontend
The frontend is built using Bootstrap and jQuery with a clean, simple layout. It includes:

A DataTables-powered view to display tasks in a searchable and sortable table.

A form above the table (rather than a modal) for creating and editing tasks.

Note: You may need to scroll up to see the form when editing.

Tasks that are overdue will not be displayed. Tasks nearing their due date will be highlighted in a panel for visibility.

Pages Included
A single-page version to demonstrate API integration.

A multi-task entry page for managing multiple tasks at once.

API Endpoints
GET /api/tasks – Retrieve tasks.

POST /api/tasks – Create a new task.

PUT /api/tasks/{id} – Update a task.

DELETE /api/tasks/{id} – Delete a task.

All endpoints are demonstrated using Postman.

Docker
A Dockerfile is included, but functionality is untested as Docker is not installed on the development machine.

Notes
This project is intended as a demo of basic CRUD API use.

The interface is simple, but functional for evaluation and development purposes.