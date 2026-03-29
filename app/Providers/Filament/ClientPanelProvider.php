<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ClientPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('client')
            ->path('')
            ->domain('invoice.tinycatstudio.tech')
            ->login()
            ->authGuard('client')
            ->colors([
                'primary' => Color::Indigo,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'danger' => Color::Rose,
            ])
            ->font('Inter')
            ->favicon(asset('favicon.ico'))
            ->spa()
            ->sidebarCollapsibleOnDesktop()
            ->topNavigation()
            ->maxContentWidth('full')
            ->renderHook(
                \Filament\View\PanelsRenderHook::FOOTER,
                fn (): string => \Illuminate\Support\Facades\Blade::render('
                    <div class="mt-8 px-4 py-6 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 text-center text-sm text-gray-500 dark:text-gray-400">
                        <p>Enjoying this invoicing platform?</p>
                        <p class="mt-1">
                            We build custom SaaS, web apps, and management systems tailored to your business.<br class="sm:hidden" />
                            <a href="https://tinycatstudio.tech" target="_blank" class="font-semibold text-primary-600 hover:text-primary-500 hover:underline transition">
                                Let\'s collaborate at TinyCatStudio.tech &rarr;
                            </a>
                        </p>
                    </div>
                '),
            )
            ->brandName('TinyCat Invoicing')
            ->profile(\App\Filament\Client\Pages\Auth\EditProfile::class, isSimple: false)
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('Workspace & Brand')
                    ->url(fn (): string => filament()->getProfileUrl())
                    ->icon('heroicon-o-building-office-2')
                    ->sort(100),
            ])
            ->discoverResources(in: app_path('Filament/Client/Resources'), for: 'App\\Filament\\Client\\Resources')
            ->discoverPages(in: app_path('Filament/Client/Pages'), for: 'App\\Filament\\Client\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Client/Widgets'), for: 'App\\Filament\\Client\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                \App\Http\Middleware\CheckClientSubscription::class,
            ]);
    }
}
