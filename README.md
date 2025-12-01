# 💧 HydroHub - Hydroelectric Dam Management Platform

HydroHub is an innovative web application designed for comprehensive **management, monitoring, and AI-driven analysis** of hydroelectric dam operations. It provides role-based dashboards to serve both on-site dam managers and corporate oversight offices. The architecture is built on a Python/Flask API backend and a responsive HTML/JavaScript frontend.

---

## ✨ Features

* **API-Driven Architecture:** Utilizes a modern **Python (Flask)** REST API for backend logic, authentication, and data services, with an HTML/JS frontend that communicates via the Fetch API.
* **Secure Authentication:** User registration and login are handled via the Flask API, using **Email/Username** as the primary identifier, with passwords secured using **Bcrypt hashing**.
* **Integrated Data Model:** The database schema (`db.sql`) links registered users (`users` table) to their corresponding dam specifications (`dam_details` table), ensuring data partitioning and dam-specific access.

### Role-Based Subclasses (Dashboards)

The application provides distinct interfaces tailored to different operational and management needs:

1.  **Corporate Dashboard** (`corporate_dashboard.html`):
    * **Purpose:** High-level executive and managerial oversight.
    * **Content:** Displays essential Key Performance Indicators (KPIs) such as **Risk Level, Water Storage, Energy Production**, and recent operational logs across multiple monitored facilities.

2.  **Main Dashboard / Dam Manager Hub** (`main_dashboard.html`):
    * **Purpose:** Central navigational point for day-to-day dam operations and system status.
    * **Content:** Provides an executive summary of the specific dam, system status (e.g., *All Systems Operational*), **AI Insights** status, and **Active Alerts**.

3.  **AI Decision Center** (`ai_center.html`):
    * **Purpose:** Interactive tool for real-time decision support and risk mitigation.
    * **Content:** A simulated chat interface that provides instant, specific operational recommendations (e.g., *"The optimal action is to open 2 gates by 1 meter each to reduce the net inflow rate to zero."*).

* **Mobile Interface:** A separate layout (`mobile_home.html`, also reflected in `crop_dashboard.html`) is available for streamlined data submission and alert viewing on mobile devices.

---

## 🛠️ Technologies Used

| Category | Technology | Purpose |
| :--- | :--- | :--- |
| **Backend Framework** | Python (Flask) | RESTful API for handling user authentication and business logic. |
| **Database** | MySQL | Central data storage (Schema in `db.sql`). |
| **Authentication/Security** | Flask-Bcrypt | Secure password hashing and verification. |
| **Frontend** | HTML5, CSS3, JavaScript (Fetch API) | Structure, Styling, Client-side UI/UX, and communication with the Flask API. |
| **Styling/UI** | Custom CSS, Font Awesome, Google Fonts | Modern, visually appealing, and responsive design. |

---

## 🚀 Installation and Setup

To run HydroHub locally, you will need **Python 3** and a local **MySQL** server.

### 1. Backend (Flask) Setup

1.  **Install Dependencies:**
    ```bash
    pip install Flask Flask-Bcrypt mysql-connector-python Flask-CORS
    ```
2.  **Configure Database Connection:**
    Open `app.py` and update the MySQL connection parameters (`host`, `user`, `password`, `database`) if they differ from your local setup:
    ```python
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="<YOUR_MYSQL_PASSWORD>", # <-- Change this line
        database="hydrohub"
    )
    ```
3.  **Run the Flask Server:**
    ```bash
    python app.py
    ```
    The API will typically run on `http://127.0.0.1:5000/`.

### 2. Database Setup

1.  **Create Database:** Access your MySQL tool (e.g., phpMyAdmin) and execute the `db.sql` file to create the `hydrohub` database and the `users` and `dam_details` tables.

### 3. Frontend Deployment

1.  **Deploy Files:** Place all HTML files (`login.html`, `main_dashboard.html`, etc.) into a web-accessible directory (or simply open them directly in your browser).
2.  **Access the Application:** Open your web browser and navigate to the entry point:
    `http://localhost/path/to/your/project/login.html` (If served by a local web server)
    OR
    `file:///path/to/your/project/login.html` (If opening locally, assuming browser security allows the `fetch` API calls to `http://127.0.0.1:5000/`).

---

## 🔑 Authentication Details

The frontend (`login.html`) uses JavaScript to communicate directly with the Flask API (`app.py`) for user management.

| Action | Files/API Involved | Description |
| :--- | :--- | :--- |
| **Registration** | `/register` POST endpoint in `app.py` | User provides **Email, Username**, and Password. The password is hashed using Bcrypt before storage in the `users` table. |
| **Login** | `/login` POST endpoint in `app.py` | User submits **Email** and Password. The API fetches the stored hash and uses `bcrypt.check_password_hash()` for verification. |
| **Redirection** | `login.html` (JS) | On successful API response, the client-side JavaScript redirects the user to `dam-dashboard.html` (or similar main view). |
| **Data Linking** | `db.sql` Schema | The `dam_details` table is linked to the `users` table via `user_id` to associate operational data with the correct user account. |

---
