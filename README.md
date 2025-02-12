---

# 🚀 Full-Stack Online Examination System  

![Laravel](https://img.shields.io/badge/Laravel-9.5.2-red?style=for-the-badge&logo=laravel)  
![MySQL](https://img.shields.io/badge/MySQL-Database-blue?style=for-the-badge&logo=mysql)  
![PHP](https://img.shields.io/badge/PHP-8.0-purple?style=for-the-badge&logo=php)  

## 🎓 Project Overview  
The Full-Stack Online Examination System is designed to simplify the examination process for both students and administrators. It provides a user-friendly interface for taking exams, managing subjects, handling results, and automating key processes.

I have created this project to enhance my skills in Laravel and gain hands-on experience in full-stack web development. Through this project, I have strengthened my understanding of backend logic, database management, and user authentication while implementing practical features for an online examination system.

## ✨ Features  

### 🧑‍🎓 **Student Panel**  
✅ **Secure Login & Password Recovery** via email.  
✅ **Exam Access** with a user-friendly interface.  
✅ **Approval System**: Receive notifications when exams are approved.  
✅ **Real-Time Updates**: Monitor exam status (Pending/Approved).  
✅ **Answer Review**: Check correct & incorrect answers with explanations.  
✅ **Marks & Results**: View pass/fail status.  
✅ **Auto-Submission**: Exams submit automatically when the time ends.  

### 👨‍💼 **Admin Panel**  
✅ **Subject Management**: Add, edit, and delete subjects.  
✅ **Question Bank**: Manage questions & import them from Excel files.  
✅ **Exam Management**: Create, assign subjects, and set time limits.  
✅ **Student Profiles**: Import/update student data from Excel.  
✅ **Email Notifications**: Send automated credentials & exam updates.  
✅ **Exam Review**: Approve/reject exams & provide feedback.  
✅ **Warnings & Alerts**: Notify admins about unapproved attempts.  
✅ **Mark Distribution**: Set passing marks & calculate scores.  

---

## 🛠️ Tech Stack  

| Technology | Description |
|------------|------------|
| **Frontend** | Laravel Blade (Bootstrap, HTML, CSS, JavaScript) |
| **Backend** | Laravel 9.5.2 (PHP Framework) |
| **Database** | MySQL |
| **Authentication** | Laravel Auth, Email Verification |
| **Excel Handling** | Laravel Excel for importing/exporting data |

---

## 🚀 Installation Guide  

### 🔹 **Prerequisites**  
Make sure you have the following installed:  
- [PHP (≥ 8.0)](https://www.php.net/downloads)  
- [Composer](https://getcomposer.org/)  
- [MySQL](https://dev.mysql.com/downloads/)  
- [Laravel](https://laravel.com/docs/9.x)  
- [Node.js & NPM](https://nodejs.org/en/)  

### 🔹 **Setup Steps**  

1️⃣ **Clone the Repository**  
```sh
git clone https://github.com/your-username/your-repository.git
cd your-repository
```  

2️⃣ **Install Dependencies**  
```sh
composer install
npm install
```  

3️⃣ **Set Up Environment File**  
```sh
cp .env.example .env
```  
- Update database details in `.env` file.  

4️⃣ **Generate Application Key**  
```sh
php artisan key:generate
```  

5️⃣ **Run Migrations & Seed Data**  
```sh
php artisan migrate --seed
```  

6️⃣ **Start the Development Server**  
```sh
php artisan serve
```  
The app will be available at **http://127.0.0.1:8000**  

---

## 📸 Screenshots  
_(Add screenshots of your project UI to make it visually appealing.)_  

---

## 📌 Future Enhancements  
🚀 Implement **Role-Based Access Control (RBAC)**.  
🚀 Add more **question types** (MCQs, True/False, Essay).  
🚀 Enable **real-time proctoring** with AI-based monitoring.  
🚀 Introduce an **analytics dashboard** for student performance tracking.  

---

## 🤝 Contributing  
🔹 Fork the repository.  
🔹 Create a new branch: `git checkout -b feature-name`  
🔹 Commit your changes: `git commit -m "Add feature"`  
🔹 Push to the branch: `git push origin feature-name`  
🔹 Open a **Pull Request**.  

---

## 📞 Contact  
📧 **Email:** (mailto:ahmadali43a5@gmail.com)  

---

## 📜 License  
This project is licensed under the **MIT License**.  

---

## 🔖 Hashtags  
`#Laravel #MySQL #WebDevelopment #OnlineExamination #EducationTech #FullStackDevelopment #SoftwareDevelopment #EdTech`  

---
