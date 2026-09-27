<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioItem;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@portfolio.dev'],
            [
                'name' => 'Raffael Ezra Nugroho',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        Profile::updateOrCreate([], [
            'name' => 'Raffael Ezra Nugroho',
            'nickname' => 'Ren',
            'headline' => 'Web Developer & Mahasiswa Teknik Informatika',
            'short_bio' => 'Web developer yang sedang menempuh pendidikan di Universitas Dian Nuswantoro. Berpengalaman dalam membangun aplikasi web modern yang fungsional dan menarik.',
            'long_bio' => "## Tentang Saya\n\nHalo, saya **Ren**, mahasiswa Teknik Informatika di Universitas Dian Nuswantoro (UDINUS), Semarang.\n\nSaya sangat tertarik dengan **web development**, baik dari sisi frontend maupun backend. Saya senang belajar teknologi baru dan menerapkannya untuk membangun solusi digital yang bermanfaat.\n\nSelain kuliah, saya juga aktif di berbagai program dan komunitas untuk terus mengembangkan skill dan memperluas relasi.\n\n### Pengalaman Terbaru\n\n- Peserta Program Bengkel Koding UDINUS\n- Member Google Developer Group on Campus (GDGoC) UDINUS",
            'photo' => null,
            'location' => 'Semarang, Indonesia',
            'email' => 'ren@example.com',
            'cv_path' => null,
            'open_to_work' => true,
        ]);

        $projects = [
            [
                'title' => 'Web Reservation Udinus Sport Center',
                'slug' => 'web-reservation-udinus-sport-center',
                'description' => 'Platform reservasi fasilitas olahraga Udinus dengan sistem pembayaran terintegrasi.',
                'content' => "## Ringkasan\n\nSistem reservasi online untuk fasilitas Udinus Sport Center yang memudahkan mahasiswa dan umum untuk memesan jadwal secara real-time.\n\n## Peran Saya\n\nFull-Stack Developer: membangun UI/UX, sistem reservasi, dan integrasi payment gateway.\n\n## Fitur Utama\n\n- Jadwal & ketersediaan real-time\n- Integrasi Payment Gateway API\n- Dashboard admin",
                'role' => 'Full-Stack Developer',
                'image' => null,
                'category' => 'Web Application',
                'technologies' => ['Next.js', 'Tailwind CSS', 'Shadcn UI', 'Payment Gateway API'],
                'project_url' => null,
                'github_url' => null,
                'project_date' => '2024-01-01',
                'year' => '2024',
                'order' => 1,
                'featured' => true,
                'published' => true,
            ],
            [
                'title' => 'MedRec',
                'slug' => 'medrec',
                'description' => 'Web Rekam Medis dengan integrasi Supabase dan enkripsi data untuk keamanan.',
                'content' => "## Ringkasan\n\nAplikasi web untuk mengelola rekam medis pasien secara digital dengan standar keamanan tinggi.\n\n## Peran Saya\n\nFull-Stack Developer: mengurus arsitektur database, enkripsi data, dan antarmuka pengguna.\n\n## Fitur Utama\n\n- Manajemen data pasien\n- Integrasi Supabase\n- Enkripsi data sensitif",
                'role' => 'Full-Stack Developer',
                'image' => null,
                'category' => 'Web Application',
                'technologies' => ['HTML', 'CSS', 'JavaScript', 'Supabase'],
                'project_url' => null,
                'github_url' => null,
                'project_date' => '2023-06-01',
                'year' => '2023',
                'order' => 2,
                'featured' => true,
                'published' => true,
            ],
            [
                'title' => 'Custom Web-based Live Stream Overlays',
                'slug' => 'custom-web-based-live-stream-overlays',
                'description' => 'Overlay interaktif berbasis web untuk keperluan live streaming.',
                'content' => "## Ringkasan\n\nKumpulan overlay dinamis yang bisa diintegrasikan dengan OBS atau software streaming lainnya menggunakan browser source.\n\n## Peran Saya\n\nFrontend Developer: membuat animasi dan integrasi data real-time.\n\n## Fitur Utama\n\n- Animasi interaktif\n- Ringan dan responsif\n- Mudah dikustomisasi",
                'role' => 'Frontend Developer',
                'image' => null,
                'category' => 'Web Tool',
                'technologies' => ['HTML', 'CSS', 'JavaScript'],
                'project_url' => null,
                'github_url' => null,
                'project_date' => '2022-01-01',
                'year' => '2022',
                'order' => 3,
                'featured' => false,
                'published' => true,
            ],
        ];

        foreach ($projects as $project) {
            PortfolioItem::updateOrCreate(['slug' => $project['slug']], $project);
        }

        $experiences = [
            [
                'position' => 'Peserta Program',
                'company' => 'Bengkel Koding UDINUS',
                'location' => 'Semarang',
                'type' => 'work',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'current' => true,
                'description' => 'Mengikuti program intensif untuk meningkatkan kemampuan programming dan problem solving.',
                'technologies' => ['PHP', 'Laravel', 'JavaScript'],
                'order' => 1,
            ],
            [
                'position' => 'Member',
                'company' => 'Google Developer Group on Campus (GDGoC) UDINUS',
                'location' => 'Semarang',
                'type' => 'organization',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'current' => true,
                'description' => 'Aktif berpartisipasi dalam event dan workshop seputar teknologi Google dan pengembangan software modern.',
                'technologies' => ['Web Development'],
                'order' => 2,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(
                ['position' => $experience['position'], 'company' => $experience['company']],
                $experience
            );
        }

        $skills = [
            ['name' => 'HTML', 'category' => 'Frontend', 'order' => 1],
            ['name' => 'CSS', 'category' => 'Frontend', 'order' => 2],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'order' => 3],
            ['name' => 'PHP', 'category' => 'Backend', 'order' => 4],
            ['name' => 'Laravel', 'category' => 'Backend', 'order' => 5],
            ['name' => 'Next.js', 'category' => 'Frontend', 'order' => 6],
            ['name' => 'React', 'category' => 'Frontend', 'order' => 7],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'order' => 8],
            ['name' => 'Bootstrap', 'category' => 'Frontend', 'order' => 9],
            ['name' => 'Supabase', 'category' => 'Backend', 'order' => 10],
            ['name' => 'Figma', 'category' => 'Tools', 'order' => 11],
            ['name' => 'Linux', 'category' => 'Tools', 'order' => 12],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        Education::updateOrCreate(
            ['institution' => 'Universitas Dian Nuswantoro', 'degree' => 'S1 Teknik Informatika'],
            [
                'location' => 'Semarang',
                'start_date' => '2021-08-01',
                'end_date' => null,
                'current' => true,
                'description' => 'Sedang menempuh pendidikan sarjana dengan fokus pada pengembangan perangkat lunak.',
                'grade' => null,
                'order' => 1,
            ]
        );

        $socials = [
            ['platform' => 'GitHub', 'url' => 'https://github.com/', 'order' => 1],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/', 'order' => 2],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/', 'order' => 3],
        ];

        foreach ($socials as $social) {
            SocialLink::updateOrCreate(['platform' => $social['platform']], $social);
        }

        Contact::create([
            'name' => 'Client',
            'email' => 'client@example.com',
            'subject' => 'Ajakan Kerjasama',
            'message' => 'Halo Ren, saya tertarik dengan portofolio web Anda.',
            'read' => false,
        ]);
    }
}