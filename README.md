# Portfolio Website with Admin Panel

Modern portfolio website built with Laravel featuring a complete admin panel for easy content management.

## Features

### Frontend Features
- 🎨 **Modern & Responsive Design** - Beautiful UI with animations and responsive layout
- ⚡ **Fast Performance** - Optimized for speed and smooth user experience
- 📱 **Mobile-Friendly** - Fully responsive design that works on all devices
- 🎭 **Animations** - AOS (Animate On Scroll) and custom CSS animations
- 🏷️ **Portfolio Showcase** - Display projects with categories and filtering
- 👤 **About Section** - Timeline, skills, and experience display
- 📞 **Contact Form** - Functional contact form with validation

### Admin Panel Features
- 🔐 **Authentication** - Secure login/register system with role-based access
- 📊 **Dashboard** - Overview with statistics and charts
- 📝 **Portfolio Management** - CRUD operations for portfolio items
- 💡 **Skills Management** - Add/Edit/Delete skills with proficiency levels
- 📅 **Experience Management** - Manage work experience entries
- 🎓 **Education Management** - Manage education history
- 📨 **Contact Management** - View and manage contact messages
- 👤 **User Management** - Admin/user role system

## Tech Stack

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates, Custom CSS, JavaScript
- **Database**: SQLite (can be configured for MySQL/PostgreSQL)
- **Authentication**: Laravel Breeze
- **Animations**: AOS (Animate On Scroll), Animate.css
- **Icons**: Font Awesome 6
- **Charts**: Chart.js (Admin Dashboard)

## Project Structure

```
portofolio-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   └── Admin/
│   │       ├── PortfolioItemController.php
│   │       └── SkillController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── PortfolioItem.php
│   │   └── ...
│   └── Http/Middleware/
│       └── AdminMiddleware.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── admin/
│   │   ├── layout.blade.php
│   │   └── dashboard.blade.php
│   ├── pages/
│   │   ├── home.blade.php
│   │   ├── about.blade.php
│   │   ├── portfolio.blade.php
│   │   └── contact.blade.php
│   └── auth/
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
└── public/
```

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd portofolio-laravel
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   - Edit `.env` file and set your database connection
   - Default uses SQLite (storage/database.sqlite)

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

## Default Admin Credentials

- **Email**: admin@portfolio.dev
- **Password**: password123

## Pages

### Public Pages
- `/` - Home page with hero section, about preview, skills, and portfolio
- `/about` - Detailed about page with timeline and services
- `/portfolio` - Portfolio showcase with filtering
- `/contact` - Contact form with information

### Admin Pages (Requires Authentication)
- `/admin/dashboard` - Admin dashboard with statistics
- `/admin/portfolio-items` - Manage portfolio items
- `/admin/skills` - Manage skills
- `/admin/experiences` - Manage work experiences
- `/admin/education` - Manage education
- `/admin/contacts` - View contact messages

## Customization

### Changing Colors
Edit CSS variables in `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary-color: #4f46e5;
    --secondary-color: #7c3aed;
    --dark-color: #1f2937;
    --light-color: #f9fafb;
}
```

### Adding New Sections
1. Create migration for new data table
2. Create model and controller
3. Add routes in `routes/web.php`
4. Create views in `resources/views/`
5. Add admin management interface

### Adding Animations
The project uses AOS (Animate On Scroll). Add `data-aos` attributes to elements:
```html
<div data-aos="fade-up" data-aos-delay="100">
    <!-- Content -->
</div>
```

## Database Schema

### Users
- id, name, email, password, role, avatar, bio, social_links, timestamps

### Portfolio Items
- id, title, slug, description, content, image, category, technologies, project_url, github_url, project_date, order, featured, published, timestamps

### Skills
- id, name, category, proficiency, order, icon, color, featured, timestamps

### Experiences
- id, position, company, location, start_date, end_date, current, description, technologies, order, timestamps

### Education
- id, degree, institution, location, start_date, end_date, current, description, grade, order, timestamps

### Contacts
- id, name, email, subject, message, read, read_at, timestamps

## Future Enhancements

1. **Blog System** - Add blog functionality with categories and tags
2. **Multi-language Support** - Internationalization (i18n)
3. **API Endpoints** - REST API for portfolio data
4. **Dark Mode** - Toggle between light and dark themes
5. **SEO Optimization** - Meta tags, sitemap, robots.txt
6. **Image Optimization** - Automatic image compression
7. **Caching** - Implement Redis caching for better performance
8. **Notifications** - Email notifications for new messages

## License

This project is open-source and available under the MIT License.

## Support

For support, email: support@portfolio.dev