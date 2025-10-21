# 🛍️ Bazarkini — Laravel + Vue eCommerce Project

**Bazarkini** হলো একটি আধুনিক eCommerce ওয়েব অ্যাপ্লিকেশন, যা তৈরি করা হয়েছে **Laravel 12**, **Vue 3**, **Inertia.js**, এবং **Tailwind CSS** ব্যবহার করে।  
এই প্রোজেক্টে ইউজার ও অ্যাডমিন উভয়ের জন্য প্রয়োজনীয় ফিচারগুলো বাস্তবভাবে দেখানো হয়েছে।

---

## ⚙️ Tech Stack
- **Backend:** Laravel 12 (PHP 8+)
- **Frontend:** Vue 3 + Inertia.js
- **Database:** MySQL
- **Styling:** Tailwind CSS / Bootstrap 5
- **Authentication:** Laravel Breeze

---

## 🌟 Features

### 🧑‍💻 User Side
- Category ও Subcategory ভিত্তিক প্রোডাক্ট ব্রাউজিং  
- Flash Sale, Best Selling, Explore Section ইত্যাদি  
- Product search ও pagination  
- Product details page  
- Responsive design (mobile friendly)  

### 🛠 Admin Side
- Category / Subcategory CRUD  
- Brand Management  
- Product Create, Edit, Delete  
- Status toggle (Active / Inactive)  
- Image upload & validation system  

---




---

## 🚀 Installation Guide

**1️⃣ Clone the repository**
```bash
git clone https://github.com/sahinislam101/Bazarkini.git
cd Bazarkini
composer install
npm install
cp .env.example .env
php artisan key:generate
DB_DATABASE=bazarkini
DB_USERNAME=root
DB_PASSWORD=
php artisan migrate --seed
php artisan serve
npm run dev


