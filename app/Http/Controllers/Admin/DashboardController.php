<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Message;
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
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />'
            ],
            [
                'label' => 'Pesan masuk',
                'value' => Message::query()->count(),
                'caption' => 'Inquiry dari form footer website.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.909A2.25 2.25 0 0 1 2.25 8.671V6.75m19.5 0-8.928 5.493a2.25 2.25 0 0 1-2.344 0L2.25 6.75" />'
            ],
            [
                'label' => 'Project aktif',
                'value' => Project::query()->where('status', 'progress')->count(),
                'caption' => 'Project yang sedang dikerjakan saat ini.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />'
            ],
            [
                'label' => 'Tagihan belum dibayar',
                'value' => Invoice::query()->where('status', 'unpaid')->count(),
                'caption' => 'Tagihan yang masih menunggu pembayaran.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />'
            ],
        ];

        $contentStats = [
            [
                'label' => 'Layanan aktif',
                'value' => Service::query()->where('is_active', true)->count(),
                'description' => 'Layanan yang sudah tampil di website.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />'
            ],
            [
                'label' => 'Portfolio unggulan',
                'value' => Portfolio::query()->where('is_featured', true)->count(),
                'description' => 'Project featured yang memperkuat first impression.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.492-3.053c.217-.266.35-.591.38-.934l-1.258-5.32c-.066-.279-.292-.505-.57-.571L7.143 4.032c-.343-.03-.668.103-.934.32l-3.053 2.492a3.375 3.375 0 0 0-1.06 3.162l1.056 4.673c.045.198.198.35.396.396l4.673 1.056c1.036.233 2.12-.124 3.162-1.06Z" />'
            ],
            [
                'label' => 'Artikel tayang',
                'value' => BlogPost::query()->published()->count(),
                'description' => 'Konten blog yang sudah live dan siap mendatangkan traffic.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />'
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

        $recentContacts = Message::query()
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
