<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Invoice;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TinyCatStudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'TinyCatStudio Admin',
            'email' => 'admin@tinycatstudio.tech',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'TinyCatStudio Staff',
            'email' => 'staff@tinycatstudio.tech',
            'password' => 'password',
            'role' => 'staff',
        ]);

        $services = collect([
            [
                'name' => 'Website Development',
                'description' => 'Pembuatan website company profile, landing page, katalog, hingga sistem web custom yang cepat, SEO-friendly, dan mudah dikembangkan.',
                'icon' => 'WEB',
                'details' => [
                    ['title' => 'Custom UI/UX', 'description' => 'Tampilan dibuat selaras dengan karakter brand dan tujuan bisnis.'],
                    ['title' => 'SEO Friendly', 'description' => 'Struktur halaman dan konten disiapkan agar lebih mudah bersaing di mesin pencari.'],
                    ['title' => 'Fast Loading', 'description' => 'Optimasi performa agar pengalaman pengguna tetap mulus di berbagai perangkat.'],
                ],
                'packages' => [
                    [
                        'name' => 'Starter Website',
                        'price' => 6500000,
                        'description' => 'Cocok untuk company profile profesional dengan halaman inti dan CTA yang jelas.',
                        'is_popular' => false,
                        'features' => ['Maksimal 6 halaman', 'Responsive design', 'Basic SEO setup', 'WhatsApp CTA'],
                    ],
                    [
                        'name' => 'Growth Website',
                        'price' => 12500000,
                        'description' => 'Untuk bisnis yang butuh website lebih strategis, cepat, dan siap scale.',
                        'is_popular' => true,
                        'features' => ['Maksimal 12 halaman', 'CMS integration', 'Technical SEO', 'Conversion-focused section'],
                    ],
                ],
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Pengembangan aplikasi mobile Android dan iOS untuk kebutuhan internal bisnis, customer app, hingga MVP startup.',
                'icon' => 'APP',
                'details' => [
                    ['title' => 'MVP Ready', 'description' => 'Validasi ide lebih cepat dengan fitur yang tepat sasaran.'],
                    ['title' => 'Scalable Architecture', 'description' => 'Struktur aplikasi dipikirkan sejak awal agar mudah dikembangkan.'],
                    ['title' => 'API Integration', 'description' => 'Siap terhubung dengan backend, payment gateway, dan third-party service.'],
                ],
                'packages' => [
                    [
                        'name' => 'MVP Mobile App',
                        'price' => 25000000,
                        'description' => 'Paket awal untuk validasi produk digital dengan fitur inti.',
                        'is_popular' => false,
                        'features' => ['2 user flows utama', 'UI prototyping', 'API integration dasar', 'Publishing assistance'],
                    ],
                    [
                        'name' => 'Business App',
                        'price' => 45000000,
                        'description' => 'Aplikasi untuk operasional bisnis atau layanan customer-facing yang lebih lengkap.',
                        'is_popular' => true,
                        'features' => ['Multi-role app', 'Push notification', 'Analytics setup', 'QA & deployment'],
                    ],
                ],
            ],
            [
                'name' => 'Logo Design',
                'description' => 'Perancangan logo yang kuat secara konsep, mudah diaplikasikan, dan konsisten dengan positioning brand.',
                'icon' => 'LOGO',
                'details' => [
                    ['title' => 'Brand Direction', 'description' => 'Eksplorasi arah visual yang sesuai dengan karakter brand.'],
                    ['title' => 'Versatile Usage', 'description' => 'Logo disiapkan agar aman dipakai di media digital dan cetak.'],
                    ['title' => 'Clear Delivery', 'description' => 'File akhir rapi dan mudah digunakan tim Anda.'],
                ],
                'packages' => [
                    [
                        'name' => 'Essential Logo',
                        'price' => 2500000,
                        'description' => 'Logo profesional untuk bisnis baru yang ingin tampil lebih kredibel.',
                        'is_popular' => false,
                        'features' => ['2 konsep awal', '2x revisi', 'File PNG, SVG, PDF', 'Basic usage guideline'],
                    ],
                    [
                        'name' => 'Strategic Brand Mark',
                        'price' => 5500000,
                        'description' => 'Logo dengan eksplorasi konsep yang lebih dalam dan aplikasi visual lebih luas.',
                        'is_popular' => true,
                        'features' => ['3 konsep awal', 'Brand rationale', 'Mini visual guide', 'Asset delivery lengkap'],
                    ],
                ],
            ],
            [
                'name' => 'Graphic Design',
                'description' => 'Desain visual untuk kebutuhan sosial media, presentasi, materi promosi, dan asset campaign yang konsisten.',
                'icon' => 'GFX',
                'details' => [
                    ['title' => 'Social Media Kit', 'description' => 'Template visual untuk menjaga konsistensi konten brand.'],
                    ['title' => 'Campaign Asset', 'description' => 'Banner, poster, feed, dan kebutuhan promosi lain.'],
                    ['title' => 'Presentation Design', 'description' => 'Materi pitch deck atau company profile yang lebih meyakinkan.'],
                ],
                'packages' => [
                    [
                        'name' => 'Content Design Kit',
                        'price' => 1800000,
                        'description' => 'Paket desain berkala untuk kebutuhan visual bisnis yang aktif di media sosial.',
                        'is_popular' => true,
                        'features' => ['10 desain feed', 'Story template', 'Source file', '1x revisi per desain'],
                    ],
                    [
                        'name' => 'Campaign Visual Pack',
                        'price' => 3500000,
                        'description' => 'Cocok untuk launching promo, event, atau campaign musiman.',
                        'is_popular' => false,
                        'features' => ['Key visual', 'Resize multi-format', 'Banner ads set', 'Priority revision'],
                    ],
                ],
            ],
            [
                'name' => 'Ads Management',
                'description' => 'Pengelolaan iklan digital untuk Meta Ads dan Google Ads dengan fokus pada leads, awareness, dan penjualan.',
                'icon' => 'ADS',
                'details' => [
                    ['title' => 'Campaign Strategy', 'description' => 'Strategi campaign disesuaikan dengan funnel dan objektif bisnis.'],
                    ['title' => 'Creative Direction', 'description' => 'Visual dan copy iklan diarahkan agar relevan dengan target market.'],
                    ['title' => 'Optimization', 'description' => 'Monitoring, evaluasi, dan optimasi rutin untuk performa lebih stabil.'],
                ],
                'packages' => [
                    [
                        'name' => 'Lead Booster Ads',
                        'price' => 3000000,
                        'description' => 'Manajemen iklan dasar untuk bisnis yang ingin mulai konsisten menjalankan campaign.',
                        'is_popular' => false,
                        'features' => ['1 platform ads', 'Audience setup', 'Monthly report', 'Basic optimization'],
                    ],
                    [
                        'name' => 'Growth Ads Retainer',
                        'price' => 6000000,
                        'description' => 'Paket retainer untuk bisnis yang butuh performa iklan lebih agresif dan terukur.',
                        'is_popular' => true,
                        'features' => ['2 platform ads', 'Creative direction', 'Weekly optimization', 'Performance dashboard'],
                    ],
                ],
            ],
        ])->map(function (array $serviceData) {
            $service = Service::create([
                'name' => $serviceData['name'],
                'slug' => Str::slug($serviceData['name']),
                'description' => $serviceData['description'],
                'icon' => $serviceData['icon'],
                'is_active' => true,
            ]);

            foreach ($serviceData['details'] as $detail) {
                $service->serviceDetails()->create($detail);
            }

            foreach ($serviceData['packages'] as $package) {
                $createdPackage = $service->pricingPackages()->create([
                    'name' => $package['name'],
                    'price' => $package['price'],
                    'description' => $package['description'],
                    'is_popular' => $package['is_popular'],
                ]);

                foreach ($package['features'] as $index => $feature) {
                    $createdPackage->features()->create([
                        'feature' => $feature,
                        'sort_order' => $index + 1,
                    ]);
                }
            }

            return $service;
        })->keyBy('slug');

        $portfolioData = [
            [
                'title' => 'Finloop Company Profile',
                'client_name' => 'Finloop',
                'service_slug' => 'website-development',
                'description' => 'Website company profile fintech dengan struktur layanan yang jelas, CTA konsultasi, dan halaman artikel untuk mendukung SEO.',
                'thumbnail' => 'https://placehold.co/1200x900/0a0a0a/ffffff?text=Finloop+Website',
                'project_url' => 'https://example.com/finloop',
                'is_featured' => true,
                'images' => [
                    'https://placehold.co/1200x900/121212/ff7a00?text=Finloop+Home',
                    'https://placehold.co/1200x900/111111/ffffff?text=Finloop+Services',
                    'https://placehold.co/1200x900/1c1c1c/ff7a00?text=Finloop+SEO+Page',
                ],
            ],
            [
                'title' => 'PetCare Mobile App MVP',
                'client_name' => 'PetCare+',
                'service_slug' => 'mobile-app-development',
                'description' => 'Aplikasi mobile untuk booking grooming dan konsultasi, dengan onboarding sederhana dan dashboard admin terhubung API.',
                'thumbnail' => 'https://placehold.co/1200x900/0b0b0b/ffffff?text=PetCare+App',
                'project_url' => null,
                'is_featured' => true,
                'images' => [
                    'https://placehold.co/1200x900/121212/ff7a00?text=PetCare+Onboarding',
                    'https://placehold.co/1200x900/111111/ffffff?text=PetCare+Booking',
                    'https://placehold.co/1200x900/1c1c1c/ff7a00?text=PetCare+Dashboard',
                ],
            ],
            [
                'title' => 'Sora Coffee Brand Identity',
                'client_name' => 'Sora Coffee',
                'service_slug' => 'logo-design',
                'description' => 'Perancangan logo dan sistem visual untuk coffee shop yang ingin tampil modern namun tetap hangat dan mudah diingat.',
                'thumbnail' => 'https://placehold.co/1200x900/101010/ffffff?text=Sora+Coffee+Logo',
                'project_url' => null,
                'is_featured' => true,
                'images' => [
                    'https://placehold.co/1200x900/151515/ff7a00?text=Logo+Exploration',
                    'https://placehold.co/1200x900/0d0d0d/ffffff?text=Brand+Applications',
                ],
            ],
            [
                'title' => 'Skina Campaign Visual',
                'client_name' => 'Skina Beauty',
                'service_slug' => 'graphic-design',
                'description' => 'Produksi key visual, feed design, dan landing campaign untuk promo seasonal brand kecantikan.',
                'thumbnail' => 'https://placehold.co/1200x900/111111/ffffff?text=Skina+Campaign',
                'project_url' => null,
                'is_featured' => false,
                'images' => [
                    'https://placehold.co/1200x900/1a1a1a/ff7a00?text=Campaign+KV',
                    'https://placehold.co/1200x900/0f0f0f/ffffff?text=Feed+Series',
                ],
            ],
            [
                'title' => 'Ruang Law Leads Campaign',
                'client_name' => 'Ruang Law',
                'service_slug' => 'ads-management',
                'description' => 'Setup funnel landing page dan campaign iklan untuk meningkatkan jumlah leads konsultasi hukum secara konsisten.',
                'thumbnail' => 'https://placehold.co/1200x900/0d0d0d/ffffff?text=Ruang+Law+Ads',
                'project_url' => null,
                'is_featured' => false,
                'images' => [
                    'https://placehold.co/1200x900/151515/ff7a00?text=Ads+Dashboard',
                    'https://placehold.co/1200x900/121212/ffffff?text=Landing+Performance',
                ],
            ],
        ];

        foreach ($portfolioData as $item) {
            $portfolio = Portfolio::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'client_name' => $item['client_name'],
                'service_id' => $services[$item['service_slug']]->id,
                'description' => $item['description'],
                'thumbnail' => $item['thumbnail'],
                'project_url' => $item['project_url'],
                'is_featured' => $item['is_featured'],
            ]);

            foreach ($item['images'] as $image) {
                $portfolio->images()->create(['image' => $image]);
            }
        }

        Testimonial::insert([
            [
                'name' => 'Rizky Maulana',
                'company' => 'Finloop',
                'message' => 'Tim TinyCatStudio cepat memahami kebutuhan bisnis kami. Website baru terasa jauh lebih profesional dan conversion-oriented.',
                'rating' => 5,
                'photo' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nadia Putri',
                'company' => 'PetCare+',
                'message' => 'Komunikasi enak, timeline jelas, dan hasil aplikasinya rapi. Cocok untuk startup yang butuh partner eksekusi.',
                'rating' => 5,
                'photo' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andra Wijaya',
                'company' => 'Sora Coffee',
                'message' => 'Logo dan identitas visual yang dibuat sangat membantu brand kami tampil lebih premium dan konsisten.',
                'rating' => 5,
                'photo' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meylisa',
                'company' => 'Ruang Law',
                'message' => 'TinyCatStudio tidak hanya jalankan iklan, tapi juga bantu perbaiki funnel supaya leads yang masuk lebih relevan.',
                'rating' => 5,
                'photo' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $categories = collect([
            Category::create(['name' => 'Website', 'slug' => 'website']),
            Category::create(['name' => 'Mobile App', 'slug' => 'mobile-app']),
            Category::create(['name' => 'Branding', 'slug' => 'branding']),
            Category::create(['name' => 'Digital Ads', 'slug' => 'digital-ads']),
        ])->keyBy('slug');

        $posts = [
            [
                'title' => 'Kenapa Website Company Profile Masih Jadi Aset Digital Penting di 2026',
                'thumbnail' => 'https://placehold.co/1200x900/0a0a0a/ffffff?text=Website+Strategy',
                'content' => "Website company profile bukan sekadar formalitas. Untuk banyak bisnis, website adalah tempat pertama calon klien membentuk persepsi tentang kualitas brand Anda.\n\nWebsite yang baik membantu menjelaskan layanan, menampilkan portfolio, membangun trust, dan mengarahkan pengunjung ke aksi yang diinginkan. Jika dirancang dengan struktur yang tepat, website juga bisa menjadi mesin akuisisi leads lewat SEO dan landing page.\n\nKarena itu, investasi pada website bukan hanya soal tampilan, tetapi juga tentang positioning, performa, dan kemudahan update ke depan.",
                'categories' => ['website'],
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Cara Menentukan Scope MVP Mobile App Supaya Launch Lebih Cepat',
                'thumbnail' => 'https://placehold.co/1200x900/0d0d0d/ffffff?text=MVP+Mobile+App',
                'content' => "Banyak produk digital gagal launch cepat karena terlalu banyak fitur di fase awal. MVP yang efektif harus fokus pada satu masalah utama pengguna dan satu outcome bisnis yang jelas.\n\nMulailah dengan memetakan user flow paling penting. Setelah itu, prioritaskan fitur yang benar-benar dibutuhkan untuk memvalidasi hipotesis awal. Fitur tambahan bisa masuk ke roadmap setelah ada feedback nyata dari pengguna.\n\nPendekatan ini membantu tim menekan biaya, mempercepat validasi, dan menjaga kualitas eksekusi.",
                'categories' => ['mobile-app'],
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'Landing Page + Ads: Kombinasi Sederhana yang Sering Dilupakan Saat Cari Leads',
                'thumbnail' => 'https://placehold.co/1200x900/101010/ffffff?text=Landing+Page+Ads',
                'content' => "Iklan yang baik akan sia-sia jika diarahkan ke halaman yang tidak fokus. Karena itu, landing page harus dirancang sebagai pasangan langsung dari campaign ads Anda.\n\nHeadline, visual, CTA, dan informasi penawaran harus selaras dengan intent audiens yang datang dari iklan. Semakin sedikit distraksi dan semakin jelas value proposition, semakin besar peluang konversi.\n\nKunci utamanya bukan traffic semata, tetapi pengalaman yang konsisten dari iklan hingga form masuk.",
                'categories' => ['digital-ads', 'website'],
                'published_at' => Carbon::now()->subDays(3),
            ],
        ];

        foreach ($posts as $item) {
            $post = BlogPost::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'content' => $item['content'],
                'thumbnail' => $item['thumbnail'],
                'is_published' => true,
                'published_at' => $item['published_at'],
            ]);

            $post->categories()->sync(
                collect($item['categories'])->map(fn (string $slug) => $categories[$slug]->id)->all()
            );
        }

        Faq::insert([
            [
                'question' => 'Apakah TinyCatStudio bisa mengerjakan project custom?',
                'answer' => 'Ya. Kami bisa menyesuaikan scope, fitur, desain, dan integrasi sesuai kebutuhan bisnis Anda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Apakah bisa request maintenance setelah project selesai?',
                'answer' => 'Bisa. Kami menyediakan opsi retainer maintenance untuk kebutuhan update, monitoring, dan optimasi lanjutan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Berapa lama proses pengerjaan website?',
                'answer' => 'Tergantung kompleksitas project. Untuk website company profile umumnya 2 sampai 5 minggu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Apakah bisa bantu menyiapkan konten dan copywriting?',
                'answer' => 'Bisa. Kami dapat membantu menyusun struktur konten, headline, CTA, hingga materi visual pendukung.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Apakah iklan digital sudah termasuk budget ads?',
                'answer' => 'Biaya jasa pengelolaan iklan terpisah dari budget ads. Budget iklan akan disesuaikan dengan target campaign Anda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Setting::insert([
            ['key' => 'site_name', 'value' => 'TinyCatStudio', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_tagline', 'value' => 'Software house dan creative studio untuk website, mobile app, branding, desain visual, dan digital ads.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'whatsapp_number', 'value' => '+62 812-3456-7890', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'email', 'value' => 'hello@tinycatstudio.tech', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'address', 'value' => 'Indonesia', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'logo', 'value' => 'TCS', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'about_us_title', 'value' => 'Lebih dari Sekadar Vendor, Kami Adalah Partner Growth Digital Anda.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'about_us_description', 'value' => 'TinyCatStudio berawal dari satu keyakinan sederhana: produk digital yang luar biasa tidak lahir dari barisan kode dan desain yang dikerjakan secara mekanis, melainkan dari pemahaman mendalam tentang audiens dan visi bisnis Anda. Kami hadir bukan sekadar untuk menyelesaikan tiket tugas, tapi untuk membangun aset digital premium—mulai dari website elegan, aplikasi mobile yang scalable, hingga branding yang tajam—yang benar-benar bekerja untuk mendatangkan konversi dan mengangkat value brand Anda di mata pasar.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'about_us_image', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $project = Project::create([
            'client_name' => 'Finloop',
            'service_id' => $services['website-development']->id,
            'status' => 'progress',
            'start_date' => Carbon::now()->subDays(14),
            'end_date' => Carbon::now()->addDays(14),
        ]);

        Invoice::create([
            'project_id' => $project->id,
            'amount' => 12500000,
            'status' => 'unpaid',
            'due_date' => Carbon::now()->addDays(7),
        ]);
    }
}
