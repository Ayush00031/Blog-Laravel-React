Blog App (Laravel + React)

A full-stack blog application built using Laravel (backend) and React (frontend).
This app allows users to create, edit, delete, and manage blog posts with authentication and a clean UI.

📌 Features
🔐 User Authentication (Login/Register)
📝 Create, Edit, Delete Blog Posts
📄 View all blogs with pagination
❤️ Like / Comment system (optional if implemented)
🔍 Search functionality
📊 Dashboard for managing posts
⚡ REST API with Laravel
🎨 Responsive UI with React + Tailwind CSS
🛠️ Tech Stack
Backend:
Laravel
PHP
MySQL
Frontend:
React
Tailwind CSS
Axios
Other Tools:
JWT / Laravel Sanctum (for authentication)
REST API
📂 Project Structure
blog-laravel-react/
│
├── backend/        # Laravel API
│   ├── app/
│   ├── routes/
│   └── ...
│
├── frontend/       # React App
│   ├── src/
│   ├── components/
│   └── ...
│
└── README.md
⚙️ Installation & Setup
🔹 1. Clone the Repository
git clone https://github.com/your-username/blog-laravel-react.git
cd blog-laravel-react
🔹 2. Backend Setup (Laravel)
cd backend

composer install
cp .env.example .env
php artisan key:generate

👉 Configure .env file:

Database name
Username & password
php artisan migrate
php artisan serve

Backend will run on:

http://127.0.0.1:8000
🔹 3. Frontend Setup (React)
cd frontend

npm install
npm run dev

Frontend will run on:

http://localhost:5173
🔗 API Endpoints (Sample)
Method	Endpoint	Description
POST	/api/register	Register user
POST	/api/login	Login user
GET	/api/posts	Get all posts
POST	/api/posts	Create post
PUT	/api/posts/:id	Update post
DELETE	/api/posts/:id	Delete post

🌟 Future Improvements
📱 Mobile optimization
🔔 Notifications system
🧠 AI-based content suggestions
🌐 SEO optimization
🤝 Contributing

Contributions are welcome!

Fork the repo
Create a new branch
Make your changes
Submit a Pull Request
📄 License

This project is licensed under the MIT License.

👨‍💻 Author

Ayush Rawat

GitHub: https://github.com/your-username
⭐ Show Your Support

If you like this project, give it a ⭐ on GitHub!
