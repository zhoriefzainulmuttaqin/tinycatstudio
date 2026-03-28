<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        if (! $request->user()?->isAdmin()) {
            throw new AccessDeniedHttpException('Anda tidak memiliki akses ke area admin.');
        }

        $overviewStats = [
            [
                'label' => 'Lead baru',
                'value' => Lead::query()->where('status', 'new')->count(),
                'caption' => 'Prospek yang belum difollow-up.',
            ],
            [
                'label' => 'Pesan masuk',
                'value' => Contact::query()->count(),
                'caption' => 'Inquiry dari form footer website.',
            ],
            [
                'label' => 'Project aktif',
                'value' => Project::query()->where('status', 'progress')->count(),
                'caption' => 'Project yang sedang dikerjakan saat ini.',
            ],
            [
                'label' => 'Invoice unpaid',
                'value' => Invoice::query()->where('status', 'unpaid')->count(),
                'caption' => 'Tagihan yang masih menunggu pembayaran.',
            ],
        ];

        $contentStats = [
            [
                'label' => 'Layanan aktif',
                'value' => Service::query()->where('is_active', true)->count(),
                'description' => 'Layanan yang sudah tampil di website.',
            ],
            [
                'label' => 'Portfolio unggulan',
                'value' => Portfolio::query()->where('is_featured', true)->count(),
                'description' => 'Project featured yang memperkuat first impression.',
            ],
            [
                'label' => 'Artikel tayang',
                'value' => BlogPost::query()->published()->count(),
                'description' => 'Konten blog yang sudah live dan siap mendatangkan traffic.',
            ],
        ];

        $projectSummary = [
            'pending' => Project::query()->where('status', 'pending')->count(),
            'progress' => Project::query()->where('status', 'progress')->count(),
            'completed' => Project::query()->where('status', 'completed')->count(),
        ];

        $financialSummary = [
            'unpaidCount' => Invoice::query()->where('status', 'unpaid')->count(),
            'unpaidTotal' => (float) Invoice::query()->where('status', 'unpaid')->sum('amount'),
        ];

        $recentLeads = Lead::query()
            ->with('service:id,name')
            ->latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'phone', 'service_id', 'status', 'created_at']);

        $recentContacts = Contact::query()
            ->latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'message', 'created_at']);

        return view('admin.dashboard', [
            'siteSettings' => $this->siteSettings(),
            'user' => $request->user(),
            'overviewStats' => $overviewStats,
            'contentStats' => $contentStats,
            'projectSummary' => $projectSummary,
            'financialSummary' => $financialSummary,
            'recentLeads' => $recentLeads,
            'recentContacts' => $recentContacts,
        ]);
    }

    /**
     * @return array<string, string>
     */
    private function siteSettings(): array
    {
        return array_merge([
            'site_name' => 'TinyCatStudio',
            'site_tagline' => 'Software house premium untuk website, aplikasi mobile, branding, desain visual, dan digital ads.',
        ], Setting::query()->pluck('value', 'key')->all());
    }
}
